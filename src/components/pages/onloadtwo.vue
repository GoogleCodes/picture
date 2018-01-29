<template>
  <div class="bgcolor">
    <div class="w1200 load-con">
      <div class="fl">
        <div class="load-prc">
          <div class="bottom-tip">
            <el-upload action="https://xinye-art.com/public/api/home/front/imgupload"
                        name="img" class="image-uploader-warp"
                        :drag="false" :on-preview="handlePreview"
                        :on-success="handleAvatarSuccess"
                        :before-upload="handleBeforeUpload"
                        :onError="uploadError" :on-remove="handleRemove"
                        :file-list="goFile.fileList">
                <el-button  type="primary" class="upload-btn">
                  <i class="el-icon-upload el-icon--right"></i>
                  <i>上传</i>
                </el-button>
            </el-upload>
            <span class="tog">
              仅支持上传png/jpg格式图片分辨率300dpi以上
            </span>
          </div>
          <div class="item-pic">
            <template v-for="(k,i) in specList">
              <div class="picture" :style="{background: 'url('+ k.img +') no-repeat',
              'backgroundSize': 'cover'}">
                <div v-if="goFile.file.data == undefined"></div>
                <img v-else :src="goFile.file.data.path" class="onloadPicture">
              </div>
            </template>
          </div>
          <el-button @click="_openpop()">预览</el-button>
        </div>
      </div>
      <div class="fr">
        <template>
          <div class="load-desc">
            <h1 class="ft-30 desc-title">{{ typeList.photo_name }}</h1>
            <div class="line"></div>
            <p class="ft-14" style="color: #898989;margin-left: 30px;">{{ typeList.photo_remark }}</p>
            <template v-for="(k,pindex) in typeList.myspec">
              <div class="guige clear">
                <h1 class="ft-18 guige-title">{{ k.spec }}</h1>
                <ul>
                  <template v-for="x in k.item" >
                    <vspec :value="x.id" :text="x.item" @chonseSpec="chonseSpec(pindex,x.id,x.item)"></vspec>
                  </template>
                </ul>
              </div>
            </template>
            <div class="nothing clear" style="display: none;">
              <div class="">
                <img src="../../../static/images/34.png" alt="" class="fl" >
                <span>暂无图片</span>
              </div>
            </div>
            <div class="have-pic clear">
              <div class="pic-under" v-if="goFile.file.data == undefined"></div>
              <img v-else :src="goFile.file.data.path" alt="" class="w100 h100">
            </div>
          </div>
        </template>
      </div>
    </div>

    <!-- pop start -->
    <div class="pop" @click="_gopop()" v-show="pops"></div>
    <div class="pop-layer" id="layer" v-show="pops">
      <div class="fl layer-pic">
        <ul>
          <template v-for="(k,i) in goFile.fileList">
            <li @click="onChonsePic(k.response,i)">
              <img :src="k.response.data.path" alt="" class="w100 h100">
            </li>
          </template>
        </ul>
      </div>
      <div class="fr">
        <div class="show-picture">
          <template v-for="(k,i) in specList">
            <div class="wrap-pic" :style="{background: 'url('+ k.data +')'}">
              <img :src="goFile.cpic" alt="" :style="{width: '+ w + px'}" class="onloadPicture w100 h100">
            </div>
          </template>
          <div class="show-util">
            <span class="block iconfont icon-fangda fl" @click="Bigger()"></span>
            <span class="block iconfont icon-suoxiao fl" @click="Smaller()"></span>
          </div>
        </div>
        <el-button @click="pops = false">重新上传</el-button>
      </div>
      <div class="iconfont icon-zengjia close-pop" @click="pops = false"></div>
    </div>
    <!-- pop end -->
  </div>
</template>

