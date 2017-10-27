<template>
  <div class="frame-bg" style="">
    <!-- tab-banner start-->
    <div class="tab-banner">
      <img src="../../../static/images/51.png" alt="" class="w100 h100" >
    </div>
    <div class="wrap-pic">
      <img src="../../../static/images/54.png" alt="" class="w100 h100" >
      <div class="wrap-pic-text w100">
        <span class="ft-28">体验区</span>
        <div class="line"></div>
        <div class="pic-desc ft-16">
          <span>匠杺，是一辈子只做好一件事，<br />用漫长岁月传承一门手艺；<br />匠杺用心为每一个相框赋予美好，<br />保留最珍贵的回忆。<br />从这里开始.......</span>
        </div>
      </div>
    </div>
    <!-- tab-banner end -->

    <!-- frame-product start -->
    <div class="frame-product">
      <div class="container">
        <ul class="product-list clearfix">
          <template v-for="item in 4">
            <li class="fl">
              <router-link :to="{ path: '/'}" class="w100 h100 block">
                <div class="prod-pic">
                  <img src="../../../static/images/55.png" alt="" class="w100 h100" >
                </div>
                <div class="content">
                  <h3>复古木纹</h3>
                </div>
              </router-link>
            </li>
          </template>
        </ul>
        <div class="show-more">
          <span class="btn-more">加载更多</span>
        </div>
      </div>
    </div>
    <!-- frame-product end -->
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
  /* frame-bg start */
  .frame-bg {
    background: #fff;
    padding: 0px;
  }
  .frame-bg .wrap-pic {
    width: 300px;
    margin: 30px auto;
    position: relative;
  }
  .frame-bg .wrap-pic .wrap-pic-text {
    position: absolute;
    top: 0px;
    left: 0px;
    text-align: center;
  }
  .frame-bg .wrap-pic .line {
    width: 60px;
    height: 3px;
    margin: 10px auto 0px;
    background: #b11e25;
  }
  .frame-bg .wrap-pic .wrap-pic-text .pic-desc {
    color: #6d706f;
    margin: 30px 10px;
    line-height: 30px;
  }
  /* frame-bg end */
  .frame-product {
    margin: 87px auto 0px;
  }
  .frame-product .container ul li {
    width: 45%;
    margin: 25px 0px 0px 10px;
  }
  .frame-product .container ul li .prod-pic {
    width: 100%;
    height: 100%;
  }
  .frame-product .container ul li .content {
    text-align: center;
    margin: 20px auto 0px;
  }
  .frame-product .container .show-more {
    text-align: center;
    line-height: 90px;
  }
  /* tab-banner start */
  .tab-banner {
    /*margin-top: 18px;*/
  }
  /* tab-banner end */

</style>
