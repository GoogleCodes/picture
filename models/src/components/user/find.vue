<template>
  <div>
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login find" style="height: 100%;">
      <div class="login-form formWindow" v-loading="load_data" element-loading-text="正在登陆中...">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-shouji fl"></div>
              <el-input v-model="ruleForm.phone" class="inputInfo input fl" placeholder="手机号码" ></el-input>
            </div>
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-yanzhengma1 fl"></div>
              <el-input v-model="ruleForm.code" class="inputInfo input fl" style="width: 59%;" placeholder="验证码" ></el-input>
              <button class="getCode code fr" @click="getCode">{{ num }}</button>
            </div>
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-mima fl"></div>
              <el-input v-model="ruleForm.password" type="password" class="inputInfo input fl" placeholder="输入密码" ></el-input>
            </div>
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-mima fl"></div>
              <el-input v-model="ruleForm.rePwd" type="password" class="inputInfo input fl" placeholder="输入密码" ></el-input>
            </div>
          </el-form>
          <div class="form-input clear matop_10">
            <el-button class="comfirm" style="margin-top: 20px" @click="goFind('ruleForm')">提交</el-button>
          </div>
          <div class="form-input desc-wrap">
            <router-link :to="{ path: '/user/login'}" class="fl" style="color: #9e9e9f;line-height: 45px;">返回登录</router-link>
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
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";

  export default {
    name: 'find',
    data () {
      return {
        ruleForm: {
          phone: null,
          code: null,
          password: null,
          rePwd: null
        },
        rules: {
          phone: [{required: true, message: '请输入手机号！', trigger: 'blur'}],
          code: [{required: true, message: '请输入验证码！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}],
          rePwd: [{required: true, message: '重新输入账户密码！', trigger: 'blur'}],
        },
        num: '获取验证码',
        load_data: false, //  请求时的loading效果
      }
    },
    created () {

    },
    methods: {
      getCode () {
        let count = 10;
        let times = setInterval(() => {
          --count;
          this.num = count;
          if (count == 0) {
            this.num = "获取验证码"
            clearTimeout(times);
          }
        },1000);
        if (!this.$toolVerify.isTel(this.ruleForm.phone)) {
          this.$message({
            showClose: true,
            message: '请输入正确的手机号码格式！谢谢!',
            type: 'warning',
            duration: 2000,
          });
          return;
        }
        this.$goFetch.fetchPost(this.$pubFetch.port_user.get_find_code + '?tel='+ this.ruleForm.phone +'').then((res) => {
          if(res.code == 0) {
            this.$message({
              message: res.msg,
              type: 'warning'
            });
          } else if (res.code == 1) {
            this.$message({
              message: res.msg,
              type: 'success'
            });
          }
        })
      },
      goFind (formName) {
        let that = this;
        this.load_data = true;
        that.$goFetch.fetchPost(this.$api.port_user.get_find_pwd +
          '&tel=' + this.ruleForm.phone +
          '&pwd=' + this.ruleForm.password +
          '&repwd=' + this.ruleForm.rePwd +
          '&code=' + this.ruleForm.code).then((res) => {
          that.load_data = false;
          if(res.code == 0) {
            this.$message({
              showClose: true,
              message: res.msg,
              type: 'warning'
            });
            return false;
          } else if (res.code == 1) {
            this.$message({
              message: res.msg,
              type: 'success'
            });
            setTimeout(() => {
              this.$router.push({ path: '/user/login' });
            }, 2000);
          }
        });
      }
    },
    components: {
      ElFormItem, ElForm, ElInput, ElButton, heads,
      foots,
    }
  };

</script>


<style>

  /* find start */
  .find {
    position: relative;
    top: 56px;
  }

  .tab .form-input .el-input__inner {
    height: 40px;
    border: none;
    width: 75%;
  }

  .tab .form-input .el-button {
    width: 100%;
    height: 40px;
    border: none;
    margin: 20px auto;
    color: #fff;
    background: #b11e25;
    display: block;
  }

  /* find end */

</style>
