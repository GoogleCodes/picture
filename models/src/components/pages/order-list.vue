<template>
  <div style="padding-bottom: 53px;margin-top: 56px;">
    <template v-for="item in 3">
      <div class="order-list">
        <div class="order-number fl w100">订单号 ：50681150656</div>
        <router-link :to="{ path: '/pages/pic-detail'}" class="block">
          <div class="order-msg fl">
            <div class="order-pic fl">
              <img src="../../../static/images/23.png" alt="" class="w100 h100">
            </div>
            <div class="wrap fl">

                <div class="wrap-title ft-16">#北欧风格装饰画 高格调 </div>
                <div class="wrap-desc clear c_898989">装饰你的新房子 </div>
                <div class="wrap-money">￥99.80</div>
            </div>
            <div class="status fr">
              <span>待付款</span>
            </div>
          </div>
        </router-link>
        <div class="warp-input clear">
          <el-button class="fr">立即付款</el-button>
          <el-button class="fr">取消订单</el-button>
          <el-button class="fr">确认收货</el-button>
        </div>
      </div>
    </template>
  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  export default {
      components: {
        ElButton

      },
      data() {
          return {

          }
      },
      created() {

      },
      mounted() {

      },
      methods: {

      }
  }
</script>

<style type="text/css">
  /* order-list start */
  .order-list {
    margin: 10px;
    background: #fff;
    overflow: hidden;
  }

  .order-list .order-number {
    color: #666;
    line-height: 35px;
    text-indent: 1em;
  }

  .order-list .order-msg {
    background: #f2f2f2;
    margin: 0px 10px 10px 10px;
  }

  .order-list .order-msg .wrap {
    width: 42%;
    margin: 4px 0px;
    padding-right: 0px;
  }

  .order-list .order-msg .status {
    margin: 27px 0px;
    text-align: center;
  }

  .order-list .order-msg .wrap .wrap-title {
    height: 23px;
    overflow: hidden;
    line-height: 21px;
    text-overflow: ellipsis;
  }

  .order-list .order-msg .wrap .wrap-desc {
    /*height: 30px;*/
    /*line-height: 30px;*/
  }

  .order-list .order-msg .order-pic {
    width: 35%;
    height: 100%;
    margin: 8px;
  }

  .order-list .warp-input {
    margin: 10px;
    overflow: hidden;
  }

  .order-list .warp-input .el-button {
    margin: 0 0px 5px 5px;
    overflow: hidden;
  }

  .el-button:focus, .el-button:hover {
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
  }


  @media screen and (max-width: 414px) {
    .order-list .order-msg .status {
      margin: 40px 5px 0px 0px;
      text-align: center;
    }

    .order-list .order-msg .wrap {
      width: 48%;
    }
  }

  @media screen and (max-width: 375px) {

    .order-list .order-msg .wrap {
      width: 45%;
    }

    .order-list .order-msg .status {
      margin: 35px 5px 0px 0px;
      text-align: center;
    }
  }


  @media screen and (max-width: 320px) {

    .order-list .order-msg .wrap {
      width: 42%;
    }

    .order-list .order-msg .status {
      margin: 27px 5px 0px 0px;
      text-align: center;
    }
  }

  /* order-list end */
</style>
