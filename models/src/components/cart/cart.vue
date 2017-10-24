<template>
  <div style="padding-top: 45px;">
    <div class="col-wrapper">
      <div class="notify-box">
        <div class="ntips fl">购物车中共有1件商品</div>
        <div class="fr" @click="changMode()">{{ data.modeText }}</div>
      </div>
    </div>
    <div class="cart-nothing" style="display: none;">
      <div class="cart-pic">
        <img src="../../../static/images/48.png" class="w100 h100" alt="">
      </div>
      <div class="ft-16 cart-desc">暂无商品，去逛逛吧</div>
    </div>
    <cart-list :chosen.sync="choseAll" v-for="item in data.list" :img="item.shotcut"
               :pid="item.id" :pname="item.name" :pformat="item.format"
               :showValue="data.showVal" :mode="editMode"
               :pprice="item.price" :pnums="item.nums"></cart-list>
    <div class="bar-wrapper w100 clear">
      <span class="iconfont icon-checked-fill c_b11e25" v-show="!data.allsel"  @click="changAll(0)">
        <i class="ft-16">全选</i>
      </span>
      <span class="iconfont icon-quxiaoquanxuan c_9e9d9d" v-show="data.allsel"  @click="changAll(1)">
        <i class="ft-16">取消</i>
      </span>
      <el-button class="fr gopay" @click="goPay()">去结算</el-button>
      <p class="ft-14 fr total-price">
        <span class="c_898989">合计</span>
        <span class="c_e64147">{{ data.totalMoney | changePrice }}</span>
      </p>
    </div>

  </div>

</template>


<script type="text/javascript">

  import cartList from '@/components/cart/cart-list.vue'

  import ElRadio from "../../../node_modules/element-ui/packages/radio/src/radio";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElCheckbox from "../../../node_modules/element-ui/packages/checkbox/src/checkbox";
  import ElCheckboxGroup from "../../../node_modules/element-ui/packages/checkbox/src/checkbox-group";

  export default {
    name: 'cart',
    data () {
        return {
          editMode: 0,
          choseAll: [],
          data: {
            modeText: '编辑',
            btnText: '删除',
            list: this.$storageGet('cart_info'),
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
      cartList
    },
    created() {
      console.log(this.data.list);
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
      changAll(type) {

      },
      changMode() {
        this.data.modeText = this.data.modeText === '编辑' ? '完成' : '编辑';
        this.editMode = this.editMode ? 0 : 1;
        this.choseAll = [];
      },
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

  /* col-wrapper start */
  .col-wrapper {
    padding: 0px 10px;
    height: 45px;
    background: #c40000;
    color: #fff;
    line-height: 45px;
  }
  /* col-wrapper end */

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
