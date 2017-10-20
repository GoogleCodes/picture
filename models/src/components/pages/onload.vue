<template>
  <div>
    <div class="cart-upload-pic">
      <div class="container">
        <div class="label" style="display: none;">
          <div>
            <span>已选</span>
            <i class="c_b11e25">0</i>
            <span>张 ,上传</span>
            <i class="c_b11e25">0</i>
            <span>张 上传中不要离开本页</span>
          </div>
          <ul>
            <li class="fl">
              <div class="onload-pic">
                <img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />
                <img src="../../../static/images/46.png" class="w100 h100s" alt="">
                <img src="../../../static/images/47.png" class="chonseok" alt="">
              </div>
              <div class="input">
                <el-button class="prev fl">-</el-button>
                <el-input class="fl" placeholder="0" readonly></el-input>
                <el-button class="next fl">+</el-button>
              </div>
            </li>
          </ul>
        </div>
        <div class="upload-pic clear">
          <div class="top-upload clearfix">
            <el-button class="fl">增加照片</el-button>
            <el-button class="fl">增加购物车</el-button>
            <!--<el-upload class="fr" action="https://jsonplaceholder.typicode.com/posts/">-->
              <!--<slot></slot>-->
              <!--<el-button class="onload" type="primary upload-btn" @click="goUpLoading">-->
                <!--<i class="el-icon-upload el-icon&#45;&#45;right"></i>-->
                <!--<i>上传</i>-->
              <!--</el-button>-->
            <!--</el-upload>-->
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
    <div class="msg-ps">备注 ：(建议使用wifi/移动4G网络上传，上传时请耐心等候）</div>
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
    margin: 0px 10px;
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
    width: 120px;
    height: 165px;
    margin: 10px 0px 0px;
    display: inline-block;
  }

  .container .label ul li .onload-pic {
    width: 120px;
    height: 120px;
    position: relative;
  }

  .label ul li .onload-pic .icon-guanbi {
    position: absolute;
    top: -10px;
    right: -12px;
    color: #333;
  }

  .onload-pic .chonseok {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 35px;
    height: 35px;
  }

  .container .upload-pic .el-button {
    padding: 10px 42px;
    height: 40px;
    /*border: 1px solid #b11e25;*/
    /*color: #b11e25;*/
    margin: 0px 5px;
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
    clear: both;
    margin: 10px;
  }

  .input .el-button {
    height: 30px;
    padding: 5px 10px;
    margin: 0px;
    background: #c8c9ca;
    color: #fff;
    border: 1px solid #c8c9ca;
    border-radius: 0px;
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

