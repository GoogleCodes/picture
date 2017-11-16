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
              <div class="icon-username fl">{{ get_user_info.user.name }}</div>
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

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'
  import { SET_USER_INFO } from '../../store/actions/type'

  export default {
      name: 'top',
      data () {
          return {
            closeuser: true,
            author: '',
            list: {},
          };
      },
      mounted() {
        this.isUser();
        this.fetchData();
      },
      computed: {
        ...mapGetters({
          get_user_info: GET_USER_INFO
        }),
        cart_count() { //  购物车总数
          return this.$store.state.cart_count;
        }
      },
      watch: {

      },
      methods: {
        ...mapActions({
          set_user_info: SET_USER_INFO
        }),
        fetchData() {
          this.load_data = true;
          this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
            this.$store.commit('SET_CART_NUMBER', res.data.length);
          });
        },
        isUser() {
          let that = this, userJson = this.get_user_info;
          if (this.get_user_info !== null) {
            that.closeuser = true;
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
            this.closeuser = false;
            this.set_user_info(null);
            setTimeout(this.$router.replace({ path: '/'}), 500);
          }).catch(() => {
            
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
