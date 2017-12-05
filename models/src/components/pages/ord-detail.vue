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
                <span class="add-desc-name">某某某</span>
                <span class="add-desc-phone">13232800159</span>
              </p>
              <p class="add-desc-msg"><i class="iconfont icon-dizhi"></i>广东省佛山市顺德区杏坛镇光华村</p>
            </div>
            <div class="border-line-vertical" style="right: 0px;"></div>
            <div class="border-line"></div>
        </div>
        <template v-for="(item, index) in listStop">
            <div class="balance-list">
                <div class="balan-pic fl">
                    <img src="../../../static/images/30.png" alt="" class="w100 h100">
                </div>
                <div class="balan-text fl">
                    <div class="bal-title ft-16">{{ item.shopName }}</div>
                    <p>单价 : <i class="c_b11e25">0.60元</i></p>
                    <p>数量 : {{ item.number }}</p>
                </div>
                <ul class="clear">
                    <li>
                        <span>商品合计 : </span>
                        <span class="fr">¥ {{ lastPaySum }}</span>
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
        </template>
        <el-button class="nowGoPay" @click="goToPay()">立即支付</el-button>

        <div class="props w100 h100">
          <ul>
            <li v-for="(k, i) in data.list">
              <p>
                <span>收货人:</span>
                <span>{{ k.sname }}</span>
              </p>
              <p>
                <span>联系电话:</span>
                <span>{{ k.tel }}</span>
              </p>
              <p>
                <span>详细地址:</span>
                <span>{{ k.adr }}</span>
              </p>
            </li>
          </ul>
          <el-button class="propsSave">确定</el-button>
        </div>

    </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'

    export default {
      components: {ElButton},
      data() {
        return {
          listStop: [{
            shopName: '照片冲印、手机上传打印照片',
            price: 50.5,
            number: 1,
          }],
          data: {
            list: []
          }
        }
      },
      created() {

      },
      computed: {
        ...mapGetters({
          get_user_info: GET_USER_INFO
        }),
        amount () {
          return this.listStop.length;
        },
        lastPaySum() {
          let sum = 0;
          if (this.amount > 0) {
            for(let i in this.listStop) {
              sum += this.listStop[i].price * this.listStop[i].number;
            }
          }
          return sum.toFixed(2)
        },
      },
      mounted() {
        this.setAddress();
      },
      methods: {
        setAddress() {
          this.$ajax.HttpGet(this.$api.get_address.get_address + '?id=' + this.get_user_info.user.id).then((res) => {
            this.data.list = res.data;
          });
        },
        goSize() {

        },
        goToPay() {
          let options = {

          };
          //  跳转页面
          this.$router.push({ path: '/pages/gopay' });
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
    padding: 10px 10px 0;
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

  .props {
    position: fixed;
    top: 47px;
    left: 0px;
    background: #fff;
  }

  .props .propsSave {
    position: absolute;
    bottom: 58px;
    left: 0px;
    width: 95%;
    right: 0px;
    color: #fff;
    border: 1px solid #c40000;
    background: #c40000;
    margin: 0px auto;
  }

  .props ul li {
    padding: 10px 5%;
    margin: 10px 0px;
    background: #fbfafa;
    overflow: hidden;
  }

  /* address-box end */
</style>
