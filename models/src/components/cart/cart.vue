<template>
  <div style="padding-top: 45px;">
    <div class="cart-nothing">
      <div class="cart-pic">
        <img src="../../../static/images/48.png" class="w100 h100" alt="">
      </div>
      <div class="ft-16 cart-desc">暂无商品，去逛逛吧</div>
    </div>
    <div style="display: none;">
      <div class="cart-body">
        <div class="cart-box" v-for="(item, index) in 10">
          <div class="addition fl">
            <i class="iconfont icon-quxiaoquanxuan c_9e9d9d"  @click="unActIt()" v-show="data.showVal"></i>
            <i class="iconfont icon-checked-fill c_b11e25" @click="actIt()" v-show="!data.showVal"></i>
          </div>
          <div class="maininfo fl">
            <div class="img fl">
              <img src="../../../static/images/30.jpg" alt="" class="w100 h100">
            </div>
            <div class="msg fl">
              <p class="name ft-16">照片冲印、手机上传打印照片</p>
              <p class="format c_898989">定格记忆 冲印美好</p>
            </div>
          </div>
          <div class="money fr c_e64147 ft-14">
            <label class="unit">¥</label>
            <label>99.1</label>
            <p class="c_898989">x1</p>
          </div>
        </div>
      </div>
      <div class="bar-wrapper w100 clear">
      <span class="iconfont icon-checked-fill c_b11e25" v-show="!data.allsel">
        <i class="ft-16">全选</i>
      </span>
        <span class="iconfont icon-quxiaoquanxuan c_9e9d9d" v-show="data.allsel">
        <i class="ft-16">取消</i>
      </span>
        <el-button class="fr gopay" @click="goPay()">去结算</el-button>
        <p class="ft-14 fr total-price">
          <span class="c_898989">合计</span>
          <span class="c_e64147">{{ data.totalMoney | changePrice }}</span>
        </p>
      </div>
    </div>
  </div>

</template>


<script type="text/javascript">

  import ElRadio from "../../../node_modules/element-ui/packages/radio/src/radio";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElCheckbox from "../../../node_modules/element-ui/packages/checkbox/src/checkbox";
  import ElCheckboxGroup from "../../../node_modules/element-ui/packages/checkbox/src/checkbox-group";

  export default {
    name: 'cart',
    data () {
        return {
          data: {
            list: [],
            number: 0,
            total: 0, //  总价
            totalMoney: 0,  //  总金额
            showVal: false,
            allsel: false,
          },
        }
    },
    components: {
      ElCheckboxGroup,
      ElCheckbox,
      ElInput,
      ElButton,
      ElRadio,
    },
    created() {
      this.$store.dispatch("init");
    },
    computed: {

    },
    watch: {
      $route (to) {

      }
    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice:function(value){
        return "￥" + value.toFixed(2);
      }
    },
    methods: {
      //  去结算
      goPay () {
//        var options = {}
//        if (this.multipleSelection.length == 0) {
//          this.$message({
//            message: '请选择商品!',
//            type: 'warning'
//          });
//          return;
//        }
//        this.$router.push({ path: '/cart/submit' });
      },
      unActIt() {
        this.data.showVal = false;
      },
      actIt() {
        this.data.showVal = true;
      }
    }
  };
</script>

<style type="text/css">

  @import "../../../static/css/cart.css";


  /* cart-box start */
  .bar-wrapper .gopay {
    width: 120px;
    height: 45px;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    box-sizing: border-box;
    margin-right: 10px;
  }

  .bar-wrapper {
    height: 44px;
    position: fixed;
    bottom: 50px;
    width: 100%;
    padding: 10px 0px;
    background: #fff;
  }

  .bar-wrapper .iconfont {
    font-size: 24px;
    line-height: 42px;
    margin-left: 10px;
  }

  .bar-wrapper .iconfont i {
    position: relative;
    top: -2px;
    margin-left: 5px;
  }

  .bar-wrapper .el-checkbox-group {
    margin: 10px;
  }

  .bar-wrapper .total-price {
    line-height: 45px;
    margin-right: 10px;
  }

  .cart-body .cart-box {
    margin: 10px 0px;
    background: #fff;
    overflow: hidden;
    padding: 10px;
  }

  .cart-box .addition {
    margin: 24px 12px 0px 0px;
  }

  .cart-box .addition .iconfont {
    font-size: 24px;
  }

  .cart-box .maininfo {
    width: 72%;
    height: 72px;
  }

  .cart-box .maininfo .img {
    width: 30%;
    height: 73px;
  }

  .cart-box .maininfo .msg {
    width: 65%;
    margin-left: 10px;
  }

  .cart-box .money {
    width: 3rem;
    font-weight: bold;
    text-align: center;
    margin: 10px 0px 0px 0px;
  }

  /* cart-box end */

  /* cart-nothing start */

  .cart-nothing {
    width: 153px;
    margin: 132px auto;
    line-height: 50px;
    text-align: center;
  }

  .cart-nothing .cart-pic {
    width: 153px;
  }

  .cart-nothing .cart-desc {
    color: #8c8c8c;
  }

  /* cart-nothing end */

</style>
