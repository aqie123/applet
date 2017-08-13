
import {Base} from '../../utils/base.js';
class Home extends Base{
  constructor(){
    super();      // 对基类调用
  }

  // 获取banner数据
  getBannerData(id,callback){
    var params = {
      url: 'banner/' + id,
      sCallback:function(res){
        callback && callback(res.items);
      }
    }
    this.request(params);
    /*
    wx.request({
      url: 'http://applet.com/api/v1/banner/' + id,
      method:'GET',
      success:function(res){
        // console.log(res);   这个可以输出
        // return res;         错误写法
        callback(res);        // 调用函数
      }
    })
    */
  }

  // 获取精选主题
  getThemeData(callback){
    var params = {
      url: 'theme?ids=1,2,3',
      sCallback: function (data) {
        callback && callback(data);
      }
    }
    this.request(params);
  }

  // 获取最近新品
  getProductorData(callback) {
    var param = {
      url: 'product/recent',
      sCallback: function (data) {
        callback && callback(data);
      }
    };
    this.request(param);
  }
}

export {Home};