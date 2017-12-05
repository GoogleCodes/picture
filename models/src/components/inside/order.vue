<template>
  <div>
    <elenav></elenav>
    <div class="order-banner" style="margin: 47px 0px 0px;">
      <template v-for="k in data.shotcut">
        <img :src="k.shotcut" class="w100 h100" alt="">
      </template>
    </div>
    <div class="shoping-list">
      <ul>
        <template v-for="item in data.list">
          <li class="fl">
            <router-link :to="{ path: '/content/proseries', query: {id: item.goods_id}}">
              <div class="shop-body">
                <div class="pic-img">
                  <template v-for="k in item.goods_thumb">
                    <img :src="k.url" alt="" class="w100 h100">
                  </template>
                </div>
                <div class="item-wrap matop_10">
                  <p class="ft-16">{{ item.goods_name }}</p>
                  <span class="block item-desc ft-14">了解更多 &gt;</span>
                </div>
              </div>
            </router-link>
          </li>
        </template>
      </ul>
      <el-button class="shoping-move clear" @click="loadMove()" v-show="moveFlog">加载更多...</el-button>
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
          list: [],
          shotcut: [],
        },
        moveFlog: true,
      }
    },
    created() {
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
    },
    methods: {
      loadMove() {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER).then((res) => {
          this.data.list = res.data;
          this.moveFlog = false;
        });
      },
      getOrder() {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?cid="+ this.$route.query.id + "&limit=" + 4).then((res) => {
          this.data.list = res.data;
          res.data == '' ? this.moveFlog = false : this.moveFlog = true;
          this.$ajax.HttpGet('/api/home/front/PrdClassifyById?id=' + this.$route.query.id).then((res) => {
            this.data.shotcut = res.data;
          });
        });
      },
    }
  }
</script>

<style type="text/css">

  /* shoping-list start */
  .order-banner {
    height: 11.5rem;
  }
  .shoping-list {
    padding: 10px 10px 100px;
    background: #fff;
    overflow: hidden;
  }

  .shoping-list ul li {
    width: 50%;
    margin: 10px 0;
  }

  shoping-list ul li:nth-child(2n) {
    /*margin: 10px 0px;*/
  }

  .shoping-list ul li .shop-body {
    width: 100%;
    height: 100%;
    text-align: center;
    background: #fff;
    transition: 0.5s;
  }
  .shoping-list ul li .shop-body .pic-img {
    width: 80%;
    height: 130px;
    margin: 0px auto;
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

  @media screen and (max-width : 600px){
    .shoping-list ul li .shop-body .pic-img {
      height: 216px;
    }
  }

  @media screen and (max-width : 414px){
    .shoping-list ul li .shop-body .pic-img {
      height: 140px;
    }
  }

  @media screen and (max-width : 375px){
    .shoping-list ul li .shop-body .pic-img {
      height: 130px;
    }
  }

  @media screen and (max-width : 320px){
    .shoping-list ul li .shop-body .pic-img {
      height: 110px;
    }
  }

  /* utils-con end */
</style>
