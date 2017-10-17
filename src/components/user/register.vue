<template>
  <div style="width: 100%;height: 100%;position: relative;background: #f8f8f8;">
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login" style="height: 565px;" v-loading="load_data" element-loading-text="正在登陆中...">
      <div class="login-form formWindow">
        <div class="tab">
          <div style="height: 40px;border-bottom: 1px solid #ccc;">
            <div class="form-title fl ft-22">快速注册</div>
            <div class="fr form-h4">已有帐号?
            <router-link :to="{ path: '/user/login'}" class="clickReg">点此登录</router-link>
            </div>
          </div>
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input" style="margin-top: 20px;">
              <div class="form-h2 lineHeight50 fl">验证码：</div>
              <el-form-item prop="code">
                <el-input class="inputInfo input fl" placeholder="输入验证码" style="width:57%"
                          v-model="ruleForm.code"></el-input>
                <el-button @click="getCode()" class="code fr"
                           style="width: 97px;margin-top: 5px;height: 42px;background: #595757">{{ codeText }}</el-button>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">姓名：</div>
              <el-form-item prop="name">
                <el-input class="inputInfo input fl" placeholder="您的姓名" v-model="ruleForm.name" ></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">手机号：</div>
              <el-form-item prop="phone">
                <el-input class="inputInfo input fl" placeholder="您的手机号" v-model="ruleForm.phone" ></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">密码：</div>
              <el-form-item prop="password">
                <el-input class="inputInfo input fl" placeholder="输入密码" v-model="ruleForm.password" ></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">确认密码：</div>
              <el-form-item prop="repwd">
                <el-input class="inputInfo input fl" v-model="ruleForm.repwd" placeholder="再次输入密码" />
              </el-form-item>
            </div>
          </el-form>
          <div class="form-input clear">
            <el-button class="comfirm" style="width: 207px;margin-left: 88px;" @click="goRegister('ruleForm')">注册</el-button>
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
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";

  export default {
    name: 'login',
    data () {
      return {
        codeText: "获取验证码",
        ruleForm: {
          code: null,       //  验证码
          name: null,           //  名称
          phone: null, //  手机号码
          password: null,       //  密码
          repwd: null,          //  确认密码
        },
        rules: {
          code: [{required: true, message: '请输入验证码！', trigger: 'blur'}],
          name: [{required: true, message: '请输入姓名！', trigger: 'blur'}],
          phone: [{required: true, message: '请输入账户名！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}],
          repwd: [{required: true, message: '再次输入密码', trigger: 'blur'}]
        },
        //  请求时的loading效果
        load_data: false,
      }
    },
    created () {

    },
    methods: {
      goRegister (formName) {
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
          }
          if (!this.$toolVerify.isTel(this.ruleForm.phone)) {
            this.$notify({
              title: '手机号码格式错误',
              message: '请输入正确的手机号码格式！谢谢!',
              duration: 2000,
              type: 'warning'
            });
            return;
          }
          this.load_data = true;
          this.$goFetch.fetchPost(this.$api.port_user.set_reg +
            '?uname=' + this.ruleForm.name +
            '&tel=' + this.ruleForm.phone +
            '&pwd=' + this.ruleForm.password +
            '&repwd=' + this.ruleForm.repwd +
            '&code=' + this.ruleForm.code).then((res) => {
              this.load_data = false;
              if (res.code == 0) {
                this.$message({
                  message: res.msg,
                  type: 'warning'
                });
                return false;
              } else if (res.code == 1) {
                this.$message({
                    message: '恭喜你，注册成功！',
                    type: 'success'
                });
                setTimeout(() => {
                    this.$router.push({ path: '/user/login' });
                }, 1000);
              }
          });

        });
      },
      getCode() {
        let count = 10;
        let times = setInterval(() => {
          count--;
          this.codeText = "还有" + count + "秒";
          if (count == 0) {
            clearInterval(times);
            this.codeText = "获取验证码"
          }
        },1000);
        this.$pubFetch.fetchPost(this.$api.port_user.get_reg_code + '?tel=13232800159').then((res) => {
          clearInterval(times);
          this.codeText = "获取验证码";
          if(res.code == 0) {
            this.$message({
              message: res.msg,
              type: 'warning'
            });
            return;
          } else if (res.code == 1) {
            this.$message({
              message: res.msg,
              type: 'success'
            });
          }
        })
      }
    },
    components: {
      ElFormItem,
      ElButton,
      ElInput,
    }
  };
</script>

<style>
  .tab .form-input .el-input__inner {
    height: 40px;
    border: none;
    width: 90%;
  }

  .tab .form-input .el-button {
    width: 100%;
    height: 49px;
    border: none;
    margin-top: 5px;
    color: #fff;
    background: #b11e25;
  }

  .tab .form-input .code {
    width: 97px;
    height: 41px;
    border: 1px solid #595757;
    background: #595757;
    color: #fff;
    border-radius: 0px;
  }

</style>
