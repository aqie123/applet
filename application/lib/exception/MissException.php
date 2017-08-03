<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 11:06
 */

namespace app\lib\exception;

/**
 * banner 未找到
 * Class BannerMissException
 * @package app\lib\exception
 */
class MissException extends BaseException
{
    public $code = 404;
    public $msg = "global:your required resource are not found";
    public $errorCode = 40000;

}