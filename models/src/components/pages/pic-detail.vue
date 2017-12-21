<template>
  <div>
    <div class="pic-detail">
      <div class="bl-express-box">
        <div class="wait" v-if="data.status == 0">
          <span class="fl ft-16">待付款，赶快去支付吧</span>
          <i class="iconfont icon-fukuan fr"></i>
        </div>
        <div class="wait" v-else-if="data.status == 1">
          <span class="fl ft-16">未发货，等待卖家发货</span>
          <i class="iconfont icon-fahuo fr"></i>
        </div>
        <div class="wait" v-else-if="data.status == 2">
          <span class="fl ft-16">快递中，等待买家确认收货</span>
          <i class="iconfont icon-yifahuo fr"></i>
        </div>
      </div>
      <div class="info-express">
        <div class="exp-content">
          <div class="iconfont icon-dizhi fl c_4d4d4d"></div>
          <div class="ex-line">
            <div class="c_4d4d4d fl">
              <span>收件人：</span>
              <span>{{ adr.sname }}</span>
            </div>
            <div class="fr c_4d4d4d">
              <span>手机号码：</span>
              <span>{{ adr.tel }}</span>
            </div>
            <div class="info-address c_4d4d4d">
              <span>收货地址：</span>
              <span>{{ adr.adr }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="info-body">
        <template v-for="(k, i) in data.goodsdata">
          <div class="order-msg fl">
            <div class="line">
              <div class="order-pic fl">
                <template v-for="y in k.gthumb">
                  <img :src="y.url" alt="" class="w100 h100">
                </template>
              </div>
              <div class="wrap fl">
                <div class="wrap-title ft-16">{{ k.gname }}</div>
                <div class="wrap-desc clear c_898989">{{ k.gremark }}</div>
                <div class="wrap-money"></div>
              </div>
              <div class="status fr">
                <p>¥{{ k.price }}</p>
                <p>X1</p>
              </div>
            </div>
          </div>
        </template>
        <div class="freight clear" style="display: none;">
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
          <div v-if="data.status == 0">
            <div class="comment-money fl">
              <span class="fl money">应付：</span>
              <span class="fl c_b11e25">￥39.80</span>
            </div>
            <div class="gopay fr util-btn" @click="pay()">立即支付</div>
          </div>
          <!--<div class="cancel fl util-btn">取消订单</div>-->
          <!--<div class="confirm fr util-btn">确认订单</div>-->
          <div class="ConfirmReceipt fr util-btn" v-if="data.status == 1">确认收货</div>
        </div>
      </div>
    </div>
  </div>
</template>


<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO, GET_USER_OPENID } from '../../store/getters/type'
  import { REMOVE_USER_INFO } from '../../store/actions/type'
  import { cookieStorage } from '../../common/storage'

  export default {
    data() {
      return {
        data: {},
        adr: {},
      }
    },
    mounted() {
      this.getOrderMsg();
      console.log(this.$route.params.id);

    },
    watch: {
      '$route'() {
        this.getOrderMsg();
      }
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO,
        get_user_openid: GET_USER_OPENID,
      })
    },
    components: {
      ElButton
    },
    methods: {
      ConfirmReceipt() {

      },
      jsApiCall () {
        let self = this, config = null;
        this.$ajax.HttpPost('/api/home/pay/mobilepay', {
          id: this.$route.params.id,
          uid: this.get_user_info.user.id,
          openid: this.get_user_openid // this.$storageGet('openid')  oQVgUw7q-XNU5aPMvLlLbNKChzcQ
        }).then((res) => {
          config = JSON.parse(res.data);
          WeixinJSBridge.invoke('getBrandWCPayRequest',config, function(res) {
              if (res.err_msg === 'get_brand_wcpay_request:ok') {
                alert('支付成功！');
              } else {
                alert('支付失败！');
              }
            }
          )
        });
      },
      pay() {
        this.weixincallpay()
      },
      weixincallpay() {
        if (typeof WeixinJSBridge == "undefined") {
          if (document.addEventListener) {
            document.addEventListener('WeixinJSBridgeReady', this.jsApiCall(), false)
          } else if (document.attachEvent) {
            document.attachEvent('WeixinJSBridgeReady', this.jsApiCall());
            document.attachEvent('onWeixinJSBridgeReady', this.jsApiCall())
          }
        } else {
          this.jsApiCall()
        }
      },
      getOrderMsg() {
        this.$ajax.HttpPost('/api/home/order/oneorder',{
          id: this.$route.params.id,
          uid: this.get_user_info.user.id
        }).then((res) => {
          this.data = res.data;
          console.log(res.data);
          this.adr = JSON.parse(res.data.address);
        });
      }
    },
  }

</script>

<style type="text/css">
  /* pic-detail start */
  .pic-detail {
    margin-top: 46px;
  }
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
    line-height: 80px;
    font-size: 20px;
  }

  .info-express .exp-content .ex-line {
    margin: 0px 0px 0px 32px;
    padding: 6px 0px;
  }

  .info-express .exp-content .ex-line .info-address {
    line-height: 20px;
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .pic-detail .order-msg {
    background: #fff;
    margin-top: 10px;
    min-height: 81px;
    width: 95%;
    padding: 10px 10px 0px;
  }

  .pic-detail .order-msg .line {
    overflow: hidden;
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
  }

  .pic-detail .order-msg .line:last-child {
    margin-bottom: 0;
  }

  .info-body {
    width: 100%;
    height: 100%;
    background: rgb(255, 255, 255);
    overflow: hidden;
    margin-top: 10px;
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
    line-height: 21px;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
  }

  .pic-detail .order-msg .wrap .wrap-desc {
    line-height: 20px;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .pic-detail .order-msg .order-pic {
    width: 35%;
    height: 95%;
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
    margin: 10px 10px 20px;
  }

  .pic-detail .comment {
    position: fixed;
    bottom: 0px;
    height: 45px;
    width: 100%;
    background: #fff;
  }

  .pic-detail .comment .util-btn,
  .pic-detail .comment .util-btn {
    line-height: 45px;
    width: 50%;
    text-align: center;
    box-sizing: border-box;
  }

  .pic-detail .comment .ConfirmReceipt {
    width: 100%;
    color: #fff;
    background: #c40000;
  }

  .pic-detail .comment .comment-money {
    line-height: 45px;
  }

  .pic-detail .comment .comment-money .money {
    padding-left: 32px;
  }

  .pic-detail .comment .gopay , .pic-detail .comment .confirm {
    background: #b11e25;
    color: #fff;
  }

  /* pic-detail end */
</style>
