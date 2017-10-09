
import * as actions from '../../store/actions/type'
import * as mutations from '../../store/mutations/type'

export default {
  //设置用户信息和登录
  [actions.SET_USER_INFO]({commit}, userinfo){
    commit(mutations.SET_USER_INFO, userinfo)
  },

  //  初始化
  [actions.INIT]({commit}) {
    console.log(typeof commit, commit);
    $.ajax('../../../static/data/cart.json', function(res) {
      commit("init", res.data);
    });
  }

}
