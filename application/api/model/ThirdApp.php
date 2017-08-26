<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/8/27 4:15
 */

namespace app\api\model;

use think\Model;

class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }
}
