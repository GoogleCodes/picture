<template>
  <div>
    <div class="wrap-desc clear">
      <div class="wrap-desc-title ft-32">LOGO</div>
      <div class="wrap-desc-text">
        顺德第一家获 ”Fint Art” 公会认证的国际装裱师资质的公司。
        用心、简单、重复，是杺叶的企业文化，也是 ”工匠精神” 的体现
        “凝神屏气无言语，两手一心付案牍”
        <div style="text-align: right;">——致杺叶</div>
      </div>
      <div class="series">
        <template v-for="(k,i) in data.albumList">
          <div class="shop-series fl">
            <router-link :to="{ path: '/inside/orderlist',
            query: {id: k.id, isup: k.is_up }}" class="block">
              <div class="shop-series-pic">
                <img :src="k.shotcut" class="w100 h100" alt="">
              </div>
              <div class="shop-series-text">
                <p class="ft-18">{{ k.title }}</p>
                <p class="ft-12">了解更多 &gt;</p>
              </div>
            </router-link>
          </div>
        </template>
        <div style="display: none">
          <el-button @click="knowMore()">更多产品&gt;</el-button>
        </div>
      </div>
    </div>

    <!--<div style="height: 300px;">-->
      <!--<img class="previewer-demo-img" v-for="(item, index) in list"-->
           <!--:src="item.src" width="100" @click="$refs.previewer.show(index)">-->
      <!--<div>-->
        <!--<previewer :list="list" ref="previewer" :options="options"></previewer>-->
      <!--</div>-->
    <!--</div>-->

    <div class="recommend">
      <div class="re-title ft-18">
        <h1 class="fl">热门推荐</h1>
        <span>—</span>
        <span class="ft-14">时光印记，定格美好的回忆</span>
      </div>
      <div class="re-wrap-shop clear">
        <swiper :options="swiperOption">
          <template v-for="(k,i) in data.arr">
            <swiper-slide>
              <div class="card-tuijian fl" @click="goDetail(k)">
                <div class="card-tuijian-pic fl">
                  <template v-for="n in k.goods_thumb">
                    <img :src="n.url" alt="" style="width: 100%;height: 100%;"/>
                  </template>
                </div>
                <div class="card-tuijian-desc fl">
                  <div class="desc-title ft-18">{{ k.goods_name }}</div>
                  <div class="desc-msg blocks ft-14">{{ k.goods_remark }}</div>
                  <div class="desc-pic">
                    <template v-for="n in k.goods_thumb">
                      <img :src="n.url" alt="" style="width: 100%;height: 100%;"/>
                    </template>
                  </div>
                </div>
              </div>
            </swiper-slide>
          </template>
          <div class="swiper-pagination" slot="pagination"></div>
        </swiper>
      </div>
    </div>
    <div>
      <router-link :to="{ path: '/inside/orderlist',query: {id: 34}}" class="block w100 h100">
        <div style="margin: 0px 10px 10px;">
          <img src="../../../static/images/41.png" class="w100 h100" alt="">
        </div>
      </router-link>
      <router-link :to="{ path: '/content/news'}" class="block w100 h100">
        <div style="margin: 0px 10px 10px;">
          <img src="../../../static/images/42.png" class="w100 h100" alt="">
        </div>
      </router-link>
    </div>
    <!-- content start -->
    <div class="content clear">
      <div class="wrap clear">
        <div class="wrap-card fl">
          <div class="wrap-card-icon box-icon"></div>
          <div class="wrap-card-text">高端进口框条
          </div>
          <div class="wrap-card-desc">采用韩国进口PS框条, 纹理逼真,手感细腻, 更好地衬托画心</div>
        </div>
        <div class="wrap-card fl">
          <div class="wrap-card-icon thumbsup-icon"></div>
          <div class="wrap-card-text">收藏级画质</div>
          <div class="wrap-card-desc">色佳能打印机, 兼容照片及油画输出完美还原照片原片真实色彩</div>
        </div>
        <div class="wrap-card fl" style="margin: 0px;">
          <div class="wrap-card-icon picture-icon"></div>
          <div class="wrap-card-text">纯手工装裱</div>
          <div class="wrap-card-desc">由国际装裱师公会 “Fint Art” 认证推荐装裱师制作, 细节体现 “匠杺” 之美</div>
        </div>
      </div>
    </div>
    <!-- content end -->
  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";


  import previewer from '../../../node_modules/vux/src/components/previewer/index.vue'

  export default {
    components: { ElButton, previewer, }, name: 'Content',
    data() {
      return {
        data: {
          arr: [],
          desc: '',
          albumList: [],
        },
        list: [{
          src: 'https://xinye-art.com/public/upload/20171205/4b08ff585cc89e587708eb130adbd8ac.jpg',
        },{
          src: 'https://xinye-art.com/public/upload/20171205/4b08ff585cc89e587708eb130adbd8ac.jpg'
        }],
        options: {
          getThumbBoundsFn (index) {
            let thumbnail = document.querySelectorAll('.previewer-demo-img')[index]
            let pageYScroll = window.pageYOffset || document.documentElement.scrollTop
            let rect = thumbnail.getBoundingClientRect()
            return {x: rect.left, y: rect.top + pageYScroll, w: rect.width}
          }
        },
        swiperOption: {
          autoplay: 30000,
          pagination: '.swiper-pagination',
          paginationClickable: true,
        },
        dome: '',
      }
    },
    mounted() {
      this.getIndex(1, 3);
      this.getAlbum();
      this.DeepCopy();
    },
    watch: {
      '$route'() {
        this.getIndex(1, 3);
        this.getAlbum();
      }
    },
    methods: {
      DeepCopy() {

      },
      getAlbum () {
        this.$ajax.HttpGet(this.$api.get_content.GET_NAV)
          .then((res) => {
            this.data.albumList = res.data;
          });
      },
      getIndex (hot, limit) {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?is_hot=" + hot + "&limit=" + limit).then((res) => {
          this.data.arr = res.data;
        })
      },
      goDetail (item) {
        this.$router.push({
          path: '/pages/detail',
          query: {id: item.goods_id}
        });
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
    text-align: justify;
    margin: 0px auto 30px;
    position: relative;
    text-indent: 2em;
    letter-spacing: 0.15em;
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
    width: 73px;
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
    font-size: 15px;
    font-weight: bold;
    color: #4d4d4d;
  }

  .content .wrap .wrap-card .wrap-card-desc {
    text-align: justify;
    text-indent: 1em;
    margin: 10px 5px 0px;
    color: #898989;
    font-size: 12px;
  }

  /* content end */

  /* series start */
  .series {
    margin: 0px 5% 30px;
    overflow: hidden;
  }

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
    margin: 0 6px 20px;
  }

  .shop-series:nth-child(2n) {
    margin: 0;
  }

  .shop-series .shop-series-pic img {
    width: 125px;
    height: 125px;
    border-radius: 100%;
  }

  .shop-series .shop-series-text {
    color: #666;
    margin-top: 10px;
  }

  .shop-series .shop-series-text p:first-child {
    height: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 16px;
    line-height: 19px;
  }

  /* series end */
  /* recommend start */
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
    padding: 10px 0;
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
    width: 40%;
    position: relative;
    color: #4d4e4e;
  }

  .card-tuijian .card-tuijian-desc .desc-title {
    /*margin: 10px 0 0 0;*/
    margin-bottom: 10px;
    color: #000;
  }

  .card-tuijian .card-tuijian-desc .desc-title, .card-tuijian-desc .desc-msg {
    font-size: 16px;
    margin-top: 10px;
    line-height: 17px;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .card-tuijian-desc .desc-msg {
    padding: 0px 5px;
    font-size: 14px;
  }

  .card-tuijian-desc .desc-pic {
    width: 90%;
    height: 90px;
    margin: 0px 0 0 10px;
    position: absolute;
    bottom: 0px;
  }

  .swiper-pagination-bullet {
    width: 15px;
    height: 8px;
    border-radius: 5px;
  }

  .swiper-pagination-bullet-active {
    opacity: 1;
    background: #c40000;
    width: 25px;
    height: 8px;
    border-radius: 5px;
  }

  .swiper-slide {
    width: 100%;
  }

  /* recommend end */
</style>
