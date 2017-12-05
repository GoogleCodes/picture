import * as type from '../../store/mutations/type'
import {cookieStorage} from '../../common/storage'
import {localStor} from '../../common/storage'

import {storageSet, storageGet} from '../../api/utils.js'

export default {
  // 设置用户信息和是否登录
  [type.SET_USER_INFO](state, userinfo){  //  userinfo
    state.count++;
    state.user_info = userinfo || {}
    if (userinfo === null) {
      cookieStorage.remove(user_info)
    } else {
      cookieStorage.set('user_info', userinfo, '2017-12-30T23:50:50.932Z')
    }
  },

  //  测试
  [type.INIT](state, list) {
    state.list = list
  },

  //  删除cookies
  [type.REMOVE_USER_INFO](state, userinfo) {
    cookieStorage.remove(userinfo)
  },

  [type.GET_CHECKED_LOGIN](state, checked_login) {
    state.checked_login = checked_login;
    storageSet('checked_login', state.checked_login);
  },

  [type.SET_CART_NUMBER](state, obj) {
    state.cart_count = obj;
  },

  //  修改购物车单个商品
  [type.SET_CART_OBJ](state, obj) {
    if (state.cart.length > 0) {
      let added = false;
      for (let plist = 0; plist < state.cart.length; plist++) {
        if (typeof state.cart[plist] === 'object' && state.cart[plist].id == obj.id) {
          state.cart[plist].nums += obj.nums;
          added = true;
          break;
        }
      }
      if (!added) {
        state.cart.push(obj);
      }
    } else {
      state.cart.push(obj);
    }
    storageSet('cart_info', state.cart);
  },

  //  增加购物车单个商品数量
  [type.INCRECARTNUMS](state, id, title) {
    for (let plist = 0; plist < state.cart.length; plist++) {
      if (typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        state.cart[plist].nums += 1;
        break;
      }
    }
    storageSet('cart_info', state.cart);
  },

  //  减少购物车单个商品数量
  [type.REDUCECARTNUMS](state, id, title) {
    for (let plist = 0; plist < state.cart.length; plist++) {
      if (typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        if (state.cart[plist].nums >= 1) {
          if (state.cart[plist].nums >= 1) state.cart[plist].nums -= 1;
          break;
        }
      }
    }
    storageSet('cart_info', state.cart);
  },

  //  删除购物车单个商品
  [type.DELCARTOBJ] (state, id, format) {
    for (let plist = 0; plist < state.cart.length; plist++) {
      if (typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        state.cart.splice(plist, 1);
        break;
      }
    }
    storageSet('cart_info', state.cart);
  },

}
