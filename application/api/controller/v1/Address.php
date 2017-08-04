<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 15:43
 */

namespace app\api\controller\v1;
use app\api\validate\AddressNew;
use app\api\model\User;
use app\api\model\UserAddress;
use app\api\service\Token as TokenService;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Controller;
use think\Exception;

class Address
{
    /**
     * 更新或者创建用户收获地址
     * 模型管理，新增和更新可以用同一个方法
     */
    public function createOrUpdateAddress(){
        (new AddressNew())->gocheck();
        /**
         * 根据Token获取uid
         * 根据uid查找数据，判断用户是否存在,不存在抛出异常
         * 获取用户从客户端提交来的地址信息
         * 根据用户地址是否存在，判断添加还是修改地址
         */
        $uid = TokenService::getCurrentUid();
        $user = User::get($uid);
        return 'address';
    }
}