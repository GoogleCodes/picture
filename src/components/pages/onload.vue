<template>
  <div class="bgcolor">
    <div class="cart-upload-pic w1200">
        <div class="el-upload-icon">
          <div class="container">
            <div class="upload-pic">
              <div class="top-upload clearfix">
                <div class="left-pic">
                  <img src="../../assets/images/31.jpg" alt="">
                </div>
                <div class="left-content">
                  <div class="product-title">金色古典<span>MP14533-2B</span></div>
                  <div class="product-text">高雅复古风</div>
                </div>
                <div class="right-upload">
                  <el-upload action="http://yuyin.ittun.com/public/api/home/front/imgupload"
                             name="img" class="image-uploader-warp"
                             :drag="false" :on-preview="handlePreview"
                             :on-success="handleAvatarSuccess"
                             :before-upload="handleBeforeUpload"
                             :onError="uploadError" :on-remove="handleRemove">
                    <slot></slot>
                    <el-button  type="primary" class="upload-btn">
                      <i class="el-icon-upload el-icon--right"></i>
                      <i>上传</i>
                    </el-button>
                  </el-upload>
                  <p>仅支持上传png/jpg格式图片分辨率300dpi以上</p>
                </div>
              </div>
              <div class="bottom-tip">
                <img src="../../../static/images/37.png" alt="">
                <span class="tip">照片 . jpg上传成功</span>
                <span class="size">图片尺寸 ： 1000 x1366像素</span>
              </div>
            </div>
            <!-- 图片展示 -->
            <div class="show-pic" v-show="picVisi">
              <div class="no-pic">
                <img src="../../../static/images/34.png" alt="">
                <span>暂无图片</span>
              </div>
              <ul class="pic-list clearfix" v-show="!picVisi">
                <li class="pic-item">
                  <img class="pic" :src="file" alt="">
                  <div class="time">
                    <img src="../../../static/images/36.png" alt="">
                    <span>2017-08-18</span>
                  </div>
                  <div class="cancel">
                    <img src="../../../static/images/35.png" alt="">
                  </div>
                </li>
              </ul>
            </div>
            <!-- 功能按钮 -->
            <div class="bottom-btn clearfix">
              <div class="left-back">
                <router-link :to="{ path: '/cart/cart'}">返回购物车</router-link>
              </div>
              <div class="right-ok">
                <router-link :to="{ path: ''}">确认提交</router-link>
              </div>
              <span class="right-tip">您已经传了3张照片</span>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    data() {
      return {
        fileList: [],
        file: null,
        picVisi: true,
      }
    },
    created() {

    },
    components: {
      ElButton

    },
    methods: {
      handleBeforeUpload(file) {
        // console.log(file);
      },
      handleAvatarSuccess(res, file) {
        this.file = res;
        this.$postData('/api/home/shopcar/upSave',{
          id: this.$route.query.id,
          img: res,
        });
      },
      handlePreview(file, fileList) {
        // console.log(file, fileList)
      },
      uploadError (response, file, fileList) {
        console.log('上传失败，请重试！')
      },
      handleRemove(file) {
        
      }
    }
  }
</script>

