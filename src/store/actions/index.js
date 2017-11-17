import * as actions from '../../store/actions/type'
import * as mutations from '../../store/mutations/type'

export default {
  //设置用户信息和登录
  [actions.SET_USER_INFO]({commit}, userinfo){
    commit(mutations.SET_USER_INFO, userinfo)
  },

  [actions.REMOVE_USER_INFO]({commit}, userinfo){
    commit(mutations.REMOVE_USER_INFO, userinfo)
  },

  //  初始化
  [actions.INIT]({commit}) {
    // $.ajax('../../../static/data/cart.json', function(res) {
    //   commit("init", res.data);
    // });
  },

  [actions.GET_CHECKED_LOGIN]({commit}) {},

  //  购物车数量
  [actions.SET_CART_NUMBER]({commit}, cartObj) {
    commit(mutations.SET_CART_NUMBER,cartObj);
  },

  //再次购买添加商品
  // export const setCartAgain = function ({dispatch},cartobjs) {
  //   dispatch('SETCARTOBJS',cartobjs);
  // }

  //  修改购物车单个商品
  [actions.SET_CART_OBJ]({commit}, cartObj) {
    commit(mutations.SET_CART_OBJ, cartObj);
  },

  //  增加购物车单个商品数量
  [actions.INCRECARTNUMS]({commit}, id, number) {
    console.log(id,title);
    commit(mutations.INCRECARTNUMS,  id,number)
  },

  //  减少购物车单个商品数量
  [actions.REDUCECARTNUMS]({commit}, id, title) {
    commit(mutations.REDUCECARTNUMS,  id, title)
  },

  //  删除购物车单个商品
  [actions.DEL_CART_OBJ]({commit}, id, format) {
    commit(mutations.DEL_CART_OBJ,  id,format)
  },

  //  获取购物车数据
  [actions.SET_CART_STORAGE]({commit}, selarray) {
    commit(mutations.SET_CART_STORAGE, selarray);
  },

  //  去支付
  [actions.SET_GO_PAY]({commit}, arr){
    commit(mutations.SET_GO_PAY, arr);
  }

}
