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
          <div class="infoBlock fl" :class="{'infoactive':index == currentIndex}" @click="goCurrent(index, item.id)">
            <div class="infor-title" v-if="item.select == 0" @click="setDefault(item.id)">
              <i class="iconfont icon-quxiaoquanxuan ft-24"></i>
              <span>设置默认</span>
            </div>
            <div class="infor-title" v-else-if="item.select == 1">
              <i class="iconfont icon-checked-fill"></i>
              <span>默认地址</span>
            </div>
            <div class="table-list address-list">
              <ul>
                <li>
                  <span>收货人：</span>
                  <span>{{ item.sname }}</span>
                </li>
                <li>
                  <span>联系电话：</span>
                  <span>{{ item.tel }}</span>
                </li>
                <li>
                  <span>详细地址：</span>
                  <span>{{ item.adr }}</span>
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
          <a href="javascript:void(0);" class="public-btn delete-address block" @click="delAddress()">
            <i class="iconfont icon-shanchu"></i>
            <span>删除地址</span>
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
            currentId: 0,
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
      watch: {

      },
      methods: {
        goCurrent(index, id) {
          this.currentIndex = index;
          this.currentId = id;
        },
        setAddress() {
          this.$goFetch.fetchGet(this.$api.get_address.get_address + '?id=6').then((res) => {
              this.data.list = res.data;
          });
        },
        setDefault(id) {
          let set_id = 0;
          for (let i = 0; i < this.data.list.length; i++) {
            set_id = this.data.list[i];
          }
          if (set_id.id == id) {
            set_id.select = 1;
          } else {
            set_id.select = 0;
          }
          this.$goFetch.fetchGet(this.$api.get_address.set_add_default + '?id='+ id +'&uid=6').then((res) => {
            if (res.code == 0) {
              this.$message({
                message: res.msg,
                type: 'warning'
              });
            } else if (res.code == 1) {
              this.$message({
                message: res.msg,
                type: 'success'
              });
              setTimeout(() => {
                  location.reload();
              }, 500);
            }
          });
        },
        delAddress() {
          this.$confirm('此操作将删除该地址, 是否继续?', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            this.$goFetch.fetchGet(this.$api.get_address.del_address + '?id='+ this.currentId +'').then((res) => {
              if (res.code == 0) {
                this.$message({
                  message: res.msg,
                  type: 'warning'
                });
              } else if (res.code == 1) {
                this.$message({
                  message: res.msg,
                  type: 'success'
                });
                setTimeout(() => {
                  location.reload();
                }, 400);
              }
            });
          }).catch(() => {
            this.$message({
              type: 'info',
              message: '已取消删除'
            });
          });
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
