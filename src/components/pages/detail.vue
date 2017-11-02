<template>
  <div class="bgcolor">
    <div class="content clear" style="margin: 0px auto;">
      <div class="con-pro" style="height: 360px;">
        <img src="../../assets/images/19.png" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience" style="margin: 70px auto;background: #fff">

        <!-- banner start -->
        <detailSwiper></detailSwiper>
        <!-- banner end -->

        <div class="exper-pic fl" style="display: none;">
          <div class="exper-pic-wrap">
            <el-carousel height="420px">
              <template v-for="item in data.pic">
                <el-carousel-item>
                  <img :src="item.src" alt="" style="width: 100%;height: 420px;">
                </el-carousel-item>
              </template>
            </el-carousel>
          </div>
          <div class="exper-pic-item">
            <div class="a1" v-for="item in 5"></div>
          </div>
        </div>

        <div class="tb-wrap fl">
          <div class="right-select fr">
            <div class="select-title">{{ list.title }}<span>{{ list.title_desc }}</span></div>
            <div class="select-text">{{ list.desc }}</div>
            <div class="select-price">¥{{ list.price }}</div>
            <div class="select-color">
              <span class="left fl">款色：</span>
              <ul>
                <li class="right" v-for="(item, index) in list.guige" :class="{'active':index == guigeIndex}"
                    @click="currentGuiGeIndex(index, item.a)">{{ item.a }}</li>
              </ul>
            </div>
            <div class="select-size clear">
              <span class="left">尺寸：</span>
              <ul class="right clearfix">
                <li v-for="(list,index) in list.size"
                    :class="{'active':index == currentIndex}"
                    @click="currentGoIndex(index, list.one)">{{ list.one }}</li>
              </ul>
            </div>
            <div class="select-num">
              <span class="left fl">数量：</span>
              <div class="item-amount ">
                <el-button class="no-minus fl" @click="changeNumber(list, -1)"
                           :class="{'disabled':list.nums <= 1}">-</el-button>
                <el-input type="text" class="fl" placeholder="0"
                          v-model="list.nums" readonly></el-input>
                <el-button class="add-max fl" @click="changeNumber(list, 1)"
                           :class="{'disabled': list.nums >= 1}">+</el-button>
              </div>
            </div>
            <div class="select-btn clear">
              <el-button class="ft-16" @click="goCart()">加入购物车</el-button>
            </div>
          </div>
        </div>

        <div class="detail-bottom clear">
          <div class="product-title">PRESENTATION</div>
          <span class="product-text">商品详情</span>
          <div class="content-top clearfix">
            <div class="pic-left">
              <img src="../../../static/images/33.png" alt="" class="w100 h100">
            </div>
            <div class="text-right">
              <div class="one">我们专注于</div>
              <div class="two">We focus on the selection of raw materials</div>
              <div class="three">原材料的精挑细选</div>
              <div class="text-vertical ft-18">
                <p>还原画芯真实色彩</p>
                <p>佳能高级打印机准确输出</p>
                <p>高仿颜料纹理质感</p>
                <p>进口原画芯高清质感图</p>
                <p>质感卓越</p>
              </div>
            </div>
          </div>
          <div class="content-bottom">
            <!-- 底部表格 -->
            <table>
              <thead class="thead">
                <tr>
                  <th>产品名称</th>
                  <th>啡色古典</th>
                  <th>挡板材质</th>
                  <th>白玻璃/有机板</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <div class="w1200 mauto clear" style="overflow: hidden;">
        <other :cid="list.id" :number="list.nums"></other>
      </div>

    </div>
    <!-- content end -->
  </div>

</template>


<script type="text/javascript">

  import elenav from '@/components/top/Nav.vue'
  import other from '@/components/pages/other.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElInputNumber from "../../../node_modules/element-ui/packages/input-number/src/input-number";

  import detailSwiper from '@/components/pages/swiper'

  export default {
    name: 'dingzhi',
    data() {
      return {
        list: JSON.parse(localStorage.getItem('detail')),
        data: {
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
      }
    },
    watch: {

    },
    created () {
      
    },
    mounted() {

    },
    components: {
      ElInputNumber,
      ElInput,
      ElButton,
      elenav,
      other,
      detailSwiper,
    },
    computed: {

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
        if (localStorage.getItem('user_info') === 'undefined') {
          this.$message('亲，请去登录一下');
          setTimeout(() => {
            this.$router.push({ path: '/user/login' });
          }, 2000);
          return false;
        } else if (this.list.nums === 0) {
          this.$message({
            message: '请增加商品！谢谢啦！',
            type: 'warning'
          });
          return false;
        }
        var option = {
          id: this.list.id,
          goods: {
            img: 'http://i1.mifile.cn/a1/pms_1474859997.10825620!80x80.jpg',
            descript: this.list.title,
          },
          desc: this.list.desc,
          number: this.list.nums,
          price: parseInt(this.list.price),
          guiGe: this.data.guige,
          size: this.data.currSize,
        };
        this.$store.commit('SET_CART_OBJ',option);
        this.$message({
          message: '恭喜你，加入购物车成功！',
          type: 'success'
        });
        setInterval(function() {
          that.$router.push({ path: '/cart/cart' });
          location.reload();
        },500);
      }
    }
  }
</script>

