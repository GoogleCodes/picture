<template>
  <div class="bgcolor">
    <div class="content clear" style="margin: 0px auto 25px;">
      <div class="con-pro" style="height: 360px;" v-loading="load.load_data" element-loading-text="正在加载中...">
        <img :src="list.shotcut" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience" style="margin: 50px auto;background: #fff">
        <detailSwiper :listpic="swiperList"></detailSwiper>
        <div class="tb-wrap fl" v-loading="load.load_data" element-loading-text="正在加载中...">
          <div class="right-select fr">
            <div class="select-title">{{ list.goods_name }}<span>{{ list.goods_remark }}</span></div>
            <div class="select-text">{{ list.good_desc }}</div>
            <div class="select-price">¥{{ list.shop_price }}</div>
            <div class="select-color clear" v-for="(fmt,pindex) in list.myspec">
              <div class="left fl">{{ fmt.spec }}：</div>
              <ul style="width: 75%;float: right;" class="fl">
                <guige :value="val.id" :text="val.item" v-for="val in fmt.item"
                       @changeGuige="changeGuige(pindex,val.id,val.item)"></guige>
              </ul>
            </div>
            <div class="select-num clear" v-if="list.cat_id == 35">
              <span class="left fl">数量：</span>
              <div class="item-amount ">
                <el-button class="no-minus fl" @click="changeNumber(list, -1)"
                           :class="{'disabled':list.sales_sum <= 1}" style="margin-left: 0;">-</el-button>
                <el-input type="text" class="fl" placeholder="0"
                          v-model="list.sales_sum" readonly></el-input>
                <el-button class="add-max fl" @click="changeNumber(list, 1)"
                           :class="{'disabled': list.sales_sum >= 1}">+</el-button>
              </div>
            </div>
            <div v-else></div>
            <div class="select-btn clear">
              <!--<router-link :to="{ path: '/pages/onload' }" v-if="$route.query.isup == 0">-->
                <!--<el-button class="ft-16">开始冲印</el-button>-->
              <!--</router-link>-->
              <el-button class="ft-16" @click="addCart()">加入购物车</el-button>
            </div>
          </div>
        </div>
        <div class="detail-bottom clear">
          <div class="product-title">PRESENTATION</div>
          <span class="product-text">商品详情</span>
          <div class="content-top clearfix" v-html="list.goods_content"></div>
        </div>
      </div>
      <div class="w1200 mauto clear">
        <div class="hunsha-product-else">
          <div class="container clear">
            <div class="product-title">PRESENTATION</div>
            <span class="product-text">浏览其他</span>
            <ul class="product-list clearfix">
              <template v-for="(item, index) in randomList">
                <li class="product-item" @click="watchElse(item.goods_id)">
                  <div class="pic">
                    <template v-for="(x,i) in item.goods_thumb">
                      <img :src="x.url">
                    </template>
                  </div>
                  <div class="item-m-desc">
                    <div class="item-price ft-22 c_e64147">¥{{ item.shop_price }}</div>
                    <div class="item-title">{{ item.goods_name }}</div>
                    <div class="item-text">{{ item.goods_remark }}</div>
                  </div>
                </li>
              </template>
            </ul>
          </div>
        </div>
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

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'
  import guige from '@/components/pages/guige'

  export default {
    name: 'dingzhi',
    data() {
      return {
        list: {},
        swiperList: [],
        data: {
          dtype: 1,
          currGuiGe: "",
          currSize: "",
        },
        load: {
          load_data: false,
        },
        choose:[],
        charItem: '',
        charId: 0,
        charSID: 0,
        myspecList: {}, //  用于保存用户添加到购车的商品数组
        active: false,
        randomList: [],
        guige: [],
        guigeName: [],
        chSize: [],
        chName: [],
      }
    },
    mounted() {
      this.getDataShop();
      console.log(this.$route.query.isup,'+-');
    },
    components: {
      ElInputNumber,
      ElInput,
      ElButton,
      elenav,
      other,
      guige,
      detailSwiper,
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
      getGuigeName() {
        if (this.guigeName <= 0) {
          return '请选择商品规格和数量';
        }
        return '已选择"' + this.guigeName.join('-').replace(/-/g,'') + '"';
      },
    },
    methods: {
      getFilterArray(array) {
        const res = [];
        const json = {};
        for (let i in array) {
          const _self = array[i];
          if(!json[_self]) {
              res.push(_self);
              json[_self] = 1;
          }
        }
        return res;
      },
      watchElse(id) {
        this.$router.replace({
          path: '/pages/detail',
          query: {id: id}
        })
      },
      getDataShop() {
        this.load.load_data = true;
        this.load_shotcut = true;
        this.$ajax.HttpGet(this.$api.get_content.GET_STOP_MSG + '?id=' + this.$route.query.id).then((res) => {
          let that = this;
          this.load.load_data = false;
          switch (true) {
            case res.code == 1:
              this.list = res.data;
              this.swiperList = JSON.parse(res.data.photo);
              that.myspecList = this.list.myspec;
              //  获取随机商品
              this.$ajax.HttpGet(this.$api.get_other.GET_OTHER + '?cid=' + this.list.cat_id + '&num=' + 3).then((res) => {
                this.randomList = res.data;
              });
              return true;
            case res.data.code == 0:
              return false;
            default:
          }
          if (res.data.is_on_sale == 0) {
            this.$message({
              message: '商品已下架',
              type: 'warning'
            });
            return false;
          }
        });
      },
      checkGuige() {
        if (this.guige.length !== this.myspecList.length) {
          return false;
        } else {
          for (let g in this.guige) {
            if (typeof this.guige[g] == 'undefined' || this.guige[g] == '') {
              return false;
            }
          }
          return true;
        }
      },
      choseSize(index, char) {
        this.currentSize = index;
        let arr = [], brr = [];
        arr.push(char.id);
        brr.push(char.item);
        this.chSize = arr;
        this.chName = brr;
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
      addCart() {
        let that = this;
        try {
          if (this.$route.query.isup == 1) {
            switch(true) {
              case this.get_user_info.user == undefined:
                this.$message('亲，请去登录一下');
                setTimeout(() => {
                  this.$router.push({ path: '/user/login' });
                }, 2000);
                return false;
              case this.guige.length == 0:
                this.$message({
                  message: '请选择规格！',
                  type: 'warning'
                });
                return false;
              case this.list.sales_sum == 0:
                this.$message({
                  message: '请增加商品！谢谢啦！',
                  type: 'warning'
                });
                return false;
              default:
                break;
            }
          }
          const json = {
            uid: this.get_user_info.user.id,
            gid: this.$route.query.id,
            sid: this.charSID,
            num: this.list.sales_sum,
            price: this.list.shop_price,
            upimg: 'a',
            specdata: this.guigeName.join('-').replace(/-/g,'')
          };
          this.$ajax.HttpPost(this.$api.get_content.POST_CART_DATA,json).then((res) => {
            setTimeout(() => {
              that.$router.push({ path: '/cart/cart' });
            }, 500);
          });
        } catch(e) {}
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
    line-height: 35px;
    color: #000;
    margin-bottom: 15px;
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
  .right-select .select-color {
    line-height: 35px;
    padding: 10px 0px;
    min-height: 35px;
    margin-top: 15px;
  }
  .right-select .select-color .left {
    display: inline-block;
    width: 100px;
  }

  .right-select .select-color ul li {
    border-radius: 5px;
    margin: 0px 20px 10px 0px;
    width: 42%;
    text-align: center;
    border: 1px solid #f2f2f2;
    cursor: pointer;
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
    margin: 0px 17px 17px 0;
  }

  .right-select .select-size .right .active, .right-select .select-color .active  {
    border: 1px solid #b11e25;
    background: #b11e25;
    color: #fff;
  }

  .right-select .select-num {
    color: #666;
    padding-top: 25px;
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
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .view .arrow-right {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .content-top p {
    font-size: 26px;
    line-height: 100px;
  }

  .content-top p img {
    width: 80%;

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
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -9px;
    width: 9px;
    height: 18px;
    z-index: 10;
  }

  .preview .arrow-right {
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

  /* 浏览其他 */
  .hunsha-product-else {
    text-align: center;
    margin-top: 70px;
    padding-bottom: 80px;
    background: #f9f9f9;
  }
  .hunsha-product-else .product-title {
    font-size: 30px;
    color: #000;
    text-align: center;
    font-family: PingFangSC-Ultralight, sans-serif;
  }
  .hunsha-product-else .product-text {
    position: relative;
    font-size: 18px;
    color: #333;
    line-height: 50px;
  }
  .hunsha-product-else .product-text:before,
  .hunsha-product-else .product-text:after {
    content: '';
    position: absolute;
    width: 24px;
    height: 0;
    border-bottom: 1px solid #717171;
    top: 50%;
  }
  .hunsha-product-else .product-text:before {
    left: -45px;
  }
  .hunsha-product-else .product-text:after {
    right: -45px;
  }
  .product-list{
    width: 1250px;
    margin-top: 30px;
  }
  .product-list .product-item {
    float: left;
    width: 285px;
    height: 330px;
    background: #fff;
    margin: 20px 9px 0 0;
    text-align: center;
    border: 4px solid #fff;
    transition: 0.5s;
  }

  .product-list .product-item:nth-child(4n) {
    margin: 20px 0 0 0;
  }

  .product-list .product-item .pic {
    width: 100%;
    background: #fff;
  }
  .product-list .product-item .pic img{
    width: 240px;
    height: 180px;
    margin: 16px;
  }

  .product-list .product-item .item-price {
    margin-top: 10px;
  }

  .item-m-desc {
    text-align: left;
    padding: 0px 20px;
  }

  .product-list .product-item .item-title {
    font-size: 16px;
    color: #000;
    line-height: 25px;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .product-list .product-item .item-text {
    font-size: 14px;
    color: #333;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    line-height: 30px;
  }
  .product-list .product-item:hover {
    border: 4px solid #b11e25;
    background: #b11e25;
    transition: 0.5s;
  }

  .product-list .product-item:hover .item-price {
    color: #fff;
  }

  .product-list .product-item:hover .item-title {
    color: #fff;
  }
  .product-list .product-item:hover .item-text {
    color: #fff;
  }

</style>
