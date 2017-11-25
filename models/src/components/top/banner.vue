<template>
  <!-- banner start -->
  <div style="padding-top: 50px;">
    <swiper :options="swiperOption">
      <template v-for="(item, index) in banner">
        <swiper-slide :style="{
          background: 'url('+ item.img +') no-repeat',
          backgroundSize: 'cover',
          height: '180px'}"></swiper-slide>
      </template>
      <div class="swiper-pagination" slot="pagination"></div>
    </swiper>
  </div>
  <!-- banner end -->
</template>

<script type="text/javascript">

//  import Group from 'vux/src/components/group'

  export default {
    data() {
      return {
        banner: [],
        swiperOption: {
          autoplay: 3000,
          pagination: '.swiper-pagination',
          paginationClickable: true,
        }
      }
    },
    components: {
//      Group
    },
    created() {

    },
    mounted() {
      this.getBanner();
    },
    methods: {
      getBanner() {
        this.$ajax.HttpGet(this.$api.get_content.GET_BANNER).then((res) => {
          this.banner = res.data;
        });
      },
    }
  }
</script>

<style type="text/css">
  .el-carousel {
    clear: both;
    z-index: 2;
    background: #fff;
    overflow: hidden;
    padding-top: 50px;
    background: #fff;
  }
</style>

