<template>
  <div>
    <!-- content start -->
    <div class="content clear">
      <div class="con-pro">
        <el-carousel height="600px">
          <template v-for="(item, index) in data.banner">
            <el-carousel-item>
              <div class="banner clear">
                <router-link :to="{ path: item.url, query: {id: item.id}}">
                  <img :src="item.img" :alt="item.name">
                </router-link>
              </div>
            </el-carousel-item>
          </template>
        </el-carousel>
        <!--<img src="../../../static/images/02.png" alt="" style="width: 100%;height: 100%;">-->
      </div>
      <div class="wrap clear">
        <div class="wrap-card fl">
          <div class="wrap-card-icon box-icon"></div>
          <div class="wrap-card-text">高端进口框条</div>
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
        <div class="wrap-list clear">
          <template v-for="(item, index) in data.albumList">
            <div class="wrap-li fl" :style="{
            background: 'url('+ item.shotcut +') no-repeat 100%'}">
              <router-link :to="{ path: '/inside/orderlist', query: {id: item.id }}" class="wrap-more block">
                <div class="wrap-li-pic wrap-li-hover"></div>
                <div v-if="item.title !== ''" style="width: 100%;height: 100%;border-radius: 100%;">
                  <p class="ft-16">{{ item.title }}</p>
                  <span>{{ item.title }}</span>
                </div>
                <div v-else=""
                     style="background: rgba(255,255,255,0.1);width: 100%;height: 100%;border-radius: 100%;"></div>
              </router-link>
            </div>
          </template>
        </div>
      </div>

      <div class="wrap-tujian clear">
        <div class="tuijian-header">
          <h1 class="tuijian-h1">热门推荐</h1>
          <div class="line"></div>
          <span class="tuijian-span">时光印记，定格美好的回忆</span>
        </div>
        <div>
          <div style="margin: 50px 0px 100px;overflow: hidden;;">
            <template v-for="item in data.arr">
              <div class="card-tuijian fl">
                <router-link class="fl block" :to="{ path: '/pages/detail/' + item.goods_id}">
                  <div class="card-tuijian-pic fl">
                    <template v-for="(x, i) in item.goods_thumb">
                      <img :src="x.url" alt="" style="width: 100%;height: 100%;"/>
                    </template>
                  </div>
                  <div class="card-tuijian-desc fl">
                    <div class="desc-title">{{ item.goods_name }}</div>
                    <span class="desc-msg blocks">{{ item.goods_remark }}</span>
                    <div class="desc-pic">
                      <template v-for="(x, i) in item.goods_thumb">
                        <img :src="x.url" alt="" style="width: 100%;height: 100%;"/>
                      </template>
                    </div>
                  </div>
                </router-link>
              </div>
            </template>
          </div>
        </div>
      </div>
      <router-link :to="{ path: '/inside/orderlist', query: {id: 34}}">
        <div class="con-pro clear pro-moves">
          <img src="../../../static/images/08.jpg" alt="" style="width: 100%;height: 100%;">
          <a class="block move"></a>
        </div>
      </router-link>
      <div class="con-pro clear pro-moves">
        <router-link :to="{ path: 'content/news'}" class="block">
          <img src="../../../static/images/09.jpg" alt="" style="width: 100%;height: 100%;">
        </router-link>
      </div>
    </div>
    <!-- content end -->
  </div>
</template>

<script type="text/javascript">
  import {Carousel, CarouselItem} from 'element-ui'
  export default {
    name: 'Content',
    data() {
      return {
        albumVisi: false,
        data: {
          banner: [],
          arr: [],
          desc: '',
          albumList: [],
        },
      }
    },
    components: {
      ElCarousel: Carousel,
      ElCarouselItem: CarouselItem
    },
    mounted() {
      this.getIndex();
      this.getAlbum();
      this.getBanner();
    },
    created() {
      this.$ajax.HttpGet(this.$api.get_content.GET_NAV + '?top=' + 1)
        .then((res) => {
        });
    },
    methods: {
      //  获取主图
      getBanner() {
        this.$ajax.HttpGet(this.$api.get_content.GET_BANNER).then((res) => {
          this.data.banner = res.data;
          console.log(this.data.banner);
        });
      },
      getIndex () {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER + "?is_hot=1" + "&limit=" + 4).then((res) => {
          this.data.arr = res.data;
        });
      },
      getAlbum () {
        this.$ajax.HttpGet(this.$api.get_content.GET_NAV + '?top=' + 1)
          .then((res) => {
            this.data.albumList = res.data;
          });
      },
    }
  }
