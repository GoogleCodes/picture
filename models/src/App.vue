<template>
  <div id="app">
    <heads></heads>
    <goback></goback>
    <keep-alive>
      <router-view></router-view>
    </keep-alive>
    <vfoot></vfoot>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import goback from '@/components/top/back.vue'
  import vfoot from '@/components/footer/Footer.vue'

  export default {
    name: 'app',
    components: {
      heads,
      vfoot,
      goback
    }
  }
</script>

<style lang="less">

  #app {
    max-width: 640px;
  }
  /*@import '~vux/src/styles/reset.less';*/
</style>



