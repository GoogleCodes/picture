<template>
  <div>
    <div class="admin clear">
      <div class="head">
        <div class="head-pic">
          <img src="../../../static/images/50.png" class="w100 h100" alt="">
        </div>
        <!--<div class="head-name ft-20">{{ userList.name }}</div>-->
        <div class="head-vip">
          <span class="iconvip iconfont icon-vip1"></span>
          <span class="vipspan">普通会员</span>
        </div>
      </div>
      <ul>
        <li>
          <router-link :to="{ path: '/pages/order'}" class="block w100 h100">
            <div class="fl">
              <i class="iconfont icon-dingdan c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">我的订单</span>
            </div>
            <div class="fr">
              <i class="c_b3b3b3">查看全部订单</i>
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </router-link>
        </li>
        <li>
          <router-link :to="{ path: '/'}" class="block">
            <div class="fl">
              <i class="iconfont icon-geren c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">个人资料</span>
            </div>
            <div class="fr">
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </router-link>
        </li>
        <li>
          <router-link :to="{ path: '/admin/vip'}" class="block w100 h100">
            <div class="fl">
              <i class="iconfont icon-vip2 c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">我的会员</span>
            </div>
            <div class="fr">
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </router-link>
        </li>
      </ul>

      <ul class="clear" style="margin-top: 10px;">
        <li>
          <router-link :to="{ path: '/admin/address'}" class="block w100 h100">
            <div class="fl">
              <i class="iconfont icon-dizhi c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">收货地址</span>
            </div>
            <div class="fr">
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </router-link>
        </li>
        <li>
          <router-link :to="{ path: '/user/modify'}" class="w100 h100 block">
            <div class="fl">
              <i class="iconfont icon-mima c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">修改密码</span>
            </div>
            <div class="fr">
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </router-link>
        </li>
        <li @click="goBack()">
          <div class="block">
            <div class="fl">
              <i class="iconfont icon-tuichu c_b3b3b3"></i>
              <span class="ft-16" style="margin-left: 5px;">退出帐号</span>
            </div>
            <div class="fr">
              <span class="iconfont icon-youbian c_b3b3b3"></span>
            </div>
          </div>
        </li>
      </ul>

    </div>
  </div>
</template>


<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import eleLeft from '@/components/admin/eleleftNav.vue'
  import foots from '@/components/footer/Footer.vue'

  export default {
      name: 'admin',
      data () {
          return {
            userList: {},
          }
      },
      created () {
          this.isUserTrue();
      },
      components: {
          heads,
          foots,
          eleLeft
      },
      methods: {
          isUserTrue() {
              if (localStorage.getItem('user_info') === 'undefined') {
                  setTimeout(() => {
                      this.$router.push({ path: '/user/login'})
                  }, 1);
              } else {
                this.userList = this.$storageGet('user_info');
              }
          },
          goBack() {
              this.$confirm('确定要退出登录??', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
              }).then(() => {
                  this.$message({
                    type: 'success',
                    message: '退出成功!'
                  });
                  localStorage.removeItem('user_info');
                  this.$storageSet('user_info',undefined);
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
  };
</script>

<style scoped="">
  /* admin start */
  .admin {
    margin: 47px 0px 0px;
  }

  .admin ul {
    width: 100%;
    height: 100%;
    background: #fff;
  }

  .admin ul li {
    margin: 0px 10px;
    height: 45px;
    line-height: 45px;
    border-bottom: 1px solid rgb(230,230,230);
  }
  .admin ul li:last-child {
    border: none;
  }
  /*admin end*/

  /* head start */
  .head {
    width: 100%;
    height: 183px;
    background: #3b5998;
  }
  .head .head-pic {
    width: 90px;
    height: 90px;
    padding-top: 23px;
    margin: 0px auto;
  }
  .head .head-name {
    text-align: center;
    color: #fff;
    margin-top: 10px;
  }
  .head .head-vip {
    text-align: center;
    color: #b11e25;
  }
  .head .head-vip .iconvip {
    width: 29px;
    display: inline-block;
    height: 22px;
    position: relative;
    font-size: 26px;
    top: 5px;
    /*background: url('../../../static/images/25.png') no-repeat 0px 0px;*/
  }

  /* head end */

</style>

<style>
  /* el-message-box start */
  .el-message-box {
    width: 85%;
  }
  .el-message-box__content {
    padding: 18px 20px;
  }
  /* el-message-box end */
</style>
