<template>
  <div id="app">
    <heads></heads>
    <router-view></router-view>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'

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
  }
}
</script>




