// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
//  导入样式
import 'element-ui/lib/theme-default/index.css'
//  导入Vue框架
import Vue from 'vue'
//  导入主视图文件
import App from './App'
//  导入组件
import VueResource from 'vue-resource'
//  导入微信SDK
var wx = require('weixin-js-sdk');
//导入状态管理器
import store from './store'
//  导入组件
import router from './router'
//  导入element组件
import ElementUI from 'element-ui'
//  导入swiper-css
require('swiper/dist/css/swiper.css')

// require('../node_modules/vconsole/dist/vconsole.min.js');

import VConsole from '../node_modules/vconsole/dist/vconsole.min.js'

var vConsole = new VConsole();

//  导入路由
import VueRouter from 'vue-router'
import {
  storageSet,
  storageGet } from './api/utils.js'
Vue.prototype.$storageSet = storageSet;
Vue.prototype.$storageGet = storageGet;
import * as fetch from './api/utils.js'
import { tool_verify, tools_axios, tools_filter } from './api/tool'
//  验证
Vue.prototype.$toolVerify = tool_verify;
Vue.prototype.$ajax = tools_axios;
Vue.prototype.$goFetch = fetch;
//  加载过滤器
Vue.filter('goParse', tools_filter.JsonParse);
Vue.filter('goPrice', tools_filter.changePrice);
Vue.filter('gotimes', tools_filter.goTime);
Vue.filter('goTest', tools_filter.texts);
//  导入API
import api from './common/port_uri'
Vue.prototype.$api = api;

//  使用element-ui
Vue.use(ElementUI);

//  导入swiper组件
import VueAwesomeSwiper from 'vue-awesome-swiper'
Vue.use(VueAwesomeSwiper)

//  网络请求模块vue-resource
Vue.use(VueResource);

//  发布后是否显示提示
Vue.config.productionTip = false;

//是否开启工具调试
Vue.config.devtools = process.env.NODE_ENV === 'development'

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  template: '<App/>',
  components: { App }
});

