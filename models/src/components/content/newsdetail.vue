<template>
    <div style="background: #fff;">
        <div style="padding-top: 55px;"></div>
        <div class="newDetail">
            <div class="detail-title">
                <strong class="ft-18 block" style="text-align: center;">{{ list.post_title }}</strong>
                <span class="fl">{{ list.post_source }}</span>
                <span class="fr">{{ list.published_time }}</span>
            </div>
            <div class="detail-content">
                <!--<div class="detail-con-desc">-->
                  <!--在综合各方面意见的基础上，中央政治局会议研究决定对党章进行适当修改，强调这次修改党章工作，要把党的十九大报告确立的重大理论观点和重大战略思想写入党章，使党章充分体现马克思主义中国化最新成果，充分体现党的十八大以来以习近平同志为核心的党中央提出的治国理政新理念新思想新战略，充分体现坚持和加强党的领导、全面从严治党的新鲜经验，以适应新形势新任务对党的事业和党的建设提出的新要求。-->
                <!--</div>-->
                <div class="detail-pic" v-html="list.post_content">
                  <!--<img src="../../../static/images/40.png" alt="">-->
                </div>
            </div>
            <!--<div class="pages">-->
                <!--<div class="">-->
                    <!--<el-button class="prve">上一遍</el-button>-->
                    <!--<span>2016年顺德装饰画、相框展示会</span>-->
                <!--</div>-->
                <!--<div class="">-->
                    <!--<el-button class="next">下一遍</el-button>-->
                    <!--<span>2016年顺德装饰画、相框展示会</span>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  export default {
    components: {
      ElButton
    },
    data() {
      return {
        list: [],
      }
    },
    created() {
      this.getNews();
    },
    computed: {

    },
    mounted() {

    },
    filters: {
      TimeTexts (value) {
        return value.substring(0, 10);
      },
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
            console.log(this.$route.query.newid);
            for (let i in res.data) {
              if (res.data[i].id == this.$route.query.newid) {
                this.list = res.data[i];
                console.log(this.list);
              }
            }
          }
        });
      }
    },
  }
</script>


<style type="text/css">
  /* newDetail start */
  .newDetail {
    /*padding: 10px 0px;*/
    background: #fff;
    padding-bottom: 30px;
  }

  .newDetail .detail-title {
    width: 260px;
    height: 66px;
    margin: 0px auto 0px;
    line-height: 35px;
    overflow: hidden;
  }

  .newDetail .detail-title span {
    color: #ccc;
  }

  .newDetail .detail-content .detail-con-desc {
    margin: 60px 50px 0px;
    line-height: 30px;
    text-indent: 2em;
    padding-bottom: 20px;
  }

  .newDetail .detail-content .detail-pic {
    margin: 0px auto;
    /*width: 910px;*/
  }

  .detail-pic p {
    padding: 0px 5%;
  }

  .detail-pic p img {
    width: 100%;
  }

  .newDetail .pages {
    margin: 80px 0px 40px;
    height: 37px;
  }

  /* newDetail end */
</style>
