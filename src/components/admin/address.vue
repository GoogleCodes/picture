<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Delivery Address</h1>
        <div class="line"></div>
        <h5 class="order-h5">收货地址</h5>
      </div>

      <div class="trade_status" style="width: 99%;">
        <template v-for="(item, index) in 4">
          <div class="infoBlock fl" :class="{'infoactive':index==currentIndex}" @click="currentIndex=index">
            <div class="infor-title" style="text-indent: 0.4em">
              <el-radio v-model="deReadio" label="1" >默认地址</el-radio>
            </div>
            <div class="table-list address-list">
              <ul>
                <li>
                  <span>客户：</span>
                  <span>恩小猫</span>
                </li>
                <li>
                  <span>客户：</span>
                  <span>13672964196</span>
                </li>
                <li>
                  <span>地址：</span>
                  <span>广东省佛山市顺德区佛山市顺德区大良街道家电城41号</span>
                </li>
              </ul>
            </div>
          </div>
        </template>
        <div class="infoBlock-btn clear">
          <router-link :to="{ path: '/admin/increase'}" class="public-btn add-address block">
            <i class="iconfont icon-zengjia"></i>
            <span>添加新地址</span>
          </router-link>
          <!--<a href="javascript:void(0);" class="public-btn add-address block"></a>-->
          <a href="javascript:void(0);" class="public-btn delete-address block">
            <i class="iconfont icon-shanchu"></i>
            删除地址
        </a>
        </div>

      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    name: 'address',
    data () {
      return {
        deReadio: '0',
        currentIndex: 0,
      }
    }
  };
</script>
