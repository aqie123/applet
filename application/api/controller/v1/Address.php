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

class Address extends Controller
{
    protected $beforeActionList = [
        'first' => ['only' => 'second,third'],      // 只有second才需要执行前置方法first
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];
    protected function first(){              // 接口的前置方法
        echo 'first';
    }
    public function second(){            // 相当于一个接口方法
        echo 'second';
    }
    public function third(){
        echo 'third';
    }
    protected function checkPrimaryScope(){
//        $scope = Token::
    }
    /**
     * 更新或者创建用户收获地址
     * 模型管理，新增和更新可以用同一个方法
     */
    public function createOrUpdateAddress(){
        $validate = new AddressNew();
        $validate->goCheck();
        /**
         * 根据Token获取uid
         * 根据uid查找数据，判断用户是否存在,不存在抛出异常
         * 获取用户从客户端提交来的地址信息
         * 根据用户地址是否存在，判断添加还是修改地址
         * @return mixed (user模型/ success信息)
         */
        $uid = TokenService::getCurrentUid();
        $user = User::get($uid);
        if(!$user){
            throw new UserException([
                'code' => 404,
                'msg' => '用户收获地址不存在',
                'errorCode' => 60001
            ]);
        }
        $userAddress = $user->address;   // 在user模型新建关联关系
        // // 根据验证器规则取字段是很有必要的，防止恶意更新非客户端字段 (防止user_id被覆盖)
        $data = $validate->getDataByRule(input('post.'));   // BaseValidate
        // 通过关联模型，在user_address新增数据
        if(!$userAddress){
            $user->address()->save($data);  // 新增
        }else{
            // 存在则更新 fromArrayToModel($user->address, $data);
            // 新增的save方法和更新的save方法并不一样
            // 新增的save来自于关联关系
            // 更新的save来自于模型
            $user->address->save($data);   // 更新
        }
        // return $user;
        return json(new SuccessMessage(),201); // 保障状态码和显示一致
    }
}