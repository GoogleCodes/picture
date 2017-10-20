<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Delivery Address</h1>
        <div class="line"></div>
        <h5 class="order-h5">收货地址</h5>
      </div>

      <div class="trade_status" style="width: 99%;">
        <template v-for="(item, index) in data.list">
          <div class="infoBlock fl" :class="{'infoactive':index == currentIndex}" @click="currentIndex=index">
            <div class="infor-title" v-if="!item.isDefault" @click="setDefault(item.addressId)">
              <i class="iconfont icon-quxiaoquanxuan ft-24"></i>
              <span>设置默认</span>
            </div>
            <div class="infor-title" v-if="item.isDefault">
              <i class="iconfont icon-checked-fill"></i>
              <span>默认地址</span>
            </div>
            <div class="table-list address-list">
              <ul>
                <li>
                  <span>收货人：</span>
                  <span>{{ item.userName }}</span>
                </li>
                <li>
                  <span>联系电话：</span>
                  <span>{{ item.tel }}</span>
                </li>
                <li>
                  <span>详细地址：</span>
                  <span>{{ item.streetName }}</span>
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

  import ElRadioGroup from "../../../node_modules/element-ui/packages/radio/src/radio-group";

  export default {
    components: {ElRadioGroup}, name: 'address',
      data () {
          return {
            deReadio: '0',
            currentIndex: 0,
            data: {
                list: [],
                isRadio: false,
            },
            radio: '1'
          }
      },
      created() {
          this.setAddress();
      },
      components: {

      },
      methods: {
          setAddress() {
//            this.$http.get(this.$api.get_address.url_address).then((res) => {
//              console.log(res);
//              this.data.list = res.data.result;
//            });
          },
          setDefault(addressId) {
            for (let i = 0; i < this.data.list.length; i++) {
              if (this.data.list[i].addressId == addressId) {
                this.data.list[i].isDefault = true;
              } else {
                this.data.list[i].isDefault = false;
              }
            }
          }
      }
  };
</script>


<style type="text/css">

  .infor-title .icon-quxiaoquanxuan , .infor-title .icon-checked-fill {
      font-size: 22px;
      line-height: 30px;
      position: relative;
      top: 3px;
      color: #333;
  }

  .infor-title .icon-checked-fill {
      color: #4db3ff;
  }

</style>
