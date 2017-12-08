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
      <cart-list :chosen.sync="choseAll" :uid="userID" v-for="(item, index) in data.cartShoplist" :pid="item.id" :img="item.goods_thumb"
                 :pName="item.goods_name" :pprice="item.price" :pformat="item.goods_remark"
                 :mode="editMode" :list="item" :pnums="item.num"></cart-list>

      <div class="bar-wrapper w100 clear">
        <span class="iconfont icon-checked-fill c_b11e25" @click="changAll(0)" v-show="allsel">
          <i class="ft-16">全选</i>
        </span>
        <span class="iconfont icon-quxiaoquanxuan c_9e9d9d" @click="changAll(1)" v-show="!allsel">
          <i class="ft-16">全选</i>
        </span>
          <el-button class="fr gopay" @click="goPay()">去结算({{ choseAll.length }})</el-button>
          <p class="ft-14 fr total-price">
            <span class="c_898989">合计</span>
            <span class="c_e64147 ft-18 ft-we">{{ chosePrice }}</span>
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

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'

  export default {
    name: 'cart',
    data () {
        return {
          editMode: 0,
          choseAll: [],
          data: {
            modeText: '编辑',
            cartShoplist: [],
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
//      this.$store.dispatch("init");
      this.fetchData();
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
      userID() {
        try {
          let json = this.get_user_info
          return json.user.id;
        } catch(e) {}
      },
      allsel() {
        if(this.data.cartShoplist.length === this.choseAll.length) {
          return true;
        }
        return false;
      },
      chosePrice() {
        let sum = 0;
        if (this.choseAll.length <= 0) {
          return sum.toFixed(2);
        }
        for (let ch in this.choseAll) {
          for (let pl in this.data.cartShoplist) {
            if (this.choseAll[ch] === this.data.cartShoplist[pl].id) {
              sum += this.data.cartShoplist[pl].price * this.data.cartShoplist[pl].num;
              break;
            }
          }
        }
        return sum.toFixed(2);
      }
    },
    watch: {
      //  监听路由
      '$route'() {
          this.fetchData();
      }
    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice (value) {
        return "￥" + value.toFixed(2);
      }
    },
    methods: {
      //  获取购物车数据
      fetchData() {
        this.load_data = true;
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,{uid: this.userID}).then((res) => {
          this.cart_number = res.data.length;
          this.$store.commit('SET_CART_NUMBER', this.cart_number);
          this.load_data = false;
          this.data.cartShoplist = res.data;
          this.load_data = false;
        }).catch((error) => {
          this.load_data = false;
        });
      },
      changAll(type) {
        if(this.choseAll.length > 0) {
          this.choseAll.splice(0,this.choseAll.length);
        }
        let arr = [];
        if(type === 1) {
          for(let cl in this.data.cartShoplist) {
            arr.push(this.data.cartShoplist[cl].id);
          }
          this.choseAll = arr;
        } else if (type == 0) {
          this.choseAll = arr = [];
        }
      },
      changMode() {
        this.data.modeText = this.data.modeText === '编辑' ? '完成' : '编辑';
        this.editMode = this.editMode ? 0 : 1;
        this.choseAll = [];
      },
      //  去结算
      goPay () {
        var options = {}, arr = []
        if (this.choseAll.length == 0) {
          this.$message({
            message: '请选择商品!',
            type: 'warning'
          });
          return;
        }
        for (let i in this.data.cartShoplist) {
          options = {
            list: this.data.cartShoplist[i],
            price: this.chosePrice,
          }
          arr.push(options);
        }
        this.$storageSet('cart_list_data', arr);
        this.$router.push({
          path: '/pages/ord-detail'
        });
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

  .bar-wrapper .gopay, .bar-wrapper .delete-shop  {
    -webkit-box-sizing: border-box;
    border: 1px solid #b11e25;
    box-sizing: border-box;
    background: #b11e25;
    padding: 14px 28px;
    color: #fff;


    width: 120px;
    height: 100%;
    /* margin-right: 10px; */
    border-radius: 0px;
  }

  .bar-wrapper .delete-shop {
    border: 2px solid #b11e25;
    background: #fff;
    color: #b11e25;
  }

  .bar-wrapper {
    height: 44px;
    position: fixed;
    bottom: 0px;
    width: 100%;
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
    padding: 170px 67px;
    text-align: center;
    color: #8c8c8c;
    line-height: 35px;
    font-family: 'microsoft yahei';
  }


  /* cart-nothing end */

</style>
