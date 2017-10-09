
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

  [type.INIT](state, list) {
    state.list = list
  }



}
