<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 11:01
 */

namespace app\lib\exception;

use think\Exception;

/**
 * 统一描述信息
 * 第一种异常分类 (用户)
 * Class BaseException
 * @package app\lib\exception
 */
class BaseException extends Exception
{
    // http状态码
    public $code = 400;
    // 错误具体信息
    public $msg = 'parameter error';
    // 自定义错误码
    public $errorCode = 10000;
}