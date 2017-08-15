
import {Config} from '../utils/config.js';
class Base{
  constructor(){
    "use strict";
    this.baseRequestUrl = Config.restUrl;
  }

  request(params){
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
        params.sCallback&&params.sCallback(res.data);
        
      },
      fail:function(err){
        console.log(err);
      }
    })
  }
  
  /*获得元素上的绑定的值*/
  getDataSet(event, key) {
    return event.currentTarget.dataset[key];
  };

}
export {Base};