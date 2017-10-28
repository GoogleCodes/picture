<template>
  <div style="margin-top: 58px;padding-bottom: 52px;" class="goToPay">
    <div class="pay-address">
      <div class="fl">
        <p class="add-p">
          <span class="pay-add-name">不会吃鱼的猫</span>
          <span>13672964186</span>
        </p>
        <p class="add-p c_9e9d9d">广东省 佛山市 顺德区 大良街道沿江北路</p>
      </div>
      <i class="el-icon-arrow-right fr c_9e9d9d"></i>
      <div class="line"></div>
      <div class="add-style">
        <span class="fl">配送方式</span>
        <span class="fr">快递</span>
      </div>
    </div>

    <div class="shopping-list">
      <div class="list-wrap">
        <div class="wrap-pic fl">
          <img src="../../../static/images/23.png" class="w100 h100 block" alt="">
        </div>
        <div class="wrap-info fl">
          <p class="ft-16 info-title">照片冲印、手机上传打印照片</p>
          <p>
            <span>单价 : <i class="c_b11e25">66.6元</i> </span>
          </p>
          <p>数量 : 1</p>
        </div>
      </div>
    </div>

    <ul>
      <li class="pay-li">
        <span class="fl">商品合计 :</span>
        <span class="fr">¥ 0.60</span>
      </li>
      <li class="pay-li">
        <span class="fl">实收金额 :</span>
        <strong class="fr">¥ 0.60</strong>
      </li>
      <li class="pay-li">
        <span>注 : 快递费用自付</span>
      </li>
      <li class="pay-li">
        <span>支付方式</span>
      </li>
      <li class="pay-li">
        <i class="iconfont icon-weixinzhifu"></i>
        <i class="iconfont icon-zhifubao"></i>
      </li>
    </ul>

    <el-button class="now-pay">立即支付</el-button>

  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  export default {
    components: {ElButton}, data() {
          return {

          }
      },
      mounted () {

      },
      watch: {

      },
      computed: {

      },
      methods: {

      }
  }
</script>

<style type="text/css">
  .pay-address {
    background: #fff;
    height: 100%;
    margin: 10px;
    border-radius: 5px;
    padding: 10px;
  }
  .pay-address .add-p {
    line-height: 30px;
  }
  .pay-address .el-icon-arrow-right {
    line-height: 65px;
  }
  .pay-address .line {
    width: 100%;
    height: 1px;
    clear: both;
    background: #9e9d9d;
  }
  .pay-address .add-style {
    height: 35px;
    line-height: 40px;
  }

  .shopping-list {
    margin: 0px 10px;
    padding: 0px 10px;
    background: #fff;
    border-radius: 5px 5px 0px 0px;
  }
  .shopping-list .list-wrap {
    padding: 10px;
    background: #fff;
    overflow: hidden;
    border-bottom: 1px solid #cacccc;
  }
  .shopping-list .list-wrap .wrap-pic {
    width: 30%;
    height: 100%;
  }
  .shopping-list .list-wrap .wrap-info {
    margin-left: 10px;
    width: 66%;
  }
  .list-wrap .wrap-info .info-title {
    height: 30px;
    line-height: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: bold;
  }

  .goToPay ul {
    margin: 0px 10px;
    padding: 10px;
    background: #fff;
    border-radius: 0px 0px 5px 5px;
  }

  .goToPay ul .pay-li {
    height: 50px;
    line-height: 50px;
    border-bottom: 1px solid #cacccc;
  }
  .goToPay ul .pay-li .icon-weixinzhifu , .goToPay ul .pay-li .icon-zhifubao {
    font-size: 34px;
  }

  .goToPay ul .pay-li .icon-weixinzhifu {
    color: #14b83b;
  }

  .goToPay ul .pay-li .icon-zhifubao {
    color: #20a0ff;
  }

  .goToPay ul .pay-li:last-child {
    border: none;
    padding-top: 10px;
  }

  .goToPay .now-pay {
    display: block;
    color: #fff;
    border: 1px solid #b11e25;
    width: 100%;
    padding: 12px 15px;
    border-radius: 0px;
    background: #b11e25;
    position: fixed;
    bottom: 0px;
  }

</style>
