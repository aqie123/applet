<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 11:53
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;

}