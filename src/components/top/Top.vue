<template>
  <div>
    <!-- header start -->
    <div class="header w100">
      <div class="header-main">
        <router-link :to="{ path: '/' }">
          <div class="header-logo fl"></div>
        </router-link>
        <div class="quguo-user fr" v-show="closeuser">
          <div class="fl">
            <router-link :to="{ path: '/admin/manage'}" style="color: #9fa0a0;" class="block">
              <div class="iconfont icon-yonghu fl" > <!-- :style="{backgroundImage:'url('+ author +')'}" -->
                <img :src="list.author" alt="" class="w11 h100" >
              </div>
              <div class="icon-username fl">{{ list.name }}</div>
            </router-link>
          </div>
          <div class="fl marLeft">|</div>
          <div class="fl cart-round">
            <el-badge :value="count" class="item">
              <div class="iconfont icon-shoppingcar-ac fl marLeft"></div>
              <el-button class="icon-cartname fl" @click="goCart()">购物车</el-button>
            </el-badge>
          </div>
          <div class="fl marLeft goback" @click="goback()">
            <div class="fl icon-line" style="margin-right: 10px;">|</div>
            <span>退出</span>
          </div>
        </div>
        <div class="header-userInfo fr" v-show="!closeuser">
          <router-link :to="{ path: '/user/login' }" class="userInfo fl">登录</router-link>
          <span class="userInfo fl">|</span>
          <router-link :to="{ path: '/user/register' }" class="userInfo fl">注册</router-link>
        </div>
      </div>
    </div>
    <!-- header end -->
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
          };
      },
      mounted() {
        this.isUser();
      },
      computed: {
        user_info() {
          try {
            let arr = JSON.parse(this.$store.state.user_info);
            this.list = arr.user
            console.log(this.list, "---");
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
        isUser() {
          //  调用user_info
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
    background: url("../../../static/images/logo.png") no-repeat;
    margin: 5px 0px;
  }

  .quguo-user .goback {
    position: absolute;
    right: 25px;
    cursor: pointer;
  }

  /* header end */
</style>
