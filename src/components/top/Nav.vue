<template>
  <div style="height: 103px;">
    <!-- nav start -->
    <div class="nav clear">
      <ul class="fl">
        <li>
          <router-link :to="{ path: '/'}" class="blocks nav-href">首页</router-link>
        </li>
        <li v-for="(item, index) in data.list">
          <router-link :to="{ path: '/inside/orderlist', query: {id: item.id}}" class="blocks nav-href">
            <span>{{ item.title }}</span>
            <div class="dropDomn" v-show="dropDowm">
              <div class="triangle"></div>
              <ul class="drop-ul fl">
                <li class="clear" v-for="(wrap, index) in item.dounav">{{ wrap.title}}</li>
              </ul>
            </div>
            <div class="dropDome-Image fl"></div>
          </router-link>
        </li>
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
        dropDowm: false,
        data: {
          list: [],
        },
      }
    },
    created() {
      this.getNav();
    },
    mounted() {

    },
    methods: {
      getNav() {
        this.$ajax.HttpGet(this.$api.get_content.GET_NAV)
        .then((res) => {
            this.data.list = res.data;
        });
      }
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

  .nav ul li:last-child .nav-href {
    margin: 12px 0 12px 0;
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
    background: url("../../../static/images/01.png") no-repeat;
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
