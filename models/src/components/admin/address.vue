<template>
  <div>
    <div class="info-address" v-loading="load_data" element-loading-text="正在获取信息中...">
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
                <div class="delete iconfont icon-shanchu fr" @click="delAddress(item.id)"></div>
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

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'
  import { REMOVE_USER_INFO } from '../../store/actions/type'
  import { cookieStorage } from '../../common/storage'

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
          radio: '1',
          load_data: false,
        }
      },
      created() {
          this.setAddress();
      },
      computed: {
        ...mapGetters({
          get_user_info: GET_USER_INFO
        }),
        getID () {
          try {
            let json = this.get_user_info
            return json.user.id;
          } catch(e) {}
        },
        list () {
            return this.setAddress();
        },
      },
      watch: {

      },
      methods: {
        delAddress(id) {
          this.$confirm('此操作将删除该地址, 是否继续?', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            this.$ajax.HttpGet(this.$api.get_address.del_address + '?id='+ id +'').then((res) => {
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
          this.$ajax.HttpGet(this.$api.get_address.set_add_default + '?id='+ id +'&uid='+ this.getID +'').then((res) => {
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
          this.$ajax.HttpGet(this.$api.get_address.get_address + '?id=' + 6).then((res) => {
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
    height: auto;
    max-height: 55px;
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
<style>
  /* el-message-box start */
  .el-message-box {
    width: 85%;
  }
  .el-message-box__content {
    padding: 18px 20px;
  }
  /* el-message-box end */
</style>
