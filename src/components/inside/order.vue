<template>
  <div>
    <elenav></elenav>
    <div class="con-pro" style="height: 360px;">
      <img src="../../assets/images/19.png" alt="" style="width: 100%;height: 100%;">
    </div>
    <div class="advertising">
      <img src="../../../static/images/32.png" class="w100 h100" alt="">
    </div>
    <div class="filter-con">
      <div class="filter-nav">
        <span class="fl">筛选条件 ：</span>
        <div class="fl classif">
          <el-dropdown>
            <span class="el-dropdown-link">
              分类<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>黄金糕</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
        <div class="fl classif">
          <el-dropdown>
            <span class="el-dropdown-link">
              分类<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>黄金糕</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
        <div class="fl classif">
          <el-dropdown>
            <span class="el-dropdown-link">
              封面<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>黄金糕</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
        <div class="fl classif">
          <el-dropdown>
            <span class="el-dropdown-link">
              尺寸<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>1m</el-dropdown-item>
              <el-dropdown-item>2m</el-dropdown-item>
              <el-dropdown-item>3m</el-dropdown-item>
              <el-dropdown-item>4m</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
        <div class="fl classif">
          <el-dropdown>
            <span class="el-dropdown-link">
              装帧<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>黄金糕</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>

        <div class="fr search">
          <!-- :on-icon-click="handleIconClick" -->
          <el-input placeholder="输入产品名称进行搜索" icon="search" class="fl" ></el-input>
          <el-button class="gosearch fl">搜索</el-button>
        </div>

      </div>
    </div>

    <div class="shoping-list">
      <ul>
        <template v-for="item in data.list">
          <li class="fl">
            <router-link :to="{ path: '/pages/detail'}">
              <div class="shop-body">
                <div class="pic-img">
                  <img :src="item.pic" alt="" class="w100 h100">
                </div>
                <div class="item-wrap">
                  <p class="ft-18">{{ item.title }}</p>
                  <span class="block item-desc">{{ item.desc }}</span>
                  <p class="item-money ft-18">
                    <i>￥</i>
                    <span>36.00</span>
                  </p>
                </div>
              </div>
            </router-link>
          </li>
        </template>

      </ul>
      <a href="javascript:void(0);" class="block clear shoping-move">
        <span class="block" style="position: relative;top: 5px;">展开全部</span>
        <i class="block el-icon-arrow-down" style="position: relative;top: -1px;"></i>
      </a>
    </div>

    <div class="utils-con">
      <div class="util-bg">
        <ul>
          <li class="fl block">
            <p class="icons book"></p>
            <p>人工制作，独具匠心，细节体现品质。</p>
          </li>
          <li class="fl block">
            <p class="icons pen"></p>
            <p>人工制作，独具匠心，细节体现品质。</p>
          </li>
          <li class="fl block">
            <p class="icons gift"></p>
            <p>人工制作，独具匠心，细节体现品质。</p>
          </li>
        </ul>
      </div>
    </div>

    <div class="gift-con clear">
      <h1 class="ft-34 gift-title">相册礼盒</h1>
      <p class="gift-desc ft-14">一个精美的相册礼盒，能让产品更有价值感，提升档次和客户的满意度</p>
      <ul>
        <li class="fl" v-for="list in 3">
          <div class="gift-sp-pic">
            <img src="../../../static/images/30.png" alt="" class="w100 h100" />
          </div>
          <div class="gift-sp-desc ft-18">相册礼盒名称</div>
        </li>
      </ul>
    </div>

    <div class="dingzhi clear">
      <router-link :to="{ path: ''}">
        <img src="../../../static/images/31.png" class="w100 h100" alt="">
      </router-link>
    </div>

  </div>
</template>

<script type="text/javascript">

  import elenav from '@/components/top/Nav.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    data () {
      return {
        data: {
          list: []
        }
      }
    },
    created() {
      this.getOrder();
    },
    components: {
      ElButton,
      elenav,
    },
    methods: {
      getOrder() {
        this.$http.get('../../../static/data/index.json').then((res) => {
          this.data.list = res.data.tuijian;
        });
      }
    }
  }
