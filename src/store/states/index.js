// import {cookieStorage} from 'common/storage'

import { storageSet, storageGet } from '../../api/utils.js'

export default {
  //  用户信息和是否登录
  user_info: localStorage.getItem('user_info'),
  // remove_user_info: localStorage.removeItem('user_info'),
  list: [],
  count: 0,
  //  购物车商品数量
  cart_count: 0,
  checked_login: false,
  //  购物车缓存
  cart: localStorage.getItem('cart_info') ? JSON.parse(localStorage.getItem('cart_info')) : [],
  setCart: storageGet('cart_info') || [],
}


