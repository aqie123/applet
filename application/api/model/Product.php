<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 9:29
 */

namespace app\api\model;


class Product extends BaseModel
{
    // pivot字段多对多关系中间表
    protected $hidden = [
    'delete_time', 'main_img_id', 'pivot', 'from', 'category_id',
    'create_time', 'update_time'];

    // 获取主题下产品图片完整url
    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }


    /**
     * 查询指定数量最新商品，倒序排列
     * @param $count
     * @return mixed(product模型)
     */
    public static function getMostRecent($count){
        $products = self::limit($count)->order('create_time desc')->select();
        return $products;
    }

    /**
     * 获取分类id下商品
     * @param $categoryID
     * @param bool $paginate
     * @param int $page
     * @param int $size
     * @return false|\PDOStatement|string|\think\Collection|\think\Paginator
     */
    public static function getProductsByCategoryID(
        $categoryID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where('category_id', '=', $categoryID);
        if (!$paginate)
        {
            return $query->select();
        }
        else
        {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                'page' => $page
            ]);
        }
    }

}