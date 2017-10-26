<template>
  <!-- banner start -->
  <el-carousel height="500px">
    <template v-for="(item, index) in list">
    <el-carousel-item>
      <div class="banner clear">

          <img :src="item.pic" alt="" >

        <!--<div class="banner-title">杺 叶</div>-->
        <!--<div class="banner-text">-->
          <!--<img src="../../../static/images/banner/01.jpg" alt="">-->
          <!--以 “匠杺”代表着一木一心，尽在人心。我们用心制造每一件印品的高质量，尽心做到每个客户满意。用心制造别具匠心的美好，这是我们对产品服务理念的定义。-->
        <!--</div>-->
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
        list: [
          {
            "pic" : "../../../static/images/banner/01.jpg"
          },{
            "pic" : "../../../static/images/banner/02.jpg"
          }
        ],
      }
    },
    components: {

    },
    created() {

    },
    mounted() {
        this.getPic();
    },
    methods: {
      getPic() {

      }
    }
  }
</script>
