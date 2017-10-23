<template>
  <div>
    <div class="pic-detail">
      <div class="bl-express-box">
        <div class="wait">
          <span class="fl ft-16">待付款，赶快去支付吧</span>
          <i class="iconfont icon-fukuan fr"></i>
        </div>
        <div class="wait" style="display: none;">
          <span class="fl ft-16">待付款，赶快去支付吧</span>
          <i class="iconfont icon-fahuo fr"></i>
        </div>
        <div class="wait" style="display: none;">
          <span class="fl ft-16">待付款，赶快去支付吧</span>
          <i class="iconfont icon-yifahuo fr"></i>
        </div>
      </div>

      <div class="info-express">
        <div class="exp-content">
          <div class="iconfont icon-dizhi fl c_4d4d4d"></div>
          <div class="ex-line">
            <div class="c_4d4d4d fl">
              <span>收件人：</span>
              <span>恩小猫</span>
            </div>
            <div class="fr c_4d4d4d">13672964196</div>
            <div class="info-address c_4d4d4d">
              <span>收货地址：</span>
              <span>广东省佛山市顺德区佛山市顺德区大良街道家电城41号</span>
            </div>
          </div>
        </div>
      </div>

      <div style="width: 100%;height: 100%;background: #fff;overflow: hidden">
        <router-link :to="{ path: '/pages/pic-detail'}" class="block">
          <div class="order-msg fl">
            <div class="line" style="">
              <div class="order-pic fl">
                <img src="../../../static/images/23.png" alt="" class="w100 h100">
              </div>
              <div class="wrap fl">

                <div class="wrap-title ft-16">#北欧风格装饰画 高格调 </div>
                <div class="wrap-desc clear c_898989">装饰你的新房子 </div>
                <div class="wrap-money"></div>
              </div>
              <div class="status fr">
                <p>￥99.80</p>
                <p>X1</p>
              </div>
            </div>
          </div>
        </router-link>
        <div class="freight clear">
          <span class="fl">运费</span>
          <span class="fr">包邮</span>
        </div>
        <div class="money-util fr">
          <p>商品总价：￥39.80</p>
          <p class="ft-18">
            <span>实付款：</span>
            <span class="c_b11e25">￥</span>
            <i class="c_b11e25">39.80</i>
          </p>
        </div>
        <div class="comment clear">
          <div class="comment-money fl">
            <span class="fl money">应付：</span>
            <span class="fl c_b11e25">￥39.80</span>
          </div>
          <div class="gopay fr">立即支付</div>
        </div>
      </div>
    </div>
  </div>
</template>


<script type="text/javascript">

  export default {
    data() {
      return {}
    },
    created() {

    },
    components: {},
    methods: {},
  }

</script>

<style type="text/css">
  /* pic-detail start */
  .pic-detail .bl-express-box {
    padding: 0px 40px;
    height: 77px;
    background: #f2f2f2;
    line-height: 77px;
  }

  .pic-detail .bl-express-box .iconfont {
    font-size: 46px;
    display: block;
  }

  .pic-detail .bl-express-box span{
    color: #333;
  }

  .pic-detail .info-express {
    background: #fff;
    height: 80px;
    overflow: hidden;
  }

  .pic-detail .info-express .exp-content {
    margin: 4px 10px;
  }

  .info-express .exp-content .icon-dizhi {
    line-height: 71px;
    font-size: 20px;
  }

  .info-express .exp-content .ex-line {
    margin-left: 40px;
  }

  .info-express .exp-content .ex-line .info-address {
    height: 50px;
    width: 100%;
    overflow: hidden;
  }

  .pic-detail .order-msg {
    background: #fff;
    margin-top: 10px;
    min-height: 81px;
    padding: 10px 5px 0px 5px;
  }

  .pic-detail .order-msg .line {
    overflow: hidden;
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
  }

  .order-list .order-msg .wrap {
    width: 42%;
    margin: 4px 0px;
    padding-right: 0px;
  }

  .pic-detail .order-msg .status {
    margin: 18px 0px;
    text-align: center;
  }

  .pic-detail .order-msg .wrap .wrap-title {
    height: 23px;
    overflow: hidden;
    line-height: 21px;
    text-overflow: ellipsis;
  }

  .pic-detail .order-msg .wrap .wrap-desc {
    /*height: 30px;*/
    /*line-height: 30px;*/
  }

  .pic-detail .order-msg .order-pic {
    width: 35%;
    height: 100%;
    padding: 0px 5px;
  }

  .pic-detail .order-msg .wrap {
    width: 43%;
  }

  @media screen and (max-width: 414px) {

    .pic-detail .order-msg .status {
      margin: 27px 0px;
    }

  }

  @media screen and (max-width: 384px) {

    .pic-detail .order-msg .status {
      margin: 22px 0px;
    }

  }

  @media screen and (max-width: 375px) {

    .pic-detail .order-msg .status {
      margin: 22px 0px;
    }

  }

  @media screen and (max-width: 320px) {

    .pic-detail .order-msg {
      margin-top: 10px;
      padding: 10px 10px;
    }

    .pic-detail .order-msg .status {
      margin: 16px 0px;
    }

  }

  .pic-detail .freight {
    height: 40px;
    line-height: 40px;
    margin: 10px;
    border: 1px solid #cbcbcb;
    border-left: none;
    border-right: none;
  }

  .pic-detail .money-util {
    text-align: right;
    margin: 20px 10px;
  }

  .pic-detail .comment {
    position: fixed;
    bottom: 0px;
    height: 45px;
    width: 100%;
    background: #fff;
  }

  .pic-detail .comment .comment-money, .pic-detail .comment .gopay {
    line-height: 45px;
    width: 50%;
    text-align: center;
    box-sizing: border-box;
  }

  .pic-detail .comment .comment-money .money {
    padding-left: 32px;
  }

  .pic-detail .comment .gopay {
    background: #b11e25;
    color: #fff;
  }

  /* pic-detail end */
</style>
