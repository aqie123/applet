<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 17:54
 */

namespace app\api\controller\v1;
use app\api\validate\TokenGet;
use app\api\service\UserToken;

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

}