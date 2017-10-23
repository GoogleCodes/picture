<template>
  <div>
    <elenav></elenav>
    <div>
      <img src="../../../static/images/43.png" class="w100 h100" alt="">
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
                <div class="item-wrap matop_10">
                  <p class="ft-18">相册系列</p>
                  <span class="block item-desc">了解更多 &gt;</span>
                </div>
              </div>
            </router-link>
          </li>
        </template>
      </ul>
      <el-button class="shoping-move">加载更多...</el-button>
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

  /* shoping-list start */
  .shoping-list {
    width: 100%;
    height: 100%;
    padding: 15px 0 100px;
    background: #fff;
  }

  .shoping-list ul li {
    width: 45%;
    margin: 10px 8px;
  }

  shoping-list ul li:nth-child(2n) {
    margin: 10px 0px;
  }

  .shoping-list ul li .shop-body {
    width: 100%;
    height: 100%;
    text-align: center;
    background: #fff;
    transition: 0.5s;
  }

  .shoping-list ul li .shop-body .pic-img img {
    width: 100%;
    height: 100%;
    border-radius: 100%;
  }

  .shop-body .item-wrap .item-desc {
    color: #898989;
  }

  /* shoping-list end */

  /* shoping-move start */
  .shoping-move {
    display: block;
    border: none;
    text-align: center;
    line-height: 21px;
    background: #fff;
    margin: 0px auto;
    padding: 5px 15px;
    color: #999;
    position: relative;
    top: 35px;
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
</style>
