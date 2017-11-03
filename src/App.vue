<template>
  <div id="app">
    <heads></heads>
    <router-view></router-view>
    <vfoot></vfoot>
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import vfoot from '@/components/footer/Footer.vue'

export default {
  name: 'app',
  data() {
      return {

      };
  },
  crated() {

  },
  methods: {

  },
  components: {
    heads,
    vfoot
  }
}
</script>




