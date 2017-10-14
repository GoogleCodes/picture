<template>
  <div>
    <banner></banner>
    <elenav></elenav>
    <elecontent></elecontent>
    <gotop></gotop>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import elenav from '@/components/top/Nav.vue'
  import banner from '@/components/top/banner.vue'
  import gotop from '@/components/content/gotop.vue'
  import elecontent from '@/components/content/Content.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
    name: 'index',
    data () {
      return {
        list: [],
      }
    },
    created() {

    },
    computed: {
      user_info() {
        return this.$store.state.user_info;
      }
    },
    components: {
      heads,
      elenav,
      elecontent,
      gotop,
      banner,
      foots,
    }
  }
</script>

<style scoped>

  .page-top {
    height:100%;
    position:fixed;
    width: 100%;
    background:rgb(255, 255, 255);
    z-index:0;
    transition:All 0.4s ease;
    -webkit-transition:All 0.4s ease;
  }

  .page-top .header-tab .online {
    text-align: center;
    line-height: 45px;
    position: absolute;
    height: 45px;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 55%;
    color: #fff;
    margin: 0px auto;
    font-size: 20px;
    font-weight: bold;
  }

  /* header-tab start */
  .header-tab {
    width: 100%;
    height: 45px;
    line-height: 45px;
    background: #6ba74f;
    z-index: 100;
  }

  .header-tab .icon-liebiao {
    color: #fff;
    font-size: 30px;
    padding-left: 0.5em;
  }
  /* header-tab end */

</style>
