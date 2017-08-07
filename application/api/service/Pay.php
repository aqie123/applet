<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 17:10
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;
// extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
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
     * 支付主函数
     */
    public function pay(){
        // 订单号可能不存在；订单号和当前用户不匹配；订单已经被支付过
        $this->checkOrderValid();
        // 进行库存量检测
        $order = new Order();
        $status = $order->checkOrderStock($this->orderID);
        if (!$status['pass'])
        {
            return $status;   // 支付接口业务逻辑被中断
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
        // order模型获取uid和用户令牌携到缓存换取uid是否一致
        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException(
                [
                    'msg' => '订单与用户不匹配',
                    'errorCode' => 10003
                ]);
        }
        if($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        // 成员变量
        $this->orderNo = $order->order_no;
        return true;
    }

    // 构建微信支付订单信息
    private function makeWxPreOrder($totalPrice)
    {
        // 微信用户身份标识
        $openid = Token::getCurrentTokenVar('openid');

        if (!$openid)
        {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();   // 没有命名空间 加/

        $wxOrderData->SetOut_trade_no($this->orderNo);  // 订单号
        $wxOrderData->SetTrade_type('JSAPI');  // 小程序
        $wxOrderData->SetTotal_fee($totalPrice * 100);  // 订单总金额 (以分为单位)
        $wxOrderData->SetBody('零食商贩');             // 商品描述
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));  // 微信回调通知
        // 对象发送到微信预订单接口,返回参数签名结果
        return $this->getPaySignature($wxOrderData);
    }

    //向微信请求订单号并生成签名
    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
            //  throw new Exception('获取预支付订单失败');
        }
        // prepay_id 微信向用户主动推送消息
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    // 处理wxOrder prepay_id
    private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        OrderModel::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    // 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());        // php内置函数转换为时间戳,必须转换为string
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);                 // 随机字符串
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);  // 注意格式
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();     // 将对象转换为数组
        $rawValues['paySign'] = $sign;              // 将签名返回
        unset($rawValues['appId']);
        return $rawValues;
    }



}
