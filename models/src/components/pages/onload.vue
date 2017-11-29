<template>
  <div>
    <div class="cart-upload-pic">
      <div class="container">
        <div class="label">
          <div>
            <span>已选</span>
            <i class="c_b11e25">0</i>
            <span>张 ,上传</span>
            <i class="c_b11e25">{{ fileList.length }}</i>
            <span>张 上传中不要离开本页</span>
          </div>
          <ul>
            <template v-for="(item, index) in fileList">
              <li class="fl" :class="{ 'chonsepic': index == chonseIndex }" @click.stop="choosePic(item)" @longtouch="longClick()">
                <div class="onload-pic">
                  <i class="el-icon-close icon-guanbi" @click="deletePic(index, item)"></i>
                  <i class="el-icon-check chonseok" v-show="chonseok"></i>
                  <!--<img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />-->
                  <img :src="item.url" class="w100 h100" alt="">
                  <!--<img src="../../../static/images/47.png" class="chonseok" alt="">-->
                </div>
                <div class="input">
                  <el-button class="prev fl" @click="changeNumber(item.response.data, -1)">-</el-button>
                  <el-input v-model="item.response.data.num" class="fl" placeholder="0" readonly></el-input>
                  <el-button class="next fl" @click="changeNumber(item.response.data, 1)">+</el-button>
                </div>
              </li>
            </template>
          </ul>
        </div>
        <div class="upload-pic clear">
          <div class="top-upload clearfix">
            <!--<a href="javascript:void(0);" class="fl block href-btn add-pic">增加照片</a>-->
            <a class="block href-btn" @click="saveImages()">保存图片</a>
          </div>
          <el-upload ref="upload" :drag="false" name="img"
            action="https://xinye-art.com/public/api/home/front/imgupload"
             :on-preview="handlePreview"
             :on-remove="handleRemove"
             :on-success="handleAvatarSuccess"
             :file-list="fileList" :auto-upload="false">
            <el-button slot="trigger" size="small" type="primary" class="fl">选取文件</el-button>
            <el-button style="margin-left: 10px;" size="small" type="success" class="fr" @click="submitUpload">上传到服务器</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
          </el-upload>
        </div>
        <div class="c_9fa0a0 toast">点击照片可以删除</div>
      </div>
    </div>
    <div class="msg-ps clear">备注 ：(建议使用wifi/移动4G网络上传，上传时请耐心等候）</div>
  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  export default {
    data() {
      return {
        fileList: [],
        chonseIndex: 0,
        chonseok: false,
        piclist: [],
        num: 0,
      }
    },
    mounted() {

    },
    computed: {

    },
    components: {
      ElButton
    },
    methods: {
      saveImages() {
        let values = '', arr = [], json = {};
        for (let i in this.fileList) {
          values = this.fileList[i].response.data
        }
        this.$ajax.HttpPost('/api/home/shopcar/upSave',{
          id: this.$route.query.id,
          img: values.path,
        }).then((res) => {
          this.$message(res.msg);
        });
      },
      changeNumber(item,flag) {
        if (flag >= 0) {
          item.num += 1;
        } else {
          item.num -= 1;
          if (item.num <= 1) {
            item.num = 1;
          }
        }
      },
      submitUpload() {
        this.$refs.upload.submit();
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
      },
      choosePic(item, index) {
        for (let i in this.fileList) {
          if (this.fileList[i].uid === item.uid) {
            this.chonseok = true;
            break;
          }
        }
      },
      deletePic(index, item) {
        let getIndex = null;
        for (let i in this.fileList) {
          this.fileList[i].index = i
          if (this.fileList[i].index === index) {
            getIndex = i;
            break;
          }
        }
        if (getIndex >= 0) {
          this.fileList.splice(getIndex,1);
        }
      },
      handleAvatarSuccess(res, file, fileList) {
        console.log(fileList);
        this.fileList = fileList;
        this.piclist.push({
          url: res.data,
          num: 0,
        });
      },
      clearpic() {
        this.$confirm('确定要删除图片吗?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          this.$message({
            type: 'success',
            message: '删除成功!'
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          });
        });
      },
      goUpLoading() {

      }
    }
  }
</script>

<style>
  /* 购物车上传照片 */
  .cart-upload-pic {
    margin: 60px 10px 10px;
    padding: 10px 0px;
    background: #fff;
  }
  .cart-upload-pic .container .label {
    margin: 10px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
  }

  .container .label ul {
    overflow: hidden;
  }

  .container .label ul li {
    height: 100%;
    width: 8rem;
    margin: 10px 14px 0px 0px;
    display: inline-block;
  }

  .container .label ul li:nth-child(2n) {
    margin: 10px 0 0 0;
  }

  .container .label ul li .input {
    margin-top: 10px;
  }

  .container .label ul li .onload-pic {
    width: 100%;
    height: 7rem;
    position: relative;
  }
  .onload-pic .el-icon-close {
    color: #fff;
    border-radius: 100%;
    background: #000;
    padding: 6px;
  }
  .onload-pic .el-icon-check {
    color: #fff;
    text-align: center;
    line-height: 25px;
    padding: 3px;
    border-radius: 100%;
    background: #c40000;
  }

  .label ul li .onload-pic .icon-guanbi {
    position: absolute;
    top: -8px;
    right: -10px;
    font-size: 12px;
  }

  .onload-pic .chonseok {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 25px;
    height: 25px;
  }

  .container .upload-pic .el-button {
    padding: 10px 33px;
    height: 40px;
    margin: 0px 10px;
  }

  .container .onload {
    /*border: 1px solid #20a0ff;*/
    color: #fff;
    padding: 10px 33px;
  }

  .container .el-upload__tip {
    margin: 10px;
  }

  .container .toast {
    margin: 10px;
  }
  /* container end */

  .msg-ps{
    margin: 10px;
    padding: 0px 0px 55px;
  }

  .input .el-button {
    height: 30px;
    padding: 7px 8.5%;
    margin: 0px;
    background: #c8c9ca;
    color: #fff;
    border: 1px solid #c8c9ca;
    border-radius: 0px;
  }

  .upload-pic .top-upload .href-btn {
    width: 93%;
    background: #b11e25;
    height: 40px;
    border-radius: 5px;
    text-align: center;
    color: #fff;
    line-height: 40px;
    margin: 10px 10px 0;
    border: 1px solid #b11e25;
  }
  .upload-pic .top-upload .add-pic {
    background: #fff;
    color: #b11e25;
    border: 1px solid #b11e25;
  }

  .upload-pic .top-upload .href-btn:last-child {
    margin: 10px auto;
  }

  .input .el-input {
    width: 4rem;
  }

  .el-input__inner {
    height: 30px;
    text-align: center;
    border-radius: 0px;
  }

  /* el-message-box start */
  .el-message-box {
    width: 90%;
  }
  /* el-message-box end*/

  @media screen and (max-width : 375px){
    .container .label ul li {
      margin: 10px 14px 0px 0px;
    }
  }



</style>

