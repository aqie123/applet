<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/27 4:09
 */

namespace app\api\validate;

class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}
