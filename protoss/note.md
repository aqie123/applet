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