<template>
  <div class="bgcolor">
    <div class="cart-upload-pic w1200">
      <div class="el-upload-icon">
        <div class="container">
          <div class="upload-pic">
            <div class="top-upload clearfix">
              <div class="left-pic">
                <template v-for="k in fList">
                  <img :src="k.url" alt="">
                </template>
              </div>
              <div class="left-content">
                <div class="product-title">{{ $route.query.name }}</div>
                <div class="product-text">{{ $route.query.desc }}</div>
              </div>
              <div class="right-upload">
                <el-upload action="https://xinye-art.com/public/api/home/front/imgupload"
                           name="img" class="image-uploader-warp"
                           :drag="false"
                           :on-success="handleAvatarSuccess"
                           :multiple="true"
                           :before-upload="handleBeforeUpload"
                           :file-list="fileList" :on-remove="handleRemove">
                  <el-button type="primary" class="upload-btn">
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
          <div class="show-pic">
            <div class="no-pic" v-if="list.length == 0">
              <img src="../../../static/images/34.png" alt="">
              <span>暂无图片</span>
            </div>
            <ul class="pic-list clearfix block w100 h100" v-else>
              <template v-for="(k,i) in list">
                <li class="pic-item">
                  <div style="border: 1px solid #dbdcdc;padding: 0 0 15px 0;">
                    <img class="pic" :src="k.src" alt="">
                    <div class="time">
                      <img src="../../../static/images/36.png" alt="">
                      <span>2017-08-18</span>
                    </div>
                    <div class="cancel" @click="deletePic(k, i)">
                      <img src="../../../static/images/35.png" alt="">
                    </div>
                  </div>
                  <div class="item-amount">
                    <el-button slot="prepend" class="no-minus fl" style="margin: 0 10px 0 0;"
                               @click="changeNumber(i, -1)">
                       -
                    </el-button>
                    <el-input type="text" v-model="k.sum" class="fl" readonly></el-input>

                    <el-button slot="append" class="add-max fl" style="margin-left: 10px;"
                               @click="changeNumber(i, 1)">+
                    </el-button>
                  </div>
                </li>
              </template>
            </ul>
          </div>
          <!-- 功能按钮 -->
          <div class="bottom-btn clearfix">
            <div class="left-back">
              <router-link :to="{ path: '/cart/cart'}">返回购物车</router-link>
            </div>
            <div class="right-ok" @click="goSubmit()">确认提交</div>
            <span class="right-tip">您已经传了{{ count }}张照片</span>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="layer-upload"></div>-->
    <!--<div class="layer-pop">-->
    <!--<ul class="fl">-->
    <!--<li>-->
    <!--<img src="../../../static/images/33.png" alt="">-->
    <!--</li>-->
    <!--</ul>-->
    <!--<div class="fr iconfont el-icon-close"></div>-->
    <!--<img src="../../../static/images/33.png" alt="">-->
    <!--</div>-->
  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  import {mapGetters, mapActions} from 'vuex'
  import {GET_USER_INFO} from '../../store/getters/type'

  export default {
    data() {
      return {
        fileList: [],
        fList: [],
        list: [],
        file: null,
        picVisi: true,
        img: '',
        arr: [],
        options: {},
        orderList: [],
      }
    },
    created() {
      this.fetchData()
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
      //  统计上传多小张图片
      count() {
        return this.list.length;
      },
    },
    components: {
      ElButton,
    },
    methods: {
      changeNumber(index, flag) {
        let option = {}, json = {}, arr = [], brr = [], that = this;
        if (flag >= 1) {
          this.list[index].sum++;
        } else {
          this.list[index].sum--;
        }
        if (this.list[index].sum <= 1) {
          this.list[index].sum = 1;
        }
        for(let i in this.list) {
          json = {
            img: this.list[i].src,
            num: this.list[i].sum,
          };
          arr.push(json);
        }
        let count = arr;
        if (typeof JSON.stringify(count) === 'string') {
          this.$ajax.HttpPost('/api/home/shopcar/upSave', {
            id: that.$route.query.id,
            img: JSON.stringify(count),
            num: 1,
          }).then((res) => {
            this.$message(res.msg);
          });
        }
      },
      deletePic(item, index) {
        let getIndex = null, json = {}, arr = [];
        this.list.splice(index, 1);
        for (let i in this.list) {
          json = {
            img: this.list[i].src,
            num: this.list[i].sum
          };
          arr.push(json);
        }
        if (typeof JSON.stringify(arr) === 'string') {
          this.$ajax.HttpPost('/api/home/shopcar/upSave', {
            id: this.$route.query.id,
            img: JSON.stringify(arr),
            num: 1,
          }).then((res) => {
            this.$message(res.msg);
          });
        }
      },
      goSubmit() {
        let that = this;
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
          let id = 0, arr = [];
          for (let i in res.data) {
            id = res.data[i].id;
            if (that.$route.query.id == id) {
              //  获取购物车商品
              this.orderList = res.data[i];
              arr.push(this.orderList)
              this.$store.commit('SET_GO_PAY', arr);
              this.$router.push({ path: '/cart/submit' });
            }
          }
        })

      },
      fetchData() {
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
          let id = 0;
          if(this.list == "") {
            this.isNoList = false;
          } else {
            this.isNoList = true;
          }
          let json = {}, arr = [];
          for (let i in res.data) {
            id = res.data[i].id;
            if (this.$route.query.id == id) {
              this.fList = res.data[i].goods_thumb;
              if(res.data[i].upimg == null) {
                return false;
              } else {
                arr = arr.concat(res.data[i].upimg);
              }
            }
          }
          for (let j in arr) {
            json = {
              src: arr[j].img,
              sum: arr[j].num,
            };
            this.list.push(json);
          }
        }).catch((error) => {
        });
      },
      saveImages() {
        let json = {}, arr = [], brr = [], option = {};
        for(let y in this.list) {
          option = {
            img: this.list[y].src,
            num: this.list[y].sum
          };
          brr.push(option);
        }
        for(let i in this.fileList) {
          json = {
            img: this.fileList[i].response.data.path,
            num: this.fileList[i].response.data.num,
          };
          arr.push(json);
        }
        let count = arr.concat(brr);
        if (typeof JSON.stringify(count) === 'string') {
          this.$ajax.HttpPost('/api/home/shopcar/upSave', {
            id: this.$route.query.id,
            img: JSON.stringify(count),
            num: 1,
          }).then((res) => {
            this.$message(res.msg);
            location.reload();
          });
        }
      },
      handleBeforeUpload(file) {

      },
      handleAvatarSuccess(res, file, fileList) {
        let options = {sum: 1};
        this.arr.push(options);
        try {
          setTimeout(() => {
            this.fileList = fileList;
            this.saveImages();
          }, 500)
        } catch (e) {
        }
      },
      handleRemove(file, fileList) {
        try {
          for (let i in fileList) {
            this.fileList = fileList[i];
          }
        } catch (e) {
        }
      }
    }
  }
