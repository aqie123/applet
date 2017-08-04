<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/4
 * Time: 14:50
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden=['product_id', 'delete_time', 'id'];
}