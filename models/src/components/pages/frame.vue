<template>
  <div class="frame-bg" style="">
    <!-- tab-banner start-->
    <div class="tab-banner">
      <img src="../../../static/images/51.png" alt="" class="w100 h100" >
    </div>
    <div class="wrap-pic">
      <img src="../../../static/images/54.png" alt="" class="w100 h100" >
      <div class="wrap-pic-text w100">
        <span class="ft-28">体验区</span>
        <div class="line"></div>
        <div class="pic-desc ft-14">
          <span>匠杺，是一辈子只做好一件事，<br />用漫长岁月传承一门手艺；<br />匠杺用心为每一个相框赋予美好，<br />保留最珍贵的回忆。<br />从这里开始.......</span>
        </div>
      </div>
    </div>
    <!-- tab-banner end -->

    <!-- frame-product start -->
    <div class="frame-product">
      <div class="frame-nav">
        <ul>
          <li v-for="(k,i) in typeList" class="frame-li fl" :class="{'active': i == index}" @click="chonseTab(i, k.id)">{{ k.key }}</li>
        </ul>
      </div>
      <div class="container">
        <ul class="product-list clearfix">
          <template v-for="item in photoList">
            <li class="fl">
              <router-link :to="{ path: '/'}" class="w100 h100 block">
                <div class="prod-pic">
                  <template v-for="k in item.photo_thumb">
                    <img :src="k.url" alt="" class="w100 h100" >
                  </template>
                </div>
                <div class="content">
                  <p>{{ item.photo_name }}</p>
                </div>
              </router-link>
            </li>
          </template>
        </ul>
        <div class="show-more">
          <span class="btn-more">加载更多</span>
        </div>
      </div>
    </div>
    <!-- frame-product end -->
  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
    data() {
      return {
        typeList: '',
        index: 0,
        photoList: [],
        load_data: false
      }
    },
    components: {
      heads,
      foots
    },
    created() {
      this.getTypeList();
      this.chonseTab(0,1);
    },
    methods: {
      chonseTab(i, id) {
        this.index = i;
        this.load_data = true;
//        $('.frame-product').css({
//          'position': 'fixed',
//          'top': '46px',
//        });
        this.$ajax.HttpGet('/api/home/photo/photoList?cid=' + id).then((res) => {
          this.load_data = false;
          this.photoList = res.data.data;
          console.log(this.photoList);
        });
      },
      getTypeList() {
        this.$ajax.HttpGet('/api/home/photo/typeList').then((res) => {
          this.typeList = res.data;
        });
      },
    }
  }
</script>

<style type="text/css">
  /* frame-bg start */
  .frame-bg {
    background: #fff;
    padding: 47px 0px;
    z-index: 1;
  }
  .frame-bg .wrap-pic {
    width: 300px;
    margin: 30px auto;
    position: relative;
  }
  .frame-bg .wrap-pic .wrap-pic-text {
    position: absolute;
    top: 0px;
    left: 0px;
    text-align: center;
  }
  .frame-bg .wrap-pic .line {
    width: 60px;
    height: 3px;
    margin: 10px auto 0px;
    background: #b11e25;
  }
  .frame-bg .wrap-pic .wrap-pic-text .pic-desc {
    color: #6d706f;
    margin: 30px 10px;
    line-height: 30px;
    letter-spacing: 4px;
  }
  /* frame-bg end */
  .frame-product {
    margin: 87px auto 0px;
  }
  .frame-nav {
    width: 100%;
    height: 40px;
    background: #fff;
  }
  .frame-nav ul .frame-li {
    width: 50%;
    line-height: 40px;
    text-align: center;
    border-bottom: 3px solid #eee;
  }
  .frame-nav ul .active {
    background: #c40000;
    color: #fff;
    border-bottom: 3px solid #710505;
  }
  .frame-product .container .product-list {
    margin: 0px 2%;
  }
  .frame-product .container ul li {
    width: 45%;
    margin: 10px 3.5% 10px;
  }
  .frame-product .container ul li:nth-child(2n) {
    margin: 10px 0% 10px;
  }
  .frame-product .container ul li .prod-pic {
    width: 100%;
    height: 130px;
  }
  .frame-product .container ul li .content {
    text-align: center;
    margin: 0px auto;
    padding: 0px 0px 0px;
    height: 45px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .frame-product .container .show-more {
    text-align: center;
    line-height: 90px;
  }
  /* tab-banner start */
  .tab-banner {
    /*margin-top: 18px;*/
  }
  /* tab-banner end */

</style>
