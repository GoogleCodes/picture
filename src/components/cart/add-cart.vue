<template>
  <div class="bgcolor">
    <div style="width: 1200px;margin: 0px auto 45px;">
      <!-- 添加到购物车 -->
      <div class="hunsha-add-cart">
        <div class="container clearfix">
          <div class="left-pic">
            <img src="../../assets/images/30.jpg" alt="">
          </div>
          <div class="left-content">
            <div class="product-title">金色古典<span>MP14533-2B</span></div>
            <div class="product-text">高雅复古风</div>
            <div class="product-price">¥360.00</div>
          </div>
          <div class="right-content">
            <div class="tip">
              <img src="../../assets/images/29.png" alt="">
              <span>商品已经成功加入购物车</span>
            </div>
            <div class="btn">
              <router-link :to="{path : '/cart/cart'}">
                <span class="btn-cart">购物车</span>
              </router-link>
              <router-link :to="{path : '/cart/cart'}">
                <span class="btn-detail">查看商品详情</span>
              </router-link>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import other from '@/components/pages/other.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
    components: {
      heads,
      foots,
      other
    },
    data() {
      return {

      }
    },
    created() {

    },
    methods: {

    },
  }
</script>

<style>
  /* 添加到购物车 */
  .hunsha-add-cart {
    //  margin-top: 25px;
    padding-top: 40px;
  }
  .hunsha-add-cart .container {
    // margin-top: 70px;
    padding-top: 50px;
    padding-bottom: 70px;
    background: #fff;
  }
  .hunsha-add-cart .container .left-pic {
    float: left;
    margin-left: 35px;
  }
  .hunsha-add-cart .container .left-pic img {
    width: 122px;
    height: 108px;
  }
  .hunsha-add-cart .container .left-content {
    float: left;
    margin-left: 45px;
  }
  .hunsha-add-cart .container .left-content .product-title {
    font-size: 26px;
    color: #000;
  }
  .hunsha-add-cart .container .left-content .product-title span {
    font-size: 14px;
    padding-left: 10px;
  }
  .hunsha-add-cart .container .left-content .product-text {
    font-size: 15px;
    line-height: 50px;
  }
  .hunsha-add-cart .container .left-content .product-price {
    font-size: 24px;
    color: #e54147;
  }
  .hunsha-add-cart .container .right-content {
    float: right;
    width: 330px;
    margin-right: 30px;
  }
  .hunsha-add-cart .container .right-content .tip {
    margin-bottom: 36px;
  }
  .hunsha-add-cart .container .right-content .tip img {
    width: 40px;
    height: 40px;
    vertical-align: bottom;
  }
  .hunsha-add-cart .container .right-content .tip span {
    padding-left: 10px;
    font-size: 23px;
    color: #000;
    line-height: 40px;
  }
  .hunsha-add-cart .container .right-content .btn span {
    display: inline-block;
    width: 146px;
    height: 38px;
    margin-right: 5px;
    border-radius: 5px;
    text-align: center;
    line-height: 38px;
  }
  .hunsha-add-cart .container .right-content .btn .btn-cart {
    background: #b01e25;
    color: #fff;
  }
  .hunsha-add-cart .container .right-content .btn .btn-detail {
    border: 1px solid #000;
    box-sizing: border-box;
    color: #000;
    background: #fff;
  }
</style>
