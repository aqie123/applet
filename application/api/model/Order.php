<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/6
 * Time: 14:24
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;

    // 读取器，格式化显示数据
    public function getSnapItemsAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);   // json字符串转换为json对象
    }

    public function getSnapAddressAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode(($value));
    }

    /**
     * @param $uid  (用户uid)
     * @param int $page  (页数)
     * @param int $size   (每页个数)
     * @return \think\Paginator
     */
    public static function getSummaryByUser($uid, $page=1, $size=15)
    {
        $pagingData = self::where('user_id', '=', $uid)
            ->order('create_time desc')
            ->paginate($size, true, ['page' => $page]);   // page当前页，客户端传过来页码
        return $pagingData ;
    }

    public static function getSummaryByPage($page=1, $size=20){
        $pagingData = self::order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData ;
    }
}