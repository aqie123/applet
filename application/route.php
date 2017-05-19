<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/*
 * 路由两种写法，动态注册，静态配置
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
*/
use think\Route;
// 自定义路径hello  z.cn/hello
//Route::rule('路由表达式','路由地址','请求类型','路由参数(数组)','变量规则(数组)');
// 请求类型 post get delete put *(默认)
// 路由参数 路由分组
//Route::rule('hello','sample/Test/hello','GET|POST',['https' => false]);
// http://z.cn/hello/123?name=aqie
Route::get("hello/:id","sample/Test/hello"); // any => *  get传参
Route::post("hello/:id","sample/Test/hello"); // any => *  post传参
// http://z.cn/request/123?name=aqie
Route::post("request/:id","sample/Test/request"); // any => *  post传参

// 依赖注入
Route::post("rely/:id","sample/Test/rely"); // any => *  post传参

Route::rule("list/:id","index/Lists/list"); // any => *  post传参


/**
 * 小程序路由开始 第一次写API
 */
// 规范加api/版本号
Route::get('api/v1/banner/:id',"api/v1.Banner/getBanner");  // 注意访问方式