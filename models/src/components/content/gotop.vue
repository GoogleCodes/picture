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
//      //  窗体滚动事件
//      $(window).scroll(function() {
//        if($(window).scrollTop() >= 350) {
//          $(".icon-dingbu").fadeIn(500);
//        } else {
//          $(".icon-dingbu").stop(true,true).fadeOut(500);
//        }
//      });
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
    bottom: 70px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: #222;
    text-align: center;
    line-height: 40px;
    font-size: 26px;
    color: #fff;
    z-index: 100;
    cursor: pointer;
    display: none;
  }
  /* icon-dingbu end */
</style>
