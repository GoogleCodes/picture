<template>
  <div class="proseries" v-cloak>
    <template v-for="(item, index) in data.list">
      <div class="matop_10" style="height: 100%;overflow: hidden;">
        <div class="pro-pic fl">
          <router-link :to="{ path: '/pages/detail', query: {id: item.goods_id }}">
            <template v-for="(k,i) in item.goods_thumb">
              <img :src="k.url" alt="" class="w100 h100">
            </template>
          </router-link>
        </div>
        <div class="pro-con">
          <div class="pro-desc fl">
            <p class="ft-16 pro-desc-title">{{ item.goods_name }}</p>
            <span class="ft-14 c_b3b3b3 fl desc-h2">{{ item.goods_remark }}</span>
            <h1 class="moeny ft-18 c_e64147 fl">￥39.80</h1>
            <router-link :to="{ path: '/pages/detail', query: {id: item.goods_id }}">
              <el-button class="fr">查看详情</el-button>
            </router-link>
          </div>
        </div>
      </div>
    </template>
    <el-button class="el-more" style="display: none;">加载更多......</el-button>
  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    components: {ElButton},
    data() {
      return {
        load_data: false,
        data: {
          list: [],
          shotcut: [],
          listPages: [],
        },
      }
    },
    created() {
      this.getOrder();
    },
    mounder () {

    },
    methods: {
      getOrder() {
        this.load_data = true;
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?cid=" + this.$route.query.id + "limit=" + 4).then((res) => {
          this.load_data = false;
          this.data.list = res.data;
          this.data.listPages = res.data;
        });
      },
    }
  }
</script>

<style type="text/css">
  /* proseries start */
  .proseries {
    margin: 48px 0;
    padding: 8px 15px 25px;
    background: #fff;
  }

  .proseries .el-more {
    border: none;
    margin: 30px auto;
    display: block;
  }

  .pro-con .pro-desc {
    width: 100%;
  }

  .proseries .pro-pic img {
    border-radius: 10px;
    margin-bottom: 10px;
  }

  .proseries .pro-pic {
    width: 100%;
    height: 150px;
    margin: 0px 0px 15px;
  }

  .proseries .pro-con {
    line-height: 25px;
  }

  .pro-desc .pro-desc-title, .pro-desc .desc-h2 {
    background: #f2f2f2;
    padding: 5px 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 24px;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .pro-desc .desc-h2 {
    width: 95%;
    padding: 5px 0px;
    background: #fff;
    line-height: 24px;
  }

  .pro-desc .moeny {
    font-weight: bold;
    line-height: 40px;
  }

  .proseries .pro-con .el-button {
    width: 95px;
    border: 1px solid #b11e25;
    color :#b11e25;
  }
  /* proseries end */
</style>
