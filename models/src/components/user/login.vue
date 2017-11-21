<template>
  <div>
    <!-- login start -->
    <div class="login" v-loading="load_data" element-loading-text="正在登陆中...">
      <div class="login-form">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="form-h2 iconfont icon-shouji fl"></div>
              <el-input class="inputInfo"v-model="ruleForm.username" placeholder="手机号"></el-input>
            </div>
            <!--<div style="border-bottom: 1px solid #dcdddd;margin: 10px 0px;"></div>-->
            <div class="form-input">
              <div class="form-h2 iconfont icon-mima fl"></div>
              <el-input type="password" class="inputInfo" v-model="ruleForm.password" placeholder="密码"></el-input>
            </div>
          </el-form>
          <div class="form-input clear">
            <el-button class="comfirm login-btn" @click="logining('ruleForm')" type="primary">立即登录</el-button>
          </div>
          <div class="form-input">
            <router-link :to="{ path: '/user/register'}" class="fl" style="color: #9e9e9f;">还没账号?立即注册</router-link>
            <router-link :to="{ path: '/user/find'}" class="fr" style="color: #9e9e9f;">忘记密码</router-link>
          </div>
        </div>
      </div>
    </div>
    <!-- login end -->
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'
  import { mapActions } from 'vuex'
  import { SET_USER_INFO } from '../../store/actions/type'

  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";
  import ElCheckboxGroup from "../../../node_modules/element-ui/packages/checkbox/src/checkbox-group";

  export default {
    name: 'login',
    data () {
      return {
        ruleForm: {
          username: '13232800159',
          password: '123123',
        },
        rules: {
          username: [{required: true, message: '请输入账户名！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}]
        },
        //  请求时的loading效果
        load_data: false,
      }
    },
    created () {
      //  调用Vuex action
      this.$store.commit('GET_CHECKED_LOGIN',this.checked_login);
      this.$store.dispatch("set_user_info");
    },
    methods: {
      ...mapActions({
        set_user_info: SET_USER_INFO
      }),
      logining () {
        let that = this;
        that.load_data = true;
        this.$ajax.HttpPost(this.$api.port_user.get_login,{
            tel: this.ruleForm.username,
            pwd: this.ruleForm.password
          }).then((res) => {
            if(res.code == 0) {
              that.load_data = false;
              return false;
            } else {
              this.checked_login = true;
              this.$store.commit('GET_CHECKED_LOGIN',this.checked_login);
              that.set_user_info({
                user: {
                  id: res.data.id,
                  name: res.data.uname,
                  tel: this.ruleForm.username,
                },
                login: true
              });
              that.load_data = false;
              setTimeout(() => {
                this.$router.push({ path: '/' });
                location.reload();
              }, 500);
            }
        });
      }
    },
    watch: {

    },
    computed: {

    },
    components: {
      ElCheckboxGroup, ElFormItem, ElForm, ElButton, ElInput, heads,
      foots,
    }
  };
</script>


<style type="text/css">

  /* login start */
  .login {
    width: 100%;
    height: 180px;
    margin: 0px auto;
    position: relative;
    top: 56px;
  }

  .login .login-form {
    width: 100%;
    height: 230px;
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    margin: 0px auto;
  }

  .login .login-form form {
    background: #fff;
  }

  .login .login-form .form-input {
    clear: both;
    margin: 0px 15px;
  }

  .login .login-form .form-input .inputInfo {
    width: 75%;
    height: 40px;
    margin: 0px;
    text-indent: 1em;
    border: none;

  }
  /* login end */

  .tab .form-input .el-input__inner {
    height: 45px;
    border: none;
    width: 90%;
    padding: 0px;
  }

  .tab .form-input .login-btn {
    width: 100%;
    height: 45px;
    border: none;
    margin: 15px auto;
    color: #fff;
    background: #b11e25;
    display: block;
  }

  .tab .form-input .el-form-item {
    margin-bottom: 20px;
    width: 100%;
  }

</style>
