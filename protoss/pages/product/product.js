// product.js

import { Product } from 'product-model.js';
var product = new Product();  //实例化 商品详情 对象

Page({

  /**
   * 页面的初始数据
   */
  data: {
    id:null,
    loadingHidden: false,
    hiddenSmallImg: true,
    countsArray: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    productCounts: 1,
    currentTabsIndex: 0,
    cartTotalCounts: 0,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var id = options.id;         // 获取传递过来的id
    // console.log(id);
    this.data.id = id;           // 将id保存到data变量中
    this._loadData();
  },
  _loadData: function(){
    product.getDetailInfo(this.data.id,(data)=>{
      this.setData({
        product:data
      })
    });
  },

  //选择购买数目
  bindPickerChange: function (e) {
    this.setData({
      // 获取用户选择的数组下标
      productCounts: this.data.countsArray[e.detail.value], 
    })
  },

  //切换详情面板
  onTabsItemTap: function (event) {
    // 基类公用方法  获取到每个tab id也就是index
    var index = product.getDataSet(event, 'index');
    this.setData({
      currentTabsIndex: index
    });
  },


 
})