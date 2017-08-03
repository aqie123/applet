<?php
/**
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 14:40
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];
}