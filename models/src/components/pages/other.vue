<template>
  <div>
    <div class="cart-success">
      <div class="success-text">
        <i class="el-icon-check"></i>
        <p class="el-desc ft-18">商品已经成功加入购物车</p>
        <router-link :to="{ path: '/cart/cart'}" class="el-btn">购物车</router-link>
        <router-link :to="{ path: ''}" class="el-btn shop-msg">查看商品详情</router-link>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  export default {
    components: {

    },
    data() {
      return {
        data: {
          arr: [],
        },
      }
    },
    created() {

    },
    methods: {

    },
  }
</script>

<style>
  .cart-success {
    width: 100%;
    height: 100%;
  }
  .cart-success .success-text {
    margin: 0px auto;
    padding: 150px 0;
    height: 100%;
    overflow: hidden;
    text-align: center;
  }
  .cart-success .success-text .el-icon-check {
    width: 40px;
    height: 40px;
    line-height: 45px;
    color: #fff;
    background: #fcd11a;
    border-radius: 100%;
  }
  .cart-success .success-text .el-desc {
    line-height: 50px;
    margin-bottom: 25px;
  }
  .cart-success .success-text .el-btn {
    padding: 8px 20px;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    border-radius: 5px;
  }
  .cart-success .success-text .shop-msg {
    color: #595757;
    background: #fff;
    margin-left: 10px;
    border: 1px solid #595757;
  }
</style>
