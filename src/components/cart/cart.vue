<template>
  <div class="bgcolor">
    <div class="cart-body">
      <div class="cart-head">
        <div class="cart-h1">SHOPPING CART</div>
        <p class="cart-h2">
          <span class="line block fl"></span>
          <span class="block clear">购物车</span>
          <span class="line block fr"></span>
        </p>
      </div>
      <div class="cart-content">
        <table class="table-body">
          <thead class="thead">
            <tr class="ul">
              <td class="li all-chonse">
                <el-checkbox
                  :indeterminate="data.isIndeterminate"
                  v-model="data.checkAll"
                  @change="handleCheckAllChange">全选</el-checkbox>
              </td>
              <td class="li shoping">商品名称</td>
              <td class="li unitprice">单价</td>
              <td class="li number">数量</td>
              <td class="li totalprice">总价</td>
              <td class="li operating">操作</td>
            </tr>
          </thead>
          <tbody class="tbody">{{ list }}
            <template v-for="(item, index) in list">
              <tr class="ul">
                <td class="li radio">
                  <el-checkbox-group v-model="data.checkedCities">
                    <el-checkbox style="margin-right: 10px;"></el-checkbox>
                  </el-checkbox-group>
                </td>
                <td class="li">
                  <div class="item-pic fl">
                    <img src="../../assets/images/26.png" alt="" style="width: 100%;height: 100%;" />
                  </div>
                  <p class="ft-18 shoping-name">
                    <router-link :to="{ path: '/cart/cart'}">
                      罗马之恋(皮革相册）
                    </router-link>
                  </p>
                  <p class="ft-14 shoping-desc" style="color: #898989;">甜蜜时光，纪念爱情</p>
                </td>
                <td class="li unitprice ft-24" style="color: #b5b5b6;">￥{{ data.uprice }}</td>
                <td class="li number">
                  <div class="item-amount ">
                    <el-button class="no-minus fl" @click="nominus" :class="{'disabled':pnums <= 1}">-</el-button>
                    <el-input type="text" class="fl" placeholder="0" v-model="pnums"></el-input>
                    <el-button class="add-max fl" @click="addmax" :class="{'disabled': pnums >= 1}">+</el-button>
                  </div>
                </td>
                <td class="li totalprice ft-24" style="color: #e64147">
                  <p>￥{{ data.tprice }}</p>
                  <el-button @click="goLoad()">上传图片</el-button>
                </td>
                <td class="li operating clearshop">X</td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="bar-wrapper w100">
        <p class="shoping-desc ft-18 fl">继续购物 共1件商品，已选择1件</p>
        <div class="fr">
          <el-button class="fr" @click="goPay()">去结算</el-button>
          <p class="ft-20 fr selectedItem">合计(不含运费)：36.00元</p>
        </div>
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
          pnums: 0,
          data: {
            checkAll: true,
            isIndeterminate: true,
            checkedCities: [],
            shopOptions: [1],
            uprice: 0,  //  单价
            tprice: 0,  //  总价
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
      //  调用Vuex action
      this.$store.dispatch("init");
    },
    computed: {
      list() {
        return this.$store.state.list;
      }
    },
    methods: {
      //  全选商品
      handleCheckAllChange (event) {
        this.checkedCities = event.target.checked ? this.shopOptions : [];
        this.isIndeterminate = false;
      },
      goLoad () {
          this.$router.push({ path : '../pages/onload'});
      },
      nominus () {
        if (this.pnums > 0) {
          this.pnums--;
        }
      },
      addmax () {
        if (this.pnums < 0) {
          return false;
        }
        this.pnums++;
      },
      //  去结算
      goPay () {
        this.$router.push({ path: '/cart/submit' });
      }
    }
  };
</script>

<style type="text/css">

  @import "../../../static/css/cart.css";

  .cart-body .cart-content .table-body {
    width: 100%;
  }

  .cart-body .cart-content .thead {
    width: 100%;
    height: 80px;
    border-bottom: 1px solid #efefef;
    text-align: center;
  }

  .cart-body .cart-content .thead .ul {
    height: 80px;
  }

  .cart-body .cart-content .thead .ul .all-chonse {
    width: 99px;
  }

  .cart-body .cart-content .thead .ul .all-chonse .el-checkbox {
    padding: 0 0 0 20px;
  }

  .cart-body .cart-content .thead .ul .shoping {
    width: 407px;
    text-align: center;
  }

  .cart-body .cart-content .thead .ul .unitprice {
    width: 207px;
  }

  .cart-body .cart-content .thead .ul .totalprice {
    width: 143px;
  }

  .tbody .ul .totalprice .el-button {
    position: relative;
    left: 6px;
    top: 20px;
    height: 35px;
  }

  .cart-body .cart-content .thead .ul .operating {
    width: 88px;
  }

  .cart-body .cart-content .tbody {
    width: 100%;
    text-align: center;
  }

  .cart-body .cart-content .tbody .ul {
    height: 160px;
    border-bottom: 1px solid #efefef;
  }

  .cart-body .cart-content .tbody .ul:last-child {
    border: none;
  }

  .cart-body .cart-content .tbody .ul .li {
    height: 90px;
    margin: 40px 0px;
  }

  .cart-body .cart-content .tbody .ul .li .shoping-name {
    margin: 20px 0 0 0;
    text-indent: 1em;
    text-align: left;
  }

  .cart-body .cart-content .tbody .ul .li .shoping-desc {
    margin: 10px 0 0 0;
    text-indent: 1.5em;
    text-align: left;
  }

  .cart-body .cart-content .tbody .ul .li .item-pic {
    width: 130px;
    height: 97px;
  }

  .cart-body .cart-content .tbody .ul .li .item-amount {
    width: 256px;
    position: relative;
    left: 28px;
  }

  .tbody .ul .li .item-amount .el-input {
    width: 75px;
  }

  .tbody .ul .li .item-amount .el-input__inner {
    text-align: center;
    background: #f7f8f8;
    font-weight: bold;
    margin-left: 10px;
  }

  .tbody .ul .li .item-amount .add-max, .no-minus {
    margin-left: 20px;
    font-weight: bold;
    background: #f7f8f8;
  }

  .tbody .ul .clearshop {
    color: #c9caca;
    cursor: pointer;
  }

  .tfoot {
    height: 80px;
    line-height: 80px;
  }

  .tfoot .ul .foot-li {
    width: 100%;
  }

  .bar-wrapper {
    background: #fff;
    height: 80px;
    line-height: 80px;
    margin-bottom: 136px;
  }

  .bar-wrapper .shoping-desc{
    width: 50%;
    color: #595757;
    margin-left: 40px;
  }

  .bar-wrapper .selectedItem {
    color: #c40000;
    margin-right: 50px;
  }

  .bar-wrapper .el-button {
    height: 80px;
    width: 186px;
    background: #c40000;
    border: 1px solid #c40000;
    border-radius: 0px;
    color: #fff;
  }


  /* cart-body end */
</style>
