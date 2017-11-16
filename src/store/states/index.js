// import {cookieStorage} from 'common/storage'

import { storageSet, storageGet } from '../../api/utils.js'
import { cookieStorage } from '../../common/storage'

export default {
  //  用户信息和是否登录
  user_info: cookieStorage.get('user_info'),
  s_user_info: sessionStorage.getItem('user_info'),
  list: [],
  count: 0,
  //  购物车商品数量
  cart_count: 0,
  //  记录是否记住登录
  checked_login: false,
  //  购物车缓存
  cart: localStorage.getItem('cart_info') ? storageGet('cart_info') : [],
  setCart: storageGet('cart_info') || [],
  gopay: []
}


