<template>
  <div class="tools-pson">

    <div class="personal">
      <div class="per-tools">
        <ul>
          <li style="position: relative;">
            <span class="fl ft-14 block chonseHead w100" id="pick-avatar">头像</span>
            <div class="fr">
              <div class="pson-pic fl">
                <img :src="user_pic" alt="" class="w100 h100">
                <avatar-cropper
                  trigger="#pick-avatar" upload-form-name="img"
                  upload-url="https://xinye-art.com/public/api/home/front/imgupload"></avatar-cropper>
              </div>
              <div class="icon-youbian iconfont fl"></div>
            </div>
          </li>
          <li>
            <span class="fl ft-14">会员级别</span>
            <div class="fr">
              <div class="iconfont">普通会员</div>
            </div>
          </li>
          <li>
            <span class="fl ft-14">姓名</span>
            <div class="form fr">
              <div class="pson-pic fl">
                <el-input :value="get_user_info.user.name" class="el-input"></el-input>
              </div>
              <div class="icon-youbian iconfont fl"></div>
            </div>
          </li>
          <li>
            <span class="fl ft-14">手机号码</span>
            <div class="form fr">
              <div class="pson-pic fl">
                <el-input :value="get_user_info.user.tel" class="el-input"></el-input>
              </div>
              <div class="icon-youbian iconfont fl"></div>
            </div>
          </li>
          <li>
            <span class="fl ft-14">收货地址</span>
            <div class="form fr">
              <div class="pson-pic fl">
                <el-input :value="defaults" class="el-input"></el-input>
              </div>
              <div class="icon-youbian iconfont fl"></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <el-button>保存</el-button>
  </div>

</template>


<script>

  import {mapGetters} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'
  import AvatarCropper from "vue-avatar-cropper"

  export default {
    data() {
      return {
        list: [],
        defaults: '',
        user_pic: '',
        userAvatar: undefined,
      }
    },
    components: { AvatarCropper },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      })
    },
    mounted() {
      this.setAddress();
      this.$ajax.HttpPost('/api/home/user/userinfo',{
        id: this.get_user_info.user.id
      }).then((res) => {
        this.user_pic = res.data.img;
      });
    },
    methods: {
      updateUserAvatar(resp) {
        this.$http.patch('/users/23', {
          avatar: resp.relative_url
        }).then(() => {
          this.userAvatar = resp.relative_url
        })
      },
      setAddress() {
        let that = this;
        this.$ajax.HttpGet(this.$api.get_address.get_address + '?id=' + 6).then((res) => {
          for (let i in res.data) {
            if (res.data[i].select == 1) {
//              that.default = res.data[i].adr;
            }
          }
        });
      },
    }
  }
</script>

<style type="text/css">
  /* personal start */
  .personal {
    margin: 60px 0px 0px;
    padding: 0px 7%;
    background: #fff;
    overflow: hidden;
  }

  .personal .per-tools ul li .chonseHead {
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .personal .per-tools ul li {
    height: 3rem;
    line-height: 3rem;
    border-bottom: 1px solid #ccc;
  }
  .personal .per-tools ul li:last-child {
    border: none;
  }
  .personal .per-tools ul li .pson-pic {
    width: 2.5rem;
    height: 2.5rem;
    margin-right: 10px;
  }
  .per-tools ul li .form {
    width: 200px;
  }
  .per-tools ul li .form .el-input {
    width: 185px;
  }
  .form .el-input .el-input__inner {
    border: none;
    text-align: right;
  }
  .personal .per-tools ul li .icon-youbian {
    font-size: 18px;
    line-height: 3.1rem;
    color: #999;
    float: right;
  }
  .tools-pson .el-button {
    width: 90%;
    color: #fff;
    display: block;
    margin: 40px auto;
    background: #c40000;
    border: 1px solid #c40000;
  }
  /* personal end */
</style>

<style type="text/css">
  .avatar-cropper .avatar-cropper-container .avatar-cropper-footer .avatar-cropper-btn {
    padding: 0px;
  }
</style>
