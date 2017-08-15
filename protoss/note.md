小程序开始  2017/8/12
1. 小程序所有请求都是异步(回调函数)

2.真机请求地址必须是https
3.getBannerData(id) 都是异步方法
  接收异步方法返回结果
  定义回调函数，将回调函数当参数传到getBannerData(id)方法，拿到参数后
  var data = home.getBannerData(id,this.callBack);
  callBack:function(res){
    console.log(res);
  }
  ec6箭头函数
4. 新建基类base.js
   配置文件config.js
   在home模型调用 base.js封装方法
   home C层调用homeModel->调用base.js
   继承1.基类输出，2.引用，3.super()
   homeModel定义参数，再调用基类
5.home  _loadData  传递回调函数
  home_model 将回调函数传递到 base里面
  base简化输出，home_model进一步简化数据
6.最近新品使用模板
  tpls/products 最近新品模板  记得引入
7.swiper图片绑定id
  event.currentTarget.dataset.id  id就是data后面跟着的值，自定义
  在base基类定义通用方法
8.精选主题绑定id
9.app.json 中配置导航栏
10.主题页面
  a.home.js 通过点击将id传到theme页面，在theme.js onload函数接收
  b.theme 模板中 键名对应 <block wx:for="{{productsData}}">
  c.调试 APPData有所有绑定数据
11.在home.json配置导航栏名字;通过传入name动态设置导航栏名称
12.product 详情
  a.picker range(可选字段,在product.js data设置)
    product.js获取到当前用户选定number,(执行事件bindPickerChange)再通过this.setData进行数据绑定
    在data里设置初始值
    缺货禁用(数据绑定改变样式)
  b.商品详情下面 在wxml直接绑定，动态改变样式,绑定序列号
    hidden=true 就会隐藏
13.商品分类
    这个要仔细看