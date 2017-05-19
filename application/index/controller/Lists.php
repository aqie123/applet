<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
class Lists extends Controller
{
    public function index()
    {
        // http://app.com/list.php?page-=1&pagesize=12
        $response = new \my\Response();
        $cache = new \my\Caches();
        $data = $cache->cacheData('index_cron_cahce');
        if($data) {
            return $response->showDatas(200, '首页数据获取成功', $data);
        }else{
            return $response->showDatas(400, '首页数据获取失败', $data);
        }
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
    }
    public function list(){
        $id = Request::instance()->post();  // 获取路径里面 post参数
        return $this->fetch();
    }

}
