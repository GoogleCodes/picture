<template>
  <div class="proseries">
    <template v-for="item in 5">
      <div class="matop_10" style="height: 100%;overflow: hidden;">
        <div class="pro-pic">
          <img src="../../../static/images/43.png" alt="" class="w100 h100" >
        </div>
        <div class="pro-con">
          <div class="pro-desc fl">
            <p class="ft-16 pro-desc-title">金色古典MP14533-2B</p>
            <span class="ft-14 c_b3b3b3">高雅复古风格</span>
            <h1 class="moeny ft-18 c_e64147">￥39.80</h1>
          </div>
          <el-button class="fr">查看详情</el-button>
        </div>
      </div>
    </template>
    <el-button class="el-more">加载更多......</el-button>
  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    components: {ElButton}, data() {
          return {

          }
      },
    created(){

    },
    mounder (){

    },
    methods: {

    }
  }
</script>

<style type="text/css">
  /* proseries start */
  .proseries {
    margin: 10px 15px;
    padding-bottom: 60px;
  }

  .proseries .el-more {
    border: none;
    margin: 0px auto;
    display: block;
  }

  .proseries .pro-pic img {
    border-radius: 0px 10px 0px 10px;
    margin-bottom: 10px;
  }

  .proseries .pro-con {
    line-height: 25px;
  }

  .pro-desc .pro-desc-title {
    background: #f2f2f2;
  }

  .pro-desc .moeny {
    font-weight: bold;
  }

  .proseries .pro-con .el-button {
    margin-top: 20px;
    width: 95px;
    border: 1px solid #b11e25;
    color :#b11e25;
  }
  /* proseries end */
</style>
