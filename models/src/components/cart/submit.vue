<template>
  <div class="bgcolor">
    <div class="cart-body" style="padding-top: 50px;">
      <div class="cart-head">
        <div class="cart-h1">CHECK OUT</div>
        <p class="cart-h2">
          <span class="line block fl"></span>
          <span class="block clear">确认订单</span>
          <span class="line block fr"></span>
        </p>
      </div>
      <div class="cart-content" style="padding-bottom: 100px;">
        <template v-for="(item, index) in list">
          <div class="cart-address cart-box fl">
            <p class="ft-18 cart-box-head">
              <strong>恩小猫</strong>/<strong>{{ item.phone }}</strong>
            </p>
            <p class="cart-box-desc" style="color: #898989;">
              <span class="block">{{ item.waddress }}</span>
              <span class="block">{{ item.address }}</span></p>
          </div>
        </template>
        <div class="cart-address fl" @click="openAddress">
          <div class="form-box ft-20">
            <span style="font-size: 30px;">+</span>
            <span>还没添加快递地址</span>
          </div>
        </div>
        <div class="distribution clear">
          <div class="distr-title ft-18">配送方式</div>
          <ul>
            <li class="fl expressli" v-for="(item, index) in exporess"
                :class="{'active':index == currentExpress}" @click="currExpress(index, item)">申通快递</li>
          </ul>
          <div class="pay clear">
            <div class="pay-title ft-18 clear">选中支付方式</div>
            <ul>
              <li class="fl payli" v-for="(item, index) in pay"
                  :style="{background: 'url('+ item.pic +') no-repeat top center',
                  backgroundPositionY: '10px'}" :class="{'active':index == payindex}" @click="chonsePay(index, item)"></li>
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
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <div class="layer-head ft-18">使用新地址：</div>
        <div class="bf-selected">
            <div class="select-content">
              <el-form-item prop="whereAddress">
                <span class="fl">所在地区: <i>*</i></span>
                <el-cascader :options="address" v-model="ruleForm.whereAddress" :props="props" style="width: 88%;"></el-cascader>
              </el-form-item>
            </div>
            <div class="select-content">
              <el-form-item prop="address" class="fl">
                <div class="fl combox-input-wrap">
                  <span>详细地址: <i>*</i></span>
                  <el-input type="text" v-model="ruleForm.address" placeholder="请精确到门牌号"></el-input>
                </div>
              </el-form-item>
              <el-form-item prop="zip" class="fl">
                <div class="fl">
                  <span>邮编: <i>*</i></span>
                  <el-input type="text" v-model="ruleForm.zip"  max="6" placeholder="六位数"></el-input>
                </div>
              </el-form-item>
            </div>
          <el-form-item>
            <div class="select-content">
              <el-form-item prop="address" class="fl">
                <div class="fl item-name">
                  <span>收货人:　 <i>*</i></span>
                  <el-input type="text" v-model="ruleForm.receiver"  placeholder="某某某"></el-input>
                </div>
              </el-form-item>
              <el-form-item prop="address" class="fl">
                <div class="fl item-name">
                  <span>手机号码: <i>*</i></span>
                  <el-input type="text"  v-model="ruleForm.phone"  placeholder="132*******" class="item-phone"></el-input>
                </div>
              </el-form-item>
            </div>
          </el-form-item>
        </div>
        <el-button class="submit-message" @click="submitMessage('ruleForm')">提交信息</el-button>
      </el-form>
    </div>
  </div>
</template>

<script type="text/javascript">

  import chinaData from '../../../static/api/address.json'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";

  export default {
    name: 'submit',
    data() {
        return {
          ruleForm: {
            whereAddress: null, //  详细地址
            address: null,      //地址
            zip: null,          //邮编
            receiver: null,     //收货人
            phone: null,        //联系人电话
          },
          rules: {
            address: [{required: true, message: '请输入具体地址！', trigger: 'blur'}],
            zip: [{required: true, message: '请输入邮编！', trigger: 'blur'}],
            receiver: [{required: true, message: '请输入收货人的姓名！', trigger: 'blur'}],
            phone: [{required: true, message: '请输入联系人电话号码！', trigger: 'blur'}]
          },
          list: JSON.parse(localStorage.getItem('Info_address')),
          layer: false,
          address: chinaData,
          props: {
            value: 'label',
            children: 'cities'
          },
          currentExpress: 0,
          exporess: [{exp_title: '顺丰速递'},
            {exp_title: '申通快递'},
            {exp_title: '顺丰快递'},
            {exp_title: '上门自提'},],
          pay: [
            {pic: '../../../static/images/43.jpg'},
            {pic: '../../../static/images/44.jpg'},
          ],
          payindex: 0,
        }
    },
    created () {

    },
    methods: {
      submitMessage(formName) {
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
          }
          let json = {
            waddress : this.ruleForm.whereAddress,
            address : this.ruleForm.address,
            zip : this.ruleForm.zip,
            receiver : this.ruleForm.receiver,
            phone : this.ruleForm.phone,
          }
          var arr = [];
          arr.push(json);
          localStorage.setItem('Info_address',JSON.stringify(arr));
        });
      },
      chonsePay(index, item) {
        this.payindex = index;
      },
      currExpress(index, item) {
        this.currentExpress = index
      },
      openAddress() {
          this.layer = true;
      },
      overflowLayer() {
          this.layer = false;
      }
    },
    components: {
      ElFormItem, ElForm, ElInput, ElButton,
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
    height: 510px;
    background: #fff;
    margin: 0px auto;
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

  .distribution ul .payli ,
  .distribution ul .expressli {
    padding: 12px 46px;
    border: 2px solid #c9caca;
    margin: 0px 25px 0 0;
    cursor: pointer;
  }

  .cart-body .cart-content .distribution ul .active {
    border: 2px solid #b11e25;
    background: #b11e25;
    color: #fff;
  }

  .distribution ul .active {
    background: #b11e25;
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
