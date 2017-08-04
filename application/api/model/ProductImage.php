<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 14:50
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];
    // product_image 关联image模型
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}