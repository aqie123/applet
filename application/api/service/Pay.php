<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 17:10
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;
class Pay
{
    private $orderNo;  //
    private $orderID;  //
    public function __construct($orderID)
    {
        if (!$orderID) {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    /**
     *
     */
    public function pay(){
        // 订单号可能不存在；订单号和当前用户不匹配；订单已经被支付过
        $this->checkOrderValid();
        // 进行库存量检测
        $order = new Order();
        $status = $order->checkOrderStock($this->orderID);
        if (!$status['pass'])
        {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
        //        $this->checkProductStock();
    }

    // 检测订单是否存在
    private function checkOrderValid()
    {
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if (!$order)
        {
            throw new OrderException();
        }
//        $currentUid = Token::getCurrentUid();
        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException(
                [
                    'msg' => '订单与用户不匹配',
                    'errorCode' => 10003
                ]);
        }
        if($order->status != 1){
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNo = $order->order_no;
        return true;
    }
}
