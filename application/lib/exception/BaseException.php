<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 11:01
 */

namespace app\lib\exception;

use think\Exception;
use Throwable;

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
    public function __construct($params = [])
    {
        if(!is_array($params)){
            throw new Exception('参数必须是数组');
        }
        if(array_key_exists('code',$params)){  // 关联数组存在code
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){  // 关联数组存在msg
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){  // 关联数组存在errorCode
            $this->errorCode = $params['errorCode'];
        }
    }
}