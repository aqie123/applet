<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 17:03
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePositiveInt;
use think\Controller;

class Pay extends BaseController
{
    // 只能用户访问
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];
    // 请求预订单信息 (到微信服务器请求微信服务器要求订单)
    public function getPreOrder($id='')
    {
        (new IDMustBePositiveInt()) -> goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    // 向微信提供的异步接口(每隔一段时间调用一次,知道收到服务器正确处理通知)
    // 1.第三次检测库存量
    // 2.真实更新订单状态
    // 3.减库存
    // 成功处理返回成功消息
    // 否则返回没有成功处理
    // 特点 ： 1.post接收,2.xml数据，3.url地址不能添加?参数
    public function receiveNotify(){
        $notify = new WxNotify();
        $notify->handle();
        // $xmlData = file_get_contents('php://input');
        //        Log::error($xmlData);

        //        $xmlData = file_get_contents('php://input');
        //        $result = curl_post_raw('http:/zerg.cn/api/v1/pay/re_notify?XDEBUG_SESSION_START=13133',
        //            $xmlData);
        //        return $result;
        //        Log::error($xmlData);
    }
}