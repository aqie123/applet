<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 15:04
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在，请检查商品ID';
    public $errorCode = 20000;
}