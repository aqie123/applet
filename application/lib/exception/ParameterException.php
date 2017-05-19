<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 19:43
 */

namespace app\lib\exception;

/**
 * 参数异常错误
 * Class ParameterException
 * @package app\lib\exception
 */
class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = "参数错误";
    public $errorCode = 10000;
}