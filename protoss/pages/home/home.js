// home.js
import {Home} from 'home-model.js'
var home = new Home();   // 实例化类
Page({

  /**
   * 页面的初始数据
   */
  data: {
  
  },

  onLoad:function(){
    this._loadData();
  },
  _loadData:function(){
    var id = 1;
    var data = home.getBannerData(id,(res) =>{
      console.log(res);
    });
    
  },
  // 被上面箭头函数替代
  callBack: function (res) {
    console.log(res);
  }



})