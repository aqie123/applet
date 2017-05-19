<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 7:27
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        // 获取http传入参数
        // 对参数校验
        // http://z.cn/banner/123     Route::get('banner/:id',"api/v1.Banner/getBanner");
        $request = Request::instance();
        $params = $request->param();
        // 批量验证错误
        $result = $this->batch()->check($params);
        // var_dump($result);   // true
        if(!$result){
            // 保证验证规则正确  应该抛出自定义异常
            $e = new ParameterException([  // 使用构造函数代替
                'msg' => $this->error,
            ]);
            // 获取当前错误
            // $e->msg = $this->error;
            throw $e;  // throw 必须是异常
        }else{
            return true;
        }

    }
    /**
     * 判断id是否为正整数
     * @param $value
     * @param $rule
     * @param $data
     * @param $field
     * @return mixed
     */
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }

}