</script>

<style>
  /* 购物车上传照片 */
  .cart-upload-pic {
    margin: 0px auto 130px;
    position: relative;
    top: 50px;
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
    padding: 38px 5px;
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
    width: 252px;
    margin: 0 15px 20px 7px;
    text-align: center;
  }

  .cart-upload-pic .container .show-pic .pic-list .pic-item:nth-child(4n) {
    margin: 0;
  }

  .pic-item .item-amount {
    margin: 20px 0px 0;
    overflow: hidden;
  }

  .pic-item .item-amount .el-input {
    width: 60%;
  }

  .pic-item .item-amount .el-input__inner {
    width: 100%;
    padding: 0;
    margin: 0;
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
    top: -14px;
    cursor: pointer;
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

  .cart-upload-pic .container .bottom-btn .left-back a {
    display: block;
    width: 120px;
    height: 44px;
    color: #727171;
  }

  .cart-upload-pic .container .bottom-btn .right-ok {
    float: right;
    color: #fff;
    display: block;
    width: 120px;
    height: 44px;
    margin: 0px 40px 0px 16px;
    background: #b01e26;
  }

  .cart-upload-pic .container .bottom-btn .right-tip {
    float: right;
    color: #b01e26;
  }

  .layer-upload {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
  }

  .layer-pop {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 1088px;
    height: 550px;
    display: block;
    margin: 110px auto;
    background: #fff;
    overflow: hidden;
  }

  .layer-pop ul li {
    width: 150px;
    height: 150px;
    margin: 0 20px 0 0;
    overflow: hidden;
  }

  .layer-pop ul li:last-child {
    margin-bottom: 30px;
  }

  .layer-pop ul {
    height: 550px;
    overflow: hidden;
    overflow-y: auto;
  }

  .layer-pop ul li img {
    width: 100%;
    height: 100%;
  }

  .layer-pop .el-icon-close {
    float: right;
    padding: 15px;
    cursor: pointer;
  }

  .layer-pop img {
    margin: 30px;
    height: 90%;
  }

  /*.tab-title {*/
    /*height: 50px;*/
    /*line-height: 50px;*/
    /*margin: 10px 10px 20px;*/
    /*border-bottom: 1px solid #ccc;*/
    /*font-size: 20px;*/
    /*font-weight: bold;*/
  /*}*/

</style>

