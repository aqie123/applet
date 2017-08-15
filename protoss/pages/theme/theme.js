// theme.js
import { Theme } from 'theme-model.js';
var theme = new Theme(); //实例化  主题列表对象
Page({

  /**
   * 页面的初始数据
   */
  data: {
    loadingHidden: false
  },
  onReady: function () {
    wx.setNavigationBarTitle({
      title: this.data.titleName
    });
  },
  onLoad: function (option) {
    this.data.titleName = option.name;
    this.data.id = option.id;
    wx.setNavigationBarTitle({
      title: option.name
    });
    this._loadData();

  },
  
  /*加载所有数据*/
  _loadData: function (callback) {
    var that = this;
    /*获取单品列表信息*/
    theme.getProductorData(this.data.id, (data) => {
      that.setData({
        themeInfo: data,
        loadingHidden: true
      });
      callback && callback();
    });
  },
})