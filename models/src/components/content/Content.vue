<template>
  <div>

    <div class="wrap-desc clear">
      <div class="wrap-desc-title ft-32">杺 叶</div>
      <div class="wrap-desc-text">
        以 “匠杺”代表着一木一心，尽在人心。我们用心制造每一件印品的高质量，尽心做到每个客户满意。用心制造别具匠心的美好，这是我们对产品服务理念的定义。
      </div>

      <div class="series">
        <template v-for="(k,i) in data.arr">
          <div class="shop-series fl">
            <router-link :to="{ path: '/content/proseries'}" class="block">
              <div class="shop-series-pic">
                <template v-for="y in k.goods_thumb">
                  <img :src="y.url" class="w100 h100" alt="">
                </template>
              </div>
              <div class="shop-series-text">
                <p class="ft-18">{{ k.goods_name }}</p>
                <p class="ft-14">了解更多 &gt;</p>
              </div>
            </router-link>
          </div>
        </template>
        <div>
          <el-button>更多产品&gt;</el-button>
        </div>
      </div>
    </div>

    <div class="recommend">
      <div class="re-title ft-18">
        <h1 class="fl">热门推荐</h1>
        <span>—</span>
        <span class="ft-14">时光印记，定格美好的回忆</span>
      </div>
      <div class="re-wrap-shop clear">
        <el-carousel height="180px" style="padding: 0px;">
          <template v-for="(k,i) in data.albumList">
            <el-carousel-item>
                <div class="card-tuijian fl" @click="goDetail(item)">
                  <div class="card-tuijian-pic fl">
                    <img :src="k.shotcut" alt="" style="width: 100%;height: 100%;"/>
                  </div>
                  <div class="card-tuijian-desc fl">
                    <div class="desc-title ft-16">{{ k.title }}</div>
                    <span class="desc-msg blocks ft-14">{{ k.description }}</span>
                    <div class="desc-pic">
                      <img :src="k.shotcut" alt="" style="width: 100%;height: 100%;" />
                    </div>
                  </div>
                </div>
            </el-carousel-item>
          </template>
        </el-carousel>
      </div>
    </div>

    <div>
      <!--<div class="" style="margin: 15px 10px;">-->
        <!--<img src="../../../static/images/41.png" class="w100 h100" alt="">-->
      <!--</div>-->
      <router-link :to="{ path: '/content/news'}" class="block w100 h100">
        <div class="" style="margin: 15px 10px;">
          <img src="../../../static/images/42.png" class="w100 h100" alt="">
        </div>
      </router-link>
    </div>

    <!-- content start -->
    <div class="content clear">
      <div class="wrap clear">
        <div class="wrap-card fl">
          <div class="wrap-card-icon box-icon"></div>
          <div class="wrap-card-text ft-24">纯手工装裱</div>
          <div class="wrap-card-desc">质感卓越，进口画芯真实色彩</div>
        </div>
        <div class="wrap-card fl">
          <div class="wrap-card-icon thumbsup-icon"></div>
          <div class="wrap-card-text ft-24">纯手工装裱</div>
          <div class="wrap-card-desc">质感卓越，进口画芯真实色彩</div>
        </div>
        <div class="wrap-card fl" style="margin: 0px;">
          <div class="wrap-card-icon picture-icon"></div>
          <div class="wrap-card-text ft-24">纯手工装裱</div>
          <div class="wrap-card-desc">质感卓越，进口画芯真实色彩</div>
        </div>
      </div>
    </div>
    <!-- content end -->
  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  export default {
    components: {ElButton}, name: 'Content',
    data() {
      return {
        albumVisi: false,
        data: {
          arr: [],
          desc: '',
          albumList: [],
        }
      }
    },
    mounted() {
      this.getIndex();
      this.getAlbum();
    },
    created() {

    },
    watch: {
      $route (to) {

      }
    },
    methods: {
      getIndex () {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?is_hot=1" + "&limit=" + 2).then((res) => {
          this.data.arr = res.data;
        })
      },
      getAlbum () {
        this.$ajax.HttpGet(this.$api.get_content.GET_NAV + '?top=' + 1)
        .then((res) => {
          this.data.albumList = res.data;
        });
      },
      goDetail (item) {
        var options = {
          title: item.title,
          desc: item.desc,
          id: item.id,
          pic: item.pic,
          price: item.price,
          small: item.small,
          size: item.size,
          nums: item.nums,
          guige: item.guige,
        };
        this.$storageSet('detail',  options);
        this.$router.push({
          path : '/pages/detail',
          query:{ id:item.id }
        });
        setTimeout((res) => {
            location.reload();
        },100);
        window.scrollTo(0,0);
      },
    }
  }
