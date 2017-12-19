<template>
  <div class="bgcolor">
    <div style="width: 1200px;margin: 0px auto 45px;">
      <!-- 添加到购物车 -->
      <div class="hunsha-add-cart">
        <div class="container clearfix">
          <div class="left-pic">
            <template v-for="(k, i) in goods_thumb">
              <img :src="k.url" alt="">
            </template>
          </div>
          <div class="left-content">
            <div class="product-title">{{ list.goods_name }}</div>
            <div class="product-text">{{ list.goods_remark }}</div>
            <div class="product-price">¥{{ list.shop_price }}</div>
          </div>
          <div class="right-content">
            <div class="tip">
              <img src="../../assets/images/29.png" alt="">
              <span>商品已经成功加入购物车</span>
            </div>
            <div class="btn">
              <router-link :to="{path : '/cart/cart'}">
                <span class="btn-cart">购物车</span>
              </router-link>
              <router-link :to="{path : '/cart/cart'}">
                <span class="btn-detail">查看商品详情</span>
              </router-link>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="w1200 mauto clear">
      <div class="hunsha-product-else">
        <div class="container clear">
          <div class="product-title">PRESENTATION</div>
          <span class="product-text">浏览其他</span>
          <ul class="product-list clearfix">
            <template v-for="(item, index) in randomList">
              <router-link :to="{ path: '/pages/detail/' + item.goods_id}" class="block w100 h100" replace>
                <li class="product-item">
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
              </router-link>
            </template>
          </ul>
        </div>
      </div>
    </div>

  </div>
</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import other from '@/components/pages/other.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
    components: {
      heads,
      foots,
      other
    },
    data() {
      return {
        randomList: [],
        list: {},
        goods_thumb: [],
      }
    },
    created() {
      this.getDataShop();
    },
    methods: {
      getDataShop() {
        this.$ajax.HttpGet(this.$api.get_content.GET_STOP_MSG + '?id=' + this.$route.params.id).then((res) => {
          switch (true) {
            case res.code == 1:
              this.list = res.data;
              this.goods_thumb = JSON.parse(res.data.goods_thumb);
              console.log(this.list, this.goods_thumb);
              //  获取随机商品
              this.$ajax.HttpGet(this.$api.get_other.GET_OTHER + '?cid=' + this.$route.params.cid + '&num=' + 3).then((res) => {
                this.randomList = res.data;
              });
              return true;
            case res.data.code == 0:
              return false;
            default:
          }
        });
      },
    },
  }
</script>

<style>
  /* 添加到购物车 */
  .hunsha-add-cart {
    //  margin-top: 25px;
    padding-top: 40px;
  }
  .hunsha-add-cart .container {
    // margin-top: 70px;
    padding-top: 50px;
    padding-bottom: 70px;
    background: #fff;
  }
  .hunsha-add-cart .container .left-pic {
    float: left;
    margin-left: 35px;
  }
  .hunsha-add-cart .container .left-pic img {
    width: 122px;
    height: 108px;
  }
  .hunsha-add-cart .container .left-content {
    float: left;
    margin-left: 45px;
  }
  .hunsha-add-cart .container .left-content .product-title {
    font-size: 26px;
    color: #000;
  }
  .hunsha-add-cart .container .left-content .product-title span {
    font-size: 14px;
    padding-left: 10px;
  }
  .hunsha-add-cart .container .left-content .product-text {
    font-size: 15px;
    line-height: 50px;
  }
  .hunsha-add-cart .container .left-content .product-price {
    font-size: 24px;
    color: #e54147;
  }
  .hunsha-add-cart .container .right-content {
    float: right;
    width: 330px;
    margin-right: 30px;
  }
  .hunsha-add-cart .container .right-content .tip {
    margin-bottom: 36px;
  }
  .hunsha-add-cart .container .right-content .tip img {
    width: 40px;
    height: 40px;
    vertical-align: bottom;
  }
  .hunsha-add-cart .container .right-content .tip span {
    padding-left: 10px;
    font-size: 23px;
    color: #000;
    line-height: 40px;
  }
  .hunsha-add-cart .container .right-content .btn span {
    display: inline-block;
    width: 146px;
    height: 38px;
    margin-right: 5px;
    border-radius: 5px;
    text-align: center;
    line-height: 38px;
  }
  .hunsha-add-cart .container .right-content .btn .btn-cart {
    background: #b01e25;
    color: #fff;
  }
  .hunsha-add-cart .container .right-content .btn .btn-detail {
    border: 1px solid #000;
    box-sizing: border-box;
    color: #000;
    background: #fff;
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