<style>
  .right-select {
    width: 400px;
    font-size: 18px;
    color: #717171;
  }
  .right-select .select-title {
    font-size: 26px;
    color: #000;
  }
  .right-select .select-title span {
    font-size: 14px;
    padding-left: 10px;
  }
  .right-select .select-text {
    font-size: 15px;
    line-height: 50px;
  }
  .right-select .select-price {
    font-size: 24px;
    color: #e54147;
    border-bottom: 1px solid #ccc;
    padding-bottom: 20px;
  }
  .right-select .select-color .left {
    display: inline-block;
    width: 100px;
    line-height: 80px;
  }

  .right-select .select-size {
    height: 38px;
  }

  .right-select .select-size .left {
    float: left;
    width: 100px;
    line-height: 35px;
  }
  .right-select .select-size .right {
    float: left;
    width: 295px;
    cursor: pointer;
    margin-bottom: 20px;
  }


  .right-select .select-size .right li, .right-select .select-color .right {
    float: left;
    width: 125px;
    height: 32px;
    margin: 0 18px 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
    line-height: 32px;
    font-size: 15px;
  }

  .right-select .select-color .right {
    margin: 18px 17px 0 0;
  }

  .right-select .select-size .right .active, .right-select .select-color .active  {
    border: 1px solid #b11e25;
    background: #b11e25;
    color: #fff;
  }

  .right-select .select-num {
    color: #666;
  }
  .right-select .select-num .left {
    display: inline-block;
    width: 100px;
    line-height: 36px;
  }

  .select-num .item-amount {
    height: 40px;
  }

  .select-num .item-amount .no-minus {
    background: #f7f8f8;
    font-weight: bold;
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

  .detail-bottom {
    text-align: center;
    padding-top: 45px;
  }
  .detail-bottom .product-title {
    font-size: 30px;
    color: #000;
    text-align: center;
  }
  .detail-bottom .product-text {
    position: relative;
    font-size: 18px;
    color: #333;
    line-height: 50px;
  }
  .detail-bottom .product-text:before,
  .detail-bottom .product-text:after {
    content: '';
    position: absolute;
    width: 24px;
    height: 0;
    border-bottom: 1px solid #717171;
    top: 50%;
  }
  .detail-bottom .product-text:before {
    left: -45px;
  }
  .detail-bottom .product-text:after {
    right: -45px;
  }
  .detail-bottom .content-top {
    padding-top: 60px;
    margin: 0 40px 48px;
  }
  .detail-bottom .content-top .pic-left {
    float: left;
    width: 570px;
    height: 754px;
  }

  .detail-bottom .content-top .text-right {
    /* 右侧文本 */
    float: right;
    width: 354px;
    margin-right: 115px;
    padding-top: 140px;
    text-align: center;
  }
  .detail-bottom .content-top .text-right .one {
    font-size: 40px;
    font-weight: lighter;
  }
  .detail-bottom .content-top .text-right .two {
    font-size: 10px;
    line-height: 40px;
  }
  .detail-bottom .content-top .text-right .three {
    font-size: 40px;
  }
  .detail-bottom .content-top .text-right .text-vertical {
    display: flex;
    height: 300px;
    flex-direction: row-reverse;
    justify-content: space-around;
    align-items: center;
    padding: 0 40px;
  }
  .detail-bottom .content-top .text-right .text-vertical p {
    writing-mode: tb-rl;
    color: #727171;
  }
  .detail-bottom .content-bottom {
    margin: 0px 45px 100px;
    color: #3e3a39;
  }
  .detail-bottom .content-bottom table {
    width: 754px;
    height: 334px;
  }

  .content-bottom table .thead tr {
    border: 2px solid #3e3a39;
  }

  .content-bottom table .thead tr th {
    text-align: center;
    border: 2px solid #3e3a39;
    height: 35px;
  }

  /* preview */
  .pc-slide {
    margin: 23px;
    float: left;
  }

  .view .swiper-container {
    width: 660px;
    height: 500px;
  }

  .view .arrow-left {
    background: url('../../../static/images/detail/index_tab_l.png') no-repeat left top;
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .view .arrow-right {
    background: url('../../../static/images/detail/index_tab_r.png') no-repeat left bottom;
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .preview {
    width: 100%;
    margin-top: 10px;
    position: relative;
  }

  .preview .swiper-container {
    width: 430px;
    height: 82px;
    margin-left: 35px;
  }

  .preview .swiper-slide {
    width: 87px;
    height: 82px;
  }

  .preview .slide6 {
    width: 82px;
  }

  .preview .arrow-left {
    background: url('../../../static/images/detail/feel3.png') no-repeat left top;
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -9px;
    width: 9px;
    height: 18px;
    z-index: 10;
  }

  .preview .arrow-right {
    background: url('../../../static/images/detail/feel4.png') no-repeat left bottom;
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -9px;
    width: 9px;
    height: 18px;
    z-index: 10;
  }

  .preview img {
    padding: 1px;
  }

  .preview .active-nav img {
    padding: 0;
    border: 1px solid #F00;
  }
  /* preview */

</style>


<style scoped>
  .swiper-container {
    margin: 20px;
  }
  .swiper-slide {
    background-size: cover;
    background-position: center;
  }
  .gallery-top {
    height: 80%!important;
    width: 100%;
  }
  .gallery-thumbs {
    height: 20%!important;
    box-sizing: border-box;
    padding: 10px 0;
  }
  .gallery-thumbs .swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
  }
  .gallery-thumbs .swiper-slide-active {
    opacity: 1;
  }
</style>
