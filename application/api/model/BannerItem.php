<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{
    protected $hidden = ['id','img_id','banner_id','update_time','delete_time'];
    //BannerItem表关联image表
    public function img(){
        // 一对一 (关联模型名字,外键，id)
        return $this->belongsTo('Image','img_id','id');
    }

}
