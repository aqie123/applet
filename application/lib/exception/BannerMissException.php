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
class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = "banner miss";
    public $errorCode = 40000;

}