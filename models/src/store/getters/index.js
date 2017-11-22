
import * as type from '../../store/getters/type'

export default {
  //获取用户信息
  [type.GET_USER_INFO]: state => {
    return JSON.parse(state.user_info)
  },
}
