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
 * 路由两种写法，动态注册（全部使用），静态配置(注释掉的)
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
// 请求类型 post get delete put *(默认，任意请求类型)
// 路由参数 路由分组
// Route::rule('hello','sample/Test/hello','GET|POST',['https' => true]); // hello函数有传参，这个不能用

// http://z.cn/hello/123?name=aqie (:是url路径，)
// Route::get("hello/:id","sample/Test/hello"); // any => *  get传参
 Route::post("hello/:id","sample/Test/hello"); // any => *  post传参
// http://z.cn/request/123?name=aqie  age也可以post提交
Route::post("request/:id","sample/Test/request"); // any => *  post传参

// 依赖注入
Route::post("rely/:id","sample/Test/rely"); // any => *  post传参

Route::rule("list/:id","index/Lists/list"); // any => *  post传参


/**
 * 小程序路由开始 第一次写API
 */
// 规范加api/版本号 z.cn/api/v1/banner/1

// banner
Route::get('api/:version/banner/:id',"api/:version.Banner/getBanner");  // 注意访问方式(模块/控制器/操作方法)

//theme
Route::get('api/:version/theme','api/:version.theme/getSimpleList');  //（http://applet.com/api/v1/theme?ids=1,2,3）
Route::get('api/:version/theme/:id','api/:version.theme/getComplexOne');  // (http://applet.com/api/v1/theme/1)

//product 路由分组
Route::group('api/:version/product',function(){
    Route::get('/by_category','api/:version.product/getAllInCategory');   // (http://applet.com/api/v1/product/by_category?id=2)
    Route::get('/:id','api/:version.product/getOne',[],['id'=>'\d+']);   // (http://applet.com/api/v1/product/11)
    Route::get('/recent','api/:version.product/getRecent');             // (http://applet.com/api/v1/product/recent?count=16)
});
/*
Route::get('api/:version/product/by_category','api/:version.product/getAllInCategory');
Route::get('api/:version/product/:id','api/:version.product/getOne',[],['id'=>'\d+']);
Route::get('api/:version/product/recent','api/:version.product/getRecent');
*/
//category
Route::get('api/:version/category/all','api/:version.category/getAllCategories');  // (http://applet.com/api/v1/category/all)

// token
Route::post('api/:version/token/user','api/:version.Token/getToken');  // (http://applet.com/api/v1/category/all)

//address
Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');    // (http://applet.com/api/v1/address)

// 测试前置方法
Route::get('api/:version/second','api/:version.Address/second');    // (http://applet.com/api/v1/second)
Route::get('api/:version/third','api/:version.Address/third');    // (http://applet.com/api/v1/third)

// order
Route::post('api/:version/order','api/:version.Order/placeOrder');  // (http://applet.com/api/v1/order)

// pay
Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');