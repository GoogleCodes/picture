<template>
  <div>
      <div class="info-address">
          <ul>
              <li v-for="item in 4" class="clear">
                <div style="margin: 0px 10px;">
                  <p>
                  <span class="fl">
                    <i>收件人：</i>
                    <i>恩小猫</i>
                  </span>
                    <span class="fr">13672964196</span>
                  </p>
                  <p class="address-msg">广东省佛山市顺德区佛山市顺德区大良街道家电城41号</p>
                  <div class="def">
                    <div class="default-add fl">
                      <i class="iconfont icon-checked-fill c_b11e25"></i>
                      <span>默认地址</span>
                    </div>
                    <div class="default-add fl" v-show="">
                      <i class="iconfont icon-quxiaoquanxuan c_4d4d4d"></i>
                      <span>默认地址</span>
                    </div>
                    <div class="delete iconfont icon-shanchu fr"></div>
                  </div>
                </div>
              </li>
          </ul>
          <el-button icon="check" @click="addAddress()">添加收货地址</el-button>
      </div>
  </div>
</template>

<script type="text/javascript">

  import ElRadioGroup from "../../../node_modules/element-ui/packages/radio/src/radio-group";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    components: {ElButton, ElRadioGroup}, name: 'address',
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
          addAddress() {
              this.$router.push({ path: '/admin/increase'});
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
  .info-address {
    margin-top: 48px;
    overflow: hidden;
    padding-bottom: 50px;
  }
  .info-address ul li {
    margin: 10px 0;
    background: #fff;
    display: block;
  }

  .info-address ul li p {
    height: 35px;
    line-height: 35px;
  }
  .info-address ul li .address-msg {
    height: 55px;
    line-height: 25px;
    overflow: hidden;
    border-bottom: 1px solid #f2f2f2;
    text-overflow: ellipsis;
  }
  .info-address ul li .def {
    height: 45px;
    line-height: 45px;
  }
  .info-address ul li .def .iconfont {
    font-size: 20px;
    position: relative;
    line-height: 45px;
    top: 3px;
    z-index: 50;
  }
  .info-address ul li .def .default-add {
    width: 80%;
    line-height: 45px;
  }
  .info-address .el-button {
    width: 90%;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    margin: 30px auto;
    display: block;
    padding: 12px 15px;
  }

</style>
