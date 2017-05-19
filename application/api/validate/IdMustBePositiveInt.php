<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/18 22:56
 */

namespace app\api\validate;


class IdMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

}