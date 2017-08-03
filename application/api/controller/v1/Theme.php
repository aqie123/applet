<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 9:29
 */

namespace app\api\controller\v1;


use app\api\model\Theme as ThemeModel;
use app\api\validate\IDCollection;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * 获取对应主题列表
     * @param $ids (接收theme id)
     * @url /theme?ids=id1,id2...（http://applet.com/api/v1/theme?ids=1,2,3）
     * @return mixed (一组theme模型)
     * @throws ThemeException
     */
    public function getSimpleList($ids = ''){
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return $result;
    }

    public function getComplexOne($id){
        (new IdMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProduct($id);
        if(!$theme){
            throw new ThemeException();
        }
        return $theme;
    }
}