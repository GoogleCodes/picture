<template>
  <div>
    <!-- login start -->
    <div class="administrator"></div>
    <div class="login find" style="height: 100%;">
      <div class="login-form formWindow" v-loading="load_data" element-loading-text="正在登陆中...">
        <div class="tab">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-mima fl"></div>
              <el-input v-model="ruleForm.opwd" type="password" class="inputInfo input fl" placeholder="当前密码" ></el-input>
            </div>
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-mima fl"></div>
              <el-input v-model="ruleForm.npwd" type="password" class="inputInfo input fl" placeholder="新密码" ></el-input>
            </div>
            <div class="form-input">
              <div class="lineHeight45 iconfont icon-mima fl"></div>
              <el-input v-model="ruleForm.nrepwd" type="password" class="inputInfo input fl" placeholder="确认密码" ></el-input>
            </div>
          </el-form>
          <div class="form-input clear matop_10">
            <el-button class="comfirm" style="margin-top: 50px" @click="goModify('ruleForm')">提交</el-button>
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
          opwd: null,
          npwd: null,
          nrepwd: null
        },
        rules: {
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
      goModify (formName) {
        let that = this;
        this.load_data = true;
        that.$goFetch.fetchPost(this.$api.port_user.get_chapwd +
          '&id=' + "6" +
          '&opwd=' + this.ruleForm.opwd +
          '&npwd=' + this.ruleForm.npwd +
          '&nrepwd=' + this.ruleForm.nrepwd).then((res) => {
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
