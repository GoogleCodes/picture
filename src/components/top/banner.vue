<template>
  <!-- banner start -->
  <div v-loading="load_data" element-loading-text="正在加载中...">
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
  </div>
  <!-- banner end -->
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        //  获取数据
        list: [],
        //  提示加载中
        load_data: false,
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
        this.load_data = true;
        this.$ajax.HttpGet(this.$api.get_content.GET_BANNER).then((res) => {
          this.load_data = false;
          this.list = res.data;
        });
      }
    }
  }
</script>
