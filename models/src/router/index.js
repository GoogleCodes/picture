import Vue from 'vue'
import Router from 'vue-router'

import { storageSet, storageGet } from '../api/utils.js'

import store from '../store'

//  首页
import Index from '@/components/Index'
//  定制
import dingzhi from '@/components/inside/dingzhi'
//  商品详情
import detail from '@/components/pages/detail'
//  上传图片
import onloadpic from '@/components/pages/onload'
import onloadtwo from '@/components/pages/onloadtwo'
//  相框
import frame from '@/components/pages/frame'
//  相框详情页
import fdetail from '@/components/pages/frame-detail'
//  购物车
import cart from '@/components/cart/cart'
//  加入购物车
import addcart from '@/components/cart/add-cart'
//  提交订单
import submit from '@/components/cart/submit'
//  管理页面
import admin from '@/components/admin/admin'
//  会员页面
import vip from '@/components/admin/vip'
//  修改密码
import changepwd from '@/components/admin/changePwd'
//  历史订单
import shoping from '@/components/admin/shoping'
//  地址管理
import address from '@/components/admin/address'
//  管理订单
import manage from '@/components/admin/manage'
//  增加地址
import increase from '@/components/admin/increase'
//  登录
import login from '@/components/user/login'
//  忘记密码
import find from '@/components/user/find'
//  会员注册
import register from '@/components/user/register'
//  修改密码
import modify from '@/components/user/modify'
//  商品列表
import orderlist from '@/components/inside/order'

import proseries from '@/components/content/proseries'
//  皮革相册
import picdetail from '@/components/pages/pic-detail'
//  测试
import ordcart from '@/components/cart/ord-cart'
//  绘画装饰
import paintings from '@/components/pages/paintings'
//  订单列表
import order from '@/components/pages/order-list'
//  订单确认
import orddetail from '@/components/pages/ord-detail'
//  产品详情
import otherdetail from '@/components/pages/other-detail'
//  成功加入购物车
import cartOther from '@/components/pages/other'
//  订单支付
import gopay from '@/components/pages/gopay'
//  新闻
import news from '@/components/content/news'
import newsdetail from '@/components/content/newsdetail'
//  个人资料
import personal from '@/components/user/personal'

//  Dome 测试
import DomeUpload from '@/components/dome/dome'
Vue.use(Router);

