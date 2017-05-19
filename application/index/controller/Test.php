<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Test extends Controller
{
   /* protected $beforeActionList = [
        'first' => ['except'=>'jump'],
        'second' =>  ['except'=>'hello,jump'],
        'three'  =>  ['only'=>'hello,data'],
    ];
   */
    // 测试中文汉字输出
    public function index()
    {
        $data = array('name'=>'啊切','wind'=>'south',array(1=>'aqie',2,3));
         //return json_encode($data,JSON_UNESCAPED_UNICODE);
        return $data;
    }


    protected function first()
    {
        echo 'first<br/>';
    }

    protected function second()
    {
        echo 'second<br/>';
    }

    protected function three()
    {
        echo 'three<br/>';
    }
    public function hello(){
        // 引入命名空间下面类文件
        $hello = new \my\Test;
        $hello->sayHello();
    }
    // 测试json 数据输出
    public function data(){
        return ['name'=>'啊切','status'=>1];
    }

    public function jump(){
        $a = 1;
        $request = Request::instance();
        if($a){
            echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
            echo "当前模块名称是" . $request->module();
            echo "当前控制器名称是" . $request->controller();
            echo "当前操作名称是" . $request->action();
            $info = Request::instance()->header();
            var_dump($info);
            // $this->success("跳转成功",THINK_PATH . 'tpl/dispatch_jump.tpl');
        }else{
            $this->error("跳转失败");
        }
    }
    public function response(){
        $data = array(
            'id' =>1,
            'name' => '啊切',
            'type' => array(2,4,5),
            'test' => array(1,3,5=>array(3,5,'abc'))
        );
        $json = new \my\Response;
         //return $json::json(200,'数据返回成功',$data);
         //return $json::xmlEncode(200,'成功接收',$data);
        return $json::showDatas(200,'成功',$data,'xml');

    }

    public function cache(){
        $data = array(
            'id' =>1,
            'name' => '啊切',
            'type' => array(2,4,5),
            'test' => array(1,3,5=>array(3,5,'abc'))
        );
        $file = new \my\Caches;
        if($file->cacheData('index_aq_cache',null)){
            var_dump($file->cacheData('index_aq_cache'));
            echo "删除缓存生成成功";
        }else{
            echo "失败";
        }
    }

}
