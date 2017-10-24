<template>
  <div class="shop-search">
      <div class="ban-picture">
        <img src="../../../static/images/51.png" alt="" class="w100 h100">
      </div>
      <div class="search-form">
        <div class="">
          <el-input placeholder="输入产品名称进行搜索" icon="search" v-model="searchinput" :on-icon-click="handleIconClick">
          </el-input>
          <el-button style="display: none;"></el-button>
        </div>
      </div>
      <ul>
        <li class="fl" v-for="item in 4">
          <div class="pic">
            <img src="../../../static/images/52.png" class="w100 h100" alt="">
          </div>
          <div class="paint-desc">
            <span class="c_868989">#北欧风格装饰画</span>
          </div>
          <div class="paint-money">
            <span class="fl c_e64147 ft-20 cash">¥39.80</span>
            <span class="fr iconfont icon-shoppingcar-ac c_868989 block" @click="getCartGo()"></span>
          </div>
        </li>
      </ul>
      <el-button class="more">查看更多...</el-button>
  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
    export default {
      components: {ElButton}, data() {
            return {
                searchinput: ''
            }
        },
        created() {

        },
        methods: {
          handleIconClick() {

          },
          getCartGo() {
            this.$message({
              type: 'success',
              message: '加入购物车成功!'
            });
          },
        },
    }
</script>

<style type="text/css">
    /* search-form start */
    .shop-search {
      margin-top: 46px;
      background: #fff;
      overflow: hidden;
      padding-bottom: 80px;
    }
    .shop-search ul {
      width: 100%;
      height: 100%;
      overflow: hidden;
      margin-bottom: 35px;
    }
    .shop-search ul li {
      padding: 10px 0px 0px 10px;
      width: 45%;
    }
    .shop-search ul li:nth-child(2n) {
      padding: 10px 0px 0px 10px;
    }
    .shop-search ul li .paint-desc {
      height: 35px;
      line-height: 35px;
      width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .shop-search ul li .icon-shoppingcar-ac {
      font-size: 32px;
    }
    .shop-search ul li .paint-money {
      height: 30px;
      line-height: 30px;
    }
    .paint-money .cash {
      font-weight: bold;
    }
    .shop-search .el-button {
      margin: 0px auto;
      display: block;
      border: none;
    }
    .search-form {
      padding: 20px 10px 0px;
    }
    /* search-form end */
</style>

<style>
  /*.el-input__icon {*/
    /*width: 65px;*/
    /*background: #c40000;*/
    /*color: #fff;*/
    /*border-radius: 0px 5px 5px 0px;*/
  /*}*/
</style>