</script>

<style>
  /* content start */
  .content {
    margin: 0px auto;
  }

  .content .con-pro {
    width: 100%;
    /*margin-bottom: 20px;*/
    height: 400px;
  }

  .content .pro-moves {
    position: relative;
    height: 350px;
    padding-top: 0px;
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
    width: 1050px;
    overflow: hidden;
    height: 100%;
    margin: 245px auto 0px;
  }

  .content .wrap .wrap-card {
    width: 320px;
    height: 250px;
    position: relative;
    margin: 0 45px 0 0;
  }

  .content .wrap .wrap-card .wrap-card-icon {
    width: 90px;
    height: 90px;
    background: url("../../../static/images/03.png") no-repeat;
    margin: 35px auto 0px;
  }

  .content .wrap .wrap-card .box-icon {
    background-position: 0px 0px;
    position: relative;
    left: 0px;
  }

  .content .wrap .wrap-card .thumbsup-icon {
    background-position: -90px 0px;
  }

  .content .wrap .wrap-card .picture-icon {
    background-position: -193px 0px;
  }

  .content .wrap .wrap-card .wrap-card-text {
    text-align: center;
    font-size: 26px;
    margin-top: 35px;
  }

  .content .wrap .wrap-card .wrap-card-desc {
    text-align: center;
    margin: 20px 5px;
    color: #898989;
    font-size: 14px;
    letter-spacing: 5px;
  }

  .content .wrap .wrap-list {
    padding-top: 130px;
    overflow: hidden;
  }

  .content .wrap .wrap-li {
    width: 260px;
    height: 260px;
    background: url('../../assets/images/05.png') no-repeat;
    /*filter: blur(1px);*/
    border-radius: 100%;
    text-align: center;
    margin: 0 68px 85px 38px;
    transition: .5s;
    position: relative;
  }

  .content .wrap .wrap-li-pic {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    border-radius: 100%;
    transition: 0.5s;
  }

  .content .wrap .wrap-li-hover:hover {
    background: rgba(0, 0, 0, 0.3);
    transition: 0.5s;
    cursor: pointer;
  }

  .content .wrap .wrap-li p, .wrap-more {
    line-height: 45px;
    color: #fff;
  }

  .content .wrap .wrap-li .wrap-more {
    font-size: 16px;
    height: 100%;
    width: 100%;
    z-index: 10;
  }

  .content .wrap .wrap-li p {
    font-size: 36px;
    font-family: "Arial Black";
    padding-top: 110px;
  }

  .tuijian-header {
    text-align: center;
  }

  .tuijian-header .tuijian-h1 {
    font-size: 31px;
  }

  .tuijian-header .tuijian-span {
    color: #9fa0a0;
  }

  .tuijian-header .line {
    width: 65px;
    height: 1px;
    background: #333;
    margin: 20px auto 10px;
  }

  .wrap-tujian {
    width: 1200px;
    margin: 0px auto;
  }

  .wrap-tujian .card-tuijian {
    margin: 26px 26px 0px 0px;
    width: 585px;
    height: 297px;
    border: 1px solid #9d9e9e;
  }

  .wrap-tujian .card-tuijian:nth-child(2n) {
    margin: 26px 0px 0px 0px;
  }

  .wrap-tujian .card-tuijian .card-tuijian-pic {
    width: 363px;
    height: 297px;
  }

  .card-tuijian-desc {
    width: 221px;
    height: 100%;
    text-align: center;
  }

  .card-tuijian-desc .desc-title {
    font-size: 20px;
    margin-top: 10px;
    height: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    color: #231815;
    padding: 0px 10px;
  }

  .card-tuijian-desc .desc-msg {
    margin-top: 10px;
    color: #9d9e9e;
    height: 50px;
    padding: 0px 10px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .card-tuijian-desc .desc-pic {
    width: 85%;
    height: 170px;
    margin: 0 10px 0 17px;
  }

  .content .wrap .wrap-list .wrap-li:nth-child(3n) {
    margin: 0px;
  }

  /* content end */
</style>
