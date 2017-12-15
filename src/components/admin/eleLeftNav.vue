<template>
  <div class="admin-left fl">
    <div class="admin-pic">
      <el-upload action="https://xinye-art.com/public/api/home/front/imgupload"
                 class="avatar-uploader"
                 name="img"
        :on-success="handleAvatarSuccess"
        :before-upload="beforeAvatarUpload">
        <img v-if="imageUrl" :src="imageUrl" class="avatar w100 h100">
        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
      </el-upload>

      <!-- 坑逼上传工具 -->
      <!--
      <div class="text-center">
        <img v-if="userAvatar">
        <button id="pick-avatar">Select An image</button>
        <avatar-cropper
          :uploaded="updateUserAvatar"
          trigger="#pick-avatar"
          upload-url="https://xinye-art.com/public/api/home/front/imgupload"></avatar-cropper>
      </div>
      -->

      <h2 class="admin-uname ft-16">
        <el-input :value="uname" @blur="chonse(uname)"></el-input>
      </h2>
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
        <!--
        <dd class="admin-dt tIndex">
          <router-link :to="{ path: '/admin/shoping'}" style="color: #b11e25">我购买过的记录</router-link>
        </dd>
        -->
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
      <dl class="admin-dl" style="cursor: pointer">
        <dt class="admin-dt ft-18" @click="goBack()">
          <i class="iconfont icon-tuichu"></i>
          <span>退出登录</span>
        </dt>
      </dl>
    </div>
  </div>
</template>

<script type="text/javascript">

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'
  import { REMOVE_USER_INFO } from '../../store/actions/type'

  import AvatarCropper from "vue-avatar-cropper"

  export default {
    components: { AvatarCropper },
    data() {
      return {
        imageUrl: '',
        uname: '',
        json: {},
        userAvatar: undefined,
        fileList: [],
      }
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
    },
    watch: {

    },
    mounted() {
      this.$ajax.HttpPost('/api/home/user/userinfo',{
        id: this.get_user_info.user.id
      }).then((res) => {
        this.uname = res.data.uname
        this.imageUrl = res.data.img;
      });
    },
    methods: {
      ...mapActions({
        remove_user_info: REMOVE_USER_INFO,
      }),
      updateUserAvatar(res) {
        return;
        this.$ajax.HttpPost('/api/home/user/setmember', {
          id: this.get_user_info.user.id,
        }).then(() => {
          this.userAvatar = resp.relative_url
        })
      },
      handleAvatarSuccess(res, file) {
        this.$ajax.HttpPost('/api/home/user/setmember',{
          id: this.get_user_info.user.id,
          img: res.data.path
        }).then((res) => {
          setTimeout(() => {
            location.reload();
          }, 1500)
        });
      },
      beforeAvatarUpload(file) {
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isLt2M) {
          this.$message.error('上传头像图片大小不能超过 2MB!');
        }
        return isLt2M;
      },
      chonse(name) {
        this.$ajax.HttpPost('/api/home/user/setmember',{
          id: this.get_user_info.user.id,
          uname: name
        }).then((res) => {
          if (res.code === 0) {
//            this.$message(res.msg);
          }
        });
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
          this.remove_user_info('user_info');
          this.$router.push({ path: '/'});
          location.reload();
        }).catch(() => {

        });
      }
    },
  }
</script>


<style type="text/css">
  /* admin-uname start */
  .admin-uname .el-input__inner {
    border: none;
  }

  .el-upload--text {
    width: 100px;
    height: 100px;
    display: block;
  }

  /* admin-uname end */
</style>
