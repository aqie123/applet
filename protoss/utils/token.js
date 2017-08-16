// 引用使用es6的module引入和定义
// 全局变量以g_开头
// 私有函数以_开头

import { Config } from 'config.js';

class Token {
  constructor() {
    this.verifyUrl = Config.restUrl + 'token/verify';
    this.tokenUrl = Config.restUrl + 'token/user';
  }

  // 校验当前令牌是否有效
  verify() {
    var token = wx.getStorageSync('token');
    if (!token) {
      this.getTokenFromServer();
    }
    else {
      this._veirfyFromServer(token);
    }
  }

  // 携带令牌去服务器校验
  _veirfyFromServer(token) {
    var that = this;
    wx.request({
      url: that.verifyUrl,
      method: 'POST',
      data: {
        token: token
      },
      success: function (res) {
        var valid = res.data.isValid;
        // 令牌不合法
        if (!valid) {
          that.getTokenFromServer();
        }
      }
    })
  }

  // 从服务器获取Token
  getTokenFromServer(callBack) {
    var that = this;
    wx.login({
      success: function (res) {
        wx.request({
          url: that.tokenUrl,
          method: 'POST',
          data: {
            code: res.code
          },
          // 服务器返回token保存到缓存中
          success: function (res) {
            wx.setStorageSync('token', res.data.token);
            callBack && callBack(res.data.token);
          }
        })
      }
    })
  }
}

export { Token };