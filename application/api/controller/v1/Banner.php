<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/18 21:24
 */

namespace app\api\controller\v1;
use app\api\validate\IdMustBePositiveInt;
use app\api\validate\TestValidate;
use app\lib\exception\BannerMissException;
use think\Exception;
use think\Validate;
use app\api\model\Banner as BannerModel;
class Banner
{
    public function testValidate(){
        // 对数据验证  1.独立验证 2.验证器
        $data = [
            'name' => 'vendor3433333333333333',
            'email' => 'vendor@qq.com'
        ];
        /*
        $validate = new Validate([  // 对字段验证要求
            'name' => 'require|max:10',
            'email' => 'email'
        ]);
        独立验证
        */
        $validate = new TestValidate();
        // 对数据进行验证
        $result = $validate->batch()->check($data); // batch() 批量验证
        print_r($validate->getError());
    }
    /**
     * 获取指定id banner 信息
     * @url /banner/:id
     * @http GET
     * @param $id (传入不同ID获取banner)
     * @return mixed (返回轮播图信息)
     */
    public function getBanner($id){
        /*
        $data = [
            'id' => $id
        ];

        $validate = new Validate([
            'id' =>'',
        ]);

        $validate = new IdMustBePositiveInt();
        $result = $validate->batch()->check($data);
        if($result){

        }else{

        }
        */
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        /*
        try{
            $banner = BannerModel::getBannerById($id);
        }catch(Exception $e){

            // 自定义错误返回
            $err = [
                'error_code' => 10001,
                'msg' => $e->getMessage()
            ];
             return json($err,400);  // 直接返回数组会报错 同时指定状态码

        }
        */
        $banner = BannerModel::getBannerById($id); // 测试抛出异常经过ExceptionHandler/render方法
        if(!$banner){
            // log('error');
            // 抛出自定义异常
             throw new BannerMissException();
            // throw new Exception("服务器异常,内部错误");
        }
        return $banner;
    }
}