<script type="text/javascript">

  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  import vspec from '@/components/dome/spec'

  export default {
    components: {
      vspec,
      ElButton,
    },
    data() {
      return {
        pops: false,
        typeList: [],
        SizeList: [],
        ColorList: [],
        goFile: {
          fileList: [],
          file: {},
          cpic: '',
        },
        guige: [],
        guigeName: [],
        specList: [],
        w: 0,
        h: 0
      }
    },
    created() {

    },
    mounted () {
      this.getTypeList();
    },
    methods: {
      Bigger() {

      },
      Smaller() {

      },
      getTypeList() {
        this.$ajax.HttpPost('/api/home/photo/photoById',{
          id: this.$route.query.id
        }).then((res) => {
          this.typeList = res.data;
        });
      },
      checkGuige() {
        if (this.guige.length !== this.typeList.myspec) {
          return false;
        } else {
          for (let gg = 0; gg < this.guige.length; gg++) {
            if (typeof this.guige[gg] === 'undefined' || this.guige[gg] == '') {
              return false;
            }
          }
          return true;
        }
      },
      chonseSpec(index, id, name) {
        this.$set(this.guige, index, id);
        this.$set(this.guigeName, index, name);
        if (!this.checkGuige) {
          return;
        }
        this.$ajax.HttpPost('/api/home/photo/sku',{
          pid: this.$route.query.id,
          spec: this.guige.join("-").match(/\d+/g).toString().replace(',','-')
        }).then((res) => {
          this.specList = res.data;
        });
      },
      _openpop() {
        if (this.goFile.fileList.length == 0) {
          this.$message('请先上传图片');
          return false;
        }
        this.pops = true;
      },
      _gopop() {
        this.pops = false;
      },
      onChonsePic(key, index) {
        console.log(key.data.path, index);
        this.goFile.cpic = key.data.path;
      },
      handleBeforeUpload(file) {

      },
      handleAvatarSuccess(res, file,fileList) {
        try {
          this.goFile.file = res;
          this.goFile.fileList = fileList;
          console.log(this.goFile.fileList,fileList);
        } catch(e) {
        }
      },
      handlePreview(file, fileList) {
      },
      uploadError (response, file, fileList) {
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      }

    }
  }

</script>

<style type="text/css">
  /* load-con start */
  .load-con {
    margin: 0px auto 180px;
    overflow: hidden;
    position: relative;
    top: 50px;
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
    border: 1px solid #b11e25;
    background: #b11e25;
    border-radius: 100px;
    text-align: center;
    cursor: pointer;
    line-height: 65px;
    font-size: 25px;
    color: #fff;
  }

  .bottom-tip .upload-btn .icon-shangchuan {
    color: #fff;
    font-size: 26px;
  }

  .load-prc .item-pic .picture {
    width: 84%;
    height: 0px;
    margin: 50px auto;
    position: relative;
    overflow: hidden;
    padding-top: 125%;
    background: url('../../../static/images/38.png') no-repeat;
  }

  .load-prc .item-pic .picture .onloadPicture {
    width: 86.6%;
    height: 80%;
    margin: 47px auto;
    position: absolute;
    top: -4px;
    left: 44px;
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
    font-size: 21px;
    line-height: 32px;
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

  .load-desc .guige ul .active {
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
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
    /*border: 1px solid #000;*/
    padding: 10px;
    width: 230px;
    height: 175px;
    margin: 380px auto 28px;
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
    margin: 0 25px 10px;
    width: 150px;
    height: 150px;
    cursor: pointer;
  }

  .pop-layer .fr {
    width: 815px;
    height: 620px;
    margin: 30px 35px;
    position: relative;
  }

  .pop-layer .fr .show-picture {
    width: 100%;
    height: 85%;
    position: relative;
    background: rgb(247, 248, 248);
    overflow: hidden;
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
    color: #f1f1f1;
    display: none;
  }
  .show-util .iconfont:hover {
    background: #4bc487;
  }

  .pop-layer .close-pop {
    float: right;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
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
    width: 100%;
    height: 100%;
    margin: 0px auto;
    /*position: relative;*/
    /*top: 20px;*/
    background: url('../../../static/images/38.png') no-repeat;
  }

  .el-upload--text {
    width: 320px;
    height: 100%;
    overflow: hidden;
    margin: 0px auto;
    display: block;
  }

  .image-uploader-warp .el-upload--text {
    width: 100%;
    overflow: hidden;
    height: 100%;
  }

  /* pop end */
</style>
