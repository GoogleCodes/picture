<template>
  <div>
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login reg" style="height: 490px;" v-loading="load_data" element-loading-text="正在登陆中...">
      <div class="login-form formWindow">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="form-h2 lineHeight45 iconfont icon-geren fl"></div>
              <el-input class="inputInfo input fl" placeholder="您的姓名" v-model="ruleForm.name" ></el-input>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight45 iconfont icon-shouji fl"></div>
              <el-input class="inputInfo input fl" placeholder="您的手机号" v-model="ruleForm.phone" ></el-input>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight45 iconfont icon-yanzhengma1 fl"></div>
              <el-input class="inputInfo input fl" placeholder="输入验证码" style="width:55%"
                        v-model="ruleForm.code"></el-input>
              <el-button @click="getCode()" class="code fr">{{ codeText }}</el-button>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight45 iconfont icon-mima fl"></div>
              <el-input class="inputInfo input fl" placeholder="输入密码" v-model="ruleForm.password" ></el-input>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight45 iconfont icon-mima fl"></div>
              <el-input class="inputInfo input fl" v-model="ruleForm.repwd" placeholder="再次输入密码" />
            </div>
          </el-form>
          <div class="form-input clear matop_20">
            <el-button class="comfirm" @click="goRegister('ruleForm')">注册</el-button>
          </div>
          <div class="form-input desc-wrap">
            <router-link :to="{ path: '/user/login'}" class="fl" style="color: #9e9e9f;">已有账号?立即登录</router-link>
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
        this.load_data = true;
        if (!this.$toolVerify.isTel(this.ruleForm.phone)) {
          this.load_data = false;
          this.$message({
            message: '请输入正确的手机号码格式！谢谢!',
            duration: 2000,
            type: 'warning'
          });
          return;
        }
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

  .reg {
    /*margin: 0px 20px;*/
    position: relative;
    top: 56px;
  }


  .login .login-form .form-input {
    height: 45px;
  }

  .tab .form-input .el-input__inner {
    height: 40px;
    border: none;
    width: 70%;
  }

  .tab .form-input .code {
    width: 80px;
    height: 35px;
    margin: 5px 5px 0px 0px;
    border: 1px solid #b11e25;
    background: #fff;
    color: #b11e25;
    padding: 0px 5px;
  }

  .tab .desc-wrap {
    margin: 0px 24px;
    line-height: 47px;
  }

</style>
