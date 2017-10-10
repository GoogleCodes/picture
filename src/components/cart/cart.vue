<template>
  <div class="bgcolor">
    <div style="margin: 15px 0;"></div>
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
        <el-table :data="data.list" border tooltip-effect="dark" style="width: 100%" >
          <el-table-column type="selection" width="99"></el-table-column>
          <el-table-column label="商品名称" width="407">
            <template scope="scope">
              <router-link :to="{ path: '/pages/detail'}" class="block">
                <div class="item-pic fl">
                  <img :src="scope.row.shotcut" alt="" style="width: 100%;height: 100%;" />
                </div>
                <p class="ft-18 shoping-name">
                  <router-link :to="{ path: '/cart/cart'}">{{ scope.row.name }}</router-link>
                </p>
                <p class="ft-14 shoping-desc" style="color: #898989;">{{ scope.row.format }}</p>
              </router-link>
            </template>
          </el-table-column>
          <el-table-column prop="price" label="单价" width="210">
            <template scope="scope">
              <div class="ft-24" style="color: #b5b5b6">{{ scope.row.price }}</div>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="数量" width="250">
            <template scope="scope">
              <div class="item-amount ">
                <el-button class="no-minus fl"
                           @click="changeNumber(scope.row, -1)"
                           :class="{'disabled':scope.row.nums <= 1}">-</el-button>
                <el-input type="text"
                          class="fl" placeholder="0"
                          v-model="scope.row.nums"></el-input>
                <el-button class="add-max fl"
                           @click="changeNumber(scope.row, 1)"
                           :class="{'disabled':scope.row.nums >= 1}"
                           style="margin-left: 20px;">+</el-button>
              </div>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="总价" show-overflow-tooltip width="143">
            <template scope="scope">
              <p class="ft-24 totalprice">{{ scope.row.price * scope.row.nums | changePrice }}</p>
              <el-button @click="goLoad()">上传图片</el-button>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="操作" show-overflow-tooltip width="88">
            <template scope="scope">
              <el-button type="primary" icon="delete"></el-button>
            </template>
          </el-table-column>
        </el-table>

        <table class="table-body">
          <thead class="thead">
            <tr class="ul">
              <td class="li all-chonse">
                <!--<i class="iconfont success icon-checked-fill" @click="changAll(0)" v-show="showVal"></i>-->
                <!--<i class="iconfont circle icon-quxiaoquanxuan" @click="changAll(1)" v-show="!showVal"></i>-->
                <el-checkbox v-model="data.checkAll">全选</el-checkbox>
              </td>
              <td class="li shoping">商品名称</td>
              <td class="li unitprice">单价</td>
              <td class="li number">数量</td>
              <td class="li totalprice">总价</td>
              <td class="li operating">操作</td>
            </tr>
          </thead>
          <tbody class="tbody">
            <template v-for="(item, index) in data.list">
              <tr class="ul">
                <td class="li radio">
                  <el-checkbox style="margin-right: 13px;"></el-checkbox>
                  <!--<i class="iconfont success icon-checked-fill"></i>-->
                  <!--<i class="iconfont circle icon-quxiaoquanxuan"></i>-->
                </td>
                <td class="li">
                  <div class="item-pic fl">
                    <img :src="item.shotcut" alt="" style="width: 100%;height: 100%;" />
                  </div>
                  <p class="ft-18 shoping-name">
                    <router-link :to="{ path: '/cart/cart'}">{{ item.name }}</router-link>
                  </p>
                  <p class="ft-14 shoping-desc" style="color: #898989;">{{ item.format }}</p>
                </td>
                <td class="li unitprice ft-24" style="color: #b5b5b6;">￥{{ item.price }}</td>
                <td class="li number">
                  <div class="item-amount ">
                    <el-button class="no-minus fl" @click="changeNumber(item, -1)" :class="{'disabled':item.nums <= 1}">-</el-button>
                    <el-input type="text" class="fl" placeholder="0" v-model="item.nums"></el-input>
                    <el-button class="add-max fl" @click="changeNumber(item, 1)" :class="{'disabled':item.nums >= 1}">+</el-button>
                  </div>
                </td>
                <td class="li totalprice ft-24" style="color: #e64147">
                  <p>{{ item.price * item.nums | changePrice }}</p>
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

  import cartlist from '@/components/cart/cart-list.vue'

  import ElRadio from "../../../node_modules/element-ui/packages/radio/src/radio";
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElCheckbox from "../../../node_modules/element-ui/packages/checkbox/src/checkbox";
  import ElCheckboxGroup from "../../../node_modules/element-ui/packages/checkbox/src/checkbox-group";

  const cityOptions = ['上海'];
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
            list: [],
            chosen: [],
          },
        }
    },
    components: {
      ElCheckboxGroup,
      ElCheckbox,
      ElInput,
      ElButton,
      ElRadio,
      cartlist,
    },
    created() {
      //  调用Vuex action
      this.$store.dispatch("init");

      this.$http.get('../../../static/data/cart.json').then((res) => {
        console.log(res.data);
        this.data.list = res.data;
      });

    },
    computed: {
      list() {
        return this.$store.state.list;
      },
      className: function(){
        const obj = {};
        if(this.data.chosen.length > 0) {
          for(let ch = 0;ch < this.data.chosen.length; ch++) {
            if(this.data.chosen[ch].id == this.pid && this.data.chosen[ch].format == this.pformat) {
              obj['active'] = true;
              break;
            } else {
              obj['active'] = false;
            }
          }
        } else {
          obj['active'] = false;
        }
        return obj;
      },
      showVal: function(){
        if(this.className.active){
          return true;
        }else{
          return false;
        }
      }
    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice:function(value){
        // toFixed(2)：保留两位小数(引用老师原句：该数值应为后端处理传过来的数据，前端进行计算容易丢失精度)
        return "￥"+value.toFixed(2);
      }
    },
    methods: {
      changAll(type) {

      },
      goLoad () {
          this.$router.push({ path : '../pages/onload'});
      },
      changeNumber(item,flag) {
        //  大于0为加
        if (flag > 0) {
          //  item数量自增1
          item.nums++;
        } else {
          //  item数量自减1
          item.nums--;
          if(item.nums <= 1) {
            item.nums = 1;
          }
        }
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
    display: none;
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

  .el-tooltip .totalprice {
    width: 107px;
    margin-bottom:10px;
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

  .tbody .ul .li .icon-checked-fill, .icon-quxiaoquanxuan ,
  .thead .ul .li .icon-checked-fill {
    font-size: 24px;
    color: #f40;
    cursor: pointer;
  }

  .tbody .ul .li .icon-quxiaoquanxuan , .thead .ul .li .icon-quxiaoquanxuan {
    color: #333;
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

  .item-amount .el-input {
    width: 75px;
  }

  .item-amount .el-input__inner {
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

  .el-table thead tr {
    height: 80px;
  }

  .el-table th {
    background: #fff;
  }

  .el-table__footer-wrapper thead div,
  .el-table__header-wrapper thead div {
    background: #fff;
  }

  .el-table--border td, .el-table--border th {
    border: none;
    border-bottom: 1px solid #dfe6ec;
  }

  .el-table--enable-row-transition .el-table__body td {
    height: 160px;
  }

  .el-table--border td, .el-table--border th {
    text-align: center;
  }

  .el-table .el-table_1_column_2 .cell {
    width: 407px;
  }

  .el-table__row .el-table_1_column_2 .cell {
    width: 407px;
  }
  .el-table_1_column_8 {
    width: 407px;
  }
  .cell .item-pic {
    width: 130px;
    height: 97px;
  }
  /* cart-body end */
</style>
