<style scoped>
  .swiper-container {
    margin: 0px;
  }
  .swiper-slide {
    background-size: cover;
    background-position: center;
  }
  .gallery-top {
    height: 80%!important;
    width: 100%;
  }
  .gallery-thumbs {
    height: 20%!important;
    box-sizing: border-box;
    padding: 10px 0;
  }
  .gallery-thumbs .swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
  }
  .gallery-thumbs .swiper-slide-active {
    opacity: 1;
  }
</style>

<template>
  <div class="fl">
    <div style="margin-top: 46px;">
      <swiper :options="swiperOption" ref="mySwiper">
        <!-- slides -->
        <template v-for="(item, index) in data.pic">
          <swiper-slide  :style="{
                  background: 'url('+ item.src +') no-repeat',
                  height: '300px'}">
          </swiper-slide>
        </template>
        <div class="swiper-pagination" slot="pagination"></div>
        <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
        <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
      </swiper>
    </div>
    <!-- swiper2 Thumbs -->
    <swiper style="height: 75px;" :options="swiperOptionThumbs" class="gallery-thumbs" ref="swiperThumbs">
      <template v-for="(item, index) in data.pic">
        <swiper-slide :style="{
                  background: 'url('+ item.src +') no-repeat',
                  backgroundSize: 'cover'}">
        </swiper-slide>
      </template>
    </swiper>
  </div>
</template>

<script type="text/javascript">


  import { swiper, swiperSlide } from 'vue-awesome-swiper'

  export default {
      data() {
          return {
              data: {
                  pic: [{
                      "src" : '../../static/images/23.png',
                  },{
                      "src": '../../static/images/23.png'
                  },{
                      "src": '../../static/images/23.png'
                  },{
                      "src": '../../static/images/23.png'
                  },{
                      "src": '../../static/images/23.png'
                  }],
              },
              swiperOption: {
                  // swiper options 所有的配置同swiper官方api配置
                  autoplay: 3000,
                  notNextTick: true,
                  direction: 'horizontal',
                  grabCursor: true,
                  pagination: '.swiper-pagination',
                  prevButton: '.swiper-button-prev',
                  nextButton: '.swiper-button-next',
                  observeParents: true,
                  spaceBetween: 10,
                  debugger: true,

              },
              swiperOptionThumbs: {
                  notNextTick: true,
                  spaceBetween: 10,
                  centeredSlides: true,
                  slidesPerView: 'auto',
                  touchRatio: 0.2,
                  slideToClickedSlide: true
              }
          }
      },
      mounted() {
          const mySwiper = this.$refs.mySwiper.swiper
          const swiperThumbs = this.$refs.swiperThumbs.swiper
          mySwiper.params.control = swiperThumbs
          swiperThumbs.params.control = mySwiper
      },
      components: {
          swiper,
          swiperSlide
      },
      computed: {
//        swiper() {
//            return this.$refs.mySwiper.swiper
//        }
      },
      methods: {
        onTransitionStart (swiper) {
          console.log(swiper, '-----------')
        }
      },
  }
</script>

<style type="text/css">

  @media screen and (max-device-width: 414px) {
    .swiper-container-horizontal {
      width: 414px;
    }
  }

  @media screen and (max-device-width: 412px) {
    .swiper-container-horizontal {
      width: 412px;
    }
  }

  @media screen and (max-device-width: 375px) {
    .swiper-container-horizontal {
      width: 375px;
    }
  }

  @media screen and (max-device-width: 360px) {
    .swiper-container-horizontal {
      width: 360px;
    }
  }

  @media screen and (max-device-width: 320px) {
    .swiper-container-horizontal {
      width: 320px;
    }
  }

</style>
