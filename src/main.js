// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
//  导入样式
import 'element-ui/lib/theme-default/index.css'
//  导入Vue框架
import Vue from 'vue'
//  导入主视图文件
import App from './App'
//  导入路由
import VueResource from 'vue-resource'
//导入状态管理器
import store from './store'
//  导入组件
import router from './router'
//  导入element组件
import ElementUI from 'element-ui'
//  swiper.css
import '../static/css/idangerous.swiper.css'

require('swiper/dist/css/swiper.css')

//  导入路由
import VueRouter from 'vue-router'
import {
  fetchGet,
  fetchPost,
  fetchPut,
  fetchDelete,
  storageSet,
  storageGet, goJson } from './api/utils.js'
Vue.prototype.$getData = fetchGet;
Vue.prototype.$postData = fetchPost;
Vue.prototype.$putData = fetchPut;
Vue.prototype.$deleteData = fetchDelete;
Vue.prototype.$storageSet = storageSet;
Vue.prototype.$storageGet = storageGet;
Vue.prototype.$goJson = goJson;

import * as fetch from './api/utils.js'
Vue.prototype.$goFetch = fetch;

import * as goFetchs from './router/utils.js'
Vue.prototype.$goFetchs = goFetchs;

//  验证
import { tool_verify } from './api/tool'
Vue.prototype.$toolVerify = tool_verify;
//  导入API
import api from './common/port_uri'
Vue.prototype.$api = api;

import VueAwesomeSwiper from 'vue-awesome-swiper'

// mount with global
Vue.use(VueAwesomeSwiper)

//  使用element-ui
Vue.use(ElementUI);

//  网络请求模块vue-resource
Vue.use(VueResource);

//  发布后是否显示提示
Vue.config.productionTip = false;

//是否开启工具调试
Vue.config.devtools = process.env.NODE_ENV === 'development'

// If used in Nuxt.js/SSR, you should keep it only in browser build environment
if (process.browser) {
  const VueAwesomeSwiper = require('vue-awesome-swiper/ssr')
  Vue.use(VueAwesomeSwiper)
}

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  template: '<App/>',
  components: { App }
});

