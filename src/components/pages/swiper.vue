<style scoped>
  .swiper-container {
    margin: 20px;
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
  <div style="width:650px;height: 500px;" class="fl">
    <swiper style="width:650px;" :options="swiperOption" ref="mySwiper">
      <!-- slides -->
      <template v-for="(item, index) in data.pic">
        <swiper-slide :style="{
                  background: 'url('+ item.src +') no-repeat',
                  height: '350px'}">
        </swiper-slide>
      </template>
      <!-- Optional controls -->
      <div class="swiper-pagination"  slot="pagination"></div>
      <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
      <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
      <div class="swiper-scrollbar"   slot="scrollbar"></div>
    </swiper>
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
                  paginationClickable: true,
                  prevButton: '.swiper-button-prev',
                  nextButton: '.swiper-button-next',
                  scrollbar: '.swiper-scrollbar',
                  mousewheelControl: true,
                  observeParents: true,
                  spaceBetween: 10,
                  debugger: true,
              },
              swiperOptionThumbs: {
                  autoplay: 3000,
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
