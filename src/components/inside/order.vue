<template>
  <div>
    <elenav></elenav>
    <div class="con-pro" style="height: 360px;" v-loading="load_data" element-loading-text="正在加载中...">
      <template v-for="(k,i) in data.shotcut">
        <img :src="k.shotcut" alt="" style="width: 100%;height: 100%;">
      </template>
    </div>
    <div class="customized">
      <div class="customized-main">
        <div class="customized-title">
          <p class="customized-h1">相册定制</p>
          <span class="customized-h2">CUSTOMIZED</span>
        </div>
        <div class="customized-desc ft-16">
          一向以独特的设计，将东西方设计匠心巧妙联姻，轻奢与温馨交融，各种高档材质的混搭工艺，紧靠时代前沿。
        </div>
      </div>
    </div>
    <div class="filter-con">
      <div class="filter-nav">
        <span class="fl">筛选条件 ：</span>
        <template v-for="(item, index) in specif">
          <div class="fl classif">
            <el-dropdown @command="handleCommand">
              <span class="el-dropdown-link">
                <i>{{ item.spec_name }}</i>
                <i class="el-icon-caret-bottom el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <template v-for="(warp, index) in item.children">
                  <el-dropdown-item :command="warp">{{ warp.type_id }}{{ warp.item }}</el-dropdown-item>
                </template>
              </el-dropdown-menu>
            </el-dropdown>
          </div>
        </template>
        <div class="fr search">
          <el-input placeholder="输入产品名称进行搜索" v-model="searchText"
          icon="search" class="fl" :on-icon-click="handleIconClick" @keyup.enter.native="handleIconClick"></el-input>
        </div>
      </div>
    </div>

    <div class="shoping-list">
      <template v-if="data.list == 0">
        <div class="data-kong">
          <i class="iconfont icon-kong"></i>
          <p>小二去采购了！</p>
        </div>
      </template>
      <ul class="w100 h100 block" style="overflow: hidden" v-else v-loading="load_data" element-loading-text="正在加载中...">
        <template v-for="item in data.list">
          <li class="fl">
            <router-link :to="{ path: '/pages/detail/' + item.goods_id}">
              <div class="shop-body">
                <div class="pic-img">
                  <template v-for="(x,i) in item.goods_thumb">
                    <img :src="x.url" alt="" class="w100 h100">
                  </template>
                </div>
                <div class="item-wrap">
                  <p class="ft-16 wrap-title">{{ item.goods_name }}</p>
                  <span class="block item-desc">{{ item.desc }}</span>
                  <p class="item-money ft-18">
                    <i>¥</i>
                    <span>{{ item.shop_price }}</span>
                  </p>
                </div>
              </div>
            </router-link>
          </li>
        </template>

      </ul>
      <a class="block clear shoping-move" @click="AllShowShop()" v-show="shopAll">
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

    <template v-if="randomList == 0"></template>
    <div class="gift-con clear" v-else>
      <h1 class="ft-34 gift-title">相册礼盒</h1>
      <p class="gift-desc ft-14">一个精美的相册礼盒，能让产品更有价值感，提升档次和客户的满意度</p>
      <ul>
        <template v-for="(k,x) in randomList">
          <li class="fl">
            <router-link :to="{ path: '/inside/orderlist', query: {id: k.goods_id} }" class="w100 h100 block">
              <div class="gift-sp-pic">
                <template v-for="(a,b) in k.goods_thumb">
                  <img :src="a.url" alt="" class="w100 h100" />
                </template>
              </div>
              <div class="gift-sp-desc ft-18">{{ k.goods_name }}</div>
            </router-link>
          </li>
        </template>
      </ul>
    </div>
  </div>
</template>

