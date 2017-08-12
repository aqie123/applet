class Base{
  constructor(){
    this.baseRequestUrl = 'http://applet/api/v1/';
  }

  request(params,){
    var url = this.baseRequestUrl + params.url;

    if(!params.type){
      params.type = 'GET';
    }
    wx.request({
      url: url,
      data: params.data,
      method: params.type,
      header: {
        'content-type' : 'application/json',
        'token' : wx.getStorageSync('token')     // 同步方法缓存中读取
      },
      success:function(res){
        if(params.sCallBack){
          params.sCallBack(res);
        }
        
      },
      fail:function(err){

      }
    })
  }
}