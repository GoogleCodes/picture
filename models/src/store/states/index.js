import {cookieStorage} from '../../common/storage'

export default {
  //  用户信息和是否登录
  user_info: cookieStorage.get('user_info'),
  list: [],
  //  购物车数量
  count: 0,
  cart_count: 0,
  checked_login: false,
  //  购物车缓存
  cart: localStorage.getItem('cart_info') ? JSON.parse(localStorage.getItem('cart_info')) : []
}


