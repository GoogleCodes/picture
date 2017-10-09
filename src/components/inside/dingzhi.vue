<template>
  <div>
    <!-- content start -->
    <div class="content clear" style="margin: 0px auto;">
      <div class="con-pro" style="height: 360px;">
        <img src="../../assets/images/19.png" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience">
        <div class="Experience-title">
          <img src="../../assets/images/21.png" alt="">
        </div>
        <div class="experience-tab" id="tabing">
          <el-button class="tab-chonse fl active">高雅现代相框</el-button>
          <el-button class="tab-chonse fr">字画相框</el-button>
        </div>
        <div id="content">
          <div class="picture-list">
            <template v-for="item in data.list">
              <div class="experience-list fl">
                <router-link :to="{ path: '/pages/detail'}" class="block">
                  <div class="experience-pic">
                    <img :src="item.pic" style="width: 100%;height: 100%;" alt="" >
                  </div>
                  <div class="experience-desc ft-18">{{ item.title }}</div>
                </router-link>
              </div>
            </template>
          </div>
          <div class="picture-list" style="display: none;">
            <template v-for="item in data.list">
              <div class="experience-list fl">
                <router-link :to="{ path: '/pages/detail'}" class="block">
                  <div class="experience-pic">
                    <img :src="item.pic" style="width: 100%;height: 100%;" alt="" >
                  </div>
                  <div class="experience-desc ft-18">{{ item.title }}</div>
                </router-link>
              </div>
            </template>
          </div>
        </div>

      </div>
    </div>
    <!-- content end -->
  </div>

</template>


<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import elenav from '@/components/top/Nav.vue'
  import foots from '@/components/footer/Footer.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    name: 'dingzhi',
    data() {
      return {
        data: {
          list: [],
          dtype: 1
        }
      }
    },
    created () {
      this.getPicItem();
    },
    methods: {
      getPicItem() {
        this.$http.get('../../../static/data/order.json').then((res) => {
          this.data.list = res.data.order;
        });
      },
      $id (id) {
          return document.getElementById(id);
      },
      siblings: function (dom,callback) {
        var pdom = dom.parentElement;
        var tabArr = [].slice.call(pdom.children);
        tabArr.filter(function(obj){
          if(obj!=dom)callback.call(obj);
        });
      },
      siblingsDom:function (){
        var cardDom = this.$id("tabing");
        var liDomes = cardDom.children;
        var len = liDomes.length;
        for(var i = 0; i < len; i++) {
          //给对象缓存自有属性
          liDomes[i].index = i;
          var _this = this;
          liDomes[i].onclick = function(){
            this.className = "active";
            this.style.color = "#81c429";
            //同辈元素互斥
            _this.siblings(this,function(){
              this.className = "";
              this.style.color = "#333";
            });
            //把对应的选项卡的内容显示出来
            var tabDom = document.getElementById("content").children[this.index];
            tabDom.style.display = "block";
            //拿它的父亲对象
            _this.siblings(tabDom,function(){
              this.style.display = "none";
            });
          };
        }
      },
    },
    components: {
      ElButton, heads, elenav,
      foots,
    }
  }
</script>

<style>
  .content .experience .experience-tab .active {
    background: #b11e25;
    color: #fff;
    border: 1px solid #b11e25;
  }

  /*.experience #content {*/
    /*width: 100%;*/
    /*height: 100%;*/
    /*overflow: hidden;*/
    /*position: relative;*/
  /*}*/

  /*.experience .picture-list {*/
    /*!*position: absolute;*!*/
    /*!*top: 0px;*!*/
    /*!*left: 0px;*!*/
    /*height: 100%;*/
    /*width: 100%;*/
  /*}*/

</style>
