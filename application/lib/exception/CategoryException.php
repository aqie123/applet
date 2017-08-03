<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 17:01
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查商品ID';
    public $errorCode = 20000;
}