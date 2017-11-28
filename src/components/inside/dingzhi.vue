<template>
  <div>
    <!-- content start -->


    <div class="content clear" style="margin: 0px auto;" v-loading="load_data" element-loading-text="正在加载中...">
      <div class="con-pro" style="height: 360px;">
        <img src="../../assets/images/19.png" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience">
        <div class="Experience-title">
          <img src="../../assets/images/21.png" alt="">
        </div>
        <div class="experience-tab" id="tabing">
          <ul>
            <template v-for="(item, index) in typeList">
              <li class="tab-chonse fl" @click="getChoose(item.id)" :class="{'active':data.dType == item.id}">
                  <div @click="chonseTab(item.id)">{{ item.key }}</div>
              </li>
            </template>
          </ul>
        </div>
        <div id="content">
          <div class="picture-list" v-show="picVisiList">
            <template v-for="item in photoList">
              <div class="experience-list fl" v-show="nullShop">
                <router-link :to="{ path: '/pages/onloadtwo', query: {id: item.photo_id }}" class="block">
                  <div class="experience-pic">
                    <template v-for="(k,i) in item.photo_thumb">
                      <img :src="k.url" style="width: 100%;height: 100%;" alt="" >
                    </template>
                  </div>
                  <div class="experience-desc ft-18">{{ item.photo_name }}</div>
                </router-link>
              </div>
            </template>
            <div class="NullShop" v-show="!nullShop">
              <i class="iconfont icon-kong"></i>
              <div>
                <span>暂时没有商品</span>
              </div>
            </div>
          </div>
          <div class="picture-list" v-show="!picVisiList">
            <template v-for="item in photoList">
              <div class="experience-list fl" v-show="nullShop">
                <router-link :to="{ path: '/pages/onloadtwo', query: {id: item.photo_id }}" class="block">
                  <div class="experience-pic">
                    <template v-for="(k,i) in item.photo_thumb">
                      <img :src="k.url" style="width: 100%;height: 100%;" alt="" >
                    </template>
                  </div>
                  <div class="experience-desc ft-18">{{ item.photo_name }}</div>
                </router-link>
              </div>
            </template>
            <div class="NullShop" v-show="!nullShop">
              <i class="iconfont icon-kong"></i>
              <div>
                <span>暂时没有商品</span>
              </div>
            </div>
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
          tabIndex: 1,
        },
        load_data: false,
        nullToast: false,  //  提示空商品
        nullShop: false,
        shopPages: {},
        typeList: [],
        photoList: [],
        picVisiList: false,
      }
    },
    created () {
      this.getTypeList();
      this.chonseTab(1);
      this.getChoose(1);
    },
    methods: {
      getChoose(type) {
        if(this.data.dType == type) return true;
        this.data.dType = type;
      },
      getTypeList() {
        this.$ajax.HttpGet('/api/home/photo/typeList').then((res) => {
          this.typeList = res.data;
        });
      },
      getPhotoList() {

      },
      chonseTab(id) {
        this.load_data = true;
        this.$ajax.HttpGet('/api/home/photo/photoList?cid=' + id).then((res) => {
          this.load_data = false;
          this.photoList = res.data.data;
          this.shopPages = res.data;
          if (this.photoList.length != 0) {
            this.nullShop = true;
          } else {
            this.nullShop = false;
          }
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

  /* NullShop start */
  .NullShop {
    text-align: center;
    height: 250px;
    font-size: 26px;
    line-height: 0px;
  }
  .NullShop .icon-kong {
    font-size: 115px;
    line-height: 180px;
  }
  /* NullShop end */

</style>
