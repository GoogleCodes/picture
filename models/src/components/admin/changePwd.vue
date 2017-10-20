<template>
  <div class="admin-right fr">
    <div class="orderHistory">
      <h1 class="ft-26" style="font-weight: 500;">Modify Password</h1>
      <div class="line"></div>
      <h5 class="order-h5">修改密码</h5>
    </div>

    <div class="trade_status" style="width:99%;padding-bottom: 116px;">
      <div class="trade-form">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
          <el-form-item prop="nowpwd">
            <el-input type="password" class="block" placeholder="当前密码" v-model="ruleForm.nowpwd" />
          </el-form-item>
          <el-form-item prop="newpwd">
            <el-input type="password" class="block" placeholder="新密码" v-model="ruleForm.newpwd" />
          </el-form-item>
          <el-form-item prop="dopwd">
            <el-input type="password" class="block" placeholder="再次确认密码" v-model="ruleForm.dopwd" />
          </el-form-item>
        </el-form>
        <el-button type="primary" @click="submitForm('ruleForm')">确认修改</el-button>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";
  export default {
    components: {ElFormItem, ElForm}, data() {
      return {
        ruleForm: {
          nowpwd: null, //旧密码
          newpwd: null, //新密码
          dopwd: null,  //再次输入密码
        },
        rules: {
          nowpwd: [{ required: true, message: '请输入旧密码', trigger: 'blur' },],
          newpwd: [{ required: true, message: '请输入新密码', trigger: 'blur' },],
          dopwd: [{ required: true, message: '再次输入密码', trigger: 'blur' },]
        },
      }
    },
    methods: {
      submitForm (formName) {
        this.$refs[formName].validate((valid) => {
          if (!valid) {
            return false;
          }
          this.$message({
            showClose: true,
            message: '警告哦，这是一条警告消息',
            type: 'warning'
          });

        });
      }
    }
  }
</script>

<style>
  .admin-right .trade-form {
    width: 401px;
    height: 100%;
    margin: 95px auto 0;
  }

  .admin-right .trade-form .el-input {
    width: 100%;
    height: 46px;
    background: #fafbfc;
    border: 1px solid #dcdddd;
    margin-top: 10px;
    color: #b5b5b6;
  }

  .admin-right .trade-form input[type='text'],input[type='password'] {
    margin: 0px;
    border: none;
    height: 46px;
    text-indent: 1em;
    background: #fafbfc;
    width: 95%;
  }

  .admin-right .trade-form .el-button {
    width: 182px;
    height: 39px;
    border: 1px solid #b11e25;
    background: #b11e25;
    border-radius: 5px;
    color: #fff;
    margin: 50px auto 0px;
    cursor: pointer;
    display: block;
  }
</style>
