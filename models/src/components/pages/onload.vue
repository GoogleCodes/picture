<template>
  <div>
    <div class="cart-upload-pic">
      <div class="container">
        <div class="label">
          <div>
            <span>已选</span>
            <i class="c_b11e25">0</i>
            <span>张 ,上传</span>
            <i class="c_b11e25">{{ list.length }}</i>
            <span>张 上传中不要离开本页</span>
          </div>
          <ul>
            <!--<template v-for="(item, index) in fileList" v-show="!isNoList">-->
              <!--<li class="fl" :class="{ 'chonsepic': index == chonseIndex }" @click.stop="choosePic(item, index)">-->
                <!--<div class="onload-pic">-->
                  <!--<i class="el-icon-close icon-guanbi" @click="deletePic(index, item)"></i>-->
                  <!--<i class="el-icon-check chonseok" v-show="chonseok"></i>-->
                  <!--&lt;!&ndash;<img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />&ndash;&gt;-->
                  <!--<img :src="item.url" class="w100 h100 previewer-demo-img" @click="$refs.previewer.show(index)">-->
                  <!--&lt;!&ndash;<img src="../../../static/images/47.png" class="chonseok" alt="">&ndash;&gt;-->
                <!--</div>-->
                <!--<div class="input">-->
                  <!--<el-button class="prev fl" @click="changeNumber(index, -1)">-</el-button>-->
                  <!--<el-input v-model="arr[index].sum" class="fl" placeholder="0" readonly></el-input>-->
                  <!--<el-button class="next fl" @click="changeNumber(index, 1)">+</el-button>-->
                <!--</div>-->
              <!--</li>-->
            <!--</template>-->

            <template v-for="(item, index) in list" v-show="isNoList">
              <li class="fl" :class="{ 'chonsepic': index == chonseIndex }" @click.stop="choosePic(item, index)">
                <div class="onload-pic">
                  <i class="el-icon-close icon-guanbi" @click="deletePic(index, item)"></i>
                  <i class="el-icon-check chonseok" v-show="chonseok"></i>
                  <!--<img src="../../../static/images/35.png" class="icon-guanbi" @click="clearpic()" />-->
                  <img :src="item.src" style="margin: 0px auto;" class="previewer-demo-img block" @click="$refs.previewer.show(index)">
                  <!--<img src="../../../static/images/47.png" class="chonseok" alt="">-->
                </div>
                <div class="input">
                  <el-button class="prev fl" @click="changeNumber(index, -1)">-</el-button>
                  <el-input v-model="item.sum" class="fl" placeholder="0" readonly></el-input>
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
            :on-change="changePicture"
            :on-success="handleAvatarSuccess"
            :file-list="fileList" :multiple="true">
            <el-button size="small" type="primary">增加相片</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
          </el-upload>
          <el-button @click="orderNow()">立即下单</el-button>


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
    <previewer :list="list" ref="previewer" :options="options"></previewer>
    </div>

  </div>
</template>

<script type="text/javascript">
  import ElButton from "../../../node_modules/element-ui/packages/button/src/button";
  import previewer from '../../../node_modules/vux/src/components/previewer/index.vue'

  import {mapGetters, mapActions} from 'vuex'
  import {GET_USER_INFO} from '../../store/getters/type'


  import wx from 'weixin-js-sdk'


  export default {
    data() {
      return {
        list: [],
        isNoList: false,
        uploadUrl: 'https://xinye-art.com/public/api/home/front/imgupload',
        fileList: [],
        fList: [],
        arr: [],
        arrays: [],
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
      this.$ajax.HttpPost('/api/home/front/jssdk').then((res) => {
        wx.config({
          debug: true,
          appId: res.appId,
          timestamp: res.timestamp,
          nonceStr: res.nonceStr,
          signature: res.signature,
          jsApiList: res.jsApiList,
        });


      });
      console.log(window.location.href.split('#')[0])
      console.log(encodeURIComponent(window.location.href.split('#')[0]));
    },
    watch: {
      '$route'() {
        location.reload();
      }
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
      orderNow() {

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
      handleChange(file, fileList) {

      },
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
//        option = {
//          num: this.list[index].sum,
//          img: this.list[index].src,
//        };
//        brr.push(option);

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
//            location.reload();
          });
        }
      },
      //  删除相片
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
      //  删除相片
      deletePic(index, item) {
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
            location.reload();
          });
        }
      },
      changePicture() {
        wx.chooseImage({
          count: 1, // 默认9
          debug: true,
          sizeType: ['original', 'compressed'],
          sourceType: ['album', 'camera'],
          success: function (res) {
            var localIds = res.localIds;
            console.log(localIds);
          }
        });
      },
      //  上传成功相片
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
    width: 46%;
    margin: 10px 14px 0px 0px;
    display: inline-block;
  }

  .container .label ul li:nth-child(2n) {
    margin: 10px 0 20px 0;
  }

  .container .label ul li .input {
    margin-top: 10px;
  }

  .container .label ul li .onload-pic {
    width: 100%;
    height: 130px;
    overflow: hidden;
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
    top: 0px;
    right: 0px;
    font-size: 12px;
  }

  .onload-pic .chonseok {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 25px;
    height: 25px;
  }

  .upload-pic {
    position: relative;
  }

  .container .upload-pic .el-button {
    padding: 10px 33px;
    height: 40px;
  }

  .container .upload-pic .upload-demo .el-button {
    margin: 0px 10px;
    left: 0px;
    top: 0px;
  }

  .upload-demo .el-upload .el-button , .upload-pic .el-button {
    width: 46%
  }

  .container .upload-pic .el-button {
    right: 10px;
    position: absolute;
    top: 0px;
  }

  .container .onload {
    /*border: 1px solid #20a0ff;*/
    color: #fff;
    padding: 10px 33px;
  }

  .upload-demo .el-upload {
    width: 100%;
    height: 40px;
  }

  .container .el-upload__tip {
    margin: 10px;
  }

  .container .toast {
    margin: 10px;
  }

  /* container end */

  .msg-ps {
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
    width: 25%;
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
    width: 50%;
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

  @media screen and (max-width: 375px) {
    .container .label ul li {
      margin: 10px 14px 0px 0px;
    }
  }


</style>

