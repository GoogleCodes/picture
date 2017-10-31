<template>
  <div class="bgColor">
      <div class="news">
        <!--
           v-loading="load_data" element-loading-text="加载中..."
        -->
          <ul>
              <template v-for="(item, index) in list">
                  <li class="fl">
                      <router-link :to="{ path: '/content/newsdetail' , query: { newid : item.id }}" class="block">
                          <div class="news-pic">
                              <img :src="item.more.thumbnail" alt="" class="w100 h100">
                          </div>
                          <div class="news-text">
                              <router-link :to="{ path: '/'}" class="block w100 h100">
                                  <div class="title ft-16">{{ item.post_title }}</div>
                                  <div class="date">{{ item.published_time | texts }}</div>
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
        filters: {
          texts (value) {
            return value.substring(0,10);
          },
          time: function (value) {
            let d = new Date(parseInt(value) * 1000);
            var years = d.getFullYear();
            var month = d.getMonth() + 1;
            var days = d.getDate();
            var hours = d.getHours();
            var minutes = d.getMinutes();
            var seconds = d.getSeconds();
            return years + "-" + month + "-" + days + " " + (hours > 9 ? hours : '0' + hours) + ':' + (minutes > 9 ? minutes : '0' + minutes);
          }
        },
        methods: {
          getNews() {
            this.load_data = true;
            this.$goFetch.fetchGet(this.$api.get_content.GET_NEWS).then((res) => {
              if (res.code == 0) {
                this.load_data = false;
                this.$message({
                  message: res.msg,
                  type: 'warning'
                });
              } else if (res.code == 1) {
                this.load_data = false;
                this.$message({
                  message: res.msg,
                  type: 'success'
                });
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
    height: 100%;
    margin: 0px auto 50px;
    padding-top: 55px;
    overflow: hidden;
  }

  .news ul li {
    width: 95%;
    height: 100%;
    background: #fff;
    margin: 0px 8px 10px;
    transition: 0.5s;
    padding: 0 0 15px;
  }

  @media screen and (min-width: 414px) {
    .news ul li {
      width: 47%;
      margin: 0px 8px 10px;
    }

    .news ul li:nth-child(2n) {
      margin: 0px 0px 10px;
    }

  }

  /*.news ul li:nth-child(2n) {*/
    /*margin: 0px 0px 10px;*/
  /*}*/

  .news ul li:hover {
    box-shadow: 2px 2px 20px #ccc;
    cursor: pointer;
    transition: 0.5s;
  }

  .news ul li .news-pic {
    width: 100%;
    height: 100%;
  }

  .news ul li .news-text {
    margin: 10px;
    height: 100%;
    line-height: 35px;
    border-bottom: 1px solid #e6e6e6;
  }

  .news ul li .more .more-text {
    color: #b11e25;
    margin: 0 0px 0px 15px;
  }

  .zan {
    margin: 0px 20px 0px 0px;
  }

  /* news end */
</style>
