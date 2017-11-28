<template>
  <div v-cloak>
    <div class="fl">
      <div style="margin-top: 46px;">
        <swiper :options="swiperOption" ref="mySwiper">
          <template v-for="(item, index) in data.picture">
            <swiper-slide :style="{background: 'url('+ item.url +') no-repeat',
            backgroundSize: 'cover',height: '300px'}">
            </swiper-slide>
          </template>
          <div class="swiper-pagination" slot="pagination"></div>
        </swiper>
      </div>
    </div>
    <!--<ele-swipers :list="list"></ele-swipers>-->
    <div class="experience clear">
      <div class="tb-wrap">
        <div class="right-select">
          <div class="select-title">
            <span class="c_5d6060">{{ list.goods_name }}</span>
          </div>
          <div class="select-text">
            <span>{{ list.goods_remark }}</span>
          </div>
          <div class="select-price">
            <span>¥{{ list.shop_price }}</span>
          </div>
          <el-button class="fr" @click="showLayer()">开始冲印</el-button>
        </div>
      </div>
    </div>
    <div class="detailpage" style="padding-bottom: 100px;" v-html="list.goods_content">
      <!--<img src="../../../static/images/45.png" alt="" class="w100 h100">-->
    </div>
    <div class="thislayer" v-show="layer" @click="goLayer()"></div>
    <div class="item-layer" v-show="layer">
      <div class="item-shop-msg">
        <div class="shop-pic fl" :style="{background: 'url('+ list.shotcut +') no-repeat'}"></div>
        <div class="shop-desc fl">
          <p class="ft-16 c_5d6060">{{ list.goods_name }}</p>
          <span class="ft-14">单价 : <i class="money">{{ list.shop_price }}元</i></span>
        </div>
        <div class="iconfont fr icon-guanbi c_5d6060" @click="goLayer()"></div>
      </div>
      <div class="select-color clear" v-for="(fmt,pindex) in list.myspec">
        <span class="left fl">{{ fmt.spec }}：</span>
        <ul class="right clearfix fl">
          <guige :value="val.id" :text="val.item" v-for="val in fmt.item"
                 @changeGuige="changeGuige(pindex,val.id,val.item)"></guige>
        </ul>
      </div>
      <div class="select-num clear" style="display: none;">
        <span class="left fl">数量：</span>
        <div class="item-amount ">
          <el-button class="no-minus fl" @click="changeNumber(list, -1)" :class="{'disabled':list.sales_sum <= 1}">-</el-button>
          <el-input type="text" class="fl" placeholder="0" v-model="list.sales_sum" readonly></el-input>
          <el-button class="add-max fl" @click="changeNumber(list, 1)" :class="{'disabled': list.sales_sum >= 1}">+</el-button>
        </div>
      </div>
      <div class="select-btn clear">
        <el-button class="ft-16" @click="goToUpload(list.goods_id)">去上传照片</el-button>
      </div>
    </div>
  </div>
    <!-- content end -->
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'
  import elenav from '@/components/top/Nav.vue'
  import other from '@/components/pages/other.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElInputNumber from "../../../node_modules/element-ui/packages/input-number/src/input-number";

  import eleSwipers from '@/components/pages/swiper'

  import guige from '@/components/pages/guige'
  import { swiper, swiperSlide } from 'vue-awesome-swiper'

  export default {
    name: 'dingzhi',
    data() {
      return {
        list: [],
        data: {
          picture: [],
          dtype: 1,
          currGuiGe: "",
          currSize: "",
        },
        // 用于保存每件商品的对象
        shopItem: {},
        //  用于保存用户添加到购车的商品数组
        buyLists: [],
        guigeIndex: 0,
        currentIndex: 0,
        layer: false,
        price: 0,
        charSID: 0,
        guige: [],
        guigeName: [],
        swiperOption: {
          autoplay: 30000,
          pagination: '.swiper-pagination',
          paginationClickable: true,
        },
      }
    },
    mounted () {
      this.getDataShop();
    },
    watch: {
      '$route'() {
        this.getDataShop();
      }
    },
    methods: {
      goToUpload(id) {
        if (this.guige.length == 0) {
          this.$message('请选择规格！');
          return false;
        }
        setTimeout(this.$router.push({ path: '/pages/onload', query: {id: id}}), 1000)
      },
      getDataShop() {
        this.$ajax.HttpGet(this.$api.get_content.GET_STOP_MSG + '?id=' + this.$route.query.id).then((res) => {
          this.list = res.data
          this.data.picture = JSON.parse(this.list.photo)
        });
      },
      checkGuige() {
        if (this.guige.length !== this.list.myspec) {
          return false;
        } else {
          for (let gg = 0; gg < this.guige.length; gg++) {
            if (typeof this.guige[gg] === 'undefined' || this.guige[gg] == '') {
              return false;
            }
          }
          return true;
        }
      },
      changeGuige(index, id, name) {
        this.$set(this.guige, index, id);
        this.$set(this.guigeName, index, name);
        if (!this.checkGuige) {
          return;
        }
        this.$ajax.HttpPost(this.$api.get_content.GET_POST_PRICE, {
          gid: this.list.goods_id,
          spec: this.guige.join('-').match(/\d+/g).toString().replace(',','-')
        }).then((res) => {
          for (let i in res.data) {
            this.charSID = res.data[i].sku_id;
            this.list.shop_price = res.data[i].price;
            this.list.goods_id = res.data[i].goods_id;
          }
        });
      },
      goLayer() {
        this.layer = false;
      },
      showLayer() {
        if (!this.layer) {
          this.layer = true;
        }
      },
      currentGuiGeIndex(index, item) {
        this.guigeIndex = index;
        this.data.currGuiGe = item;
      },
      currentGoIndex(index, item) {
        this.currentIndex = index;
        this.data.currSize = item;
      },
      changeNumber(item,flag) {
        //  大于0为加
        if (flag > 0) {
          //  item数量自增1
          item.sales_sum++;
        } else {
          //  item数量自减1
          item.sales_sum--;
          if(item.sales_sum <= 1) {
            item.sales_sum = 1;
          }
        }
      },
      goCart() {
        let that = this;
        if (this.list.nums == 0) {
          this.$message({
            message: '请增加商品！谢谢啦！亲 (☄⊙ω⊙)☄',
            type: 'warning'
          });
          return;
        }
        var optionItem = {
          id: this.list.id,
          shotcut: this.list.shotcut,
          title: this.list.title,
          desc: this.list.desc,
          nums: this.list.nums,
          price: parseInt(this.list.price),
          guiGe: this.data.guige,
          size: this.data.currSize,
        };
        this.$store.commit('SETCARTOBJ',optionItem);
        this.$message({
          message: '恭喜你，加入购物车成功！',
          type: 'success'
        });
        setInterval(function() {
          location.reload();
          that.$router.push({ path: '/cart/cart' });
        },500);
      }
    },
    components: {
      ElInputNumber,
      ElInput,
      ElButton,
      heads,
      elenav,
      foots,
      other,
      guige,
      eleSwipers,
      swiper,
      swiperSlide
    }
  }
