<template>
  <div class="admin-left fl">
    <div class="admin-pic">
      <img src="../../assets/images/16.png" alt="" style="width: 100%;height: 100%;">
      <h2 class="admin-uname ft-16">{{ list.name }}</h2>
      <p class="admin-vip"></p>
    </div>
    <div class="admin-nav">
      <dl class="admin-dl" style="color: #b11e25;">
        <dt class="admin-dt ft-18">
          <router-link :to="{ path: '/admin/manage'}">
            <i class="iconfont icon-dingdan"></i>
            <span>订单管理</span>
          </router-link>
        </dt>
        <dd class="admin-dt tIndex">
          <router-link :to="{ path: '/admin/shoping'}" style="color: #b11e25">我购买过的记录</router-link>
        </dd>
      </dl>
      <div class="line"></div>
      <dl class="admin-dl">
        <dt class="admin-dt ft-18">
          <i class="iconfont icon-zhanghu"></i>
          我的账户
      </dt>
        <dd class="admin-dt tIndex">
          <router-link :to="{ path: '/admin/address'}">收货地址</router-link>
          <!--<a href="javascript:void(0);">收货地址</a>-->
        </dd>
        <dd class="admin-dt tIndex" style="text-indent: 3.5em;">
          <router-link :to="{ path: '/admin/changePwd'}">修改密码</router-link>
        </dd>
      </dl>
      <div class="line"></div>
      <dl class="admin-dl">
        <dt class="admin-dt ft-18">
          <router-link :to="{ path: '/admin/vip'}">
            <i class="iconfont icon-vip"></i>
            <span>我的会员</span>
          </router-link>
      </dt>
      </dl>
      <div class="line"></div>
      <dl class="admin-dl">
        <dt class="admin-dt ft-18" @click="goBack()">
          <i class="iconfont icon-tuichu"></i>
          <span>退出登录</span>
        </dt>
      </dl>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        list: {},
        vipname: '',
      }
    },
    computed: {
        user_info() {
          try {
            let arr = this.$storageGet('user_info');
            this.list = arr.user
          } catch(e) {}
          return this.$store.state.user_info;
        }
    },
    watch: {
      
    },
    mounted() {
      this.isUserTrue();
    },
    methods: {
      isUserTrue() {
        if (this.$goFetch.storageGet('user_info') === 'undefined') {
          setTimeout(() => {
            this.$router.push({ path: '/user/login'}, 200)
          });
        }
      },
      goBack() {
        this.$confirm('确定要退出吗?, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          this.$message({
            type: 'success',
            message: '退出成功!'
          });
          this.$goFetch.storageRemove('user_info');
          this.$goFetch.storageSet('user_info',undefined);
          //  跳回首页
          this.$router.push({ path: '/'});
          location.reload();
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
