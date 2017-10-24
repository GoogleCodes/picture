<template>
  <!-- banner start -->
  <el-carousel height="180px">
    <el-carousel-item>
      <img src="../../../static/images/banner_xiadan.png" class="w100 h100" alt="">
    </el-carousel-item>
  </el-carousel>
  <!-- banner end -->
</template>

<script type="text/javascript">

//  import Group from 'vux/src/components/group'

  export default {
    data() {
      return {

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

