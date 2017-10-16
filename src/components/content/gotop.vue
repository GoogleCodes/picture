<template>
  <!-- icon-dingbu start -->
  <div class="iconfont icon-dingbu" @click="goTopBack()"></div>
  <!-- icon-dingbu end -->
</template>

<script type="text/javascript">
  export default {
    data() {
      return {

      }
    },
    created() {
      //  窗体滚动事件
      $(window).scroll(function() {
        if($(window).scrollTop() >= 350) {
          $(".icon-dingbu").fadeIn(500);
        } else {
          $(".icon-dingbu").stop(true,true).fadeOut(500);
        }
      });
    },
    methods: {
      goTopBack() {
        $('html,body').animate({
          scrollTop: 0,
        },200);
      },
    },
  }
</script>

<style type="text/css">
  /* icon-dingbu start */
  .icon-dingbu {
    position: fixed;
    bottom: 50px;
    right: 50px;
    width: 60px;
    height: 60px;
    background: #222;
    text-align: center;
    line-height: 60px;
    font-size: 26px;
    color: #fff;
    cursor: pointer;
  }
  /* icon-dingbu end */
</style>
