
import { Token } from 'token.js';
import {Config} from '../utils/config.js';
class Base{
  constructor(){
    "use strict";
    this.baseRequestUrl = Config.restUrl;
    this.onPay = Config.onPay;
  }

  //http 请求类, 当noRefech为true时，不做未授权重试机制
  request(params, noRefetch){
    var that =this;
    var url = this.baseRequestUrl + params.url;

    if(!params.type){
      params.type = 'GET';
    }
    /*不需要再次组装地址*/
    if (params.setUpUrl == false) {
      url = params.url;
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
        // 判断以2（2xx)开头的状态码为正确
        // 异常不要返回到回调中，就在request中处理，记录日志并showToast一个统一的错误即可
        var code = res.statusCode.toString();
        var startChar = code.charAt(0);
        if (startChar == '2') {
          params.sCallback && params.sCallback(res.data);
        } else {   // 请求失败，未达到预期
          if (code == '401') {
            if (!noRefetch) {
              that._refetch(params);
            }
          }
          that._processError(res);
          if(noRefetch){
            params.eCallback && params.eCallback(res.data);
          }
          
        }
        
      },
      // 网络中断请求失败
      fail:function(err){
        that._processError(err);
      }
    })
  }
  
  /*获得元素上的绑定的值*/
  getDataSet(event, key) {
    return event.currentTarget.dataset[key];
  };

  _processError(err) {
    console.log(err);
  }

  _refetch(param) {
    var token = new Token();
    token.getTokenFromServer((token) => {
      // 再次调用request
      this.request(param, true);  // 不再重复发送
    });
  }

  /*获得元素上的绑定的值*/
  getDataSet(event, key) {
    return event.currentTarget.dataset[key];
  };

}
export {Base};