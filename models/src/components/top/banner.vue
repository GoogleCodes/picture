<template>
  <!-- banner start -->
  <!--<el-carousel height="180px">-->
    <!--<el-carousel-item>-->
      <!--<img src="../../../static/images/banner_xiadan.png" class="w100 h100" alt="">-->
    <!--</el-carousel-item>-->
  <!--</el-carousel>-->


  <div style="padding-top: 50px;">
    <swiper :options="swiperOption">
      <template v-for="(item, index) in list">
        <swiper-slide :style="{
          background: 'url('+ item.pic +') no-repeat',
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
        list: [
          {
            "pic" : "../../../static/images/banner/01.jpg"
          },{
            "pic" : "../../../static/images/banner/02.jpg"
          }
        ],
        swiperOption: {
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
        this.getPic();
    },
    methods: {
      getPic() {

      }
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

