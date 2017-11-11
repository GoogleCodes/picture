<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Order History</h1>
        <div class="line"></div>
        <h5 class="order-h5">历史订单</h5>
      </div>

      <div class="order-title" style="display: none;">
        <ul>
          <li class="fl">商品信息</li>
          <li class="fl">单价</li>
          <li class="fl" style="width: 104px;">数量</li>
          <li class="fl">实付金额</li>
          <li class="fl" style="width: 145px;">订单状态</li>
          <li class="fl">操作</li>
        </ul>
      </div>

      <div class="trade_status" style="border: none;margin: 53px 0px 0px">
        <div class="infoBlock fl" style="margin: 35px 0 0px 0px;border: 1px solid #c9caca">
          <div class="infor-title" >
            <h3>订单信息</h3>
          </div>
          <div class="table-list">
            <ul>
              <li>
                <span>客户：</span>
                <span>{{ addressData.sname }}</span>
              </li>
              <li>
                <span>客户：</span>
                <span>{{ addressData.tel }}</span>
              </li>
              <li class="info-address">
                <span>地址：</span>
                <span>{{ addressData.adr }}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="table-td fr" style="width: 665px;">
          <div class="trade-detail">
            <dl>
              <dt class="ft-18 trade-title">
                <span style="color: #3e3a39;" v-if="orderData.status == 0">订单状态:  未付款</span>
                <span style="color: #3e3a39;" v-if="orderData.status == 1">订单状态:  已付款</span>
                <span style="color: #3e3a39;" v-if="orderData.status == 2">订单状态:  已发货</span>
                <span style="color: #3e3a39;" v-if="orderData.status == 3">订单状态:  查看物流</span>
              </dt>
              <dd class="imfor-title">确认收货,超时订单自动确认收货</dd>
              <dd class="imfor-title">物流：中通快递运单号:{{ orderData.orderid }}</dd>
              <dd class="imfor-title">{{ orderData.time | gotimes }}</dd>
              <dd class="imfor-title" style="margin-top: 10px;">
                <span class="fl">您可以</span>
                <a class="ui-btn block fl confirm NotShipped" v-if="orderData.status == 0">去付款</a>
                <a class="ui-btn block fl confirm" v-if="orderData.status == 1">已付款</a>
                <a class="ui-btn block fl confirm" v-if="orderData.status == 2">已发货</a>
                <a class="ui-btn block fl select" v-if="orderData.status == 3">查看物流</a>
              </dd>
            </dl>
          </div>
        </div>
      </div>

      <div class="order-table">
        <table>
          <thead class="thead-item">
          <tr class="tr-item" style="background: #f7f8f8;text-align: center;border-bottom: 1px solid #ccc;">
            <td>商品信息</td>
            <td>单价</td>
            <td>数量</td>
            <td>实付金额</td>
            <td>订单状态</td>
            <td>操作</td>
          </tr>
          </thead>
          <template> <!--   -->
            <tbody class="tbody-item">
              <tr class="tr-item ordertime">
                <td colspan="6">
                  <span class="fl">{{ orderData.time | gotimes }}</span>
                  <span class="orderNumber fl">订单号 ：{{ orderData.orderid }}</span>
                </td>
              </tr>
              <template v-for="(item, index) in orderData.goodsdata">
                <tr class="tr-item">
                  <td class="itme-pic" style="width: 316px;">
                    <template v-for="(x, i) in item.gthumb">
                      <img :src="x.url" alt="" class="J_ItemImg fl" />
                    </template>
                    <a href="javascript:void(0);" class="item-title fl">{{ item.gname }}</a>
                    <div class="fl item-description">{{ item.gremark }}</div>
                  </td>
                  <td class="itme-money">¥{{ item.price }}</td>
                  <td class="itme-number">{{ item.num }}</td>
                  <td class="itme-all">
                    <p style="color: #b11e25;">¥{{ item.allprice }}</p>
                    <p>包邮</p>
                  </td>
                  <td class="itme-pic">
                    <p v-if="orderData.status == 0">待付款</p>
                    <p>订单详情</p>
                  </td>
                  <td style="width: 130px;">
                    <a class="nowpay privateBtn" v-if="orderData.status == 0">立即付款</a>
                    <a class="cancel protected-Btn">取消订单</a>
                    <a class="select protected-Btn" v-if="orderData.status == 2">查看物流</a>
                    <a class="delete protected-Btn" v-if="orderData.status == 3">X</a>
                  </td>
                </tr>
              </template>
              
            </tbody>
          </template>
          
        </table>
      </div>

      <div class="BarHolder">
        <div class="fr bar-picre">
          <p>商品总价：￥<i>{{ orderData.fee }}</i></p>
          <p>实际付款：￥<i>360.00</i></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        addressData: {},
        orderData: {},
      }
    },
    computed: {

    },
    mounted() {
      this.getToOrder();
    },
    methods: {
      getToOrder() {
        this.$ajax.HttpPost('/api/home/order/oneorder',{
          id: this.$route.query.id,
          uid: this.$goFetch.storageGet('user_info').user.id
        }).then((res) => {
          this.addressData = this.$goFetch.goJson(res.data.address);
          this.orderData = res.data;
        });
      }
    }
  }
</script>

<style>
  .admin-right .trade-detail dl .imfor-title .NotShipped {
    background: #fff;
    color: #b11e25;
  }
  .admin-right .trade-detail dl .imfor-title .NotShipped:hover {
    background: #b11e25;
    color: #fff;
  }

  .order-table table .tbody-item .tr-item {
    border-bottom: 1px solid #c9caca; 
  }

  .admin-right .infoBlock .table-list .info-address {
    height: 60px;
    line-height: 27px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
</style>