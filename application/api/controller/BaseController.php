<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 8:28
 */

namespace app\api\controller;


use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    // 只能用户访问
    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }
}