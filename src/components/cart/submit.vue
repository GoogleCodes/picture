<template>
  <div class="bgcolor">
    <div class="cart-body">
      <div class="cart-head">
        <div class="cart-h1">CHECK OUT</div>
        <p class="cart-h2">
          <span class="line block fl"></span>
          <span class="block clear">确认订单</span>
          <span class="line block fr"></span>
        </p>
      </div>
      <div class="cart-content" style="padding-bottom: 100px;">

        <div class="cart-address cart-box fl">
          <p class="ft-18 cart-box-head">
            <strong>恩小猫</strong>/<strong>13672964196</strong>
          </p>
          <p class="cart-box-desc" style="color: #898989;">
            <span class="block">中国 广东 佛山 顺德区 </span>
            <span class="block">佛市顺德区大良街道6号（邮编：528300）</span></p>
        </div>

        <div class="cart-address fl" @click="openAddress">
          <div class="form-box ft-20">
            <span style="font-size: 30px;">+</span>
            <span>还没添加快递地址</span>
          </div>
        </div>
        <div class="distribution clear">
          <div class="distr-title ft-18">配送方式</div>
          <ul>
            <li class="fl">申通快递</li>
            <li class="fl">顺丰速递</li>
            <li class="fl">顺丰到付</li>
            <li class="fl">上门自提</li>
          </ul>
          <div class="pay clear">
            <div class="pay-title ft-18 clear">选中支付方式</div>
            <ul>
              <li class="fl iconfont icon-zhifubao" style="color: #25abee;"></li>
              <li class="fl iconfont icon-weixinzhifu" style="color: #41b035;"></li>
            </ul>
          </div>
        </div>
        <div class="list-goods">
          <div class="list-head ft-18">
            <i class="iconfont icon-gouwudai ft-20"></i>
            <span>商品清单</span>
            <router-link :to="{ path: '/cart/cart'}" class="backcart fr">返回购物车 &gt;</router-link>
          </div>
          <div class="list-shoping">
            <div class="fl" style="margin: 35px 0px;">
              <div class="shoping-pic fl">
                <img src="../../assets/images/26.png" alt="" class="w100 h100" />
              </div>
              <div class="shoping-title fl">
                <p class="ft-20">罗马之恋(皮革相册）</p>
                <p class="ft-14" style="color: #898989;margin-top: 10px;">甜蜜时光，纪念爱情</p>
              </div>
            </div>
            <div class="price ft-18">
              <div class="fr" style="color: #b11e25;margin-left: 100px;">￥99.9</div>
              <div class="fr">
                <span>￥99.9</span>
                <i>X</i>
                <span>1</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="item-price">
        <div class="fl">
          <span class="total ft-18">合计金额：￥<i>99.9</i></span>
          <span class="actual ft-14">实际金额：<strong class="ft-28">￥99.9</strong></span>
        </div>
        <el-button class="submit-order fr">提交订单</el-button>
      </div>
    </div>

    <div class="popup" @click="overflowLayer" v-show="layer"></div>
    <div class="layer" v-show="layer">
      <div class="layer-head ft-18">使用新地址：</div>
      <div class="bf-selected">
        <div class="select-content">
          <span class="fl">所在地区: <i>*</i></span>
          <el-cascader :options="address" :props="props" style="width: 88%;"></el-cascader>
        </div>
        <div class="select-content">
          <div class="fl combox-input-wrap">
            <span>详细地址: <i>*</i></span>
            <el-input type="text" placeholder="请精确到门牌号" />
          </div>
          <div class="fl">
            <span>邮编: <i>*</i></span>
            <el-input type="text" max="6" placeholder="六位数" />
          </div>
        </div>
        <div class="select-content">
          <div class="fl item-name">
            <span>收货人:　 <i>*</i></span>
            <el-input type="text" placeholder="某某某" />
          </div>
          <div class="fl item-name">
            <span>手机号码: <i>*</i></span>
            <el-input type="text" placeholder="132*******" class="item-phone" />
          </div>
        </div>
      </div>
      <el-button class="submit-message">提交信息</el-button>
    </div>
  </div>
</template>

<script type="text/javascript">

  import chinaData from '../../../static/api/address.json'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";

  export default {
    name: 'submit',
    data() {
        return {
          layer: false,
          address: chinaData,
          props: {
            value: 'label',
            children: 'cities'
          }
        }
    },
    created () {

    },
    methods: {
      openAddress() {
          this.layer = true;
      },
      overflowLayer() {
          this.layer = false;
      }
    },
    components: {
      ElInput, ElButton,
    }
  };
</script>


<style type="text/css">

  @import "../../../static/css/cart.css";
  /* layer start */

  .popup {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.5);
  }

  .layer {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 926px;
    height: 440px;
    background: #fff;
    margin: 150px auto;
  }

  .layer .layer-head {
    width: 820px;
    height: 80px;
    line-height: 80px;
    border-bottom: 1px solid #c9caca;
    margin: 0px auto;
  }

  .layer .bf-selected {
    width: 820px;
    height: auto;
    padding-bottom: 36px;
    margin: 28px auto;
    border-bottom: 1px solid #c9caca;
  }

  .layer .bf-selected .select-content {
    height: 43px;
    line-height: 43px;
    margin-top: 10px;
  }

  .layer .bf-selected .select-content .el-input {
    width: 170px;
    margin: 0 0 0 10px;
  }

  .layer .bf-selected .select-content .el-cascader .el-input  {
    width: 98.5%;
  }

  .select-content .el-cascader .el-cascader__label {
    line-height: 45px;
    width: 95%;
    text-indent: 1em;
  }

  .layer .bf-selected .select-content .combox-input-wrap .el-input {
    width: 420px;
    height: 45px;
    position: relative;
    left: -3px;
    margin-right: 60px;
  }

  .layer .bf-selected .select-content .item-name {
    width: 400px;
  }

  .layer .bf-selected .select-content .item-name .el-input {
    width: 250px;
  }

  .layer .bf-selected .select-content .item-name .item-phone {
    width: 77%;
  }

  .layer .submit-message {
    width: 219px;
    height: 57px;
    margin: 40px auto 0;
    display: block;
    background: #b11e25;
    border-radius: 10px;
    font-size: 16px;
    border: 1px solid #b11e25;
    color: #fff;
  }

  /* layer end */

  /* cart-body start */

  .cart-body {
    padding-top: 1px;
  }

  .cart-body .cart-content {
    border-radius: 5px;
    background: #fff;
    padding: 30px 0px;
  }

  .cart-body .cart-content .cart-address {
    width: 228px;
    height: 230px;
    border: 1px solid #c9caca;
    box-sizing: border-box;
    margin: 0 30px 35px;
    cursor: pointer;
  }

  .cart-body .cart-content .cart-box {
    text-align: center;
  }

  .cart-body .cart-content .cart-box .cart-box-head {
    line-height: 50px;
    margin-top: 20px;
  }

  .cart-body .cart-content .cart-box .cart-box-desc {
    line-height: 30px;
    text-align: left;
    padding: 10px 8px;
  }

  .cart-body .cart-content .cart-address .form-box {
    font-weight: bold;
    line-height: 230px;
    text-align: center;
    color: #898989;
  }

  .cart-body .cart-content .distribution {
    margin: 42px 30px;
    overflow: hidden;
  }

  .cart-body .cart-content .distribution .distr-title , .pay-title {
    color: #595757;
    margin-bottom: 20px;
  }

  .cart-body .cart-content .distribution ul li {
    padding: 12px 46px;
    border: 1px solid #c9caca;
    margin: 0px 25px 0 0;
    cursor: pointer;
  }

  .cart-body .cart-content .distribution ul li:last-child {
    margin: 0px;
  }

  .pay {
    padding-top: 20px;
    height: 100%;
    overflow: hidden;
  }

  .pay ul li {
    width: 97px;
    height: 29px;
    line-height: 29px;
    font-size: 30px;
  }

  .list-goods {
    margin: 0 20px;
  }

  .list-goods .list-head {
    height: 70px;
    border-bottom: 1px solid #c9caca;
    line-height: 70px;
  }

  .list-goods .list-head .icon-gouwudai {
    font-size: 20px;
    color: #595757;
  }

  .list-goods .list-shoping {
    height: 163px;
    border-bottom: 1px solid #c9caca;
  }

  .list-goods .list-shoping .shoping-title {
    margin: 24px 65px;
  }

  .list-goods .list-shoping .price {
    line-height: 163px;
  }

  .cart-body .item-price {
    height: 125px;
    line-height: 125px;
    width: 100%;
  }

  .cart-body .item-price .total {
    color: #898989;
  }

  .cart-body .item-price .actual {
    margin-left: 36px;
  }

  .cart-body .item-price .el-button {
    width: 280px;
    height: 57px;
    border: 1px solid #c40000;
    background: #c40000;
    color: #fff;
    margin: 32px 25px;
  }

  /* cart-body */
</style>
