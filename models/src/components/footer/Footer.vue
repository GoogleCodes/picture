<template>
  <!-- footer start -->
  <div class="footer clear" v-show="$route.meta.footer">
    <ul>
      <li class="fl">
        <router-link :to="{ path: '/'}" class="foot-href" :class="{'active' : $route.meta.position === 1 }">
          <i class="iconfont icon-homel block"></i>
          <span>主页</span>
        </router-link>
      </li>
      <li class="fl">
        <router-link :to="{ path: '/cart/cart'}" class="foot-href" :class="{'active' : $route.meta.position === 2 }">
          <el-badge :value="getNumber" class="item">
            <i class="iconfont icon-cart block"></i>
            <span>购物车</span>
          </el-badge>
        </router-link>
      </li>
      <li class="fl">
        <router-link :to="{ path: '/pages/order'}" class="foot-href" :class="{'active' : $route.meta.position === 3 }">
          <i class="iconfont icon-dingdan1 block"></i>
          <span>订单</span>
        </router-link>
      </li>
      <li class="fl">
        <router-link :to="{ path: '/admin/admin'}" class="foot-href" :class="{'active' : $route.meta.position === 4 }">
          <i class="iconfont icon-geren block"></i>
          <span>我的</span>
        </router-link>
      </li>
    </ul>
  </div>
  <!-- footer end -->
</template>

<script type="text/javascript">
  export default {
    name: 'foots',
    data() {
        return {

        }
    },
    computed: {
      getYear() {
        return new Date().getFullYear()
      },
      getNumber() {
          return this.$storageGet('cart_info').length
      }
    },
    watch: {

    },
    created() {

    },
    methods: {

    }
  };
</script>

<style type="text/css">
  .footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 50px;
    z-index: 100;
    background: #000;
  }

  .footer ul li {
    width: 25%;
    text-align: center;
  }

  .footer ul li .foot-href {
    color: #fff;
  }
  .footer ul li .active {
    color: #b11e25;
  }
  .footer ul li .foot-href:active {
    color: #b11e25;
  }


  .footer ul li .iconfont {
    position: relative;
    top: 4px;
    font-size: 20px;
  }

  .footer ul li span {
    position: relative;
    top: 2px;
  }

</style>


<style type="text/css">
  .el-badge__content.is-fixed {
    top: 4px;
    right: 20px;
  }
</style>
