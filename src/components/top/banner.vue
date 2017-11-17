<template>
  <!-- banner start -->
  <div>
    <el-carousel height="500px">
      <el-carousel-item>
        <div class="banner clear">
        <!--
          <router-link :to="{ path: item.url, query: {id: item.id}}">
            <img :src="item.img" :alt="item.name" >
          </router-link>
        -->
          <div class="banner-title">杺 叶</div>
          <div class="banner-text">
            以 “匠杺”代表着一木一心，尽在人心。我们用心制造每一件印品的高质量，尽心做到每个客户满意。用心制造别具匠心的美好，这是我们对产品服务理念的定义。
          </div>
        </div>
      </el-carousel-item>
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
        this.$ajax.HttpGet(this.$api.get_content.GET_BANNER).then((res) => {
          this.list = res.data;
        });
      }
    }
  }
</script>