let routes = [{
  path: '/',
  name: 'Index',
  component: Index,
  meta: {
    header: true,
    position: 1,
    footer: true,
    requiresAuth: true,
  },
  children: [],
},{
  path: '/inside/dingzhi',
  name: 'dingzhi',
  component: dingzhi,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/content/news',
  name: 'news',
  component: news,
  meta: {
    header: false,
    title: '新闻列表',
    goback: true,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/content/newsdetail',
  name: 'newsdetail',
  component: newsdetail,
  meta: {
    header: false,
    title: '新闻内容',
    goback: true,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/inside/orderlist',
  name: 'orderlist',
  component: orderlist,
  meta: {
    position: 1,
    header: false,
    title: '产品系列',
    goback: true,
    footer: true,
    requiresAuth: true
  }
},{
  path: '/pages/order',
  name: 'order',
  component: order,
  meta: {
    header: false,
    position: 3,
    title: '商品列表',
    goback: true,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/content/proseries',
  name: 'proseries',
  component: proseries,
  meta: {
    position: 1,
    header: false,
    goback: true,
    title: '婚纱装裱',
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/detail',
  name: 'detail',
  component: detail,
  meta: {
    goback: true,
    title: '产品详情',
    footer: true,
    requiresAuth: true
  },
},{
  path: '/pages/pic-detail/:id',
  name: 'picdetail',
  component: picdetail,
  meta: {
    header: false,
    title: '订单详情',
    goback: true,
    footer: false,
     requiresAuth: true
  }
},{
  path: '/pages/other-detail',
  name: 'otherdetail',
  component: otherdetail,
  meta: {
    header: false,
    title: '产品详情',
    goback: true,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/onload',
  name: 'onload',
  component: onloadpic,
  meta: {
    header: false,
    goback: true,
    title: '照片上传',
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/other',
  name: 'cartOther',
  component: cartOther,
  meta: {
    header: false,
    goback: true,
    title: '购物车',
    footer: false,
     requiresAuth: true
  }
},{
  path: '/pages/gopay',
  name: 'gopay',
  component: gopay,
  meta: {
    header: false,
    goback: true,
    title: '订单支付',
    footer: false,
     requiresAuth: true
  }
},{
  path: '/pages/onloadtwo',
  name: 'onloadtwo',
  component: onloadtwo,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/frame',
  name: 'frame',
  component: frame,
  meta: {
    header: false,
    goback: true,
    title: '体验区',
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/frame-detail',
  name: 'fdetail',
  component: fdetail,
  meta: {
    header: false,
    goback: true,
    title: '体验区',
    footer: false,
     requiresAuth: true
  }
},{
  path: '/user/login',
  name: 'login',
  component: login,
  meta: {
    header: false,
    footer: false,
    title: '登录帐号',
    goback: true,
     requiresAuth: false,
  }
},{
  path: '/user/register',
  name: 'reg',
  component: register,
  meta: {
    header: false,
    footer: false,
    title: '注册帐号',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/user/find',
  name: 'find',
  component: find,
  meta: {
    header: false,
    footer: false,
    title: '修改密码',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/user/personal',
  name: 'personal',
  component: personal,
  meta: {
    header: false,
    footer: true,
    title: '个人资料',
    goback: true,
    requiresAuth: true
  }
},{
  path: '/user/modify',
  name: 'modify',
  component: modify,
  meta: {
    header: false,
    footer: false,
    title: '找回密码',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/pages/ord-detail',
  name: 'orddetail',
  component: orddetail,
  meta: {
    header: false,
    footer: false,
    title: '订单确认',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/admin/admin',
  name: 'admin',
  component: admin,
  meta: {
    header: false,
    position: 4,
    footer: true,
    title: '会员中心',
    goback: true,
     requiresAuth: true
  },
},{
  path: '/admin/vip',
  name: 'vip',
  component: vip,
  meta: {
    header: false,
    footer: true,
    position: 4,
    title: '会员中心',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/admin/changepwd',
  name: 'changepwd',
  component: changepwd,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/admin/shoping',
  name: 'shoping',
  component: shoping,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/admin/manage',
  name: 'manage',
  component: manage,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/admin/address',
  name: 'address',
  component: address,
  meta: {
    header: false,
    title: '收货地址',
    footer: true,
    goback: true,
     requiresAuth: true
  }
},{
  path: '/admin/increase',
  name: 'increase',
  component: increase,
  meta: {
    header: false,
    title: '增加地址',
    footer: true,
    goback: true,
     requiresAuth: true
  }
},{
  path: '/cart/cart',
  name: 'cart',
  component: cart,
  meta: {
    header: false,
    position: 2,
    footer: true,
    title: '购物车',
    goback: true,
     requiresAuth: true
  }
},{
  path: '/cart/ord-cart',
  name: 'ordcart',
  component: ordcart,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/cart/add-cart',
  name: 'addCart',
  header: true,
  component: addcart,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/cart/submit',
  name: 'submit',
  component: submit,
  meta: {
    header: false,
    footer: true,
     requiresAuth: true
  }
},{
  path: '/pages/paintings',
  name: 'paintings',
  component: paintings,
  meta: {
    header: false,
    goback: true,
    title: '装饰画',
    footer: true,
     requiresAuth: true
  }
},{
  path: '/dome/dome',
  name: 'DomeUpload',
  component: DomeUpload,
  meta: {
    header: false,
    goback: true,
    title: '装饰画',
    footer: true,
     requiresAuth: true
  }
}];


const router = new Router({
  routes,
});

// 全局路由配置
// 路由开始之前的操作
router.beforeEach((to, from, next) => {

  let { href, protocol, host, search, hash } = window.location
  const pathname = '/mobile/index.html' // 解决支付路径问题添加的前缀，替换成你的
  search = search || '?'
  hash = hash || '#!/'
  let newHref = `${protocol}//${host}${pathname}${search}${hash}`
  if (newHref !== href) {
    window.location.replace(newHref)
  }

  //  判断open是否存在
  if (store.state.user_openid == undefined) {
      window.location.href = "https://xinye-art.com/public/api/home/pay/getcode"
      storageSet('openid', store.state.user_openid);
      return true;
  }

  let is_login = store.state.user_info.user
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (is_login == undefined) {
      next({
        name: 'login'
      })
    } else {
      next()
    }
  } else {
    next()
  }

});

export default router;


