<template>
  <div class="bgcolor">
    <div class="w1200 load-con">
      <div class="fl">
        <div class="load-prc">
          <div class="bottom-tip">
            <div class="upload-btn">
              <i class="iconfont icon-shangchuan"></i>
              <span>上传照片</span>
            </div>
            <span class="tog">
              仅支持上传png/jpg格式图片分辨率300dpi以上
            </span>
          </div>
          <div class="item-pic">
            <div class="picture"></div>
          </div>
          <el-button @click="_openpop()">预览</el-button>
        </div>
      </div>
      <div class="fr">
        <div class="load-desc">
          <h1 class="ft-30 desc-title">复古木纹</h1>
          <div class="line"></div>
          <p class="ft-14" style="color: #898989;margin-left: 30px;">质感卓越，进口画芯高清质感图</p>

          <div class="guige">
            <h1 class="ft-18 guige-title">款色</h1>
            <ul>
              <li v-for="item in 2" class="fl block">仿木纹银色</li>
            </ul>
          </div>

          <div class="guige size">
            <h1 class="ft-18 guige-title">尺寸</h1>
            <ul>
              <li v-for="item in 4" class="fl block">仿木纹银色</li>
            </ul>
          </div>

          <div class="nothing clear" style="display: none;">
            <div class="">
              <img src="../../../static/images/34.png" alt="" class="fl" >
              <span>暂无图片</span>
            </div>
          </div>

          <div class="have-pic clear">
            <img src="../../../static/images/30.png" alt="" class="w100 h100" />
          </div>

        </div>
      </div>
    </div>

    <!-- pop start -->
    <div class="pop" @click="_gopop()" v-show="pops"></div>
    <div class="pop-layer" id="layer" v-show="pops">
      <div class="fl layer-pic">
        <ul>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
          <li>
            <img src="../../../static/images/30.png" alt="" class="w100 h100">
          </li>
        </ul>
      </div>
      <div class="fr">
        <div class="show-picture">
          <div class="wrap-pic">

          </div>
          <div class="show-util">
            <span class="block iconfont icon-fangda fl"></span>
            <span class="block iconfont icon-suoxiao fl"></span>
          </div>
        </div>
        <el-button>重新上传</el-button>
      </div>
      <div class="iconfont icon-zengjia close-pop"></div>
    </div>
    <!-- pop end -->

  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    components: {
      ElButton,
    },
    data() {
      return {
        pops: false
      }
    },
    created() {

    },
    mounted () {

    },
    methods: {
      _openpop() {
        this.pops = true;
      },
      _gopop() {
        this.pops = false;
      },
    }
  }

</script>

