<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 9:49
 */

namespace app\api\validate;


class OrderPlace extends BaseValidate
{
    protected $rule = [
       'products' => 'checkProducts'
    ];
    protected $singleRule = [                       // 对Product下面每个子项进行验证规则
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger',
    ];
    // 验证提交过来商品 数据必须是二维数组，且不为空
    protected function checkProducts($values)
    {
        if(!is_array($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach ($values as $value)
        {
            $this->checkProduct($value);
        }
        return true;
    }
    private function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);   // 手动调用自定义验证规则
        $result = $validate->check($value);                // 传递需要验证规则 goCheck对check方法封装
        if(!$result){
            throw new ParameterException([
                'msg' => '商品列表参数错误',
            ]);
        }
    }

}