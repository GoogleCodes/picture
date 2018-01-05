<template>
  <div class="admin-left fl">
    <div class="admin-pic">
      <div class="text-center" @mouseover="overUploadImage" @mouseout="outUploadImage">
        <div v-show="imageShow" id="pick-avatar" class="changePic" style="width: 90px;height: 90px;">更换头像</div>
        <img :src="imageUrl" style="width: 90px;height: 90px;">
        <avatar-cropper
          @uploading="handleUploading"
          @uploaded="handleUploaded"
          trigger="#pick-avatar" upload-form-name="img"
          upload-url="https://xinye-art.com/public/api/home/front/imgupload"></avatar-cropper>
      </div>
      <div>
        <h2 class="admin-uname ft-16 fl">
          <p class="fl" style="margin-top: 8px;text-align: center;width:100%;" v-show="inputName">{{ uname }}</p>
          <el-input v-model="uname" @blur="chonse(uname)" class="fl" v-show="!inputName"></el-input>
          <p class="iconfont icon-weibiaoti- fl" @click="updateName()"></p>
        </h2>
        <p class="admin-vip clear"></p>
      </div>
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
        inputName: true,
        imageShow: false,
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
        if(this.imageUrl == '') {
          this.imageShow = true;
        } else {
          this.imageShow = false;
        }
      });
    },
    methods: {
      ...mapActions({
        remove_user_info: REMOVE_USER_INFO,
      }),
      updateName() {
        if(this.inputName == false) {
          this.inputName = true;
        } else if(this.inputName == true) {
          this.inputName = false;
        }
      },
      overUploadImage() {
        this.imageShow = true;
      },
      outUploadImage() {
        this.imageShow = false;
      },
      updateUserAvatar(res) {
        return;
        this.$ajax.HttpPost('/api/home/user/setmember', {
          id: this.get_user_info.user.id,
        }).then(() => {
          this.userAvatar = resp.relative_url
        })
      },
      handleUploading(form, xhr) {

      },
      handleUploaded(res) {
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
          this.inputName = true;
          this.$message(res.msg);
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
    cursor:default;
  }

  .el-upload--text {
    width: 100px;
    height: 100px;
    display: block;
  }

  /* admin-uname end */


  /* icon-weibiaoti- start */
  .admin-uname .icon-weibiaoti- {
    position: absolute;
    right: 2px;
    top: 8px;
    color: #9fa0a0;
    font-size: 23px;
    cursor: pointer;
  }
  /* icon-weibiaoti- end */

  /* text-center start */
  .text-center .iconfont {
    text-align: center;
    font-size: 80px;
    line-height: 70px;
  }

  .text-center {
    position: relative;
    width: 90px;
    margin: 0px auto;
  }

  .text-center:first-child {
    cursor: pointer;
  }

  .text-center .changePic {
    text-align: center;
    line-height: 95px;
    font-size: 16px;
    border-radius: 100%;
    background: rgba(0,0,0,0.5);
    position: absolute;
    top: 0px;
    left: 0px;
    color: #fff;
  }

  .text-center:hover .iconfont {
    display: block;
  }
  /* text-center end */
</style>
