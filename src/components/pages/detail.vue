<template>
  <div class="bgcolor">
    <div class="content clear" style="margin: 0px auto 25px;">
      <div class="con-pro" style="height: 360px;">
        <img :src="list.shotcut" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience" style="margin: 0px auto;background: #fff">
        <!-- banner start -->
        <detailSwiper :listpic="swiperList"></detailSwiper>
        <!-- banner end -->

        <div class="tb-wrap fl">
          <div class="right-select fr">
            <div class="select-title">{{ list.goods_name }}<span>{{ list.goods_remark }}</span></div>
            <div class="select-text">{{ list.good_desc }}</div>
            <div class="select-price">¥{{ list.shop_price }}</div>
              <template v-for="(todo, index) in myspecList">
                <div class="select-color clear">
                  <div class="left fl">{{ todo.spec }}：</div>
                  <ul style="width: 75%;float: right;" class="fl">
                    <!--
                    <dome :list="myspecList" :values="list.id" :texts="list.item" v-for="(list,index) in todo.item" 
                          @click="changeGuige(index, list.id, list.item)"></dome>
                    -->
                    
                    <template>
                      <li v-for="(list,index) in todo.item" class="fl" 
                      :class="active" @click="changeGuige(index, list.id, list.item)">{{ list.item }}</li>
                    </template>
                    
                  </ul>
                </div>
              </template>
            <div class="select-num clear">
              <span class="left fl">数量：</span>
              <div class="item-amount ">
                <el-button class="no-minus fl" @click="changeNumber(list, -1)"
                           :class="{'disabled':list.sales_sum <= 1}">-</el-button>
                <el-input type="text" class="fl" placeholder="0"
                          v-model="list.sales_sum" readonly></el-input>
                <el-button class="add-max fl" @click="changeNumber(list, 1)"
                           :class="{'disabled': list.sales_sum >= 1}">+</el-button>
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
          <div class="content-top clearfix" v-html="list.goods_content"></div>
        </div>
      </div>

      <!--
        <div class="w1200 mauto clear" style="overflow: hidden;">
        <other :cid="list.id" :number="list.nums"></other>
      </div>
      -->
      

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
  import dome from '@/components/pages/dome'

  export default {
    name: 'dingzhi',
    data() {
      return {
        attributeName: [],   //存储了属性类型，就是['颜色','大小']
        attrList: [],        //存储了每个属性类型下的值
        chooseAttrList: [],        //存储当前选择的属性对象的linkto(属性对应的所有产品的skuId)
        postSkuId: 0,    //最终选定的产品ID
        list: {},
        swiperList: [],
        data: {
          dtype: 1,
          currGuiGe: "",
          currSize: "",
        },
        choose:[],
        //  用于保存用户添加到购车的商品数组
        myspecList: {},
        chooseIndex: 0,
        active: false,
        guige: [],
        guigeName: [],
      }
    },
    watch: {

    },
    created () {
      
    },
    mounted() {
      this.getPostPrice();
      this.$getData(this.$api.get_content.GET_STOP_MSG + '?id=' + this.$route.query.id).then((res) => {
        let that = this;
        switch (true) {
          case res.code == 1:
            this.$message({
              message: res.msg,
              type: 'success'
            });
            this.list = res.data;
            this.swiperList = JSON.parse(res.data.photo);
            that.myspecList = this.list.myspec;
            return true;
          case res.data.code == 0:
            this.$message({
              message: res.msg,
              type: 'warning'
            });
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
    components: {
      ElInputNumber,
      ElInput,
      ElButton,
      elenav,
      other,
      dome,
      detailSwiper,
    },
    computed: {
      getGuigeName() {
        if (this.guigeName <= 0) {
          return '请选择商品规格和数量';
        }
        return '已选择"' + this.guigeName.join('-') + '"';
      },
    },
    methods: {
      getPostPrice() {
        //  GET_POST_PRICE
      },
      checkGuige() {
        if (this.guige.length !== this.myspecList.length) {
          return false;
        } else {
          for (let g in this.guige) {
            if (typeof this.guige[g] === 'undefined' || this.guige[g] == '') {
              return false;
            }
          }
          return true;
        }
      },
      changeGuige(index, id, name) {
        this.active = !this.active;
        // if (!this.active) {
        //   for (let i in this.myspecList) {
        //     for () {

        //     }
        //   }
        // }
        this.$set(this.guige, index, id);
        this.$set(this.guigeName, index, name);
        console.log(this.guige, "+++", this.guigeName);
        if (!this.checkGuige) {
          return;
        }
        this.$postData(this.$api.get_content.GET_POST_PRICE, {
          spec: this.guige.join('-')
        }).then((res) => {
          // for (let i in res.data) {
          //   this.list = res.data[i];
          // }
        });
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
          uid: 7,
          gid: this.list.cat_id,
          num: this.list.sales_sum,
          price: this.list.shop_price,
          specdata: this.myspecList,
        };
        this.$postData(this.$api.get_content.POST_CART_DATA,option).then((res) => {
          console.log(res);
        });
        return;
        // this.$store.commit('SET_CART_OBJ',option);
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
  }
  .right-select .select-color .left {
    display: inline-block;
    width: 100px;
  }

  .right-select .select-color ul li {
    border-radius: 5px;
    margin: 0px 20px 0px 0px;
    width: 42%;
    text-align: center;
    border: 1px solid #fff;
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
    margin: 18px 17px 0 0;
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
