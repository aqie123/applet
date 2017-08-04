<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 10:46
 */

namespace app\lib\exception;

// 微信服务器异常
class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = 'wechat unknown error';
    public $errorCode = 999;
}