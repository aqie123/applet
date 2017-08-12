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