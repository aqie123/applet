<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 9:30
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden = ['delete_time', 'topic_img_id', 'head_img_id'];
    /**
     * 关联Image 一对一
     * 要注意belongsTo和hasOne的区别，都是一对一
     * 带外键的表一般定义belongsTo，另外一方定义hasOne
     */
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    /**
     * 关联product，多对多关系 通过第三张表（关联模型，中间表表名，）
     */
    public function products()
    {
        return $this->belongsToMany(
            'Product', 'theme_product', 'product_id', 'theme_id');
    }

    /**
     * 获取对应主题下面产品数据
     * @param $id (主题id)
     * @return models(theme)
     */
    public static function getThemeWithProduct($id)
    {
        // 关联 产品，头图(这里写的是上面关联的函数)
        $themes = self::with('products,topicImg,headImg')->find($id);
        return $themes;
    }
}