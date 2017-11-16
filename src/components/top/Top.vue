<template>
  <div>
    <!-- header start -->
    <div class="header w100" v-show="$route.meta.header">
      <div class="header-main">
        <router-link :to="{ path: '/' }">
          <div class="header-logo fl"></div>
        </router-link>
        <div class="quguo-user fr" v-show="closeuser">
          <div class="fl">
            <router-link :to="{ path: '/admin/manage'}" style="color: #9fa0a0;" class="block">
              <div class="iconfont icon-yonghu fl" > <!-- :style="{background:'url('+ author +')'}" -->
                <img :src="list.author" alt="" class="w11 h100" >
              </div>
              <div class="icon-username fl">{{ list.name }}</div>
            </router-link>
          </div>
          <div class="fl marLeft">|</div>
          <div class="fl cart-round">
            <el-badge :value="cart_count" class="item">
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
        this.fetchData();
      },
      computed: {
        user_info() {
          try {
            let arr = this.$goFetch.goJson(this.$store.state.user_info);
            this.list = arr.user
          } catch(e) {}
          return this.$store.state.user_info;
        },
        cart_count() { //  购物车总数
          return this.$store.state.cart_count;
        }
      },
      created() {
        
      },
      watch: {

      },
      methods: {
        fetchData() {
          //  this.$postData this.$ajax.HttpPost
          this.load_data = true;
          this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.$goFetch.storageGet('user_info').user.id}).then((res) => {
            this.$store.commit('SET_CART_NUMBER', res.data.length);
          });
        },
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
    cursor: pointer;
  }

  /* header end */
</style>
