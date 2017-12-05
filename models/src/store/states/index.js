import {cookieStorage, localStorage} from '../../common/storage'

export default {
  //  用户信息和是否登录
  user_info: cookieStorage.get('user_info'),
  user_openid: cookieStorage.getCookie('zzm_admin_storage_openid'),
  list: [],
  //  购物车数量
  count: 0,
  cart_count: 0,
  checked_login: false
}


