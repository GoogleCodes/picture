<template>
  <div style="width: 100%;height: 100%;position: relative;background: #f8f8f8;">
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login w609" style="height: 560px;">
      <div class="form-title fl ft-22" style="color: #333;">
        <i class="line"></i>
        <span>找回密码</span>
      </div>
      <div class="login-form formWindow" style="top: 130px;">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">手机：</div>
              <el-form-item prop="phone">
                <el-input v-model="ruleForm.phone" class="inputInfo input fl" placeholder="手机号码" style="width: 60%;"  />
                <button class="getCode fl" @click="getCode" style="margin-top: 5px;">{{ num }}</button>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">验证码：</div>
              <el-form-item prop="code">
                <el-input v-model="ruleForm.code" class="inputInfo input fl" placeholder="验证码" />
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">新密码：</div>
              <el-form-item prop="password">
                <el-input v-model="ruleForm.password" type="password" class="inputInfo input fl" placeholder="输入密码" />
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">确认密码：</div>
              <el-form-item prop="newpwd">
                <el-input v-model="ruleForm.newpwd" type="password" class="inputInfo input fl" placeholder="输入密码" />
              </el-form-item>
            </div>
          </el-form>
          <div class="form-input clear">
            <el-button class="comfirm" style="width: 207px;margin-left: 88px;" @click="goFind('ruleForm')">提交</el-button>
          </div>
          <div class="clear form-desc-service">
            若您无法使用上述方法找回，请联系客服 <a href="tel:0757-800600">0757-800600</a>
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
          newpwd: null
        },
        rules: {
          phone: [{required: true, message: '请输入手机号！', trigger: 'blur'}],
          code: [{required: true, message: '请输入验证码！', trigger: 'blur'}],
          password: [{required: true, message: '请输入账户密码！', trigger: 'blur'}],
          newpwd: [{required: true, message: '重新输入账户密码！', trigger: 'blur'}],
        },
        num: '获取验证码',
      }
    },
    created () {

    },
    methods: {
      getCode () {
          setInterval(function() {

          }, 1000);
      },
      goFind (formName) {
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
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
