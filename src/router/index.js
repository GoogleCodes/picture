import Vue from 'vue'
import Router from 'vue-router'

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
//  商品列表
import orderlist from '@/components/inside/order'
//  皮革相册
import picdetail from '@/components/pages/pic-detail'

//  测试
import ordcart from '@/components/cart/ord-cart'

Vue.use(Router);

let routes = [{
  path: '/',
  header: true,
  name: 'Index',
  component: Index,
  children: [],
},{
  path: '/inside/dingzhi',
  name: 'dingzhi',
  component: dingzhi
},{
  path: '/inside/orderlist',
  name: 'orderlist',
  component: orderlist
},{
  path: '/pages/detail',
  name: 'detail',
  component: detail
},{
  path: '/pages/pic-detail',
  name: 'picdetail',
  component: picdetail
},{
  path: '/pages/onload',
  name: 'onload',
  component: onloadpic
},{
  path: '/pages/onloadtwo',
  name: 'onloadtwo',
  component: onloadtwo
},{
  path: '/pages/frame',
  name: 'frame',
  component: frame
},{
  path: '/user/login',
  name: 'login',
  component: login,
},{
  path: '/user/register',
  name: 'reg',
  component: register,
},{
  path: '/user/find',
  name: 'find',
  component: find,
},{
  path: '/admin/admin',
  name: 'admin',
  component: admin,
  children: [{
    path: '/admin/vip',
    name: 'vip',
    component: vip,
  },{
    path: '/admin/changepwd',
    name: 'changepwd',
    component: changepwd,
  },{
    path: '/admin/shoping',
    name: 'shoping',
    component: shoping,
  },{
    path: '/admin/manage',
    name: 'manage',
    component: manage,
  },{
    path: '/admin/address',
    name: 'address',
    component: address,
  },{
    path: '/admin/increase',
    name: 'increase',
    component: increase,
  }],
},{
  path: '/cart/cart',
  name: 'cart',
  component: cart,
},{
  path: '/cart/ord-cart',
  name: 'ordcart',
  component: ordcart,
},{
  path: '/cart/add-cart',
  name: 'addCart',
  header: true,
  component: addcart,
},{
  path: '/cart/submit',
  name: 'submit',
  component: submit,
}];


const router = new Router({
  routes,
  mode: 'hash', //default: hash ,history
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return {x: 0, y: 0}
    }
  }
});

// 全局路由配置
// 路由开始之前的操作
router.beforeEach((to, from, next) => {
  next();
  console.log(to);
});


export default router;


