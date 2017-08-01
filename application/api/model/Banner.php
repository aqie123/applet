<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 8:26
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends Model
{
    protected $hidden = ['update_time','delete_time'];
    // protected $table = "Banner_item";  对应表名
    public static function getBannerById($id){
        // banner表关联item   item关联img
        $banner = self::with(["items",'items.img'])->find($id);  // 变成模型 直接调用基类方法 (推荐静态)
        return $banner;
        // $result = Db::query('select * from banner_item where banner_id = ?',[$id]);  // query 查询
        // $result = Db::table('banner_item')->where('banner_id','=',$id)->select();
        // where(字段名,表达式,查询条件)  表达式，数组，闭包
        /*
        $result = Db::table('banner_item')
            // ->fetchSql() // 生成sql语句
            ->where(function($query) use ($id){
            $query->where('banner_id','=',$id);
        })->select();
         return $result;
        */
         // return null;  // 抛出异常
    }

    /**
     * 关联表 (关联模型，外键，主键id)
     * @return \think\model\relation\HasMany
     */
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
}