<template>
  <div>
    <div class="admin clear">
      <eleLeft></eleLeft>
      <router-view></router-view>
    </div>
  </div>
</template>


<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import eleLeft from '@/components/admin/eleleftNav.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
      name: 'admin',
      data () {
          return {

          }
      },
      created () {
          this.isUserTrue();
      },
      components: {
          heads,
          foots,
          eleLeft
      },
      methods: {
          isUserTrue() {
              if (localStorage.getItem('user_info') === 'undefined') {
                  setTimeout(() => {
                      this.$router.push({ path: '/user/login'}, 200)
                  });
              }
          }
      },
  };
</script>

<style scoped="">

</style>
