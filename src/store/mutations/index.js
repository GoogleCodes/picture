
import * as type from '../../store/mutations/type'
// import {cookieStorage} from '../../common/storage'

export default {
  // //设置用户信息和是否登录
  [type.SET_USER_INFO](state, userinfo){  //  userinfo
    state.count++;
    state.user_info = userinfo || {}
    if (userinfo === null) {
      localStorage.remove('user_info')
    } else {
      localStorage.setItem('user_info', JSON.stringify(userinfo));
    }
  },

  //  测试
  [type.INIT](state, list) {
    state.list = list
    console.log(1111);
  },

  //  增加购物车单个商品数量
  [type.INCRECARTNUMS](state,id,format) {
    for(let plist = 0; plist < state.cart.length; plist++) {
      if(typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        state.cart[plist].nums += 1;
        break;
      }
    }
    localStorage.setItem('cart_info',JSON.stringify(state.cart));
  },

  //  减少购物车单个商品数量
  [type.REDUCECARTNUMS](state,id,format) {
    for (let plist = 0; plist < state.cart.length; plist++) {
      if (typeof state.cart[plist] === 'object' && state.cart[plist].id == id) {
        if (state.cart[plist].nums >= 1) {
          if(state.cart[plist].nums >= 1) state.cart[plist].nums -= 1;
          break;
        }
      }
    }
    localStorage.setItem('cart_info',JSON.stringify(state.cart));
  },

  //  删除购物车单个商品
  [type.DELCARTOBJ] (state,id,format) {
    for(let plist = 0; plist < state.cart.length; plist++) {
        if(typeof state.cart[plist] === 'object' && state.cart[plist].id == id){
        state.cart.splice(plist,1);
        break;
      }
    }
    localStorage.setItem('cart_info',JSON.stringify(state.cart));
  },

}
