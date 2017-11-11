<template>
  <!-- banner start -->
  <el-carousel height="500px">
    <template v-for="(item, index) in list">
    <el-carousel-item>
      <div class="banner clear">
        <router-link :to="{ path: item.url, query: {id: item.id}}">
          <img :src="item.img" :alt="item.name" >
        </router-link>
      </div>
    </el-carousel-item>
    </template>
  </el-carousel>
  <!-- banner end -->
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        list: [],
      }
    },
    components: {

    },
    created() {

    },
    mounted() {
        this.getBanner();
    },
    methods: {
      //  获取主图
      getBanner() {
        this.$ajax.HttpGet(this.$api.get_content.GET_BANNER).then((res) => {
          this.list = res.data;
        });
      }
    }
  }
</script>
