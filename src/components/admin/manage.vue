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
          <table>
            <thead class="thead-item">
            <tr class="tr-item">
              <td colspan="6" style="padding-left: 18px;">
                <span class="fl">{{ item.time | time }}</span>
                <span class="orderNumber" style="padding-left: 25px;">订单号 ：{{ item.orderid }}</span>
              </td>
            </tr>
            </thead>
            <template v-for="(x, i) in item.goodsdata">
              <tbody class="tbody-item">
                <tr class="tr-item">
                  <td class="itme-pic" style="width: 316px;">
                    <template v-for="(y,n) in x.gthumb">
                      <img :src="y.url" alt="" class="J_ItemImg fl" />
                    </template>
                    <a href="javascript:void(0);" class="item-title fl">{{ x.gname }}</a>
                  </td>
                  <td class="itme-money">¥{{ x.price }}</td>
                  <td class="itme-number">{{ x.num }}</td>
                  <td class="itme-all" style="width: 135px;">
                    <p style="color: #b11e25;">¥{{ x.allprice }}</p>
                    <p>包邮</p>
                  </td>
                  <td class="itme-pic">
                    <p>待付款</p>
                    <p>订单详情</p>
                  </td>
                  <td style="width: 130px;">
                    <a href="javascript:void(0);" class="nowpay privateBtn">立即付款</a>
                    <a href="javascript:void(0);" class="cancel protected-Btn">取消订单</a>
                    <a href="javascript:void(0);" class="select protected-Btn">查看物流</a>
                    <a href="javascript:void(0);" class="delete protected-Btn">X</a>
                  </td>
                </tr>
              </tbody>
            </template>
          </table>
        </template>
        
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        orderList: [],
      }
    },
    computed: {
      
    },
    mounted() {
      this.getOrderAdmin();
    },
    filters: {
      time: function (value) {
        let d = new Date(parseInt(value) * 1000);
        var years = d.getFullYear();
        var month = d.getMonth() + 1;
        var days = d.getDate();
        var hours = d.getHours();
        var minutes = d.getMinutes();
        var seconds = d.getSeconds();
        return years + "-" + month + "-" + days + " " + (hours > 9 ? hours : '0' + hours) + ':' + (minutes > 9 ? minutes : '0' + minutes);
      }
    },
    methods: {
      getOrderAdmin() {
        this.$postData(this.$api.get_content.GET_ORDER_ADMIN,{
          uid:  + this.$storageGet('user_info').user.id
        }).then((res) => {
          this.orderList = res.data.data.data;
          console.log(this.orderList);
        });
      }
    }
  }  
</script>