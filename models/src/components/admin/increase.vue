<template>
  <div>
    <div class="admin-right fr">
      <div class="trade_status">
        <div class="item-add">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
            <div class="form-item">
              <span class="fl item-desc">收货人</span>
              <el-input type="text" class="block" placeholder="收货人姓名" v-model="ruleForm.name"></el-input>
            </div>
            <div class="form-item">
              <span class="fl item-desc">手机号</span>
              <el-input type="tel" class="block" placeholder="电话" v-model="ruleForm.telphone"></el-input>
            </div>
            <div class="form-item">
              <span class="fl item-desc">所在地区</span>
              <el-cascader class="select-input" :options="addressData" v-model="selectedOptions" :props="props"></el-cascader>
            </div>
            <div class="form-item " style="height: auto;padding: 14px 10px;">
              <span class="fl item-desc">详细地址</span>
              <el-input type="textarea" placeholder="详细地址（街道、小区、门牌号）" v-model="ruleForm.address"></el-input>
            </div>
          </el-form>
          <div class="radio-item" style="line-height: 40px;">
            <el-checkbox-group v-model="isDefault" @change="goDefault">
              <el-radio label="设置为默认收货地址"></el-radio>
            </el-checkbox-group>
          </div>
          <el-button class="save-btn" @click="gosave('ruleForm')">确认保存</el-button>
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

        },
        gosave (formName) {
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
        }
      }
  }
</script>



<style>
  .admin-right {
    width: 100%;
    margin-top: 46px;
  }
  .trade_status {

  }
  .item-add .form-item {
    height: 40px;
    padding: 0px 10px;
    background: #fff;
  }
  .item-add .form-item .item-desc {
    line-height: 40px;
    width: 60px;
  }
  .item-add .form-item .el-input {
    width: 80%;
  }
  .form-item .el-input .el-input__inner {
    border: none;
  }
  .form-item .el-form-item__content {
    width: 90%;
  }
  .form-item .el-input__icon {
    /*right: -32px;*/
  }
  .form-item .el-textarea {
    width: 80%;
  }
  .form-item .el-textarea__inner {
    height: 90px;
    border: none;
    margin-top: 5px;
  }
  .form-item .el-cascader__label {
    padding: 0 0 0 10px;
  }
  .item-add .form-item .select-input {
    width: 80%;
  }
  .item-add .radio-item {
    margin: 10px 0px;
    padding: 0px 10px;
    background: #fff;
  }
  .item-add .save-btn {
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    height: 40px;
    width: 90%;
    display: block;
    margin: 40px auto;

  }


</style>
