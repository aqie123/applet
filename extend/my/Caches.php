<?php
namespace my;
/**
 * Class Caches
 * 生成缓存，操作缓存，删除缓存
 */
class Caches{
    private $_dir;

    const EXT = '.txt';

    public function __construct() {
        // 默认存放缓存文件
        $this->_dir = dirname(__FILE__) . '/files/';
    }

    /**
     * @param $key  (文件名)
     * @param string $value (缓存数据,不传就是获取缓存,null删除缓存)
     * @param int $cacheTime
     * @return bool|int|mixed
     */
    public function cacheData($key, $value = '', $cacheTime = 0) {
        $filename = $this->_dir  . $key . self::EXT;

        if($value !== '') { // 将value值写入缓存
            // 传入为null，把缓存删除
            if(is_null($value)) {
                return @unlink($filename);
            }
            $dir = dirname($filename);
            if(!is_dir($dir)) {
                mkdir($dir, 0777);
            }

            $cacheTime = sprintf('%011d', $cacheTime);
            return file_put_contents($filename,$cacheTime . json_encode($value));
        }

        if(!is_file($filename)) {
            return FALSE;
        }
        $contents = file_get_contents($filename);
        $cacheTime = (int)substr($contents, 0 ,11);
        $value = substr($contents, 11);
        if($cacheTime !=0 && ($cacheTime + filemtime($filename) < time())) {
            unlink($filename);
            return FALSE;
        }
        return json_decode($value, true);

    }
}
/*
set name aqie
get name
setex name 10 aqie    // 过期时间秒
del name
*/