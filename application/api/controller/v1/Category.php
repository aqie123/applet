<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/3
 * Time: 16:40
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;

class Category
{
    /**
     * 获取所有分类
     * @return false|static[]
     * (这里获取图片是分类头图)
     */
    public function getAllCategories(){
        // all([传入一组id,留空就是查询全部],关联表)
        $categories = CategoryModel::all([], 'img'); // 等同 ::with('img')
        if(empty($categories)){
            throw new MissException([
                'msg' => '还没有任何类目',
                'errorCode' => 50000
            ]);
        }
        return $categories;
    }

}