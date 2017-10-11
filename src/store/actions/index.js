
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
  },

  //再次购买添加商品
  // export const setCartAgain = function ({dispatch},cartobjs) {
  //   dispatch('SETCARTOBJS',cartobjs);
  // }

  //  增加购物车单个商品数量
  [actions.REDUCECARTNUMS]({commit}, id,format) {
    commit(mutations.REDUCECARTNUMS,  id,format)
  },

  //  减少购物车单个商品数量
  [actions.REDUCECARTNUMS]({commit}, id,format) {
    commit(mutations.REDUCECARTNUMS,  id,format)
  },

  //  删除购物车单个商品
  [actions.DELCARTOBJ]({commit}, id, format) {
    commit(mutations.DELCARTOBJ,  id,format)
  },

}
