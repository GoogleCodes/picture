<template>
  <div style="background: #fff">
    <banner></banner>
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

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_OPENID, GET_USER_INFO } from '../store/getters/type'

  export default {
    name: 'index',
    data () {
      return {
        list: [],
        openid: ''
      }
    },
    mounted() {
      console.log(this.$route, this.get_user_info, this.get_user_openid);
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO,
        get_user_openid: GET_USER_OPENID,
      }),
      user_info() {
        return this.$store.state.user_info;
      }
    },
    methods: {
      getOpenID() {
        if (this.$storageGet('openid') == null) {
          window.location.href = "https://www.xinye-art.com/public/api/home/pay/getcode"
          this.$storageSet('openid', this.get_user_openid);
          return true;
        }
      },
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

<style lang="less">


  /*@import '~vux/src/styles/reset.less';*/
</style>
