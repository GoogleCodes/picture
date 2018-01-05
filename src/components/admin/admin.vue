<template>
  <div>
    <div class="admin w1200 clear">
      <eleLeft></eleLeft>
      <router-view></router-view>
    </div>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import eleLeft from '@/components/admin/eleleftNav.vue'
  import foots from '@/components/footer/Footer.vue'

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'

  export default {
      name: 'admin',
      data () {
          return {

          }
      },
      created () {
        this.isUserTrue();
//        console.log(this.get_user_info.user.id);
      },
      computed: {
        ...mapGetters({
            get_user_info: GET_USER_INFO
        }),
      },
      components: {
          heads,
          foots,
          eleLeft
      },
      methods: {
        isUserTrue() {
          if (this.get_user_info.user == undefined) {
            setTimeout(() => {
                this.$router.push({ path: '/user/login'}, 200)
            }, 500);
          }
        }
      },
  };
</script>

<style scoped="">

</style>
