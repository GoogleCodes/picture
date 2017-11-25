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
        <template v-for="(item, index) in data.picture">
          <swiper-slide :style="{
                  background: 'url('+ item.url +') no-repeat',
                  backgroundSize: 'cover',
                  height: '300px'}">
          </swiper-slide>
        </template>
        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </div>
  </div>
</template>

<script type="text/javascript">


  import { swiper, swiperSlide } from 'vue-awesome-swiper'

  export default {
    props: {
      list: {
        type: [Array,Object],
        required: true
      }
    },
    data() {
      return {
        data: {
          picture: [],
        },
        swiperOption: {
          autoplay: 3000,
          pagination: '.swiper-pagination',
          observeParents: true,
        },
      }
    },
    mounted() {
      const mySwiper = this.$refs.mySwiper.swiper
    },
    created() {
      console.log(this.list);
//      this.data.picture = JSON.parse(this.list.photo)
    },
    components: {
        swiper,
        swiperSlide
    },
    computed: {

    },
    methods: {

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
