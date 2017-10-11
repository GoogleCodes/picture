<template>
  <div class="bgcolor">
    <!--<div style="margin: 15px 0;"></div>-->


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
        <el-table ref="multipleTable"  :data="data.list" border tooltip-effect="dark" style="width: 100%" @selection-change="selected">
          <el-table-column type="selection" width="99"></el-table-column>
          <el-table-column label="商品名称" width="407">
            <template scope="scope">
              <router-link :to="{ path: '/pages/detail'}" class="block">
                <div class="item-pic fl">
                  <img :src="scope.row.shotcut" alt="" style="width: 100%;height: 100%;" />
                </div>
                <p class="ft-18 shoping-name fl">{{ scope.row.title }}</p>
                <p class="ft-14 shoping-desc fl" style="color: #898989;">{{ scope.row.desc }}</p>
              </router-link>
            </template>
          </el-table-column>
          <el-table-column prop="price" label="单价" width="210">
            <template scope="scope">
              <div class="ft-24" style="color: #b5b5b6">  {{ scope.row.price | changePrice }}</div>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="数量" width="250">
            <template scope="scope">
              <div class="item-amount ">
                <el-button class="no-minus fl" @click="changeNumber(scope.row, -1)"
                           :class="{'disabled':scope.row.nums <= 1}">-</el-button>
                <el-input class="fl" placeholder="0" @change="handleInput(scope.row)" readonly
                          v-model="scope.row.nums"></el-input>
                <el-button class="add-max fl" @click="changeNumber(scope.row, 1)"
                           :class="{'disabled':scope.row.nums >= 1}" style="margin-left: 20px;">+</el-button>
              </div>
            </template>
          </el-table-column>
          <el-table-column label="总价" width="143">
            <template scope="scope">
              <p class="ft-24 totalprice">{{ scope.row.price * scope.row.nums | changePrice }}</p>
              <el-button @click="goLoad()">上传图片</el-button>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="操作" show-overflow-tooltip width="88">
            <template scope="scope">
              <el-button type="primary" icon="delete" @click="deleteShop(scope.row)"></el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>
      <div class="bar-wrapper w100">
        <p class="shoping-desc ft-18 fl">继续购物 共1件商品，已选择1件</p>
        <div class="fr">
          <el-button class="fr" @click="goPay()">去结算</el-button>
          <p class="ft-20 fr selectedItem">合计(不含运费)：{{ data.totalMoney | changePrice }}元</p>
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
          data: {
            list: [],
            total: 0, //  总价
            totalMoney: 0,  //  总金额
          },
          multipleSelection:[],
          //  删除的索引
          delIndex: null
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
      this.data.list = JSON.parse(localStorage.getItem('cart_info'));
//      this.$http.get('../../../static/data/cart.json').then((res) => {
//        this.data.list = res.data;
//      });

    },
    computed: {
      list() {
        return this.$store.state.list;
      },
    },
    watch: {
        $route (to) {
          this.data.list = JSON.parse(localStorage.getItem('cart_info'));
        }
    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice:function(value){
        return "￥"+value.toFixed(2);
      }
    },
    methods: {
      //  取消全选
      toggleSelection() {
        this.$refs.multipleTable.clearSelection();
        this.data.totalMoney = 0;
      },
      //  返回的参数为选中行对应的对象
      selected (selection) {
        this.multipleSelection = selection;
        this.data.totalMoney = 0;
        for(var i = 0; i < selection.length; i++) {
          //  判断返回的值是否是字符串
          if(typeof selection[i].nums == 'string') {
            selection[i].nums = parseInt(selection[i].nums);
          };
          this.data.totalMoney += selection[i].nums * selection[i].price;
        }
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
        this.selected(this.multipleSelection);
      },
      //  去结算
      goPay () {
        this.$router.push({ path: '/cart/submit' });
      },
      handleInput(value) {
        value.price * value.nums
        //  增加商品数量也需要重新计算商品总价
        this.selected(this.multipleSelection);
      },
      //  删除商品
      deleteShop(item) {
        this.$confirm('确定要删除这件商品吗?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          let pid = 0;
          for (var i in this.data.list) {
            pid = this.data.list[i].id;
          }
          this.$store.commit('DELCARTOBJ',pid);
          setTimeout(() => {
            location.reload();
          }, 500);
          this.$message({
            type: 'success',
            message: '删除成功!'
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          });
        });
      },
    }
  };
</script>

<style type="text/css">

  @import "../../../static/css/cart.css";

  .cart-body {
    width: 1200px;
    margin: 0px auto;
    position: relative;
    top: 45px;
  }

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

  .el-table__row .cell .totalprice {
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

  .cell .shoping-name, .cell .shoping-desc {
    /*margin: 20px 0 0 0;*/
    text-indent: 1em;
    width: 64%;
    line-height: 35px;
    text-align: left;
    text-overflow: ellipsis;
    overflow: hidden;
  }
  .cell .shoping-desc {
    text-indent: 1.3em;
    line-height: 21px;
    height: 62px;
    text-align: left;
    word-break: break-all;
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
    width: 30%;
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

  /* element table start */
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
  /* element table end */
</style>
