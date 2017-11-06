<template>
  <div class="bgColor">
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login w609" style="height: 560px;">
      <div class="form-title fl ft-22" style="color: #333;">
        <i class="line"></i>
        <span>找回密码</span>
      </div>
      <div class="login-form formWindow"
           style="top: 130px;" v-loading="load_data" element-loading-text="正在登陆中...">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">手机号码：</div>
              <el-form-item prop="phone">
                <el-input v-model="ruleForm.phone"
                          class="inputInfo input fl"
                          placeholder="手机号码" style="width: 60%;" ></el-input>
                <button class="getCode fl" @click="getCode" style="margin-top: 5px;">{{ num }}</button>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">验证码：</div>
              <el-form-item prop="code">
                <el-input v-model="ruleForm.code" class="inputInfo input fl" placeholder="验证码" ></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">新密码：</div>
              <el-form-item prop="password">
                <el-input v-model="ruleForm.password" type="password" class="inputInfo input fl" placeholder="输入密码" ></el-input>
              </el-form-item>
            </div>
            <div class="form-input">
              <div class="form-h2 lineHeight50 fl">确认密码：</div>
              <el-form-item prop="rePwd">
                <el-input v-model="ruleForm.rePwd" type="password" class="inputInfo input fl" placeholder="输入密码" ></el-input>
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
    mounted () {
      
    },
    methods: {
      getCode () {
        if (!this.$toolVerify.isTel(this.ruleForm.phone)) {
          this.$notify({
            title: '手机号码格式错误',
            message: '请输入正确的手机号码格式！谢谢!',
            duration: 2000,
            type: 'warning'
          });
          return;
        }
        this.$goFetchs.fetchGet(this.$api.port_user.get_find_code + '?tel='+ this.ruleForm.phone +'').then((res) => {
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
          this.$goFetchs.fetchGet(this.$api.port_user.get_find_pwd + 
            '&tel=' + this.ruleForm.phone +
            '&pwd=' + this.ruleForm.password +
            '&repwd=' + this.ruleForm.rePwd +
            '&code=' + this.ruleForm.code).then((res) => {
            if(res.data.code == 0) {
              this.$message({
                showClose: true,
                message: res.msg,
                type: 'warning'
              });
              return false;
            } else if (res.data.code == 1) {
              this.$message({
                message: res.data.msg,
                type: 'success'
              });
              setTimeout(() => {
                this.$router.push({ path: '/user/login' });
              }, 2000);
            }
          });
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
