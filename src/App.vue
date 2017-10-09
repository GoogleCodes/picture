<template>
  <div id="app">
    <heads></heads>
    <router-view></router-view>
    <foots></foots>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'

export default {
  name: 'app',
  data() {
      return {

      };
  },
  crated() {

  },
  components: {
    heads,
    foots
  }
}
</script>

