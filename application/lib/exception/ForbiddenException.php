<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 8:21
 */

namespace app\lib\exception;

/**
 * token验证失败时抛出此异常
 */
class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}