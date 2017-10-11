<template>
  <div style="width: 100%;height: 100%;position: relative;background: #f8f8f8;">
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login">
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
            <div class="fl" style="cursor: pointer;">
              <el-checkbox label="记住登录密码" name="type" v-model="remember"></el-checkbox>
            </div>
            <router-link :to="{ path: '/user/find'}" class="fr" style="color: #b11e25;">忘记密码</router-link>
          </div>
          <div class="form-input clear">
            <el-button class="comfirm" @click="logining('ruleForm')"
                       type="primary"
                       v-loading.fullscreen.lock="fullscreenLoading">登录</el-button>
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

//  import { increment } from '../../store/actions/type'

  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";

  export default {
    name: 'login',
    data () {
      return {
        ruleForm: {
          username: null,
          password: null,
        },
        rules: {
          username: [{required: true, message: '请输入账户名！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}]
        },
        remember: false,
        fullscreenLoading: false,
      }
    },
    created () {
      //  调用Vuex action
      this.$store.dispatch("set_user_info");
    },
    methods: {
      ...mapActions({
        set_user_info: SET_USER_INFO
      }),
      logining (formName) {
        let that = this;
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
          }
          //  登录提交
          let json = {
            username : this.ruleForm.username,
            password : this.ruleForm.password,
          };
          that.fullscreenLoading = true;
          that.$http.get('../../../static/data/login.json', json).then((res) => {
            let uname = res.data.login.username;
            let pwrod = res.data.login.password;
            let pic = res.data.login.pic;
            switch (true) {
              case that.ruleForm.username !== uname:
                that.$message({
                  showClose: true,
                  message: '警告，账户用户名不正确!',
                  type: 'warning'
                });
                break;
              case that.ruleForm.password !== pwrod:
                that.$message({
                  showClose: true,
                  message: '警告，账户密码不正确!',
                  type: 'warning'
                });
                break;
              default:
                that.fullscreenLoading = false;
                that.$message({
                  showClose: true,
                  message: '恭喜，登录成功!',
                  type: 'warning'
                });
                let options = {
                  uname : that.ruleForm.username,
                  author: pic,
                };
                that.set_user_info({
                  user: options,
                  login: true
                });
//                localStorage.setItem('user_info', JSON.stringify(options));
                setTimeout(() => {
                  that.$router.push({ path: '/' });
                  location.reload();
                }, 500);
                break;
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
      ElFormItem, ElForm, ElButton, ElInput, heads,
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
