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
    var that = this;
    // 获取banner信息
    home.getBannerData(id,(res) =>{
      //console.log(res);                        // 在控制台展示后台banner数据
      that.setData({
        'bannerArr': res
      });
    });

    // 获取精选主题
    home.getThemeData((data) =>{
      //console.log(data);
      that.setData({
        'themeArr':data
      });
    });

    // 获取最近新品
    home.getProductorData((data) => {
      that.setData({
        'productsArr': data
      });
    });
    
  },

  /*跳转到商品详情*/
  onProductsItemTap: function (event) {
    // console.log(event);
    var id = home.getDataSet(event, 'id');
    
    wx.navigateTo({
      url: '../product/product?id=' + id
    })
  },

  /*跳转到主题列表*/
  onThemesItemTap: function (event) {
    var id = home.getDataSet(event, 'id');
    var name = home.getDataSet(event, 'name');
    wx.navigateTo({
      url: '../theme/theme?id=' + id + '&name=' + name
    })
  },
  



})