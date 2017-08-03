<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 10:02
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        // id传过来以逗号分隔，并且是正整型
        'ids' =>'require|checkIDs'
    ];
    // 返回自定义信息提示
    protected $message = [
        'ids' => 'ids参数必须为以逗号分隔的多个正整数'
    ];
    protected function checkIDs($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                return false;
            }
        }
        return true;
    }
}