</script>

<style>

  .right-select .select-size {
    height: 38px;
  }

  .right-select .select-size .left {
    float: left;
    width: 100px;
    line-height: 35px;
  }

  .right-select .select-num {
    color: #666;
  }
  .right-select .select-num .left {
    display: inline-block;
    width: 100px;
    line-height: 36px;
  }

  .select-num .item-amount .el-input {
    width: 75px;
  }

  .select-num .item-amount .el-input .el-input__inner {
    text-align: center;
    font-weight: bold;
    margin-left: 0px;
  }

  .select-num .item-amount .el-input, .add-max {
    margin-left: 10px;
    font-weight: bold;
  }

  .right-select .select-num .less, .right-select .select-num .add {
    display: inline-block;
    width: 36px;
    height: 36px;
    border-radius: 5px;
    background: #f6f7f7;
    text-align: center;
    line-height: 36px;
  }
  .right-select .select-num .num {
    display: inline-block;
    width: 75px;
    height: 36px;
    margin: 0 10px;
    border-radius: 5px;
    background: #f6f7f7;
    text-align: center;
    line-height: 36px;
  }
  .right-select .select-btn .el-button {
    width: 145px;
    height: 43px;
    text-align: center;
    color: #fff;
    background: #414042;
    border: 2px solid #333333;
    box-sizing: border-box;
    margin: 65px 0px;
    border-radius: 0px;
  }
  .right-select .select-btn a {
    display: block;
    width: 145px;
    height: 43px;
    color: #fff;
  }

  .content-bottom table .thead tr {
    border: 2px solid #3e3a39;
  }

  .content-bottom table .thead tr th {
    text-align: center;
    border: 2px solid #3e3a39;
    height: 35px;
  }


  .item-layer {
    position: fixed;
    bottom: 0px;
    width: 100%;
    background: #eee;
    z-index: 105;
    padding-bottom: 50px;
  }

  .item-layer .item-shop-msg {
    margin: 0px 10px;
    border-bottom: 1px solid #bfbfbf;
    height: 65px;
    position: relative;
  }

  .icon-guanbi {
    position: absolute;
    top: 22px;
    right: -8px;
    font-size: 28px;
  }

  .item-layer .item-shop-msg .shop-desc {
    margin: 10px 0 0 10px;
    width: 65%;
  }

  .item-shop-msg .shop-desc p {
    height: 25px;
    overflow: hidden;
    text-overflow: ellipsis;

  }

  .shop-desc .money {
    color: #b11e25;
  }

  .item-shop-msg .shop-pic {
    width: 75px;
    height: 75px;
    border-radius: 5px;
    background: #fff;
    position: relative;
    top: -20px;
  }

  .thislayer {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.5);
    z-index: 100;
  }

  .item-layer .select-color ,
  .item-layer .select-size ,
  .item-layer .select-num {
    margin: 10px 20px;
    overflow: hidden;
  }


  .item-layer .select-color .left ,
  .item-layer .select-size .left ,
  .item-layer .select-num .left{
    display: inline-block;
    width: 85px;
    line-height: 35px;
    color: #9fa0a0;
  }

  .item-layer .select-size .right li ,
  .item-layer .select-color .right li {
    width: 85px;
    height: 35px;
    float: left;
    background: #fff;
    text-align: center;
    line-height: 32px;
    color: #9fa0a0;
    box-sizing: border-box;
    border: 2px solid #9fa0a0;
    border-radius: 5px;
  }

  .item-layer .select-size .right .active,
  .item-layer .select-color .right .active {
    background: #b11e25;
    color: #fff;
    border: 2px solid #b11e25;
  }

  .item-layer .select-size .right li,
  .item-layer .select-color .right li{
    margin: 5px 10px 0px 0px;
  }

  .item-layer .select-size .right li:nth-child(2n) ,
  .item-layer .select-color .right li:nth-child(2n){
    margin: 5px 0px 0px 0px;
  }

  .select-btn .el-button {
    position: absolute;
    bottom: 0px;
    width: 100%;
    border: 1px solid #414042;
    background: #414042;
    color: #fff;
    height: 2.7rem;
    border-radius: 0;
  }

  .tb-wrap {
    margin: 10px 10px;
  }

  .right-select {
    font-size: 18px;
    color: #717171;
    padding: 10px 0px 15px;
    position: relative;
    border-bottom: 1px solid #dcdddd;
  }
  .right-select .select-title, .right-select .select-text  {
    line-height: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .right-select .select-text {
    font-size: 15px;
    -webkit-line-clamp: 1;
    line-height: 25px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .right-select .el-button {
    position: absolute;
    right: 0px;
    top: 58px;
    color: #fff;
    padding: 10px 30px;
    background: #b11e25;
    border: 1px solid #b11e25;
  }

  .right-select .select-title span {
    font-size: 16px;
  }



  .right-select .select-price {
    font-size: 1.3rem;
    color: #e64147;
    font-weight: bold;
    line-height: 40px;
  }

  .detailpage p img {
    width: 100%;
  }

</style>

<style type="text/css">
  @media screen and (max-device-width: 414px) {
    .swiper-container-horizontal {
      width: 414px;
    }
  }

  @media screen and (max-device-width: 412px) {
    .swiper-container-horizontal {
      width: 412px;
    }
  }

  @media screen and (max-device-width: 375px) {
    .swiper-container-horizontal {
      width: 375px;
    }
  }

  @media screen and (max-device-width: 360px) {
    .swiper-container-horizontal {
      width: 360px;
    }
  }

  @media screen and (max-device-width: 320px) {
    .swiper-container-horizontal {
      width: 320px;
    }
  }
</style>
