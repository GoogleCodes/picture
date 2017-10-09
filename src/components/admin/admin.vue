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

  export default {
    name: 'admin',
    data () {
      return {

      }
    },
    created () {

    },
    components: {
      heads,
      foots,
      eleLeft
    }
  };
</script>

<style scoped="">

</style>
