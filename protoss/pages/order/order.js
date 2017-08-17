// order.js

import { Order } from '../order/order-model.js';
import { Cart } from '../cart/cart-model.js';
import { Address } from '../../utils/address.js';

var order = new Order();
var cart = new Cart();
var address = new Address();
Page({

  /**
   * 页面的初始数据
   */
  data: {
  
  },

  /**
   * 生命周期函数--监听页面加载
   * 订单数据来源包括两个：
        * 1.购物车下单
        * 2.旧的订单
   */
  onLoad: function (options) {
    var productArr;
    var flag = options.from == 'cart',
      that = this;
    this.data.fromCartFlag = flag;
    this.data.account = options.account;

    //来自于购物车
    if (flag) {
      this.setData({
        productsArr: cart.getCartDataFromLocal(true),
        account: options.account,
        orderStatus: 0
      });

      /*显示收获地址*/
      /*
      address.getAddress((res) => {
        that._bindAddressInfo(res);
      });
      */
    }

    //旧订单
    else {
      this.data.id = options.id;
    }
  },
  /*修改或者添加地址信息*/
  editAddress: function () {
    var that = this;
    wx.chooseAddress({
      success: function (res) {
        console.log(res);
        var addressInfo = {
          name: res.userName,
          mobile: res.telNumber,
          totalDetail: address.setAddressInfo(res)
        };
        that._bindAddressInfo(addressInfo);

        //保存地址
        address.submitAddress(res, (flag) => {
          if (!flag) {
            that.showTips('操作提示', '地址信息更新失败！');
          }
        });
      }
    })
  },

  /*绑定地址信息*/
  _bindAddressInfo: function (addressInfo) {
    this.setData({
      addressInfo: addressInfo
    });
  },

  /*
  * 提示窗口
  * params:
  * title - {string}标题
  * content - {string}内容
  * flag - {bool}是否跳转到 "我的页面"
  */
  showTips: function (title, content, flag) {
    wx.showModal({
      title: title,
      content: content,
      showCancel: false,
      success: function (res) {
        if (flag) {
          wx.switchTab({
            url: '/pages/my/my'
          });
        }
      }
    });
  },
  
})