<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 9:13
 */

namespace app\api\service;

use app\api\model\User;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;



class UserToken extends Token
{
    protected $code;   // 客户端传过来code
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;
    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(
            config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    /**
     *
     * 登陆
     * 思路1：每次调用登录接口都去微信刷新一次session_key，生成新的Token，不删除久的Token
     * 思路2：检查Token有没有过期，没有过期则直接返回当前Token
     * 思路3：重新去微信刷新session_key并删除当前Token，返回新的Token
     * @return （Token）
     * @throws
     */
    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if (empty($wxResult)) {
            // 为什么以empty判断是否错误，这是根据微信返回
            // 规则摸索出来的
            // 这种情况通常是由于传入不合法的code
            // 服务器异常，不会返回到客户端，记录成日志
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        else {
            // 建议用明确的变量来表示是否成功
            // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
            // 这样非常不好判断，只能使用errcode是否存在来判断
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            }
            else {
                return $this->grantToken($wxResult);
            }
        }
    }

    // 处理微信登陆异常
    // 那些异常应该返回客户端，那些异常不应该返回客户端
    // 需要认真思考
    private function processLoginError($wxResult)
    {
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']  // 微信返回错误码，错误信息
            ]);
    }

    /**
     * @param $wxResult (从微信获取的数据)
     *   颁发令牌
         只要调用登陆就颁发新令牌
         但旧的令牌依然可以使用
         所以通常令牌的有效时间比较短
         目前微信的express_in时间是7200秒
         在不设置刷新令牌（refresh_token）的情况下
         只能延迟自有token的过期时间超过7200秒（目前还无法确定，在express_in时间到期后
         还能否进行微信支付
         没有刷新令牌会有一个问题，就是用户的操作有可能会被突然中断
     * @return mixed  (token)
     */
    private function grantToken($wxResult){
       /**
        *    此处生成令牌使用的是TP5自带的令牌
             如果想要更加安全可以考虑自己生成更复杂的令牌
             比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
             $token = Request::instance()->token('token', 'md5');
        */
       /* 1.拿到openid 通过数据库查看，判断用户是否生成
          2.生成令牌，准备缓存数据，写入缓存
          3.令牌返回到客户端
            key:令牌
            value: 找到用户相关变量 wxResult,uid,scope
        */
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);
        if (!$user)
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
        {
            // 插入user到数据库
            $uid = $this->newUser($openid);
        }
        else {
            $uid = $user->id;
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;

    }

    /**
     * 准备缓存数据
     * @param $wxResult
     * @param $uid  用户主键传进去
     * @return mixed
     */
    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        // $cachedValue['scope'] = 15;  // 可以测试权限不够
        return $cachedValue;
    }


    /** 写入缓存
     * @param $wxResult
     * @return string  (令牌)
     * @throws TokenException
     */
    private function saveToCache($wxResult)
    {
        $key = self::generateToken();
        $value = json_encode($wxResult);      // 数组对象转换成字符串
        $expire_in = config('setting.token_expire_in');
        // tp5自带缓存,文件缓存
        $result = cache($key, $value, $expire_in);

        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }


    // 创建新用户
    private function newUser($openid)
    {
        /*   有可能会有异常，如果没有特别处理
             这里不需要try——catch
             全局异常处理会记录日志
             并且这样的异常属于服务器异常
             也不应该定义BaseException返回到客户端
        */
        $user = User::create(
            [
                'openid' => $openid
            ]);
        return $user->id;   // 会以模型方式返回
    }
}