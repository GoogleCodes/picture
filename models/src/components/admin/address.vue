<template>
  <div>
    <div class="info-address">
      <ul>
        <template v-for="item in data.list">
          <li class="clear">
            <div style="margin: 0px 10px;">
              <p>
            <span class="fl">
              <i>收件人：</i>
              <i>{{ item.sname }}</i>
            </span>
                <span class="fr">{{ item.tel }}</span>
              </p>
              <p class="address-msg">{{ item.adr }}</p>
              <div class="def">

                <!--<el-radio-group v-model="item.select" @click="setDefault(item.id)">-->
                  <!--<el-radio :label="0"  v-if="item.select == 0">设置默认</el-radio>-->
                  <!--<el-radio :label="1"  v-else-if="item.select == 1">默认地址</el-radio>-->
                <!--</el-radio-group>-->
                <div class="default-add fl" v-if="item.select == 0" @click="setDefault(item.id)">
                  <i class="iconfont icon-quxiaoquanxuan c_4d4d4d"></i>
                  <span>设置默认</span>
                </div>
                <div class="default-add fl" v-else-if="item.select == 1">
                  <i class="iconfont icon-checked-fill c_b11e25"></i>
                  <span>默认地址</span>
                </div>
                <div class="delete iconfont icon-shanchu fr"></div>
              </div>
            </div>
          </li>
        </template>
      </ul>
      <el-button icon="check" @click="addAddress()">添加收货地址</el-button>
    </div>
  </div>
</template>

<script type="text/javascript">

  import ElRadioGroup from "../../../node_modules/element-ui/packages/radio/src/radio-group";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
      name: 'address',
      components: {
          ElButton,
          ElRadioGroup
      },
      data () {
          return {
            deReadio: '0',
            currentIndex: 0,
            data: {
                list: [],
                isRadio: false,
            },
            userid: this.$storageGet('user_info').user,
            radio: '1'
          }
      },
      created() {
          this.setAddress();
      },
      computed: {
          list () {
              return this.setAddress();
          },
      },
      watch: {

      },
      methods: {
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
          this.$goFetch.fetchGet(this.$api.get_address.set_add_default + '?id='+ id +'&uid='+ 6 +'').then((res) => {
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
        setAddress() {
          this.$goFetch.fetchGet(this.$api.get_address.get_address + '?id=6').then((res) => {
            this.data.list = res.data;
          });
        },
        addAddress() {
            this.$router.push({ path: '/admin/increase'});
        },
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
