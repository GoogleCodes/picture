<template>
  <div>
    <div class="hunsha-product-else">
      <div class="container clear">
        <div class="product-title">PRESENTATION</div>
        <span class="product-text">浏览其他</span>
        <ul class="product-list clearfix">
          <template v-for="(item, index) in list">
            <li class="product-item">
              <router-link :to="{ path: '/', query:{pid: item.goods_id }}" class="block">
                <div class="pic">
                  <img :src="item.goods_thumb" alt="">
                </div>
                <div class="item-title">{{ item.goods_name }}</div>
                <div class="item-text">{{ item.goods_remark }}</div>
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  export default {
    props: {
      cid: {
        type: [Number,String],
        required: true
      },
      number: {
        type: Number,
        required: true
      }
    },
    components: {

    },
    data() {
      return {
        list: [],
      }
    },
    mounted() {
      this.getOther();
    },
    methods: {
      getOther() {
        this.$http.get('http://yuyin.ittun.com/public/api/home/front/randGoods?cid=' + 31 + '&num=' + 4 ).then((res) => {
          console.log(res.data.data);
          if (res.data.code == 0) {
            // this.$message({
            //   message: res.data.msg,
            //   type: 'warning'
            // })
          }
          this.list = res.data.data;
        });
      }
    },
  }
</script>

<style>
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
    height: 310px;
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
  .product-list .product-item .item-title {
    font-size: 18px;
    color: #000;
    line-height: 50px;
  }
  .product-list .product-item .item-text {
    font-size: 14px;
    color: #333;
  }
  .product-list .product-item:hover {
    border: 4px solid #b11e25;
    background: #b11e25;
    transition: 0.5s;
  }

  .product-list .product-item:hover .item-title {
    color: #fff;
  }
  .product-list .product-item:hover .item-text {
    color: #fff;
  }
</style>
