<template>
  <div style="width: 100%;height: 100%;position: relative;background: #f8f8f8;">
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login" v-loading="load_data" element-loading-text="正在登陆中...">
      <div class="login-form">
        <div class="tab">
          <div style="height: 40px;border-bottom: 1px solid #ccc;">
            <div class="form-title fl ft-22">登录账号</div>
            <div class="fr form-h4">来有账号?
              <router-link :to="{ path : '/user/register'}" class="clickReg">点此注册</router-link>
            </div>
          </div>
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="form-h2">手机号：</div>
              <el-form-item prop="username">
                <el-input class="inputInfo" v-model="ruleForm.username" placeholder="请输入账户名"></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2">密码：</div>
              <el-form-item prop="password">
                <el-input type="password" class="inputInfo" v-model="ruleForm.password" placeholder="请输入账户密码"></el-input>
              </el-form-item>
            </div>
          </el-form>
          <div class="form-input">
            <div class="fl" style="cursor: pointer;width: 60%">
              <el-checkbox-group v-model="checked_login" @change="changeGo">
                <el-checkbox label="记住登录密码">记住登录密码</el-checkbox>
              </el-checkbox-group>
            </div>
            <router-link :to="{ path: '/user/find'}" class="fr" style="color: #b11e25;">忘记密码</router-link>
          </div>
          <div class="form-input clear">
            <el-button class="comfirm" @click="logining('ruleForm')" type="primary">登录</el-button>
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
  import { SET_USER_INFO, SET_USER_SESS } from '../../store/actions/type'

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
          username: '18520908682',
          password: '',
        },
        rules: {
          username: [{required: true, message: '请输入账户名！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}]
        },
        checked_login: true,
        //  请求时的loading效果
        load_data: false,
      }
    },
    created () {
      this.$store.commit('GET_CHECKED_LOGIN',this.checked_login);
    },
    methods: {
      ...mapActions({
        set_user_info: SET_USER_INFO,
        set_user_sess: SET_USER_SESS
      }),
      goBackLogin() {
        //  观察如果进入登录页面判断不等于undefined 直接返回后一页
        if (localStorage.getItem('user_info') !== undefined) {
          window.history.back();
        }
      },
      changeGo (event) {
        event ? this.checked_login = event : this.checked_login = event;
      },
      logining (formName) {
        let that = this;
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
          }
          that.load_data = true;
          that.$ajax.HttpPost(this.$api.port_user.get_login + 
          '?tel='+ this.ruleForm.username + 
          '&pwd=' + this.ruleForm.password).then((res) => {
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

  .tab .form-input .el-input__inner {
    height: 40px;
    border: none;
    width: 90%;
  }

  .tab .form-input .el-button {
    width: 100%;
    height: 49px;
    border: none;
    margin-top: 20px;
    color: #fff;
    background: #b11e25;

  }
</style>
