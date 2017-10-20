<template>
  <div>
    <div class="item-pic fl">
      <img src="https://avatars3.githubusercontent.com/u/23470846?v=4&s=460" alt="" style="width: 100%;height: 100%;" />
    </div>
    <p class="ft-18 shoping-name">
      <router-link :to="{ path: '/cart/cart'}">aaaa</router-link>
    </p>
    <p class="ft-14 shoping-desc" style="color: #898989;">abbaba</p>
  </div>

</template>


<style type="text/css">

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
</style>
