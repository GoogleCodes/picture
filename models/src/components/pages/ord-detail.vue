<template>
    <div style="margin-top: 46px;">
        <div class="address-box">
            <div class="border-line"></div>
            <div class="border-line-vertical" style="left: 0px;"></div>
            <!--<div class="add-con">-->
              <!--<span>-->
                <!--<i>还没添加快递地址</i>-->
                <!--<i @click="goSize()" style="color: #fcbcbc">点我设置</i>-->
              <!--</span>-->
            <!--</div>-->
            <div class="add-desc">
              <p style="margin-left: 16px;">
                <span class="add-desc-name">邓某某</span>
                <span class="add-desc-phone">13232800159</span>
              </p>
              <p class="add-desc-msg"><i class="iconfont icon-dizhi"></i>广东省佛山市顺德区杏坛镇光华村</p>
            </div>
            <div class="border-line-vertical" style="right: 0px;"></div>
            <div class="border-line"></div>
        </div>
        <div class="balance-list">
            <div class="balan-pic fl">
              <img src="../../../static/images/30.png" alt="" class="w100 h100">
            </div>
            <div class="balan-text fl">
                <div class="bal-title ft-16">照片冲印、手机上传打印照片</div>
                <p>单价 : <i class="c_b11e25">0.60元</i></p>
                <p>数量 : 1</p>
            </div>
            <ul class="clear">
                <li>
                    <span>商品合计 : </span>
                    <span class="fr">¥ 0.60</span>
                </li>
                <li>
                    <span>实收金额 : </span>
                    <span class="fr c_e64147" style="font-weight: bold">¥ 0.60</span>
                </li>
                <li class="c_b11e25">
                    <span>注 : 快递费用自付</span>
                </li>
            </ul>
        </div>
        <el-button class="nowGoPay">立即支付</el-button>
    </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
    export default {
      components: {ElButton}, data() {
            return {

            }
        },
        created() {

        },
        methods: {
            goSize() {

            }
        }
    }
</script>

<style type="text/css">
  /* nowGoPay start */
  .nowGoPay {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    border-radius: 0px;
    border: 1px solid #b11e25;
    color: #fff;
    height: 40px;
    background: #b11e25;
  }
  .nowGoPay :focus, .nowGoPay:hover {
    color: #fff;
    border: 1px solid #b11e25;
  }
  /* nowGoPay end */

  /* balance-list start */
  .balance-list {
    margin: 20px 10px 0px;
    clear: both;
    overflow: hidden;
    background: #fff;
    padding: 10px 10px;
  }
  .balance-list .balan-pic {
    width: 35%;
    height: 100%;
  }
  .balance-list .balan-text {
    width: 60%;
    margin-left: 14px;
  }
  .balance-list .balan-text .bal-title {
    overflow: hidden;
    text-overflow: ellipsis;
    color: #5d6060;
    height: 27px;
  }
  .balance-list ul li {
    height: 40px;
    line-height: 40px;
    border-bottom: 1px solid #f2f2f2;
  }
  .balance-list ul li:last-child {
    border: none;
  }
  /* balance-list end */

  /* address-box start */
  .address-box {
    margin: 0px 5px;
    background: #fffaf3;
    position: relative;
    top: 8px;
  }
  .address-box .add-desc {
    margin: 15px;
  }
  .address-box .add-con {
    height: 80px;
    width: 95%;
    text-align: center;
    line-height: 80px;
    margin: 0px 6px;
  }
  .address-box .border-line-vertical {
    width: 0.4rem;
    height: 100%;
    background: url('../../../static/images/address-2.png');
    background-position: top;
    background-repeat: repeat-y;
    background-size: contain;
    float: left;
    position: absolute;
    top: 0px;

  }
  .address-box .border-line {
    width: 100%;
    height: 0.4rem;
    background: url('../../../static/images/address-1.png');
    background-position: left;
    background-repeat: repeat-x;
    background-size: contain;
  }
  /* address-box end */
</style>
