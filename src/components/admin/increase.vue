<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Add Address</h1>
        <div class="line"></div>
        <h5 class="order-h5">添加收货地址</h5>
      </div>

      <div class="trade_status" style="width:99%;padding-bottom: 116px;">
        <div class="item-add">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-title ft-18">增加收货地址</div>
            <el-form-item prop="name">
              <input type="text" class="block" placeholder="收货人姓名" v-model="ruleForm.name">
            </el-form-item>
            <el-form-item prop="telphone">
              <input type="tel" class="block" placeholder="电话" v-model="ruleForm.telphone">
            </el-form-item>
            <el-form-item>
              <el-cascader :options="addressData" v-model="selectedOptions" :props="props"></el-cascader>
            </el-form-item>
            <el-form-item>
              <input type="text" class="block" placeholder="详细地址（街道、小区、门牌号）" v-model="ruleForm.address">
            </el-form-item>
            <el-form-item class=" fl">
              <el-checkbox-group v-model="isDefault" @change="goDefault">
                <el-checkbox label="设置为默认收货地址"></el-checkbox>
              </el-checkbox-group>
            </el-form-item>
            <el-button class="fr save-btn" @click="gosave('ruleForm')">确认保存</el-button>
          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  import ElForm from "../../../node_modules/element-ui/packages/form/src/form";
  import ElFormItem from "../../../node_modules/element-ui/packages/form/src/form-item";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";


  import AddressChinaData from '../../../static/api/address.json'
  import ElCarousel from "../../../node_modules/element-ui/packages/carousel/src/main";
  import ElCheckbox from "../../../node_modules/element-ui/packages/checkbox/src/checkbox";
  import ElCheckboxGroup from "../../../node_modules/element-ui/packages/checkbox/src/checkbox-group";

  export default {
    components: {ElCheckboxGroup, ElCheckbox, ElCarousel, ElButton, ElFormItem, ElForm}, data () {
        return {
          ruleForm: {
            name: null,
            telphone: null,
            region: null,
            address: null,
            deradio: false,
          },
          rules: {
            name: [{required: true, message: '请输入姓名！', trigger: 'blur'}],
            region: [{required: true, message: '请选择区域！', trigger: 'blur'}],
            telphone: [{required: true, message: '请输入电话号码！', trigger: 'blur'}],
            address: [{required: true, message: '请输入具体地址！', trigger: 'blur'}]
          },
          addressData: AddressChinaData,
          props: {
            value: 'label',
            children: 'cities'
          },
          isDefault: false,
          selectedOptions: [],
        }
      },
      created () {

      },
      methods: {
        goDefault (event) {
          console.log(event);
        },
        gosave (formName) {
          this.$refs[formName].validate((valid) => {
            if (!valid) {
              return false;
            }
            console.log(this.selectedOptions + this.ruleForm.address);
            this.$goFetch.fetchPost(this.$api.get_address.url_address +
              '?id=6&sname='+ this.ruleForm.name +
              '&tel='+ this.ruleForm.telphone +
              '&adr='+ this.selectedOptions + this.ruleForm.address).then((res) => {
              if (res.code == 0) {
                this.$message({
                  message: res.msg,
                  type: 'warning'
                });
              } else if (res.code == 1) {
                this.$message({
                  message: res.msg,
                  type: 'success'
                });
                setTimeout((res) => {
                  this.$router.push({
                    path: '/admin/address'
                  });
                }, 500);
              }

            })
          });
        }
      }
  }
</script>

<style>

  .el-cascader {
    width: 100%;
  }

  .el-cascader .el-cascader__label{
    line-height: 77px;
  }

  .default-address ,.icon-checked-fill {
      font-size: 16px;
  }

</style>
