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
     * @throws BannerMissException
     */
    public function getBanner($id){
        // AOP面向切面编程
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
         $banner = BannerModel::with(["items",'items.img'])->find($id);  // 变成模型 直接调用基类方法 (推荐静态)
        // get find  all select
        // $banner = new BannerModel();  $banner = $banner->get($id); // 实例化

        // $banner = BannerModel::getBannerById($id); // 测试抛出异常经过ExceptionHandler/render方法
        if(!$banner){
            //自定义错误
             throw new BannerMissException();
            // throw new Exception("服务器内部错误aqie");
        }
        return $banner; // 变成模型后会自动序列化成json
    }
}