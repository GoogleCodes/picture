<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Order History</h1>
        <div class="line"></div>
        <h5 class="order-h5">历史订单</h5>
      </div>
      <div class="order-title">
        <ul>
          <li class="fl">商品信息</li>
          <li class="fl">单价</li>
          <li class="fl" style="width: 104px;">数量</li>
          <li class="fl">实付金额</li>
          <li class="fl" style="width: 145px;">订单状态</li>
          <li class="fl">操作</li>
        </ul>
      </div>
      <div class="order-table">
        <template v-for="(item, index) in orderList">
          <table v-loading="loading" element-loading-text="拼命加载中">
            <thead class="thead-item">
            <tr class="tr-item">
              <td colspan="6" style="padding-left: 18px;">
                <span class="fl">{{ item.time | gotimes }}</span>
                <span class="orderNumber" style="padding-left: 25px;">订单号 ：{{ item.orderid }}</span>
              </td>
            </tr>
            </thead>
            <template v-for="(x, i) in item.goodsdata">
              <tbody class="tbody-item">
              <tr class="tr-item">
                <td class="itme-pic" style="width: 316px;">

                  <router-link :to="{ path: '/admin/shoping/' + item.id }" class="fl">
                    <div style="width: 123px;height: 109px;margin: 0px 15px;" class="fl">
                      <template v-for="(y,n) in x.gthumb">
                        <img :src="y.url" alt="" class="J_ItemImg fl w100 h100"/>
                      </template>
                    </div>
                    <span class="item-title fl">{{ x.gname }}</span>
                    <div class="tb_item-desc">{{ x.gremark }}</div>

                  </router-link>
                </td>
                <td class="itme-money" style="width:131px;">¥{{ x.price }}</td>
                <td class="itme-number">{{ x.num }}</td>
                <td class="itme-all" style="width: 135px;">
                  <p style="color: #b11e25;">¥{{ x.allprice }}</p>
                  <p>包邮</p>
                </td>
                <td class="itme-pic">
                  <p v-if="item.status == 0">待付款</p>
                  <p v-else-if="item.status = 1">已付款</p>
                  <p v-else-if="item.status = 2">已发货</p>
                  <p v-else-if="item.status = 3">已收货</p>
                  <p>订单详情</p>
                </td>
                <td style="width: 130px;">
                  <a class="nowpay privateBtn" v-if="item.status == 0" @click="pay(item.id, item.paytype)">去付款</a>
                  <a class="cancel protected-Btn" v-if="item.status == 1">已付款</a>
                  <a class="select protected-Btn" v-if="item.status == 2">已发货</a>
                  <a class="delete protected-Btn" v-if="item.status == 3">已收货</a>
                </td>
              </tr>
              </tbody>
            </template>
          </table>
        </template>
      </div>
      <!--<div class="block">-->
        <!--<el-pagination-->
          <!--layout="prev, pager, next"-->
          <!--:page-count="orderPages.current_page"-->
          <!--:page-size="orderPages.last_page"-->
          <!--:current-page="orderPages.per_page"-->
          <!--:total="orderPages.total">-->
        <!--</el-pagination>-->
      <!--</div>-->
      <!--<div v-html="orderPages"></div>-->
    </div>
    <div class="layer-pop" v-show="payDisplay"></div>
    <div class="wechatpay" v-show="payDisplay">
      <div class="fl payType">微信支付</div>
      <i class="iconfont icon-guanbi block fr" @click="payDisplay = false"></i>
      <img :src="wechat" alt="" class="w100 h100 block">
    </div>
    <div v-html="box"></div>
  </div>
</template>

<script type="text/javascript">

  import {mapGetters, mapActions} from 'vuex'
  import {GET_USER_INFO} from '../../store/getters/type'

  export default {
    data() {
      return {
        orderList: [],
        orderPages: {},
        box: '',
        wechat: '',
        elementTop: 0,
        page: '',
        payDisplay: false,
        loading: false,
      }
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
    },
    mounted() {
      this.getOrderAdmin();
    },
    methods: {
      pay(id, paytype) {
        if (paytype == 0) {
          //  微信支付
          this.payDisplay = true;
          this.$ajax.HttpPost('/api/home/pay/wxpay', {
            id: id,
            uid: this.get_user_info.user.id
          }).then((res) => {
            this.wechat = res.data;
          });
        } else if (paytype == 1) {
          this.payDisplay = false;
          this.$ajax.HttpPost('/api/home/pay/alpay', {
            id: id,
            uid: this.get_user_info.user.id
          }).then((res) => {
            const box = document.createElement('div');
            box.innerHTML = res;
            document.body.appendChild(box);
            document.forms[0].submit()
          })
        }
      },
      getOrderAdmin() {
        this.loading = true;
        this.$ajax.HttpPost(this.$api.get_content.GET_ORDER_ADMIN, {
          uid: +this.get_user_info.user.id
        }).then((res) => {
          this.loading = false;
          this.orderList = res.data.data.data;
          this.orderPages = res.data.data;
          console.log(this.orderPages);
        });
      }
    }
  }
</script>

<style type="text/css">
  .tbody-item {
    border-bottom: 1px solid #c9caca;
  }

  .tbody-item .tb_item-desc {
    text-align: left;

  }

  /* wechatpay start */
  .layer-pop {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    margin: 0px auto;
    background: rgba(0, 0, 0, 0.5);
  }

  .wechatpay {
    width: 256px;
    height: 256px;
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    margin: 250px auto;
  }

  .wechatpay .payType {
    background: #dadada;
    width: 82%;
    height: 50px;
    line-height: 50px;
    font-size: 23px;
    text-indent: 1.5em;
    color: #44b549;
  }

  .wechatpay .icon-guanbi {
    color: #fff;
    font-size: 26px;
    line-height: 30px;
    background: #9d9e9e;
    padding: 10px;
    cursor: pointer;
  }

  /* wechatpay end */

  /* pagination start */
  .pagination {
    height: 50px;
  }

  .pagination .disabled {
    background: #9d9e9e;
  }

  .pagination .active {
    background: #c40000;
  }

  .pagination li, .pagination li a {
    float: left;
    width: 40px;
    height: 40px;
    cursor: pointer;
    margin: 0 10px 0 0;
    text-align: center;
    line-height: 40px;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    background: #9d9e9e;
  }

  /* pagination end */

</style>