<style type="text/css">
  /* load-con start */
  .load-con {
    margin: 48px auto 180px;
    overflow: hidden;
  }

  .load-con .load-prc {
    width: 830px;
    height: 100%;
    background: #fdfaff;
    border: 1px dashed #dcdddd;
  }

  .load-con .load-prc .bottom-tip {
    width: 95%;
    height: 100%;
    border: 1px dashed #dcdddd;
    margin: 20px;
  }

  .load-prc .bottom-tip .tog {
    text-align: left;
    width: 210px;
    display: block;
    margin: 23px auto;
  }

  .load-prc .bottom-tip .upload-btn {
    width: 320px;
    height: 85px;
    margin: 40px auto 0;
    background: #b11e25;
    border-radius: 100px;
    text-align: center;
    cursor: pointer;
    line-height: 85px;
    font-size: 25px;
    color: #fff;
  }

  .bottom-tip .upload-btn .icon-shangchuan {
    color: #fff;
    font-size: 26px;
  }

  .load-prc .item-pic .picture {
    width: 621px;
    height: 414px;
    margin: 50px auto 78px;
    background: url('../../../static/images/38.png') no-repeat;
  }

  .load-prc .el-button{
    margin: 47px 60px;
    width: 125px;
    height: 45px;
  }

  .load-desc {
    width: 345px;
    overflow: hidden;
    height: 100%;
    border: 1px dashed #dcdddd;
    background: #fdfaff;
  }

  .load-desc .desc-title {
    margin: 40px 30px 10px;
  }

  .load-desc .line {
    width: 50px;
    height: 3px;
    background: #333;
    margin: 20px 0 10px 30px;
  }

  .load-desc .guige, .load-desc .size {
    margin: 50px 30px;
  }

  .guige .guige-title , .size .guige-title {
    color: #9fa0a0;
    font-weight: 500;
  }

  .load-desc .guige ul li {
    border: 1px solid #dcdddd;
    box-sizing: border-box;
    width: 135px;
    height: 35px;
    text-align: center;
    line-height: 35px;
    border-radius: 5px;
    background: #fff;
    color: #9fa0a0;
    margin: 10px 15px 20px 0px;
    cursor: pointer;
  }

  .load-desc .load-desc .size ul li {
    margin: 10px 15px 5px 0px;
  }

  .load-desc .guige ul li:last-child {
    margin: 10px 0px 20px 0px;
  }

  .load-desc .size ul li:nth-child(2n) {
    margin: 10px 0px 5px 0px;
  }

  .load-desc .nothing {
    margin: 270px 20px 250px;
    height: 117px;
  }

  .load-desc .nothing img {
    width: 83px;
    height: 117px;
    margin-left: 30px;
  }

  .load-desc .nothing span {
    font-size: 29px;
    text-indent: 1.5em;
    color: #b5b5b6;
    line-height: 117px;
    display: inline-block;
  }

  .load-desc .have-pic {
    border: 1px solid #000;
    padding: 10px;
    width: 230px;
    height: 175px;
    margin: 380px auto 60px;
  }
  /* load-con end */


  /* pop start */
  .pop {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.5);
  }

  .pop-layer {
    width: 1085px;
    height: 682px;
    border-radius: 5px;
    background: #fff;
    position: fixed;
    top: 100px;
    left: 0px;
    right: 0px;
    margin: 0px auto;
  }

  .pop-layer .layer-pic {
    width: 200px;
    height: 95%;
    overflow-y: auto;
    margin: 20px 0px;
  }

  .pop-layer .layer-pic ul li {
    margin: 25px 39px;
  }

  .pop-layer .fr {
    width: 810px;
    height: 620px;
    margin: 30px 35px;
    position: relative;
  }

  .pop-layer .fr .show-picture {
    width: 95%;
    height: 80%;
    background: #f7f8f8;
    position: relative;
  }

  .pop-layer .fr .el-button {
    position: absolute;
    bottom: 0px;
    right: 0px;
    left: 0px;
    width: 295px;
    height: 65px;
    background: #b11e25;
    border: 1px solid #b11e25;
    border-radius: 10px;
    font-size: 18px;
    text-align: center;
    margin: 0px auto;
    color: #fff;
  }

  .show-util {
    position: absolute;
    bottom: 10px;
    right: 10px;
    font-size: 16px;
  }

  .show-util .iconfont {
    font-size: 25px;
    margin: 0px 10px;
    cursor: pointer;
  }

  .pop-layer .close-pop {
    float: right;
    position: absolute;
    top: 15px;
    right: 10px;
    font-size: 36px;
    color: #c9caca;
    transition: 0.2s;
    transform: rotate(0deg);
  }

  .pop-layer .close-pop:hover {
    -webkit-transition: 0.2s;
    -moz-transition: 0.2s;
    -ms-transition: 0.2s;
    -o-transition: 0.2s;
    transition: 0.2s;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
    cursor: pointer;
  }

  .pop-layer .wrap-pic {
    width: 621px;
    height: 414px;
    margin: 0px auto;
    position: relative;
    top: 25px;
    background: url('../../../static/images/38.png') no-repeat;
  }

  /* pop end */
</style>
