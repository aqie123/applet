<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 16:41
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];
    // 关联products表
    public function products()
    {
        return $this->hasMany('Product', 'category_id', 'id');
    }

    // 关联img表
    public function img()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

}