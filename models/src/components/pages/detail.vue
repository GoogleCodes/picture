<template>

  <div>
    <!-- content start -->
    <!--<el-carousel style="margin-top: 46px;">-->
      <!--<template>-->
        <!--<el-carousel-item>-->
          <!--<img src="../../../static/images/banner_xiadan.png" alt="" class="w100 h100">-->
        <!--</el-carousel-item>-->
      <!--</template>-->
    <!--</el-carousel>-->

    <ele-swipers></ele-swipers>

    <div class="experience clear">
      <div class="tb-wrap">
        <div class="right-select">
          <div class="select-title">
            <span class="c_5d6060">照片冲印、手机上传打印照片</span>
          </div>
          <div class="select-text">
            <span>定格记忆 冲印美好</span>
          </div>
          <div class="select-price">
            <span>¥58.5</span>
          </div>
          <el-button class="fr" @click="showLayer()">开始冲印</el-button>
        </div>
      </div>
    </div>
    <div class="detailpage" style="padding-bottom: 100px;">
      <img src="../../../static/images/45.png" alt="" class="w100 h100">
    </div>

    <div class="thislayer" v-show="layer" @click="goLayer()"></div>
    <div class="item-layer" v-show="layer">
      <div class="item-shop-msg">
        <div class="shop-pic fl"></div>
        <div class="shop-desc fl">
          <p class="ft-16 c_5d6060">照片冲印、手机上传打印照片</p>
          <span class="ft-14">单价 : <i class="money">0.60元</i></span>
        </div>
        <div class="iconfont fr icon-guanbi c_5d6060" @click="goLayer()"></div>
      </div>
      <div class="select-color clear">
        <span class="left fl">相纸：</span>
        <ul class="right clearfix fl">
          <li class="right" v-for="(item, index) in 2" :class="{'active':index == guigeIndex}"
              @click="currentGuiGeIndex(index, item.a)">123</li>
        </ul>
      </div>
      <div class="select-size clear">
        <span class="left fl">尺寸：</span>
        <ul class="right clearfix fl">
          <li v-for="(list,index) in 2"
              :class="{'active':index == currentIndex}"
              @click="currentGoIndex(index, list.one)">11</li>
        </ul>
      </div>
      <div class="select-num clear">
        <span class="left fl">数量：</span>
        <!--<div class="item-amount ">-->
          <!--<el-button class="no-minus fl" @click="changeNumber(list, -1)" :class="{'disabled':list.nums <= 1}">-</el-button>-->
          <!--<el-input type="text" class="fl" placeholder="0" v-model="list.nums" readonly></el-input>-->
          <!--<el-button class="add-max fl" @click="changeNumber(list, 1)" :class="{'disabled': list.nums >= 1}">+</el-button>-->
        <!--</div>-->
      </div>
      <div class="select-btn clear">
        <router-link :to="{ path: '/pages/onload', query:{id: 1}}" class="w100 h100 block">
          <el-button class="ft-16">去上传照片</el-button>
        </router-link>
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

  export default {
    name: 'dingzhi',
    data() {
      return {
        list: this.$storageGet('detail'),//JSON.parse(localStorage.getItem('detail')),
        data: {
          pic: [{
            "src" : 'https://img.alicdn.com/simba/img/TB1OsO5cnZRMeJjSsppSutrEpXa.jpg',
          },{
            "src": 'https://img.alicdn.com/simba/img/TB1hwrqeMoQMeJjy0FoSuwShVXa.jpg'
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
        layer: false,
        price: 0,
      }
    },
    watch: {

    },
    created () {

    },
    methods: {
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
    height: 2.5rem;
    border-radius: 0;
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
