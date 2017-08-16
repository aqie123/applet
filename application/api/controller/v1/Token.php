<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 17:54
 */

namespace app\api\controller\v1;

use app\api\service\AppToken;
use app\api\service\UserToken;
use app\api\service\Token as TokenService;
use app\api\validate\AppTokenGet;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;

// 用户登录转换成获取令牌模型资源
class Token
{
    /**
     * @param string $code (小程序生成)
     * @return array   (Token)
     */
    public function getToken($code = ''){
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();       // 返回字符串
        return [                   // 返回数组，框架会自动序列化为json
            'token' => $token
        ];
    }

    /**
     * 对客户端传过来参数校验
     * @param string $token
     * @return array
     */
    public function verifyToken($token='')
    {
        if(!$token){
            // 这里可以写成验证器
            throw new ParameterException([
                'token不允许为空'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }

}