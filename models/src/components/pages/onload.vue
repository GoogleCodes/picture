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
              <li class="fl" :class="{ 'chonsepic': index == chonseIndex }" @click.stop="choosePic(item, index)">
                <div class="onload-pic">
                  <i class="el-icon-close icon-guanbi" @click="deletePic(index, item)"></i>
                  <i class="el-icon-check chonseok" v-show="chonseok"></i>
                  <!--<img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />-->
                  <img :src="item.url" class="w100 h100 previewer-demo-img" @click="$refs.previewer.show(index)">
                  <!--<img src="../../../static/images/47.png" class="chonseok" alt="">-->
                </div>
                <div class="input">
                  <el-button class="prev fl" @click="changeNumber(index, -1)">-</el-button>
                  <el-input v-model="arr[index].sum" class="fl" placeholder="0" readonly></el-input>
                  <el-button class="next fl" @click="changeNumber(index, 1)">+</el-button>
                </div>
              </li>
            </template>
          </ul>
        </div>
        <div class="upload-pic clear">

          <el-upload
            class="upload-demo" name="img"
            :action="uploadUrl"
            :on-success="handleAvatarSuccess"
            :file-list="fileList" :multiple="true">
            <el-button size="small" type="primary">点击上传</el-button>
            <el-button>立即下单</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
          </el-upload>

          <!--<div class="top-upload clearfix">-->
            <!--&lt;!&ndash;<a href="javascript:void(0);" class="fl block href-btn add-pic">增加照片</a>&ndash;&gt;-->
            <!--<a class="block href-btn" @click="saveImages()">保存图片</a>-->
          <!--</div>-->

        </div>
        <div class="c_9fa0a0 toast">点击照片可以删除</div>
      </div>
    </div>
    <div class="msg-ps clear">备注 ：(建议使用wifi/移动4G网络上传，上传时请耐心等候）</div>

    <div style="height: 150px;">
      <previewer :list="countArrays" ref="previewer" :options="options"></previewer>
    </div>

  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";

  import {mapGetters, mapActions} from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'

  import previewer from '../../../node_modules/vux/src/components/previewer/index.vue'

  export default {
    data() {
      return {
        uploadUrl: 'https://xinye-art.com/public/api/home/front/imgupload',
        fileList: [],
        fList: [],
        arr: [],
        chonseIndex: 0,
        chonseok: false,
        piclist: [],
        num: 0,
        count: 0,
        countArrays: [],
        options: {
          getThumbBoundsFn (index) {
            let thumbnail = document.querySelectorAll('.previewer-demo-img')[index]
            let pageYScroll = window.pageYOffset || document.documentElement.scrollTop
            let rect = thumbnail.getBoundingClientRect()
            return {x: rect.left, y: rect.top + pageYScroll, w: rect.width}
          }
        },
      }
    },
    created() {
      this.fetchData();
    },
    computed: {
      ...mapGetters({
        get_user_info: GET_USER_INFO
      }),
    },
    components: {
      ElButton,
      previewer,
    },
    methods: {
      show(index) {
        this.$refs.previewer.show(index)
      },
      saveImages() {
        if (typeof JSON.stringify(this.arr) === 'string') {
          this.$ajax.HttpPost('/api/home/shopcar/upSave',{
            id: this.$route.query.id,
            img: JSON.stringify(this.arr.concat(this.fList)),
            num: 1,
          }).then((res) => {
            this.$message(res.msg);
            location.reload();
          });
        }
      },
      handleChange(file, fileList) {

      },
      changeNumber(index,flag) {
        if(flag >= 1) {
          this.arr[index].sum++;
        } else {
          this.arr[index].sum--;
        }
        if (this.arr[index].sum <= 1) {
          this.arr[index].sum = 1;
        }
      },
      submitUpload() {
        this.$refs.upload.submit();
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
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
        let options = {sum: 1};
        this.arr.push(options);
        let b = {};
        try {
          setTimeout(() => {
            this.fileList = fileList;

            /*for(let i in fileList) {
              b = {
                src: fileList[i].url,
                sum: 1
              };
            }
            this.countArrays.push(b);
//          this.fileList = fileList;*/
          }, 500)
        } catch(e) {

        }
//        for(let i in this.countArrays) {
//          options = {
//            img: this.countArrays[i].src,
//            num: this.countArrays[i].sum
//          };
//        }
      },
      fetchData() {
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
          for (let i in res.data) {
            let id = res.data[i].id;
            if(this.$route.query.id == id) {
              this.fList = res.data[i].upimg;
              this.list = res.data[i].goods_thumb;
              let arr = res.data[i].upimg;
            }
            for(let i in this.fList) {
              console.log(this.fList[i], "0+0+0+0+0+");
            }
          }
        }).catch((error) => {
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

  .upload-demo .el-upload {
    width: 100%;
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