</script>

<style>

  /* wrap-desc start */
  .wrap-desc {
    width: 100%;
    text-align: center;
  }

  .wrap-desc .wrap-desc-title {
    writing-mode: tb-rl;
    text-align: center;
    width: 35px;
    margin: 43px auto;
  }

  .wrap-desc .wrap-desc-text {
    color: #999;
    width: 90%;
    text-align: center;
    margin: 0px auto 67px;
  }

  /* wrap-desc end */

  /* content start */
  .content {
    margin: 20px auto;
    padding: 0px 0px 95px;
  }

  .content .pro-moves .move {
    position: absolute;
    bottom: 78px;
    left: -12px;
    right: 0px;
    width: 183px;
    height: 59px;
    margin: 0px auto;
  }

  .content .wrap {
    width: 100%;
    height: 100%;
    overflow: hidden;
    margin: 0px auto;
  }

  .content .wrap .wrap-card {
    width: 33%;
    height: 100%;
    position: relative;
  }

  .content .wrap .wrap-card .wrap-card-icon {
    width: 75px;
    height: 69px;
    background: url("../../../static/images/03.png") no-repeat;
    margin: 0px auto;
  }

  .content .wrap .wrap-card .box-icon {
    background-position: 0px 0px;
    position: relative;
    left: 4px;
  }

  .content .wrap .wrap-card .thumbsup-icon {
    background-position: -77px 0px;
  }

  .content .wrap .wrap-card .picture-icon {
    background-position: -159px 0px;
  }

  .content .wrap .wrap-card .wrap-card-text {
    text-align: center;
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #4d4d4d;
  }

  .content .wrap .wrap-card .wrap-card-desc {
    text-align: center;
    margin: 10px 5px 0px;
    color: #898989;
    font-size: 12px;
  }

  /* content end */

  /* series start */
  .series .el-button {
    margin: 30px 0px;
    width: 150px;
    height: 35px;
    background: #b11e25;
    color: #fff;
    border: 1px solid #b11e25;
  }

  .shop-series {
    width: 47%;
    height: 100%;
    margin: 0px 6px;
  }

  .shop-series:nth-child(2n) {
    margin: 0px 0px;
  }

  .shop-series .shop-series-pic img {
    width: 145px;
    height: 145px;
    border-radius: 100%;
  }

  .shop-series .shop-series-text {
    color: #666;
    margin-top: 20px;
  }

  .shop-series .shop-series-text p:first-child {
    height: 40px;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 16px;
    line-height: 19px;
  }

    /* series end */

  /* recommend start */
  .recommend {

  }

  .recommend .re-title {
    margin: 0px 18px;
  }

  .recommend .re-title span {
    color: #999;
  }

  .recommend .re-title h1 {
    margin-right: 10px;
  }

  .re-wrap-shop {
    height: 163px;
    margin: 20px 10px;
  }

  .re-wrap-shop .card-tuijian {
    width: 100%;
    height: 163px;
  }

  .card-tuijian-pic {
    width: 60%;
    height: 100%;
  }

  .card-tuijian-desc {
    width: 35%;
  }

  .card-tuijian .card-tuijian-desc .desc-title {
    margin-top: 10px;
    font-size: 12px;
    color: #9d9e9e;
    padding: 0px 5px;
    line-height: 17px;
  }

  .card-tuijian-desc .desc-msg {
    margin-top: 5px;
    color: #9d9e9e;
    line-height: 18px;
    padding: 0px 5px;
  }

  .card-tuijian-desc .desc-pic {
    width: 90%;
    height: 95px;
    margin: 0px auto;
  }

  /* recommend end */

</style>
