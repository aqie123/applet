<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 9:00
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $autoWriteTimestamp = true;

    public function orders()
    {
        return $this->hasMany('Order', 'user_id', 'id');
    }

    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     * @param $openid
     * @return mixed
     */
    public static function getByOpenID($openid)
    {
        $user = User::where('openid', '=', $openid)
            ->find();
        return $user;
    }

}