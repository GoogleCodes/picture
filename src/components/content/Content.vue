<template>
  <div>
    <!-- content start -->
    <div class="content clear">
      <div class="con-pro">
        <img src="../../../static/images/02.png" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="wrap clear">
        <div class="wrap-card fl">
          <div class="wrap-card-icon box-icon"></div>
          <div class="wrap-card-text">纯手工装裱</div>
          <div class="wrap-card-desc">
            质感卓越，进口画芯高清质感图，高仿颜料纹理质感，佳能高级打印机准确输出，还原画芯真实色彩
        </div>
        </div>
        <div class="wrap-card fl">
          <div class="wrap-card-icon thumbsup-icon"></div>
          <div class="wrap-card-text">纯手工装裱</div>
          <div class="wrap-card-desc">
            质感卓越，进口画芯高清质感图，高仿颜料纹理质感，佳能高级打印机准确输出，还原画芯真实色彩
        </div>
        </div>
        <div class="wrap-card fl" style="margin: 0px;">
          <div class="wrap-card-icon picture-icon"></div>
          <div class="wrap-card-text">纯手工装裱</div>
          <div class="wrap-card-desc">
            质感卓越，进口画芯高清质感图，高仿颜料纹理质感，佳能高级打印机准确输出，还原画芯真实色彩
          </div>
        </div>
        <div class="wrap-list clear">
          <template v-for="(item, index) in data.albumList">
            <div class="wrap-li fl" :style="{background: 'url('+ item.shotcut +') no-repeat 100%'}">
              <div class="wrap-li-pic"></div>
              <div v-if="item.title !== ''" style="width: 100%;height: 100%;border-radius: 100%;">
                <router-link :to="{ path: '/inside/orderlist', query: {id: item.id }}" class="wrap-more block">
                  <p class="ft-16">{{ item.title }}</p>
                  <span>{{ item.title }}</span>
                </router-link>
              </div>
              <div v-else="" style="background: rgba(255,255,255,0.1);width: 100%;height: 100%;border-radius: 100%;"></div>
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
          <div style="margin-top: 50px;">
            <template v-for="item in data.arr">
              <div class="card-tuijian fl">
                  <router-link class="fl block" :to="{ path: '/inside/orderlist', query: {id: item.goods_id}}">
                    <div class="card-tuijian-pic fl">
                      <template v-for="(x, i) in item.goods_thumb">
                        <img :src="x.url" alt="" style="width: 100%;height: 100%;" />
                      </template>
                    </div>
                    <div class="card-tuijian-desc fl">
                      <div class="desc-title">{{ item.goods_name }}</div>
                      <span class="desc-msg blocks">{{ item.goods_remark }}</span>
                      <div class="desc-pic">
                        <template v-for="(x, i) in item.goods_thumb">
                          <img :src="x.url" alt="" style="width: 100%;height: 100%;" />
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
          <img src="../../../static/images/08.png" alt="" style="width: 100%;height: 100%;">
          <a class="block move"></a>
        </div>
      </router-link>
      <div class="con-pro clear pro-moves">
        <router-link :to="{ path: 'content/news'}">
          <img src="../../../static/images/09.png" alt="" style="width: 100%;height: 100%;">
        </router-link>
      </div>
    </div>
    <!-- content end -->
  </div>
</template>

<script type="text/javascript">
  export default {
    name: 'Content',
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
      this.$ajax.HttpGet(this.$api.get_content.GET_NAV + '?top=' + 1)
      .then((res) => {

      });
    },
    methods: {
      getIndex () {
        this.$ajax.HttpGet(this.$api.get_content.GET_ORDER +"?is_hot=1" + "&limit=" + 4).then((res) => {
          this.data.arr = res.data;
        });
      },
      getAlbum () {
        this.$ajax.HttpGet(this.$api.get_content.GET_NAV + '?top=' + 1)
        .then((res) => {
          this.data.albumList = res.data;
        });
      //  this.$ajax.HttpGet(this.$api.get_content.album).then((res) => {
      //    this.data.albumList = res.data;
      //  });
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
    height: 350px;padding-top: 30px;
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
    margin: 100px auto 0px;
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
    left: 4px;
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
    font-size: 12px;
  }

  .content .wrap .wrap-list {
    padding-top: 130px;
  }

  .content .wrap .wrap-li {
    width: 260px;
    height: 260px;
    background: url('../../assets/images/05.png') no-repeat ;
    /*filter: blur(1px);*/
    border-radius: 100%;
    text-align: center;
    margin: 0 68px 85px 38px;
  }
  .content .wrap .wrap-li p, .wrap-more {
    line-height: 45px;
    color: #fff;
  }

  .content .wrap .wrap-li .wrap-more {
    font-size: 16px;
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

  .tuijian-header .tuijian-span{
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
