<template>
  <div style="padding-top: 45px;">
    <div class="msg-head" v-if="data.cartShoplist.length > 0">
      <div class="col-wrapper">
        <div class="notify-box">
          <div class="ntips fl">购物车中共有{{ data.cartShoplist.length }}件商品</div>
          <div class="fr" @click="changMode()">{{ data.modeText }}</div>
        </div>
      </div>
      <div class="cart-nothing" style="display: none;">
        <div class="cart-pic">
          <img src="../../../static/images/48.png" class="w100 h100" alt="">
        </div>
        <div class="ft-16 cart-desc">暂无商品，去逛逛吧</div>
      </div>
      <cart-list :chosen.sync="choseAll" v-for="(item, index) in data.cartShoplist" :pid="item.id" :img="item.shotcut"
                 :pName="item.name" :pprice="item.price" :pformat="item.format"
                 :mode="editMode" :list="item" :pnums="item.nums"></cart-list>
      <div class="bar-wrapper w100 clear">
      <span class="iconfont icon-checked-fill c_b11e25" @click="changAll(0)" v-show="allsel">
        <i class="ft-16">全选</i>
      </span>
      <span class="iconfont icon-quxiaoquanxuan c_9e9d9d" @click="changAll(1)" v-show="!allsel">
        <i class="ft-16">全选</i>
      </span>
        <el-button class="fr gopay" @click="goPay()">去结算</el-button>
        <p class="ft-14 fr total-price">
          <span class="c_898989">合计</span>
          <span class="c_e64147">{{ data.totalMoney | changePrice }}</span>
        </p>
      </div>
    </div>
    <div class="msg-head" v-else>
        <div class="iconCart">
          <img src="../../../static/images/48.png" alt="" class="w100 h100">
          <span>暂无商品，去逛逛吧</span>
        </div>
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
          choseAllFlag: false,
          data: {
            modeText: '编辑',
            cartShoplist: this.$storageGet('cart_info'),
            btnText: '删除',
            number: 0,
            total: 0, //  总价
            totalMoney: 0,  //  总金额
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
      this.$store.dispatch("init");
      console.log(this.data.cartShoplist);
    },
    computed: {
      allsel() {
        if(this.data.cartShoplist.length === this.choseAll.length) {
          return true;
        }
        return false;
      },
    },
    watch: {

    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice (value) {
        return "￥" + value.toFixed(2);
      }
    },
    methods: {
      changAll(type) {
        if(this.choseAll.length > 0) {
          this.choseAll.splice(0,this.choseAll.length);
        }
        if(type === 1) {
          for(let cl in this.data.cartShoplist) {
            this.choseAll.push({
              id: this.data.cartShoplist[cl].id,
              format: this.data.cartShoplist[cl].format
            });
          }
        }
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
    }
  };
</script>

<style type="text/css">

  @import "../../../static/css/cart.css";

  /* col-wrapper start */
  .col-wrapper {
    padding: 0px 10px;
    height: 45px;
    background: #ccc;
    color: #333;
    line-height: 45px;
  }
  /* col-wrapper end */

  /* cart-box start */
  .bar-wrapper .gopay {
    padding: 14px 28px;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin-right: 10px;
    border-radius: 0px;
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

  .msg-head .iconCart {
    margin: 0px 30px;
    padding: 150px 35px;
    text-align: center;
    color: #8c8c8c;
    line-height: 35px;
    font-family: 'microsoft yahei';
  }

  /* cart-nothing end */

</style>
