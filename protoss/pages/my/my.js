import {Address} from '../../utils/address.js';
import {Order} from '../order/order-model.js';
import {My} from '../my/my-model.js';

var address=new Address();
var order=new Order();
var my=new My();

Page({
  data: {
    pageIndex:1,
    isLoadedAll:false,
    loadingHidden:false,
    orderArr:[],
    addressInfo:null
  },
  onLoad:function(){
    this._loadData();
    this._getAddressInfo();
  },

  onShow:function(){

  },
  _loadData:function(){
    var that=this;
    my.getUserInfo((data)=>{
      that.setData({
        userInfo:data
      });

    });

    this._getOrders();
    order.execSetStorageSync(false);  //更新标志位
  },

  /*订单信息*/
  _getOrders:function(callback){
    var that=this;
    order.getOrders(this.data.pageIndex,(res)=>{
      var data=res.data;
      that.setData({
        loadingHidden: true
      });
      if(data.length>0) {
        that.data.orderArr.push.apply(that.data.orderArr,res.data);  //数组合并
        that.setData({
          orderArr: that.data.orderArr
        });
      }else{
        that.data.isLoadedAll=true;  //已经全部加载完毕
        that.data.pageIndex=1;
      }
      callback && callback();
    });
  },

  /**地址信息**/
  _getAddressInfo:function(){
    var that=this;
    address.getAddress((addressInfo)=>{
      that._bindAddressInfo(addressInfo);
    });
  },

  /*修改或者添加地址信息*/
  editAddress:function(){
    var that=this;
    wx.chooseAddress({
      success: function (res) {
        var addressInfo = {
          name:res.userName,
          mobile:res.telNumber,
          totalDetail:address.setAddressInfo(res)
        };
        if(res.telNumber) {
          that._bindAddressInfo(addressInfo);
          //保存地址
          address.submitAddress(res, (flag)=> {
            if (!flag) {
              that.showTips('操作提示', '地址信息更新失败！');
            }
          });
        }
        //模拟器上使用
        else{
          that.showTips('操作提示', '地址信息更新失败,手机号码信息为空！');
        }
      }
    })
  },

  /*绑定地址信息*/
  _bindAddressInfo:function(addressInfo){
    this.setData({
      addressInfo: addressInfo
    });
  },

  /*显示订单的具体信息*/
  showOrderDetailInfo:function(event){
    var id=order.getDataSet(event,'id');
    wx.navigateTo({
      url:'../order/order?from=order&id='+id
    });
  },
})