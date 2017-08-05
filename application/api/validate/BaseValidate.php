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
    /**
     * 获取http传入参数
     * 整个验证层 对参数校验
     * (http://z.cn/banner/123     Route::get('banner/:id',"api/v1.Banner/getBanner");)
     * @return bool
     * @throws ParameterException
     */
    public function goCheck(){
        $request = Request::instance();
        $params = $request->param();
        // 批量验证错误
        $result = $this->batch()->check($params);

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
     * @param $field  (验证字段)
     * @return mixed
     */
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        // return $field . '必须是正整数';
        return false;
    }

    // 判断数据是否为空
    protected function isNotEmpty($value,$rule = '',$data = '',$filed = ''){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 根据验证规则接受变量
     * @param array $arrays 通常传入request.post变量数组
     * @return array 按照规则key过滤后的变量数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)) {
            // 不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

    //没有使用TP的正则验证，集中在一处方便以后修改
    //不推荐使用正则，因为复用性太差
    //手机号的验证规则
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


}