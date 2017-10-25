<template>
  <div>
    <div class="frame-bg" style="">
      <div class="frame-detail">
        <div class="fl det-pic">
          <img src="../../../static/images/56.png" class="w100 h100" alt="">
        </div>
        <div class="fr det-news">
          <p class="ft-18 det-title">复古木纹</p>
          <p class="det-desc c_b3b3b3">质感卓越，进口画芯高清质感图</p>
        </div>
      </div>
      <div>
        <el-select v-model="value" placeholder="选择相框">
          <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"></el-option>
        </el-select>
        <el-select v-model="value" placeholder="选择尺寸">
          <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"></el-option>
        </el-select>
      </div>

      <div class="onload-ele">
        <div>
          <el-upload action="https://jsonplaceholder.typicode.com/posts/"
                     list-type="picture-card" :on-preview="handlePictureCardPreview" :on-remove="handleRemove">
            <i class="el-icon-plus"></i>
          </el-upload>
          <el-dialog v-model="dialogVisible" size="tiny">
            <img width="100%" :src="dialogImageUrl" alt="">
          </el-dialog>
        </div>
      </div>
      <div class="matop_20">仅支持上传png/jpg格式图片分辨率300dpi以上</div>

      <div class="btn-util">
        <a href="javascript:void(0);" class="block fl btn showpic" @click="visiLayer = true">预览效果</a>
        <a href="javascript:void(0);" class="block fr btn again">重新上传</a>
      </div>
    </div>
    <div class="layer w100 h100" v-show="visiLayer" @click="clearLayer()"></div>
    <div class="layer-pic" v-show="visiLayer">
      <i class="iconfont icon-guanbi fr" @click="clearLayer()"></i>
      <div class="layer-title">
        <span>预览效果</span>
      </div>
      <div class="onload-pic">
        <img src="../../../static/images/23.png" class="w100 h100 pay-pic" alt="">
      </div>
      <div class="openClear">
        <i class="iconfont icon-fangda" @click="openpic()"></i>
        <i class="iconfont icon-suoxiao"></i>
      </div>
    </div>
  </div>

</template>

<script type="text/javascript">

  import heads from '@/components/top/Top.vue'
  import foots from '@/components/footer/Footer.vue'
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  export default {
    data() {
      return {
        visiLayer: false,
        options: [{
          value: '选项1',
          label: '黄金糕'
        }, {
          value: '选项2',
          label: '双皮奶'
        }, {
          value: '选项3',
          label: '蚵仔煎'
        }, {
          value: '选项4',
          label: '龙须面'
        }, {
          value: '选项5',
          label: '北京烤鸭'
        }],
        value: '',
        dialogImageUrl: '',
        dialogVisible: false
      }
    },
    components: {
      ElButton, heads,
      foots
    },
    created() {

    },
    methods: {
      openpic() {

      },
      clearLayer() {
        this.visiLayer = false;
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePictureCardPreview(file) {
        this.dialogImageUrl = file.url;
        this.dialogVisible = true;
      }
    }
  }
</script>

<style type="text/css">
  .layer {
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.5);
  }
  .layer-pic {
    /*background: url('../../../static/images/57.png') no-repeat;*/
    background: #fff;
    position: fixed;
    top: 150px;
    left: 0px;
    right: 0px;
    margin: 0px auto;
    width: 90%;
    height: 280px;
    border-radius: 5px;
    z-index: 250;
  }
  .layer-pic .openClear {
    margin: 15px auto 0px;
    width: 30%;
    text-align: center;
  }
  .layer-pic .openClear .icon-fangda , .layer-pic .openClear .icon-suoxiao {
    font-size: 26px;
    margin: 0px 5px;
    color: #666;
  }
  .layer-pic .icon-guanbi {
    font-size: 26px;
    position: relative;
    top: 10px;
    right: 15px;
    color: #666;
  }
  .layer-pic .layer-title {
    padding: 10px 15px;
    border-bottom: 1px solid #f2f2f2;
  }
  .layer-pic .onload-pic {
    padding: 0px 15px;
    margin-top: 19px;
    border-radius: 5px;
  }
  .layer-pic .onload-pic img {
    /*transition: all 0s ease-out;*/
    /*transform: translate3d(160px, 2.5px, 0px) scale3d(0.44, 0.44, 1);*/
  }

  /* frame-bg start */
  .frame-bg {
    background: #fff;
    padding: 0px 20px 95px;
    margin-top: 46px;
    overflow: hidden;
  }
  .frame-bg .layer-pic .pay-pic {

  }
  .frame-bg .matop_20 {
    color: #a5a5a5;
  }
  .frame-bg .frame-detail {
    border-bottom: 1px solid #eee;
    height: 100%;
    padding: 23px 0px;
    overflow: inherit;
  }
  .frame-bg .btn-util {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
  }
  .frame-bg .btn-util .btn{
    width: 50%;
    height: 45px;
    line-height: 45px;
    text-align: center;
  }
  .frame-bg .btn-util .showpic {
    background: #e6e6e6;
  }
  .frame-bg .btn-util .again {
    background: #b11e25;
    color: #fff;
  }
  .frame-bg .frame-detail .det-pic {
    width: 28%;
    height: 100%;
  }
  .frame-bg .frame-detail .det-news {
    width: 68%;
  }
  .frame-detail .det-news .det-title {
    font-weight: bold;
  }
  .frame-detail .det-news .det-desc {
    height: 35px;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 18px;
  }
  .frame-bg .onload-ele {
    width: 100%;
    height: 208px;
    overflow: hidden;
    margin-top: 30px;
    background: url('../../../static/images/57.png') no-repeat;
    background-size: 100%;
  }
  /* frame-bg end */

</style>

<style>
  .el-select {
    width: 45%;
    margin: 25px 22px 0px 1px;
  }
  .el-select:last-child {
    margin: 25px 0 0;
  }

  .frame-bg .onload-ele .el-upload--picture-card {
    margin: 31px 0px 0px 69px;
    background: none;
    border: none;
  }

  .frame-bg .onload-ele .el-upload-list--picture-card .el-upload-list__item {
    margin: 31px 8px 8px 31px;
    width: 216px;
  }

</style>
