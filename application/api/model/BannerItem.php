<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{
    //关联image
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }

}
