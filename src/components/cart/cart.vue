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
      <div class="cart-content" v-loading="load_data" element-loading-text="正在加载中...">
        <el-table ref="multipleTable" :data="data.list" border tooltip-effect="dark" style="width: 100%" @selection-change="selected">
          <el-table-column type="selection" width="99"></el-table-column>
          <el-table-column label="商品名称" width="407">
            <template scope="scope">
              <div class="block">
                <div class="item-pic fl">
                  <template v-for="(x,i) in scope.row.goods_thumb">
                    <img :src="x.url" alt="" style="width: 100%;height: 100%;" />
                  </template>
                </div>
                <p class="ft-18 shoping-name fl">{{ scope.row.goods_remark }}</p>
                <p class="ft-14 shoping-desc fl" style="color: #898989;">详情信息</p>
              </div>
            </template>
          </el-table-column>
          <el-table-column prop="price" label="单价" width="210">
            <template scope="scope">
              <div class="ft-24" style="color: #b5b5b6">¥{{ scope.row.price }}</div>
            </template>
          </el-table-column>
          <el-table-column prop="address" label="数量" width="250">
            <template scope="scope">
              <div class="item-amount">
                <el-button slot="prepend" class="no-minus fl" @click="changeNumber(scope.row, -1)"
                           :class="{'disabled':scope.row.num <= 1}">-</el-button>
                <el-input type="text" class="fl" readonly
                          v-model="scope.row.num" placeholder="0"></el-input>
                <el-button  slot="append" class="add-max fl" @click="changeNumber(scope.row, 1)"
                           :class="{'disabled':scope.row.num >= 1}" style="margin-left: 20px;">+</el-button>
              </div>
            </template>
          </el-table-column>
          <el-table-column label="总价" width="143">
            <template scope="scope">
              <p class="ft-24 totalprice">{{ scope.row.price * scope.row.num }}</p>
              <el-button @click="goLoad(scope.row.id)">上传图片</el-button>
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
        <p class="shoping-desc ft-18 fl">继续购物 共{{ cart_number }}件商品，已选择{{ isChonseShop }}件</p>
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
            number: 0,
            total: 0,           //  总价
            totalMoney: 0,      //  总金额
          },
          multipleSelection:[],
          delIndex: null,       //  删除的索引
          isChonseShop: 0,
          userID: this.$goFetch.storageGet('user_info').user.id,
          load_data: false,
          cart_number: 0,
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
      
    },
    mounted() {
     this.fetchData();
    //  this.getByDataID();
    },
    computed: {
      count() { //  购物车总数
        return this.$store.state.cart_count;
      }
    },
    watch: {
        
    },
    // 定义过滤方法
    filters:{
      // 传入原始value然后返回处理后数据
      changePrice(value){
        return "￥" + value.toFixed(2);
      }
    },
    methods: {
      fetchData() {
        //  this.$postData this.$ajax.HttpPost
        this.load_data = true;
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
        {uid: this.userID}).then((res) => {
          this.cart_number = res.data.length;
          this.$store.commit('SET_CART_NUMBER', this.cart_number);
          this.load_data = false;
          this.data.list = res.data;
        });
      },
      getByDataID() {
        this.$postData(this.$api.get_content.GET_CART_TODATA,{
          id: 28, 
          uid: this.userID}).then((res) => {
            
        });
      },
      //  取消全选
      toggleSelection() {
        this.$refs.multipleTable.clearSelection();
        this.data.totalMoney = 0;
      },
      //  返回的参数为选中行对应的对象
      selected (selection) {
        this.isChonseShop = selection.length;
        this.multipleSelection = selection;
        this.data.totalMoney = 0;
        for(var i in selection) {
          //  判断返回的值是否是字符串
          if(typeof selection[i].num == 'string') {
            selection[i].num = parseInt(selection[i].num);
          }
          this.data.totalMoney += selection[i].num * selection[i].price;
        }
      },
      goLoad (id) {
        this.$router.push({ path : '../pages/onload', query: {id: id}});
      },
      changeNumber(item,flag) {
        let userid = this.$goFetch.storageGet('user_info').user.id;
        if (flag > 0) {
          item.num += 1;
          this.$ajax.HttpPost(this.$api.get_content.UPDATE_CART,{
            id: item.id,
            uid: userid,
            num: item.num, }).then((res) => {});
        } else {
          item.num -= 1;
          this.$ajax.HttpPost(this.$api.get_content.UPDATE_CART,{
            id: item.id,
            uid: userid,
            num: item.num, }).then((res) => {});
          if(item.num <= 1) {
            item.num = 1;
          }
        }
        this.selected(this.multipleSelection);
      },
      //  去结算
      goPay () {
        if (this.multipleSelection.length == 0) {
          this.$message({
            message: '请选择商品!',
            type: 'warning'
          });
          return;
        }
        this.$store.commit('SET_GO_PAY',this.multipleSelection);
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
          this.$postData(this.$api.get_content.DELETE_CART_DATA,{
            id: item.id,
            uid: this.userID}).then((res) => {});
          this.$message({
            type: 'success',
            message: '删除成功!'
          });
          setTimeout(() => {
            location.reload();
          }, 500);
        })
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
