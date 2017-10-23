<template>
  <div class="goback" v-show="$route.meta.goback">
    <i class="iconfont icon-zuobian" @click="goBack()"></i>
    <span class="goback-title ft-18">{{ $route.meta.title }}</span>
  </div>
</template>

<script type="text/javascript">
  export default {
      data() {
          return {

          }
      },
      methods: {
          goBack() {
              window.history.back();
          }
      }
  }
</script>

<style type="text/css">
  /* goback start */
  .goback {
    width: 100%;
    height: 47px;
    position: fixed;
    background: #222;
    top: 0px;
    z-index: 100;
    left: 0px;
  }

  .goback .icon-zuobian {
    color: #fff;
    line-height: 47px;
    font-size: 18px;
    margin: 0px 12px;
    float: left;
  }

  .goback-title {
    color: #fff;
    line-height: 47px;
    display: block;
    width: 80%;
    text-align: center;
    margin: 0px auto;
  }

  /* goback end */

</style>