</script>

<style type="text/css">
  /* filter con end */
  .filter-con {
    width: 100%;
    height: 81px;
    border-bottom: 1px solid #efefef;
  }

  .filter-con .filter-nav {
    width: 1200px;
    height: 100%;
    line-height: 81px;
    margin: 0px auto;
  }

  .filter-nav .classif {
    margin-left: 80px;
  }

  .filter-nav .search {
    width: 320px;
  }

  .filter-nav .search .el-input {
    width: 200px;
  }

  .search .el-input .el-input__inner {
    border-right: none;
    border-radius: 5px 0px 0px 5px;
  }

  .filter-nav .search .el-button {
    margin: 23px 0px;
    border-left: none;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    width: 80px;
    border-radius: 0px 5px 5px 0px;
  }
  /* filter con start */

  /* shoping-list start */
  .shoping-list {
    width: 1200px;
    height: 100%;
    margin: 47px auto;
  }

  .shoping-list ul li .shop-body {
    width: 270px;
    height: 315px;
    text-align: center;
    background: #fff;
    transition: 0.5s;
  }

  .shoping-list ul li {
    margin: 0px 30px 30px 0px;
  }

  shoping-list ul li:nth-of-type(4n) {
    margin: 0px;
  }

  .shoping-list ul li .shop-body:hover{
    box-shadow: 2px 2px 20px #ccc;
    cursor: pointer;
    transition: 0.5s;
  }

  .shoping-list ul li .shop-body .pic-img {
    width: 200px;
    height: 200px;
    padding: 22px 35px 10px;
  }

  .shop-body .item-wrap .item-desc {
    color: #898989;
  }

  .shop-body .item-wrap .item-money {
    color: #b11e25;
    font-weight: bold;
  }

  /* shoping-list end */

  /* shoping-move start */
  .shoping-move {
    width: 167px;
    height: 40px;
    border: 1px solid #333;
    text-align: center;
    line-height: 21px;
    background: #fff;
    margin: 30px auto;
    color: #727171;
  }
  /* shoping-move end */

  /* utils-con start */
  .utils-con {
    position: relative;
    top: 100px;
    width: 100%;
    height: 236px;
    background: #f7f8f8;
    clear: both;
    overflow: hidden;
  }

  .utils-con .util-bg {
    width: 865px;
    height: 100%;
    margin: 0px auto;
  }

  .utils-con ul li {
    width: 158px;
    height: 158px;
    margin: 45px 65px;
    text-align: center;
  }

  .utils-con ul li .icons {
    width: 64px;
    height: 56px;
    margin: 20px 46px;
    background: url('../../../static/images/29.png') no-repeat top center;
  }

  .utils-con ul li .book {
    background-position: -126px 0px;
  }

  .utils-con ul li .pen {
    background-position: -53px 0px;
  }

  .utils-con ul li .gift {
    background-position: 6px 0px;
  }

  /* utils-con end */

  /* gift-con start */
  .gift-con {
    width: 1200px;
    height: 596px;
    margin: 125px auto 0;
  }

  .gift-con .gift-title, .gift-desc {
    text-align: center;
    line-height: 45px;
  }

  .gift-con .gift-title {
    padding-top: 56px;
  }

  .gift-con .gift-desc {
    color: #9fa0a0
  }

  .gift-con ul li {
    width: 376px;
    height: 300px;
    text-align: center;
    margin: 56px 24px 0px 0;
  }

  .gift-con ul li .gift-sp-pic {
    width: 376px;
    height: 260px;
  }

  .gift-con ul li .gift-sp-desc {
    width: 130px;
    height: 35px;
    margin: 35px auto;
    border-bottom: 1px solid #c9caca;
  }

  .gift-con ul li:last-child {
    margin: 56px 0 0 0;
  }

  /* gift-con end */

  /* dingzhi start */
  .dingzhi {
    width: 100%;
    height: 400px;
  }
  /* dingzhi end */

</style>
