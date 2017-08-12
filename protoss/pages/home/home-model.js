class Home{
  constructor(){

  }
  getBannerData(id,callBack){
    wx.request({
      url: 'http://applet.com/api/v1/banner/' + id,
      method:'GET',
      success:function(res){
        // console.log(res);   这个可以输出
        // return res;         错误写法
        callBack(res);        // 调用函数
      }
    })
  }
}

export {Home};