<template>
  <div>
    <div class="cart-upload-pic">
      <div class="container">
        <div class="label">
          <div>
            <span>已选</span>
            <i class="c_b11e25">0</i>
            <span>张 ,上传</span>
            <i class="c_b11e25">0</i>
            <span>张 上传中不要离开本页</span>
          </div>
          <ul>
            <template v-for="(item, index) in 3">
              <li class="fl">
                <div class="onload-pic">
                  <i class="el-icon-close icon-guanbi"></i>
                  <i class="el-icon-check chonseok"></i>
                  <!--<img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />-->
                  <img src="../../../static/images/46.png" class="w100 h100" alt="">
                  <!--<img src="../../../static/images/47.png" class="chonseok" alt="">-->
                </div>
                <div class="input">
                  <el-button class="prev fl">-</el-button>
                  <el-input class="fl" placeholder="0" readonly></el-input>
                  <el-button class="next fl">+</el-button>
                </div>
              </li>
            </template>

          </ul>
        </div>
        <div class="upload-pic clear">
          <div class="top-upload clearfix">
            <a href="javascript:void(0);" class="fl block href-btn add-pic">增加照片</a>
            <a href="javascript:void(0);" class="fl block href-btn">增加购物车</a>
          </div>
          <el-upload action="https://jsonplaceholder.typicode.com/posts/"
                     :on-preview="handlePreview" :on-remove="handleRemove" :file-list="fileList"
                     list-type="picture">
            <el-button class="onload" size="small" type="primary">
              <i class="el-icon-upload el-icon--right"></i>
              <i>点击上传</i>
            </el-button>
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
        fileList: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
      }
    },
    created() {
      this.$http.get('http://www.getcodeing.com/api/user/getuser').then((res) => {
          console.log(res);
      });
    },
    components: {
      ElButton

    },
    methods: {
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
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
    width: 43%;
    margin: 10px 27px 20px 0px;
    display: inline-block;
  }
  .container .label ul li:nth-child(2n) {
    margin: 10px 0px 0px;
  }
  .container .label ul li .input {
    margin-top: 10px;
  }

  .container .label ul li .onload-pic {
    width: 100%;
    height: 100%;
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
    top: -10px;
    right: -12px;
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
    padding: 5px 8%;
    margin: 0px;
    background: #c8c9ca;
    color: #fff;
    border: 1px solid #c8c9ca;
    border-radius: 0px;
  }

  .upload-pic .top-upload .href-btn {
    width: 45%;
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
    margin: 10px 0px;
  }

  .input .el-input {
    width: 59px;
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


</style>

