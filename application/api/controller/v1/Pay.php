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
}