<template>
  <div>
    <!-- content start -->
    <div class="content clear">
      <div class="con-pro">
        <img src="../../assets/images/02.png" alt="" style="width: 100%;height: 100%;">
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
          <div class="wrap-li fl">
            <div class="wrap-li-pic"></div>
            <p>相册系列</p>
            <a href="javascript:void(0);" class="wrap-more">了解更多 &gt;</a>
          </div>
          <div class="wrap-li fl"></div>
          <div class="wrap-li fl" style="margin: 0px;"></div>
          <div class="wrap-li fl"></div>
          <div class="wrap-li fl"></div>
          <div class="wrap-li fl" style="margin: 0px;"></div>

          <div class="wrap-tujian clear">
            <div class="tuijian-header">
              <h1 class="tuijian-h1">热门推荐</h1>
              <div class="line"></div>
              <span class="tuijian-span">{{ data.desc }}</span>
            </div>
            <div style="margin-top: 100px;">
              <template v-for="item in data.arr">
                <div class="card-tuijian fl">
                    <router-link :to="{ path: '/pages/detail', query:{ id:item.id }}" class="block w100 h100" >
                    <div class="card-tuijian-pic fl">
                      <img :src="item.pic" alt="" style="width: 100%;height: 100%;"/>
                    </div>
                    <div class="card-tuijian-desc fl">
                      <div class="desc-title">{{ item.title }}</div>
                      <span class="desc-msg blocks">{{ item.desc }}</span>
                      <div class="desc-pic">
                        <img :src="item.small" alt="" style="width: 100%;height: 100%;" />
                      </div>
                    </div>
                  </router-link>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
      <div class="con-pro clear pro-moves">
        <img src="../../assets/images/08.png" alt="" style="width: 100%;height: 100%;">
        <a href="javascript:void(0);" class="block move"></a>
      </div>
      <div class="con-pro clear pro-moves">
        <img src="../../assets/images/09.png" alt="" style="width: 100%;height: 100%;">
      </div>
    </div>
    <!-- content end -->
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        data: {
          arr: [],
          desc: '',
        }
      }
    },
    mounted() {
      this.getIndex();
    },
    created() {

    },
    methods: {
      getIndex() {
        this.$http.get('../../../static/data/index.json').then((res) => {
          this.data.desc = res.data.description;
          this.data.arr = res.data.tuijian;
        });
      }
    }
  }
</script>

<style>
  /* content start */
  .content {
    margin: 50px auto 0px;
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
    width: 1200px;
    height: 100%;
    margin: 100px auto 0px;
  }

  .content .wrap .wrap-card {
    width: 320px;
    height: 250px;
    position: relative;
    margin: 0 120px 0 0;
  }

  .content .wrap .wrap-card .wrap-card-icon {
    width: 90px;
    height: 90px;
    background: url("../../assets/images/03.png") no-repeat;
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
    width: 310px;
    height: 310px;
    background: url('../../assets/images/05.png') no-repeat ;
    /*filter: blur(1px);*/
    border-radius: 100%;
    text-align: center;
    margin: 0px 125px 85px 10px;
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
    padding-top: 125px;
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
    font-size: 25px;
    margin-top: 35px;
    line-height: 35px;
    color: #231815;
  }

  .card-tuijian-desc .desc-msg {
    margin-top: 10px;
    color: #9d9e9e;
  }

  .card-tuijian-desc .desc-pic {
    width: 85%;
    height: 170px;
    margin: 10px 17px;
  }

  /* content end */
</style>