<style>
  /* 购物车上传照片 */
  .cart-upload-pic {
    margin: 32px auto 130px;
  }
  .cart-upload-pic .container {
    padding: 0 55px;
    box-sizing: border-box;
  }
  .cart-upload-pic .container .upload-pic {
    /* 顶部上传图片 */
    padding-top: 55px;
    padding-bottom: 26px;
    margin-bottom: 30px;
    border: 1px dashed #ccc;
    background: #fbf9fe;
  }

  .cart-upload-pic .container .upload-pic .top-upload .left-pic {
    float: left;
    margin-left: 100px;
  }

  .cart-upload-pic .container .upload-pic .top-upload .left-pic img {
    width: 122px;
    height: 108px;
    vertical-align: bottom;
  }

  .cart-upload-pic .container .upload-pic .top-upload .left-content {
    float: left;
    margin-left: 45px;
  }

  .top-upload .left-content .product-title {
    font-size: 26px;
    color: #000;
  }

  .top-upload .left-content .product-title span {
    font-size: 14px;
    padding-left: 10px;
  }

  .top-upload .left-content .product-text {
    font-size: 15px;
    line-height: 50px;
  }

  .top-upload .right-upload {
    float: right;
    width: 320px;
    margin-right: 190px;
  }



  .top-upload .right-upload .upload-btn {
    width: 320px;
    height: 80px;
    border-radius: 40px;
    background: #b01e26;
    text-align: center;
    line-height: 65px;
    cursor: pointer;
    border: none;
  }

  .right-upload .upload-btn .icon-shangchuan {
    font-size: 30px;
    color: #fff;
  }

  .top-upload .right-upload .upload-btn img {
    vertical-align: middle;
    margin-top: -8px;
  }

  .top-upload .right-upload .upload-btn span {
    font-size: 25px;
    color: #fff;
    padding-left: 15px;
  }

  .top-upload .right-upload p {
    padding: 20px 55px;
    color: #333;
  }

  .cart-upload-pic .container .upload-pic .bottom-tip {
    height: 48px;
    margin: 0 80px;
    border: 15px solid #fff;
    background: #f0fcf6;
    text-align: center;
    line-height: 48px;
    color: #4bc487;
    font-size: 16px;
  }
  .cart-upload-pic .container .upload-pic .bottom-tip img {
    width: 23px;
    height: 23px;
    margin-right: 20px;
    vertical-align: middle;
  }
  .cart-upload-pic .container .upload-pic .bottom-tip span {
    margin-right: 20px;
  }
  .cart-upload-pic .container .show-pic {
    /* 展示图片 */
    padding: 38px;
    margin-bottom: 26px;
    background: #fff;
  }
  .cart-upload-pic .container .show-pic .no-pic {
    text-align: center;
  }
  .cart-upload-pic .container .show-pic .no-pic img {
    width: 86px;
    height: 120px;
    margin: 50px 0;
    vertical-align: middle;
  }
  .cart-upload-pic .container .show-pic .no-pic span {
    display: inline-block;
    margin-left: 28px;
    vertical-align: middle;
    font-size: 29px;
    color: #b4b4b5;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item {
    float: left;
    position: relative;
    width: 254px;
    height: 200px;
    margin: 0 15px 15px 0;
    border: 1px solid #dbdcdc;
    text-align: center;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .pic {
    width: 230px;
    height: 172px;
    margin-top: 14px;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .time {
    position: absolute;
    top: -1px;
    left: -1px;
    width: 120px;
    height: 26px;
    background: rgba(0, 0, 0, 0.15);
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .time img {
    width: 21px;
    height: 17px;
    margin-top: -5px;
    vertical-align: middle;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .time span {
    font-size: 16px;
    color: #fff;
    line-height: 26px;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .cancel {
    position: absolute;
    top: -7px;
    right: -7px;
  }
  .cart-upload-pic .container .show-pic .pic-list .pic-item .cancel img {
    width: 33px;
    height: 33px;
  }
  .cart-upload-pic .container .bottom-btn {
    font-size: 16px;
    line-height: 44px;
  }
  .cart-upload-pic .container .bottom-btn div {
    width: 120px;
    height: 44px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
  }
  .cart-upload-pic .container .bottom-btn .left-back {
    float: left;
    border: 1px solid #b4b4b5;
  }
  .cart-upload-pic .container .bottom-btn .left-back a{
    display: block;
    width: 120px;
    height: 44px;
    color: #727171;
  }
  .cart-upload-pic .container .bottom-btn .right-ok {
    float: right;
    margin-right: 40px;
    margin-left: 16px;
    background: #b01e26;
  }
  .cart-upload-pic .container .bottom-btn .right-ok a{
    display: block;
    width: 120px;
    height: 44px;
    color: #fff;
  }
  .cart-upload-pic .container .bottom-btn .right-tip {
    float: right;
    color: #b01e26;
  }
</style>

