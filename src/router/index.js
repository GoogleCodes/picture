import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'
//  首页
import Index from '@/components/Index'
//  定制
import dingzhi from '@/components/inside/dingzhi'
//  商品详情
import detail from '@/components/pages/detail'
import deSwiper from '@/components/pages/swiper'
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

import news from '@/components/content/news'
import newdetail from '@/components/content/newsdetail'

//  Dome
import dome from '@/components/pages/dome'
import details from '@/components/admin/details'

Vue.use(Router);

let routes = [{
  path: '/',
  header: true,
  name: 'Index',
  component: Index,
  children: [],
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/inside/dingzhi',
  name: 'dingzhi',
  component: dingzhi,
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/pages/dome',
  name: 'dome',
  component: dome,
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/inside/orderlist',
  name: 'orderlist',
  component: orderlist,
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/pages/detail',
  name: 'detail',
  component: detail,
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/pages/swiper',
  name: 'deSwiper',
  component: deSwiper,
  meta: {
    header: true,
    footer: false
  }
},{
  path: '/pages/pic-detail',
  name: 'picdetail',
  component: picdetail,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/pages/onload',
  name: 'onload',
  component: onloadpic,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/pages/onloadtwo',
  name: 'onloadtwo',
  component: onloadtwo,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/pages/frame',
  name: 'frame',
  component: frame,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/user/login',
  name: 'login',
  component: login,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/user/register',
  name: 'reg',
  component: register,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/user/find',
  name: 'find',
  component: find,
  meta: {
    header: true,
    footer: false,
  }
},{
  path: '/admin/admin',
  name: 'admin',
  component: admin,
  meta: {
    header: true,
    footer: true,
  },
  children: [{
    path: '/admin/vip',
    name: 'vip',
    component: vip,
    meta: {
      header: true,
      footer: true,
    },
  },{
    path: '/admin/changepwd',
    name: 'changepwd',
    component: changepwd,
    meta: {
      header: true,
      footer: true,
    },
  },{
    path: '/admin/shoping',
    name: 'shoping',
    component: shoping,
    meta: {
      header: true,
      footer: true,
    },
  },{
    path: '/admin/manage',
    name: 'manage',
    component: manage,
    meta: {
      header: true,
      footer: true,
    },
  },{
    path: '/admin/address',
    name: 'address',
    component: address,
    meta: {
      header: true,
      footer: true,
    },
  },{
    path: '/admin/increase',
    name: 'increase',
    component: increase,
    meta: {
      header: true,
      footer: true,
    },
  }],
},{
  path: '/cart/cart',
  name: 'cart',
  component: cart,
  meta: {
    header: true,
    footer: true,
  },
},{
  path: '/cart/ord-cart',
  name: 'ordcart',
  component: ordcart,
  meta: {
    header: true,
    footer: true,
  },
},{
  path: '/cart/add-cart',
  name: 'addCart',
  component: addcart,
  meta: {
    header: true,
    footer: true
  },
},{
  path: '/cart/submit',
  name: 'submit',
  component: submit,
  meta: {
    header: true,
    footer: true,
  },
},{
  path: '/content/news',
  name: 'news',
  component: news,
  meta: {
    header: true,
    footer: true,
  },
},{
  path: '/content/newsdetail',
  name: 'newdetail',
  component: newdetail,
  meta: {
    header: true,
    footer: true,
  },
},{
  path: '/admin/details',
  name: 'details',
  component: details,
  meta: {
    header: true,
    footer: true,
  },
}];


const router = new Router({
  routes,
  mode: 'hash', //default: hash ,history
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      console.log(savedPosition)
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
});

export default router;