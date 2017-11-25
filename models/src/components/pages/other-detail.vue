<template>
  <div style="background: #fff;">
    <div>
      <div style="margin-top: 46px;">
        <swiper :options="swiperOption" ref="mySwiper">
          <!-- slides -->
          <template v-for="(item, index) in data.pic">
            <swiper-slide  :style="{
                  background: 'url('+ item.src +') no-repeat',
                  backgroundSize: 'cover',height: '180px'}">
            </swiper-slide>
          </template>
          <div class="swiper-pagination" slot="pagination"></div>
          <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
          <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
        </swiper>
        <!-- swiper2 Thumbs -->
        <swiper style="display: none;height: 50px;background: #fff;" :options="swiperOptionThumbs" class="gallery-thumbs" ref="swiperThumbs">
          <template v-for="(item, index) in data.pic">
            <swiper-slide :style="{
                  background: 'url('+ item.src +') no-repeat',
                  width: '23%',
                  backgroundSize: 'cover'}">
            </swiper-slide>
          </template>
        </swiper>
      </div>
    </div>
    <div class="experience clear">
      <div class="tb-wrap">
        <div class="right-select fl">
          <div class="select-title">
            <span class="c_5d6060">照片冲印、手机上传打印照片</span>
          </div>
          <div class="select-text">
            <span>定格记忆 冲印美好</span>
          </div>
          <div class="select-price">
            <span>¥58.5</span>
          </div>
        </div>
        <div class="fr">

        </div>
      </div>
    </div>
    <div class="detailpage" style="padding-bottom: 100px;">
      <img src="../../../static/images/45.png" alt="" class="w100 h100">
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

  export default {
    name: 'dingzhi',
    data() {
      return {
        list: this.$storageGet('detail'),//JSON.parse(localStorage.getItem('detail')),
        data: {
          pic: [{
            "src" : '../../static/images/23.png',
          },{
            "src": '../../static/images/23.png'
          }],
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
        price: 0,
        swiperOption: {
          // swiper options 所有的配置同swiper官方api配置
          autoplay: 3000,
          notNextTick: true,
          direction: 'horizontal',
          grabCursor: true,
          pagination: '.swiper-pagination',
          prevButton: '.swiper-button-prev',
          nextButton: '.swiper-button-next',
          observeParents: true,
          spaceBetween: 10,
          debugger: true,

        },
        swiperOptionThumbs: {
          notNextTick: true,
          spaceBetween: 10,
          centeredSlides: true,
          slidesPerView: 'auto',
          touchRatio: 0.2,
          slideToClickedSlide: true
        },
      }
    },
    watch: {

    },
    mounted() {
      const mySwiper = this.$refs.mySwiper.swiper
      const swiperThumbs = this.$refs.swiperThumbs.swiper
      mySwiper.params.control = swiperThumbs
      swiperThumbs.params.control = mySwiper
    },
    computed: {

    },
    created () {

    },
    methods: {
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
          item.nums++;
        } else {
          //  item数量自减1
          item.nums--;
          if(item.nums <= 1) {
            item.nums = 1;
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
      eleSwipers
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

  .tb-wrap {
    margin: 10px 10px;
  }

  .right-select {
    font-size: 18px;
    color: #717171;
    padding: 0px 0px 15px;
    position: relative;
    border-bottom: 1px solid #dcdddd;
  }

  .right-select .el-button {
    position: absolute;
    right: 0px;
    top: 32px;
    color: #fff;
    padding: 10px 30px;
    background: #b11e25;
    border: 1px solid #b11e25;
  }

  .right-select .select-title span {
    font-size: 18px;
  }

  .right-select .select-text {
    font-size: 15px;
    line-height: 25px;
  }


  .right-select .select-price {
    font-size: 1.3rem;
    color: #e64147;
    font-weight: bold;
  }

</style>
