<template>
  <div>
    <!-- tab-banner start-->
    <div class="tab-banner">
      <img src="../../../static/images/42.jpg" alt="" class="w100 h100" >
    </div>
    <!-- tab-banner end -->

    <!-- frame-product start -->
    <div class="frame-product w1200">
      <div class="container">
        <div class="product-top-title">
          <h3>PHOTO FRAME</h3>
          <p class="line"></p>
          <p>婚纱相框</p>
        </div>
        <ul class="product-list clearfix">
          <li>
            <div class="frame-pic">
              <img src="../../../static/images/40.jpg" alt="" class="w100 h100" />
              <div class="filter-layer" style=""></div>
            </div>
            <div class="content">
              <h3>复古木纹</h3>
              <p>MP14533-2B</p>
              <router-link :to="{ path: '/'}" class="display">
                <span class="more">查看更多</span>
              </router-link>
            </div>
          </li>
        </ul>
        <div class="show-more">
          <span class="btn-more">展开更多</span>
        </div>
      </div>
    </div>
    <!-- frame-product end -->

    <!-- frame-ban start -->
    <div class="frame-ban w1200">
      <img src="../../../static/images/41.jpg" alt="" class="w100 h100" >
    </div>
    <!-- frame-ban end -->
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
    data() {
      return {

      }
    },
    components: {
      heads,
      foots
    },
    created() {

    },
    methods: {

    }
  }
</script>

<style type="text/css">
  /* 产品内容 */
  .frame-product {
    margin: 45px auto;
  }
  .frame-product .product-top-title {
    width: 100%;
    height: 136px;
    padding-top: 100px;
    margin-bottom: 40px;
    background: url("../../../static/images/39.jpg");
    text-align: center;
  }
  .frame-product .product-top-title h3 {
    text-align: center;
    font-size: 29px;
    font-style: italic;
    color: #fff;
  }
  .frame-product .product-top-title .line {
    margin: 3px 525px;
    height: 0;
    border-bottom: 1px solid #fff;
  }
  .frame-product .product-top-title p {
    text-align: center;
    font-size: 27px;
    color: #fff;
  }
  /* 产品列表 */
  .frame-product .product-list {
    width: 1230px;
  }
  .frame-product .product-list li {
    float: left;
    position: relative;
    width: 584px;
    height: 381px;
    margin-right: 28px;
    margin-bottom: 28px;
    box-shadow: 0 0 5px #ccc;
  }

  .frame-product .product-list li .frame-pic {
    width: 584px;
    position: relative;
    height: 381px;
  }

  .frame-pic .filter-layer {
    background: rgba(0,0,0,0.5);
    -webkit-filter: blur(2px);
    -moz-filter: blur(2px);
    -ms-filter: blur(2px);
    -o-filter: blur(2px);
    position: absolute;
    filter: blur(2px);
    height: 100%;
    width: 100%;
    left: 0px;
    top: 0px;
  }

  .frame-product .product-list li .content {
    position: absolute;
    width: 200px;
    top: 120px;
    left: 50%;
    margin-left: -100px;
    text-align: center;
  }
  .frame-product .product-list li .content h3 {
    font-size: 26px;
    color: #fff;
  }
  .frame-product .product-list li .content p {
    font-size: 13px;
    color: #fff;
    margin: 12px;
  }
  .frame-product .product-list li .content span {
    display: inline-block;
    width: 122px;
    height: 40px;
    background: #fff;
    border-radius: 20px;
    color: #000;
    line-height: 40px;
    cursor: pointer;
  }
  .frame-product .show-more {
    margin-top: 18px;
    margin-bottom: 40px;
    text-align: center;
  }
  .frame-product .show-more .btn-more {
    display: inline-block;
    width: 184px;
    height: 42px;
    border: 1px solid #ccc;
    font-size: 16px;
    line-height: 42px;
    text-align: center;
    color: #4D4D4D;
    cursor: pointer;
  }


  .frame-ban {
    height: 400px;
    margin: 45px auto;
  }
</style>
