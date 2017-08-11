<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 8:46
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;
use think\console\Input;
use think\Controller;

class Order extends BaseController
{
    /**
     * 1.用户选择商品后，向API提交商品信息
     * 2.API接收到信息后，检测商品库存量
     * 3.有库存，订单数据存入数据库，下单成功。 返回客户端可以支付
     * 4.调用支付接口
     * 5.再次进行库存检测
     * 6.服务器调用微信支付接口进行支付
     *      小程序根据微信返回结果，调起微信支付,(用户付款)
     * 7.微信返回支付结果 (异步返回,无法实时告诉客户端成功失败)
     *   服务器无法返回成功或失败结果,微信会返回给小程序客户端一个结果
     *   异步通知向服务器发送结果 (微信调用我们提供接口)
     *   成功：进行库存量检测
     * 8.成功： 进行库存量扣除。 失败：返回失败支付结果
     * ()
     */
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    /**
     * 用户下单接口 (提交：商品id,商品数量,)
     * @return string
     */
    public function placeOrder(){
        (new OrderPlace())->goCheck();
        $products = Input('post.products/a');   // 获取到数组参数
        // 拿到用户uid
        $uid = Token::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }

    public function getSummaryByUser($page = 1,$size = 15){
        // 令牌中获取用户uid

    }
}