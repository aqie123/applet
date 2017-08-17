<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 14:33
 */

namespace app\api\controller\v1;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;
use app\lib\exception\ThemeException;

class Product
{
    /** 获取最新产品
     * @param $count (传入的获取商品数量)
     * @return string
     * @throws ProductException
     */
    public function getRecent($count = 15){
        (new Count())->goCheck();
        $products = productModel::getMostRecent($count);
        // $collection = collection($products);  // collection 数据集对象
        $products = $products->hidden(['summary']);
        if(!$products){
             throw new ProductException();
        }
        return $products;
    }

    /**
     * 获取分类下所有商品
     * @param int $id
     * @return mixed
     * @throws
     */
    public function getAllInCategory($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID(
            $id, false);
        if ($products->isEmpty())
        {
            throw new ThemeException();
        }
        $data = $products
            ->hidden(['summary'])
            ->toArray();
        return $data;
    }

    /**
     * 根据id获取对应商品
     * @param $id
     * @return mixed
     * @throws ProductException
     */
    public function getOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $product  = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }
        return $product;
    }
    public function deleteOne($id){

    }
}