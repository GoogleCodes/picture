<template>
  <div class="bgColor">
      <div class="news" v-loading="load_data" element-loading-text="加载中...">
          <div class="product-title">Exhibition cooperation</div>
          <div class="product-text">展会合作</div>
          <ul>
              <template v-for="(item, index) in list">
                  <li class="fl">
                      <router-link :to="{ path: '/content/newsdetail' , query: { newid : item.id }}" class="block">
                          <div class="news-pic">
                              <img :src="item.more.thumbnail" alt="" class="w100 h100">
                          </div>
                          <div class="news-text">
                              <router-link :to="{ path: '/'}" class="block w100 h100">
                                  <div class="title ft-18 fl">{{ item.post_title }}</div>
                                  <div class="date fr">{{ item.published_time }}</div>
                              </router-link>
                          </div>
                      </router-link>
                      <div class="more clear ft-16">
                          <router-link :to="{ path: '/'}" class="more-text">查看更多&gt;</router-link>
                          <span class="fr zan">👍<i>{{ item.post_like }}</i></span>
                      </div>
                  </li>
              </template>
          </ul>
      </div>
  </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                list: [],
                load_data: false,
            }
        },
        created() {
          this.getNews();
        },
        methods: {
          getNews() {
            this.load_data = true;
            this.$ajax.HttpGet(this.$api.get_content.GET_NEWS)
            .then((res) => {
              if (res.code == 0) {
                this.load_data = false;
              } else if (res.code == 1) {
                this.load_data = false;
                this.list = res.data;
              }
            });
          }
        },
    }
</script>

<style type="text/css">
  /* news start */
  .news {
    width: 1200px;
    height: 100%;
    overflow: hidden;
    margin: 0px auto 50px;
    padding-top: 100px;
  }

  .news ul li {
    width: 379px;
    height: 372px;
    background: #fff;
    margin: 35px 31px 0px 0px;
    transition: 0.5s;
  }

  .news ul li:nth-child(3n) {
    margin: 35px 0px 0 0;
  }

  .news ul li:hover {
    box-shadow: 2px 2px 20px #ccc;
    cursor: pointer;
    transition: 0.5s;
  }

  .news ul li .news-pic {
    width: 100%;
    height: 270px;
  }

  .news ul li .news-text {
    margin: 15px 10px;
    height: 35px;
    line-height: 35px;
  }

  .news ul li .more .more-text {
    color: #b11e25;
    margin: 0 15px;
  }

  .news .product-title {
    font-size: 30px;
    color: #000;
    text-align: center;
  }
  .news .product-text {
    position: relative;
    font-size: 18px;
    color: #333;
    line-height: 50px;
    text-align: center;
    width: 150px;
    margin: 0px auto;
  }
  .news .product-text:before,
  .news .product-text:after {
    content: '';
    position: absolute;
    width: 24px;
    height: 0;
    border-bottom: 1px solid #717171;
    top: 50%;
  }

  .news .product-text:before {
    left: 5px;
  }

  .news .product-text:after {
    right: 5px;
  }

  .zan {
    margin: 0px 20px 0px 0px;
  }

  /* news end */
</style>