<script type="text/javascript">

  import elenav from '@/components/top/Nav.vue'
  import { Dropdown, DropdownMenu, DropdownItem } from 'element-ui'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    data () {
      return {
        data: {
          list: [],
          listPages: {},
          shotcut: [],
        },
        shopAll: true,
        randomList: [],
        //  规格
        specif: [],
        currentPage: 5,
        load_data: false,
        searchText: '',
      }
    },
    mounted() {
      this.getOrder();
    },
    watch: {
      '$route'() {
        this.getOrder();
      }
    },
    components: {
      ElButton,
      elenav,
      ElDropdown: Dropdown,
      ElDropdownMenu: DropdownMenu,
      ElDropdownItem: DropdownItem
    },
    computed: {
      showPages () {
        if(this.data.list.length == 0) {
          return false;
        } else {
          return true;
        }
      }
    },
    methods: {
      handleIconClick() {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER +
        "?cid=" + this.$route.query.id + "&keyword=" + this.searchText).then((res) => {
          this.data.list = res.data;
          this.load_data = false;
          this.shopAll = false;
        });
      },
      handleCommand(command) {
        this.load_data = true;
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER  + "?cid=" + this.$route.query.id + "&spec=" + command.id).then((res) => {
          this.data.list = res.data;
          if (this.data.list.length == 0) {
            this.$message({
              message: '暂时还没有产品',
              type: 'warning'
            });
          }
          this.load_data = false;
        });
      },
      //  获取规格
      getSpecif() {
        this.$ajax.HttpGet(this.$api.get_content.GET_SPECIF).then((res) => {
          this.specif = res.data;
        });
      },
      getOrder() {
        this.load_data = true;
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?cid="+ this.$route.query.id +"&limit=" + 4).then((res) => {
          this.load_data = false;
          this.data.list = res.data;
          this.data.listPages = res.data;
          if (res.data.length == 0) {
            this.shopAll = false;
          }
          this.$ajax.HttpGet('/api/home/front/PrdClassifyById?id=' + this.$route.query.id).then((res) => {
            this.data.shotcut = res.data;
          });
          this.getRadomList(this.$route.query.id, 4);
          this.getSpecif();
        });
      },
      getRadomList(id, number) {
        this.$ajax.HttpGet(this.$api.get_other.GET_OTHER + "?cid=" + id + "&limit=" + number).then((res) => {
          this.randomList = res.data;
        });
      },
      AllShowShop() {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER).then((res) => {
          this.load_data = false;
          this.data.list = res.data;
          this.data.listPages = res.data;
          this.$ajax.HttpGet('/api/home/front/PrdClassifyById?id=' + this.$route.query.id).then((res) => {
            this.data.shotcut = res.data;
          });
          this.getRadomList(this.$route.query.id, 4);
          this.getSpecif();
        });
        this.shopAll = false;
      }
    }
  }
</script>

<style type="text/css">

  /* customized start */
  .customized {
    background: #fcf9f5;
    height: 148px;
  }

  .customized .customized-main {
    width: 1200px;
    margin: 0px auto;
    position: relative;
  }

  .customized .customized-main .customized-title {
    line-height: 30px;
    padding-top: 54px;
  }

  .customized .customized-main .customized-desc {
    text-align: center;
    width: 512px;
    margin: 0px auto;
    position: absolute;
    top: 50px;
    left: 0px;
    right: 0px;
    color: #333;
    font-weight: bold;
  }

  .customized-main .customized-title .customized-h1 {
    font-size: 32px;
    font-weight: bold;
  }

  .customized-main .customized-title .customized-h2 {
    font-size: 16px;
    color: #9fa0a0;
  }

  /* customized end */

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
    width: 320px;
  }

  .filter-nav .search .el-input .el-input__icon {
    cursor: pointer;
  }

  .search .el-input .el-input__inner {
    // border-right: none;
    // border-radius: 5px 0px 0px 5px;
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

  .shoping-list .data-kong {
    text-align: center;
    margin-top: 150px;
    color: #9d9e9e;
  }

  .shoping-list .data-kong p {
    margin-top: 40px;
    font-size: 25px;
    font-weight: bold;
  }

  .shoping-list .data-kong .icon-kong {
    font-size: 150px;
  }

  .shoping-list ul li .shop-body {
    width: 270px;
    height: 315px;
    text-align: center;
    background: #fff;
    transition: 0.5s;
    border: 1px solid #f2f2f2;
  }

  .shoping-list ul li {
    margin: 0px 37px 30px 0px;
  }

  .shoping-list ul li:nth-child(4n) {
    margin: 0 0 30px 0;
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

  .shop-body .item-wrap .wrap-title {
    padding: 0px 14px;
    height: 45px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .shop-body .item-wrap .item-desc {
    color: #898989;
  }

  .shop-body .item-wrap .item-money {
    color: #b11e25;
    margin-top: 5px;
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
    cursor: pointer;
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
    height: 100%;
    text-align: center;
    border-bottom: 1px solid #c9caca;
    margin: 56px 24px 0px 0;
    padding-bottom: 10px;
  }

  .gift-con ul li .gift-sp-pic {
    width: 376px;
    height: 260px;
  }

  .gift-con ul li .gift-sp-desc {
    line-height: 25px;
    margin: 15px 0px 0px;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
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

  /* goToPages start */
  .goToPages {
    width: 1200px;
    padding-top: 30px;
    margin: 0px auto;
  }
  /* goToPages end */
</style>
