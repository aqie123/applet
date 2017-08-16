// product.js

import { Product } from 'product-model.js';
import { Cart } from '../cart/cart-model.js';

var product = new Product();  //实例化 商品详情 对象
var cart = new Cart();

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
        cartTotalCounts: cart.getCartTotalCounts().counts1,
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

  /*添加到购物车*/
  onAddingToCartTap: function (events) {
    //防止快速点击
    if (this.data.isFly) {
      return;
    }
    this._flyToCartEffect(events);
    this.addToCart();
  },

  /*将商品数据添加到内存中*/
  addToCart: function () {
    var tempObj = {}, keys = ['id', 'name', 'main_img_url', 'price'];
    for (var key in this.data.product) {
      if (keys.indexOf(key) >= 0) {
        tempObj[key] = this.data.product[key];
      }
    }

    cart.add(tempObj, this.data.productCounts);
  },

  /*加入购物车动效*/
  _flyToCartEffect: function (events) {
    //获得当前点击的位置，距离可视区域左上角
    var touches = events.touches[0];
    var diff = {
      x: '25px',
      y: 25 - touches.clientY + 'px'
    },
      style = 'display: block;-webkit-transform:translate(' + diff.x + ',' + diff.y + ') rotate(350deg) scale(0)';  //移动距离
    this.setData({
      isFly: true,
      translateStyle: style
    });
    var that = this;
    setTimeout(() => {
      that.setData({
        isFly: false,
        translateStyle: '-webkit-transform: none;',  //恢复到最初状态
        isShake: true,
      });
      setTimeout(() => {
        var counts = that.data.cartTotalCounts + that.data.productCounts;
        that.setData({
          isShake: false,
          cartTotalCounts: counts
        });
      }, 200);
    }, 1000);
  },

 
})