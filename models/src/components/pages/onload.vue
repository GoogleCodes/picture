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
          <ul class="localIds">
            <template v-for="(item, index) in list">
              <!--  v-show="isNoList"  @click.stop="choosePic(item, index)"  -->
              <li class="fl localIds" :class="{ 'chonsepic': index == chonseIndex }">
                <div class="onload-pic" id="onloads">
                  <i class="el-icon-close icon-guanbi" @click="deletePic(index, item)"></i>
                  <i class="el-icon-check chonseok" v-show="chonseok"></i>
                  <!--<img src="../../../static/images/35.png" class="icon-guanbi" />-->
                  <img :src="item.src" style="margin: 0px auto;" class="previewer-demo-img block"
                       @click="$refs.previewer.show(index)">
                  <!--<img src="../../../static/images/47.png" class="chonseok" alt="">-->
                </div>
                <div class="input">
                  <el-button class="prev fl" @click="changeNumber(index, -1)">-</el-button>
                  <el-input v-model="item.num" class="fl" placeholder="0" readonly></el-input>
                  <el-button class="next fl" @click="changeNumber(index, 1)">+</el-button>
                </div>
                <div>
                  <el-input style="margin: 10px 0 0;" v-model="item.remarks"
                            @blur="saveRemarks(index, item.remarks)"></el-input>
                </div>
              </li>
            </template>
          </ul>
        </div>

        <div class="upload-pic clear">
          <div class="upload-demo">
            <el-button @click="changePicture">增加相片</el-button>

            <input id="img" class="file" multiple="multiple" name="file" type="file"
                   accept="image/png,image/gif,image/jpeg" @change="changePicture"
                   style="display: none;"/>

          </div>
          <el-button @click="PlaceAnOrder()">立即下单</el-button>
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
        serverId: '',
        isNoList: false,
        uploadUrl: 'https://xinye-art.com/public/api/home/front/imgupload',
        fileList: [],
        arr: [],
        arrays: [],
        chonseIndex: 0,
        chonseok: false,
        num: 0,
        prices: 0,
        options: {
          getThumbBoundsFn(index) {
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
      this.$ajax.HttpPost('/api/home/front/jssdk', {
        url: window.location.href.split('#')[0]
      }).then((res) => {
        wx.config({
          debug: false,
          appId: res.appId,
          timestamp: res.timestamp,
          nonceStr: res.nonceStr,
          signature: res.signature,
          jsApiList: ["checkJsApi", "downloadImage", "chooseImage", "uploadImage", "imagePreview", "getLocalImgData"] // res.jsApiList,
        });
        wx.checkJsApi({
          jsApiList: [
            'chooseImage'
          ],
          success(res) {
            if (res.checkResult.getLocation == false) {
              alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
              return;
            }
          }
        });
      });
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
      chosePrice() {
        let sum = 0;
        return sum = this.prices * this.num;
      }
    },
    components: {
      ElButton,
      previewer,
    },
    methods: {
      fileClick() {
        document.getElementById('img').click();
      },
      saveRemarks(index, remarks) {
        let json = {}, arr = [], that = this;
        this.list[index].remarks = remarks;
        for (let i in this.list) {
          json = {
            img: this.list[i].src,
            num: this.list[i].num,
            remarks: this.list[i].remarks,
          };
          arr.push(json);
        }
        if (typeof JSON.stringify(arr) === 'string') {
          this.$ajax.HttpPost('/api/home/shopcar/upSave', {
            id: that.$route.query.id,
            img: JSON.stringify(arr),
            num: 1,
          }).then((res) => {
            this.$message(res.msg);
          });
        }
      },
      PlaceAnOrder() {
        let that = this;
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
          let arr = [], json = {};
          for (let i in res.data) {
            if (that.$route.query.id == res.data[i].id) {
              //  获取购物车商品
              json = {
                list: res.data[i],
                price: that.chosePrice,
              };
              arr.push(json)
              console.log(arr);
              that.$storageSet('cart_list_data', arr);
              that.$router.push({
                path: '/pages/ord-detail'
              });
            }
          }
        }).catch((error) => {
        });
      },
      changeNumber(index, flag) {
        let option = {}, json = {}, arr = [], brr = [], that = this;
        if (flag >= 1) {
          this.list[index].num++;
        } else {
          this.list[index].num--;
        }
        if (this.list[index].num <= 1) {
          this.list[index].num = 1;
        }
        console.log(this.list[index].num);
//        for (let y in that.fileList) {
//          option = {
//            img: this.fileList[y].src,
//            num: this.fileList[y].num,
//            remarks: this.fileList[y].remarks,
//            code: this.fileList[y].code,
//          };
//          brr.push(option);
//        }
        for (let i in this.list) {
          json = {
            img: this.list[i].src,
            num: this.list[i].num,
            remarks: this.list[i].remarks,
            code: this.list[i].code,
          };
          arr.push(json);
        }
        let count = arr;  //  arr.concat(brr);
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
            num: this.list[i].num,
            remarks: this.list[i].remarks,
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
//            location.reload();
          });
        }
      },
      changePicture() {
        let evt = window.event;
        evt.stopPropagation();
        let json = {}, that = this;
        // ID数组
        var localIds = [];
        let images = {
          localId: [],
          serverId: [],
        };
        // 上传序号
        var idx = 0;
        var serverIds = '';
        wx.ready(function () {
          wx.chooseImage({
            count: 9, // 默认9
            sizeType: ['original'],
            sourceType: ['album'],
            success(res) {
              var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
              images.localId = res.localIds;
              console.log(images.localId, " images.localId");
              //  必须做一下mediaId的设定，否则将会无法在安卓端得到微信上传功能的触发
              UploadImage();
              let length = images.localId.length;;
              function UploadImage() {
                wx.uploadImage({
                  //  需要上传的图片的本地ID，由chooseImage接口获得
                  localId: images.localId[idx],
                  isShowProgressTips: 1, // 默认为1,显示进度提示
                  success(res) {
                    idx++;
                    //存储图片媒体ID
                    json = {
                      img: 'a',
                      num: 1,
                      remarks: '',
                      code: res.serverId,
                    };
                    if (idx < length) {
                      UploadImage();
                    }
                    images.serverId.push(json);
                    let brr = [], pson = {};
                    for (let i in that.list) {
                      pson = {
                        img: that.list[i].src,
                        num: that.list[i].num,
                        remarks: that.list[i].remarks,
                        code: that.list[i].code,
                      };
                      brr.push(pson);
                    }

                    let count = images.serverId.concat(brr);
                    console.log(count, "sava");
                    if (typeof JSON.stringify(count) === 'string') {
                      that.$ajax.HttpPost('/api/home/shopcar/upSave', {
                        id: that.$route.query.id,
                        img: JSON.stringify(count),
                      }).then((res) => {
                        that.$message(res.msg);
                        setTimeout((res) => {
                          location.reload();
                        }, 500)
                      });
                    }

                  },
                  fail(err) {
                    alert("上传失败，msg：" + JSON.stringify(res));
                  }
                });
              }

            }
          });
        })
      },
      //  上传成功相片
      handleAvatarSuccess(res, file, fileList) {
        let options = {num: 1};
        this.arr.push(options);
        try {
          setTimeout(() => {
            this.fileList = fileList;
            this.PlaceAnOrder();
          }, 500)
        } catch (e) {

        }
      },
      fetchData() {
        let that = this;
        this.$ajax.HttpPost(this.$api.get_content.GET_CART_DATA,
          {uid: this.get_user_info.user.id}).then((res) => {
          let id = 0;
          let json = {}, arr = [];
          for (let i in res.data) {
            id = res.data[i].id;
            if (this.$route.query.id == id) {
              if (res.data[i].upimg == null || res.data[i].upimg.length == 0) {
                return false;
              } else {
                that.prices = res.data[i].price;
                that.num = res.data[i].num;
                arr = arr.concat(res.data[i].upimg);
              }
            }
          }
          for (let j in arr) {
            json = {
              src: arr[j].img,
              num: arr[j].num,
              remarks: arr[j].remarks,
              code: arr[j].code
            };
            this.list.push(json);
          }
          console.log(this.list, 'fetchData()');
        }).catch((error) => {
        });
      }
    }
  }
</script>

<style>
  /* 购物车上传照片 */
  .cart-upload-pic {
    margin: 60px 10px 10px;
    padding: 10px 0 20px;
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
    margin: 10px 0 10px 0;
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

  .upload-demo .el-upload .el-button, .upload-pic .el-button {
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

