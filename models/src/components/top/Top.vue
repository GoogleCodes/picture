<template>
  <div v-show="$route.meta.header">
    <!-- header start -->
    <div class="header w100">
      <i class="iconfont icon-liebiao-copy-copy block fl" @click="goLayer()"></i>
      <div class="header-main">
        <router-link :to="{ path: '/' }">
          <div class="header-logo fl"></div>
        </router-link>
      </div>
    </div>
    <!-- header end -->
    <!-- nav start -->
    <div class="layer" @click="showLayer" v-show="visiLayer" ></div>
    <div class="nav clear" v-show="visiLayer" @touchmove.prevent>
      <el-menu default-active="2" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" theme="dark">
        <el-menu-item index="1">主页</el-menu-item>
        <el-submenu :index="index | TextToString" v-for="(item, index) in navList">
          <template slot="title">{{ item.title }}</template>
          <el-menu-item-group title="分组一">
            <el-menu-item index="2-1">时尚对裱册12寸竖</el-menu-item>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </div>
    <!-- nav end -->
  </div>
</template>

<script type="text/javascript">
  export default {
      name: 'top',
      data () {
          return {
            closeuser: true,
            author: '',
            uname: '',
            list: {},
            visiLayer: false,
            navList: [],
            freeMode: {
              freeMode: true,
            },
            doubleul: false,
            current: 0,
          };
      },
      mounted() {
        this.isUser();
        this.getNav();
      },
      filters: {
          TextToString (value) {
            return value.toString();
          },
      },
      computed: {
        user_info() {
          try {
            let arr = JSON.parse(this.$store.state.user_info);
            this.list = arr.user
          } catch(e) {}
          return this.list;
        },
        count() { //  购物车总数
            return this.$store.state.count;
        }
      },
      created() {

      },
      watch: {

      },
      methods: {
        goPages(item) {
          for (let i in this.navList) {
            if (this.navList[i].id === item.id) {
              this.doubleul = true;
            } else {
              this.doubleul = false;
            }
          }
//          this.$router.push({ path: '/'});
        },
        getNav() {
          this.$http.get('http://yuyin.ittun.com/public/api/home/front/getPrdClassify').then((res) => {
            this.navList = res.data.data;
          });
        },
        goLayer(e) {

          this.visiLayer = true;
        },
        showLayer() {
          this.visiLayer = false;
        },
        handleOpen(key, keyPath) {

        },
        handleClose(key, keyPath) {

        },
        isUser() {
          this.user_info;
          let that = this, userJson = this.$goFetch.storageGet('user_info');
          if (userJson !== null) {
            that.closeuser = true;
            that.uname = userJson.uname;
            that.author = userJson.author;
          } else {
            that.closeuser = false;
          }
        },
        goCart() {
            this.$router.push({ path: '/cart/cart' });
        },
        goback() {
          this.$confirm('确定要退出吗?, 是否继续?', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            this.$message({
              type: 'success',
              message: '退出成功!'
            });
            this.closeuser = false;
            this.$goFetch.storageRemove('user_info');
            this.$goFetch.storageSet('user_info',undefined);
            //  跳回首页
            setTimeout(() => {
              this.$router.push({ path: '/'});
            }, 1500);
          }).catch(() => {
            this.$message({
              type: 'info',
              message: '已取消退出'
            });
          });
        }
      },
  }
</script>

<style scoped>
  /* header start */
  .header .header-main .header-logo {
    width: 65px;
    height: 47px;
    background: url("../../assets/images/logo.png") no-repeat top center;
    background-size: 85%;
    background-position-y: 5px;
    margin: 0px auto;
  }

  .header .icon-liebiao-copy-copy {
    width: 55px;
    height: 100%;
    line-height: 47px;
    font-size: 30px;
    color: #fff;
    text-align: center;
  }

  .header-main {
    width: 65px;
    height: 47px;
    margin: 0px auto;
  }

  .quguo-user .goback {
    position: absolute;
    right: 25px;
    cursor: pointer;
  }
  /* header end */


  /* layer start */
  .layer {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.5);
    z-index: 280;
  }
  /* layer end */

  /* nav start */
  .nav {
    width: 195px;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    z-index: 300;
    background: #333;
  }
  /* nav end */

</style>


<style>
  /* nav start */
  .nav .el-col-8 {
    width: 100%;
  }
  .el-submenu .el-menu-item {
    min-width: 195px;
  }
  .nav .el-menu--dark {
    background: #333;
  }
  .el-menu--dark .el-submenu .el-menu {
    background: #222;
  }
  .el-menu-item-group__title {
    color: #808080;
  }
  .el-menu--dark .el-menu-item , .el-menu--dark .el-submenu__title {
    color: #808080;
    border-bottom: 0.01rem solid #666;
  }
  .el-submenu__title a {
    color: #808080;

  }
  .el-menu--dark .el-submenu .el-menu {
    background: #333;
  }
  .el-submenu.is-active .el-submenu__title {
    border-bottom-color: #666;
  }
  .el-menu--dark .el-submenu .el-menu .el-menu-item:hover {
    background: #333;
  }
  .el-menu--dark .el-menu-item:hover, .el-menu--dark .el-submenu__title:hover {
    background: #333;
  }
  /* nav end */
</style>
