//状态管理器
import Vue from 'vue'
import Vuex from 'vuex'

//引入模块
import actions from './actions/index'
import getters from './getters/index'

//  应用状态操作
import mutations from './mutations/index'
//  应用状态
import state from './states/index'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
})
