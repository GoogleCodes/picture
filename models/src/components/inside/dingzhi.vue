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
          <el-button class="tab-chonse fl" v-for="(item, index) in data.tabTitle"
                     :class="{'active':index == data.dType}"
                     @click="chonseTab(index, item)">{{ item.title }}</el-button>
        </div>
        <div id="content">
          <div class="picture-list" v-show="picVisiList">
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
          <div class="picture-list" v-show="!picVisiList">
            <template v-for="item in data.list">
              <div class="experience-list fl">
                <router-link :to="{ path: '/pages/detail'}" class="block">
                  <div class="experience-pic">
                    <img :src="item.pic" style="width: 100%;height: 100%;" alt="" >
                  </div>
                  <div class="experience-desc ft-18">邪神</div>
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
          tabTitle: [{
            title: '高雅现代相框',
          },{
            title: '字画相框',
          }],
          list: [],
          dType: 0,
          tabIndex: 1
        },
        picVisiList: false,
      }
    },
    created () {
      this.getPicItem();
    },
    methods: {
      chonseTab(index, item) {
        if (this.data.dType = index) {
          this.picVisiList = true
        } else {
          this.picVisiList = false
        }
      },
      getPicItem () {
        this.$http.get('../../../static/data/order.json').then((res) => {
          this.data.list = res.data.order;
        });
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

  .experience #content {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
  }

  .experience .picture-list {
    /*position: absolute;*/
    /*top: 0px;*/
    /*left: 0px;*/
    height: 100%;
    width: 100%;
  }

</style>
