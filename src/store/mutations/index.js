
import * as type from '../../store/mutations/type'

import { cookieStorage } from '../../common/storage'

import { storageSet, storageGet, storageRemove } from '../../api/utils.js'

import Vue from 'vue'

export default {
  // 设置用户信息和是否登录
  [type.SET_USER_INFO](state, userinfo){  //  userinfo
    state.count++;
    state.user_info = userinfo || {}
    if (userinfo === null) {
      cookieStorage.remove(user_info)
      // storageRemove('user_info')
    } else {
      cookieStorage.set('user_info',userinfo)
      // storageSet('user_info',userinfo);
    }
  },

  //  用session存储信息
  [type.SET_USER_SESS](state, userinfo) {
    state.count++;
    state.user_info = userinfo || {}
    if (userinfo === null) {
      // storageRemove('user_info')
      window.sessionStorage.removeItem('user_info');
    } else {
      window.sessionStorage.setItem('user_info',JSON.stringify(userinfo));
      // storageSet('user_info',userinfo);
    }
  },

  //  测试
  [type.INIT](state, list) {
    for (let plist in state.cart) {

    }
    state.list = list
  },

  //  记录是否记住登录
  [type.GET_CHECKED_LOGIN](state, checked_login) {
    state.checked_login = checked_login;
    storageSet('checked_login',state.checked_login);
  },

  //  获取购物车商品数量
  [type.SET_CART_NUMBER](state, obj) {
    state.cart_count = obj;
  },

  //  增加购物车单个商品数量
  [type.INCRECARTNUMS](state, obj) {
    for(let plist = 0; plist < state.cart.length; plist++) {
      if(typeof state.cart[plist] === 'object' && state.cart[plist].id === obj.id) {
        state.cart[plist].number = obj.num;
        break;
      }
    }
    storageSet('cart_info',state.cart)
  },

  //  减少购物车单个商品数量
  [type.REDUCECARTNUMS](state, obj) {
    for (let plist = 0; plist < state.cart.length; plist++) {
      if (typeof state.cart[plist] === 'object' && state.cart[plist].id == obj.id) {
        if (state.cart[plist].number >= 1) {
          if(state.cart[plist].number >= 1) state.cart[plist].number = obj.num;
          break;
        }
      }
    }
    storageSet('cart_info',state.cart);
  },

  //  删除购物车单个商品
  [type.DEL_CART_OBJ] (state, id, format) {
    for(let plist = 0; plist < state.cart.length; plist++) {
        if(typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        state.cart.splice(plist,1);
        break;
      }
    }
    storageSet('cart_info',state.cart);
  },

  //  修改购物车单个商品
  [type.SET_CART_OBJ] (state, obj) {
    if(state.cart.length > 0) {
      let added = false;
      for(let plist = 0;plist < state.cart.length; plist++) {
        if(typeof state.cart[plist] === 'object' && state.cart[plist].id == obj.id) {
          state.cart[plist].number += obj.number;
          added = true;
          break;
        }
      }
      if(!added) {
        state.cart.push(obj);
      }
    }else{
      state.cart.push(obj);
    }
    storageSet('cart_info',state.cart);
  },

  //  提交订单
  [type.SET_GO_PAY] (state, arr) {
    storageSet('gopayData_info',arr);
    console.log(state.gopay, arr);
  }

}
