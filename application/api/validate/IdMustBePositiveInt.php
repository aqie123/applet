<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/18 22:56
 */

namespace app\api\validate;


class IdMustBePositiveInt extends BaseValidate
{
    // http://z.cn/api/v1/banner/0.8?num=4
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'num' => 'in:1,2,3'  // 在1,2，3之间
    ];

}