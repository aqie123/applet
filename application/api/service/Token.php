<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 11:57
 */

namespace app\api\service;

use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;
class Token
{
    // 生成令牌 静态方法和实例对象无关
    public static function generateToken()
    {
        $randChar = getRandChar(32);  // common
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];  // 当前访问时间戳
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }
    // 获取Token中全部信息
    // 约定： Token必须放在Http请求头中，不能放在body
    public static function getCurrentTokenVar($key){
        // 获取Token
        $token = Request::instance()           // 获取Request实例
            ->header('token');
        // 从缓存中获取对应Token Value值
        $vars = Cache::get($token);
        if(!vars){
            throw new TokenException();
        }else {
            if(!is_array($vars))
            {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {    // 判断数组中是否有要查找变量
                return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }
    /**
     * 当需要获取全局UID时，应当调用此方法
     * 而不应当自己解析UID
     */
    public static function getCurrentUid(){
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    //验证token是否合法或者是否过期
    //验证器验证只是token验证的一种方式
    //另外一种方式是使用行为拦截token，根本不让非法token
    //进入控制器
    // 管理员用户均有权限
    public static function needPrimaryScope(){
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    // 用户专有权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

}