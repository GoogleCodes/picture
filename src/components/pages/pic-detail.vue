<template>
  <div>
    <navs></navs>
    <div class="w1200 mauto pic-detail">
      <div class="exper-pic fl">
        <div class="exper-pic-wrap">
          <el-carousel height="360px">
            <el-carousel-item v-for="item in 2">
              <img src="../../../static/images/39.png" alt="" style="width: 100%;height: 420px;">
            </el-carousel-item>
          </el-carousel>
        </div>
        <div class="exper-pic-item">
          <div class="a1" v-for="item in 5"></div>
        </div>
      </div>
      <div class="tb-wrap clear">
        <div class="wrap-select">
          <div class="select-title ft-24">金色古典</div>
          <div class="select-text ft-14 c_898989">高雅复古风</div>
          <div class="select-price ft-24 c_e64147">¥360.00</div>

          <div class="select-color pub-wrap">
            <div class="left c_9fa0a0 fl">款色：</div>
            <ul class="fl">
              <li class="select-right c_9fa0a0">金黄色</li>
            </ul>
          </div>
          <div class="select-size pub-wrap clear">
            <div class="left c_9fa0a0 fl">尺寸：</div>
            <ul class="right clearfix fl">
              <li class="select-right c_9fa0a0" v-for="list in size">{{ list }}</li>
            </ul>
          </div>
          <div class="select-size pub-wrap clear">
            <div class="left c_9fa0a0 fl">工艺：</div>
            <ul class="right clearfix fl">
              <li class="select-right c_9fa0a0" v-for="list in size">{{ list }}</li>
            </ul>
          </div>
          <div class="select-size pub-wrap clear">
            <div class="left c_9fa0a0 fl">页数：</div>
            <div class="c_9fa0a0 fl">皮册共30页</div>
          </div>
          <div class="select-num pub-wrap clear">
            <div class="left fl c_9fa0a0">数量：</div>
            <div class="item-amount ">
              <el-button class="no-minus fl" @click="nominus" :class="{'disabled':pnums <= 1}">-</el-button>
              <el-input type="text" class="fl marLeft" placeholder="0" v-model="pnums"></el-input>
              <el-button class="add-max fl marLeft" @click="addmax" :class="{'disabled': pnums >= 1}">+</el-button>
            </div>
            <el-button class="ft-16 fr addCart">加入购物车</el-button>
          </div>
        </div>
      </div>

      <div class="detail-bottom clear">
        <div class="product-title">PRESENTATION</div>
        <span class="product-text">商品详情</span>
        <div class="content-top clearfix">
          <div class="pic-left">
            <img src="../../../static/images/33.png" alt="" class="w100 h100">
          </div>
          <div class="text-right">
            <div class="one">我们专注于</div>
            <div class="two">We focus on the selection of raw materials</div>
            <div class="three">原材料的精挑细选</div>
            <div class="text-vertical ft-18">
              <p>还原画芯真实色彩</p>
              <p>佳能高级打印机准确输出</p>
              <p>高仿颜料纹理质感</p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="w100 clear" style="background: #f7f8f8;">
      <div class="w1200 mauto" style="padding: 1px 0">
        <other></other>
      </div>
    </div>
  </div>
</template>


<script type="text/javascript">
  import other from '@/components/pages/other.vue'
  import navs from '@/components/top/Nav.vue'


  export default {
    data() {
      return {
        size: {
          one: '26寸',
        },
        isActive: true,
        pnums: 0,
      }
    },
    created() {

    },
    components: {
      navs,
      other
    },
    methods: {
      nominus() {
        if (this.pnums > 0) {
          this.pnums--;
        }
      },
      addmax() {
        if (this.pnums < 0) {
          return false;
        }
        this.pnums++;
      }
    }
  };

</script>

<style type="text/css">
  /* pic-detail start */
  .pic-detail {
    background: #fff;
  }

  .pic-detail .tb-wrap {
    padding: 64px 0px;
    border-bottom: 1px solid #ddd;
  }

  .pic-detail .tb-wrap .wrap-select .select-text {
    margin: 19px 0 5px;
  }

  .pic-detail .tb-wrap .wrap-select .select-price {
    padding: 10px 0;
    margin: 0px 0 30px;
    border-bottom: 1px solid #dcdddd;
  }
  .tb-wrap .wrap-select .pub-wrap {
    padding: 10px 0;
    overflow: hidden;
  }

  .tb-wrap .wrap-select .pub-wrap .left {
    display: inline-block;
    width: 100px;
    line-height: 30px;
  }

  .tb-wrap .wrap-select .pub-wrap ul .select-right {
    width: 130px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    border-radius: 5px;
    background: #fff;
    cursor: pointer;
    border: 1px solid #9fa0a0;
  }

  .tb-wrap .wrap-select .pub-wrap ul .active {
    background: #b11e25;
    color: #fff;
    border: 1px solid #b11e25;
  }

  .tb-wrap .wrap-select .select-num {
    width: 470px;
  }

  .tb-wrap .wrap-select .select-num .el-input {
    width: 75px;
    font-weight: bold;
  }

  .select-num .el-input .el-input__inner {
    text-align: center;
    background: #f7f8f8;
    font-weight: bold;
  }

  .tb-wrap .wrap-select .select-num .el-button {
    background: #f7f8f8;
    font-weight: bold;
  }

  .tb-wrap .wrap-select .select-num .el-button:last-child {
    margin-left: 10px;
    font-weight: bold;
  }

  .tb-wrap .wrap-select .select-num .addCart {
    background: #414042;
    border: 3px solid #333;
    width: 169px;
    height: 47px;
    color: #fff;
    position: relative;
    bottom: 5px;
    border-radius: 0px;
  }

  .detail-bottom {
    text-align: center;
    padding-top: 45px;
  }
  .detail-bottom .product-title {
    font-size: 30px;
    color: #000;
    text-align: center;
  }
  .detail-bottom .product-text {
    position: relative;
    font-size: 18px;
    color: #333;
    line-height: 50px;
  }
  .detail-bottom .product-text:before,
  .detail-bottom .product-text:after {
    content: '';
    position: absolute;
    width: 24px;
    height: 0;
    border-bottom: 1px solid #717171;
    top: 50%;
  }
  .detail-bottom .product-text:before {
    left: -45px;
  }
  .detail-bottom .product-text:after {
    right: -45px;
  }
  .detail-bottom .content-top {
    padding-top: 60px;
    margin: 0 40px 48px;
  }
  .detail-bottom .content-top .pic-left {
    float: left;
    width: 570px;
    height: 754px;
  }

  .detail-bottom .content-top .text-right {
    /* 右侧文本 */
    float: right;
    width: 354px;
    margin-right: 115px;
    padding-top: 140px;
    text-align: center;
  }
  .detail-bottom .content-top .text-right .one {
    font-size: 40px;
    font-weight: lighter;
  }
  .detail-bottom .content-top .text-right .two {
    font-size: 10px;
    line-height: 40px;
  }
  .detail-bottom .content-top .text-right .three {
    font-size: 40px;
  }
  .detail-bottom .content-top .text-right .text-vertical {
    display: flex;
    height: 300px;
    flex-direction: row-reverse;
    justify-content: space-around;
    align-items: center;
    padding: 0 40px;
  }
  .detail-bottom .content-top .text-right .text-vertical p {
    writing-mode: tb-rl;
    color: #727171;
  }
  .detail-bottom .content-bottom {
    margin: 0px 45px 100px;
    color: #3e3a39;
  }

  /* pic-detail end */
</style>
