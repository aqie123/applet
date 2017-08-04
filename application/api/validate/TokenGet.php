<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 17:57
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require}isNotEmpty'
    ];
    protected $message = [
        'code' => '必须传递code，才能获取token'
    ];
}