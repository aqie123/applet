<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    // 隐藏image表中字段
    protected $hidden = ['id','from','delete_time','update_time'];

    /** 模型读取器(必须以get开头Attr结尾)
     * @param $value (url取值)
     * @param $data  （当前img相关字段）
     * @return mixed
     */
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}
