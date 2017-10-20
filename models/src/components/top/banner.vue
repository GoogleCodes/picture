<template>
  <!-- banner start -->
  <el-carousel height="180px" style="z-index: -1">
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
    padding-top: 45px;
  }
</style>

