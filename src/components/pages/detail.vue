<template>

  <div class="bgcolor">
    <div class="content clear" style="margin: 0px auto;">
      <div class="con-pro" style="height: 360px;">
        <img src="../../assets/images/19.png" alt="" style="width: 100%;height: 100%;">
      </div>
      <div class="experience" style="margin: 70px auto;background: #fff">
        <div class="exper-pic fl">
          <div class="exper-pic-wrap">
            <el-carousel height="420px">
              <el-carousel-item v-for="item in 2" :key="item">
                <img src="../../assets/images/23.png" alt="" style="width: 100%;height: 420px;">
              </el-carousel-item>
            </el-carousel>
          </div>
          <div class="exper-pic-item">
            <div class="a1" v-for="item in 5"></div>
          </div>
        </div>
        <div class="tb-wrap fl">
          <div class="right-select fr">
            <div class="select-title">金色古典<span>MP14533-2B</span></div>
            <div class="select-text">高雅复古风</div>
            <div class="select-price">¥360.00</div>
            <div class="select-color">
              <span class="left">款色：</span>
              <span class="right">金黄色</span>
            </div>
            <div class="select-size">
              <span class="left">尺寸：</span>
              <ul class="right clearfix">
                <li v-for="list in size">{{ list }}</li>
              </ul>
            </div>
            <div class="select-num">
              <span class="left fl">数量：</span>
              <div class="item-amount ">
                <el-button class="no-minus fl" @click="nominus" :class="{'disabled':pnums <= 1}">-</el-button>
                <el-input type="text" class="fl" placeholder="0" v-model="pnums"></el-input>
                <el-button class="add-max fl" @click="addmax" :class="{'disabled': pnums >= 1}">+</el-button>
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
        <other></other>
      </div>

    </div>
    <!-- content end -->
  </div>

</template>


<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'
  import elenav from '@/components/top/Nav.vue'
  import other from '@/components/pages/other.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import ElInput from "../../../node_modules/element-ui/packages/input/src/input";
  import ElInputNumber from "../../../node_modules/element-ui/packages/input-number/src/input-number";

  export default {
    name: 'dingzhi',
    data() {
      return {
        data: {
          list: [],
          dtype: 1,
        },
        size: {
          one: '26寸',
        },
        pnums: 0,
      }
    },
    created () {

    },
    methods: {
      nominus() {
        if (this.pnums > 0) {
          this.pnums--;
        }
      },
      addmax() {
        if (this.pnums < 0) {
          return false;
        }
        this.pnums++;
      },
      goCart() {
        let that = this;
        this.$message({
          message: '恭喜你，加入购物车成功！',
          type: 'success'
        });
        setInterval(function() {
          that.$router.push({ path: '/cart/submit' });
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
    margin-bottom: 20px;
  }
  .right-select .select-size .right li {
    float: left;
    width: 125px;
    height: 32px;
    margin-right: 18px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
    line-height: 32px;
    font-size: 15px;
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

</style>
