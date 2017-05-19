<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/18 22:15
 */

namespace app\api\validate;
use think\Validate;

/**
 * 验证器使用
 * Class TestValidate
 * @package app\api\validate
 */
class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
}