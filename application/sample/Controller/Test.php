<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/17 13:55
 */

namespace app\sample\Controller;

use think\Request;
// 获取变量三种方法
// 1.依赖注入  2.use Request对象 3.助手函数 input()
class Test
{
    /**
     * http://www.applet.com/index.php/sample/test/hello
     * @param id
     * @param $name
     * @param $age
     * @return string
     */
    public function hello($id, $name, $age){
        //return 'hello';
         return $id."hello {$name},年龄:{$age}";
    }
    /*
     * 或者使用助手函数
     */
    public function request(){
         //$id = Request::instance()->param('id');  // param不区分获取类型get/post
         $all = Request::instance()->param();  // 获取全部参数  是一个数组
         // $all = Request::instance()->get();  // 只获取?后面 get参数
         // $all = Request::instance()->route();  // 获取路径里面 get参数
         // $all = Request::instance()->post();  // 获取路径里面 post参数
        // $all = input('param.');  // 获取单个 param.name  post get   param. 获取全部
        var_dump($all);die;
        // $name = Request::instance()->param('name');  //获取单个参数
        // $age = Request::instance()->param('age');
        return $all[0]."hello {$all[1]},年龄:{$all[2]}";
    }

    /*
     * 依赖注入
     */
    public function rely(Request $request){
        // 不需要静态方法，直接使用变量
        $all = $request->param();
        var_dump($all);
    }
}