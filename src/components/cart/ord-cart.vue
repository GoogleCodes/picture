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
      <el-table :data="setCart" border tooltip-effect="dark"style="width: 100%" @selection-change="selected">
        <el-table-column type="selection" width="99"></el-table-column>
        <el-table-column label="商品名称" width="407">
          <template scope="scope">
            <router-link :to="{ path: '/pages/detail' , query:{ id:scope.row.id }}" class="block">
              <div class="item-pic fl">
                <img :src="scope.row.goods.img" alt="" style="width: 100%;height: 100%;" />
              </div>
              <p class="ft-18 shoping-name fl">{{ scope.row.goods.descript }}</p>
              <!--<p class="ft-14 shoping-desc fl" style="color: #898989;">{{ scope.row.desc }}</p>-->
            </router-link>
          </template>
        </el-table-column>
        <el-table-column label="单价" width="210" prop="price">
        </el-table-column>
        <el-table-column label="数量" width="250">
          <template scope="scope">
            <div class="item-amount">
              <!--<el-button class="no-minus fl" @click="del(scope.row)">-</el-button>-->
              <!--<el-input v-model="scope.row.number" class="fl" placeholder="0" @change="handleInput(scope.row)"></el-input>-->
              <!--<el-button class="add-max fl" @click="add(scope.row)" style="margin-left: 20px;">+</el-button>-->

              <el-button class="no-minus fl" slot="prepend" @click="changeNumber(scope.row, -1)">-</el-button>
              <el-input v-model="scope.row.number" class="fl" placeholder="0" @change="handleInput(scope.row)"></el-input>
              <el-button class="add-max fl" slot="append" @click="changeNumber(scope.row, 1)" style="margin-left: 20px;">+</el-button>

            </div>
          </template>
        </el-table-column>
        <el-table-column label="小计" width="143" prop="goodTotal"></el-table-column>
        <el-table-column label="操作">
          <template scope="scope">
            <el-button type="danger" icon="delete" @click="handleDelete(scope.$index, scope.row)"></el-button>
          </template>
        </el-table-column>
      </el-table>
      <br>

      <div class="bar-wrapper w100">
        <p class="shoping-desc ft-18 fl">继续购物共{{ count }}件商品，已选择{{ isChonseShop }}件</p>
        <div class="fr">
          <el-button class="fr">去结算</el-button>
          <p class="ft-20 fr selectedItem">合计(不含运费)：{{ moneyTotal }}元</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        tableData: [],
        moneyTotal:0,
        isChonseShop: 0,
        list: [],
        multipleSelection:[],
      }
    },
    computed: {
      setCart() {
        return this.$store.state.setCart;
      },
      count() { //  购物车总数
        return this.$store.state.cart_count;
      },
    },
    created() {
      console.log(this.$store.state.setCart);
    },
    methods: {
      handleDelete(index) {
        this.$confirm('确定删除该商品？', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          //删除数组中指定的元素
          this.tableData.splice(index,1);
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
      handleInput(value) {
        if(null==value.number || value.number=="") {
          value.number = 1;
        }
        value.goodTotal = (value.number * value.price).toFixed(2);//保留两位小数
        //  增加商品数量也需要重新计算商品总价
//        this.selected(this.multipleSelection);
      },
      changeNumber(item,flag) {
        if (flag > 0) {
          this.$store.commit('INCRECARTNUMS',item.id, item.number);
        } else {
          this.$store.commit('REDUCECARTNUMS',item.id, item.number);
          if(item.number <= 1) {
            item.number = 1;
          }
        }
        this.selected(this.multipleSelection);
      },
      add(addGood) {
        //输入框输入值变化时会变为字符串格式返回到js
        //此处要用v-model，实现双向数据绑定
        if(typeof addGood.number === 'string') {
          addGood.number = parseInt(addGood.number);
        }
        addGood.number += 1;
      },
      del(delGood) {
        if(typeof delGood.number === 'string') {
          delGood.number = parseInt(delGood.number);
        }
        if(delGood.number > 1 ) {
          delGood.number -= 1;
        }
      },
      //返回的参数为选中行对应的对象
      selected (selection) {
        this.isChonseShop = selection.length;
        this.multipleSelection = selection;
        this.moneyTotal = 0;
        //此处不支持forEach循环，只能用原始方法了
        for(var i in selection) {
          //判断返回的值是否是字符串
          if(typeof selection[i].goodTotal == 'string'){
            selection[i].goodTotal = parseInt(selection[i].goodTotal);
          };
          this.moneyTotal += selection[i].goodTotal;
        }
      },

    },
  }
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

  .el-table_1_column_8 {
    width: 407px;
  }
  .cell .item-pic {
    width: 130px;
    height: 97px;
  }
  tbody .el-table__row .el-table_1_column_5 .cell {
    font-size: 26px;
    font-weight: bold;
  }
  /* element table end */
</style>

