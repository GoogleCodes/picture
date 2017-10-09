<template>
  <div style="height: 103px;">
    <!-- nav start -->
    <div class="nav clear">
      <ul class="fl">
        <li>
          <router-link :to="{ path : '/'}" class="blocks nav-href">
            <span>首页</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ path : '/inside/orderlist'}" class="blocks nav-href">
            皮册定制
          </router-link>
        </li>
        <li>
          <router-link :to="{ path : '/inside/dingzhi'}" class="blocks nav-href">
            字画装裱
          </router-link>
        </li>
        <li>
          <a href="javascript:void(0);" class="blocks nav-href">
            <span>照片装裱</span>
            <div class="dropDomn">
            <div class="triangle"></div>
            <ul class="drop-ul fl">
              <li class="clear">时尚对裱册12寸竖</li>
              <li class="clear">时尚对裱册12寸竖</li>
            </ul>
            <div class="dropDome-Image fl"></div>
          </div>
          </a>
        </li>
        <li>
          <router-link :to="{ path : '/pages/frame'}" class="blocks nav-href">
            婚纱套系
          </router-link>
        </li>
        <li><a href="javascript:void(0);" class="blocks nav-href">特殊本</a></li>
        <li>
          <a href="javascript:void(0);" class="blocks nav-href">
            照片冲印
            <div class="dropDomn">
            <div class="triangle"></div>
            <ul class="drop-ul fl">
              <li class="clear">时尚对裱册12寸竖</li>
              <li class="clear">时尚对裱册12寸竖</li>
            </ul>
            <div class="dropDome-Image fl"></div>
          </div>
          </a>
        </li>
        <li><a href="javascript:void(0);" class="blocks nav-href" style="margin-right: 0px;">装饰画</a></li>
      </ul>
      <router-link :to="{ path: '/inside/dingzhi'}" class="block" style="position: relative;right: -35px;">
        <div class="fr Experience"></div>
      </router-link>
    </div>
    <!-- nav end -->

  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {

      }
    },
    created() {

    },
    methods: {

    },
  }
</script>


<style>
  /* nav start */
  .nav {
    width: 1200px;
    height: 50px;
    padding: 28px 0px;
    margin: 0px auto;
  }

  .nav ul li {
    float: left;
  }

  .nav ul li .nav-href {
    line-height: 25px;
    border: 1px solid #B3B3B3;
    border-top: none;
    border-bottom: none;
    margin: 12px 65px 12px 0px;
    padding: 0px 10px;
    font-size: 16px;
    color: #3e3a39;
    position: relative;
  }

  .nav .Experience {
    width: 120px;
    height: 39px;
    margin: 5px 0px;
    background: url("../../assets/images/01.png") no-repeat;
  }

  .nav ul li .nav-href .dropDomn {
    position: absolute;
    top: 38px;
    left: -42px;
    border-radius: 15px;
    width: 340px;
    border: 1px solid #fff;
    box-shadow: 1px 1px 10px #eee;
    background: #fff;
    display: none;
    z-index: 999;
  }

  .nav ul li .nav-href:hover .dropDomn {
    display: block;
  }

  .nav ul li .nav-href .dropDomn .triangle {
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 18px solid #efefef;
    position: absolute;
    top: -20px;
    left: 67px;
  }

  .nav ul li .nav-href .dropDomn .drop-ul {
    width: 40%;
    margin-top: 5px;
  }

  .nav ul li .nav-href .dropDomn .drop-ul li {
    width: 100%;
    text-align: center;
    line-height: 40px;
  }

  .nav ul li .nav-href .dropDomn .dropDome-Image {
    width: 55%;
    height: 165px;
    margin: 7px;
    border-radius: 10px;
    background: #333;
  }

  /* nav end */
</style>
