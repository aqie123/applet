<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 7:27
 */

namespace app\api\validate;


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
        $result = $this->check($params);
        // var_dump($result);   // true
        if(!$result){
            //getError();
            $error = $this->error;
            throw new Exception($error);   // 保证验证规则正确
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