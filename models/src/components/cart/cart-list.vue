<template>
  <div class="cart-body" :class="actives">
    <div class="cart-box">
      <div class="addition fl">
        <i class="iconfont icon-checked-fill c_b11e25" @click="unActIt" v-show="actives"></i>
        <i class="iconfont icon-quxiaoquanxuan c_9e9d9d" @click="unActIt" v-show="!actives"></i>
      </div>
      <router-link :to="{ path: '/pages/detail', query:{pid: pid}}" class="block w100 h100">
        <div class="maininfo fl">
          <div class="img fl">
            <template v-for="(k,i) in img">
              <img :src="k.url" alt="" class="w100 h100">
            </template>
          </div>
          <div class="msg fl">
            <p class="name ft-14">{{ pName }}</p>
            <p class="format c_898989">{{ pformat }}</p>
          </div>
          <div class="money fl c_e64147 ft-14">
            <label class="unit">¥</label>
            <label>{{ pprice }}</label>
            <!--<span class="c_898989" style="margin-left: 10px;">x{{ pnums }}</span>-->
          </div>
        </div>
      </router-link>
      <!--<el-button class="fr upload-pic">上传图片</el-button>-->
      <div class="fr iconfont icon-shanchu" v-show="mode == 1" @click="deleteShop(pid)"></div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
      props: {
          uid: {
            type: [Number,String],
            required: true,
          },
          pid: {
              type: [Number,String],
              required: true,
          },
          img: {
              type: [Array],
              required: true,
          },
          pName: {
              type: String,
              required: true,
          },
          pformat: {
              type: String,
              required: true,
          },
          pprice: {
              type: [Number,String],
              required: true
          },
          pnums: {
              type: [Number,String],
              required: true
          },
          mode: {
              type: Number,
              required: true,
          },
          chosen: {
              type: Array,
              twoWay: true,
              required: true
          },
          list: {
              type: Object,
              required: false,
          },
      },
      data() {
          return {
            actives: false
          }
      },
      created() {

      },
      watch: {
          chosen() {
              let that = this, arr = [];
              for (let i in this.chosen) {
                  if (that.chosen[i] == this.pid) {
                      that.actives = true;
                      break;
                  }
              }
              if(that.chosen.length == 0) {
                that.actives = false;
              }
          },
      },
      computed: {
          showVal() {
              if (this.className.active){
                  return true;
              } else {
                  return false;
              }
          }
      },
      methods: {
          actIt() {
              if(!this.actives) {
                  this.chosen.push({
                    id: this.pid,
                  });
              }
          },
          unActIt() {
              this.actives = !this.actives;
              if(this.actives) {
                this.chosen.push(this.pid);
              } else if(!this.actives) {
                let getIndex = null;
                for(let ch = 0;ch < this.chosen.length; ch++) {
                  if(this.chosen[ch] == this.pid) {
                    getIndex = ch;
                    break;
                  }
                }
                if(getIndex >= 0) {
                  this.chosen.splice(getIndex,1);
                }
              }
          },
          deleteShop(id) {
            this.$confirm('确定要删除这件商品吗?', '提示', {
              confirmButtonText: '确定',
              cancelButtonText: '取消',
              type: 'warning'
            }).then(() => {
              this.$ajax.HttpPost(this.$api.get_content.DELETE_CART_DATA,{
                id: this.list.id,
                uid: this.uid}).then((res) => {
                if (res.code == 1) {
                  this.$message(res.msg);
                  setTimeout(() => {
                    location.reload()
                  },1500);
                } else {
                  this.$message(res.msg);
                  return false;
                }
              });
            }).catch(() => {
              this.$message({
                  type: 'info',
                  message: '已取消删除'
              });
            });
          },
      },
  }
</script>


<style type="text/css">

  /* cart-box start */
  .bar-wrapper .gopay {
    width: 120px;
    height: 45px;
    background: #b11e25;
    border: 1px solid #b11e25;
    color: #fff;
    box-sizing: border-box;
    margin-right: 10px;
  }

  .bar-wrapper {
    height: 44px;
    position: fixed;
    bottom: 50px;
    width: 100%;
    padding: 10px 0px;
    background: #fff;
  }

  .bar-wrapper .iconfont {
    font-size: 24px;
    line-height: 42px;
    margin-left: 10px;
  }

  .bar-wrapper .iconfont i {
    position: relative;
    top: -2px;
    margin-left: 5px;
  }

  .bar-wrapper .el-checkbox-group {
    margin: 10px;
  }

  .bar-wrapper .total-price {
    line-height: 45px;
    margin-right: 10px;
  }

  .cart-body .cart-box {
    position: relative;
    margin: 10px 0px 0px;
    background: #fff;
    overflow: hidden;
    padding: 10px 5px;
  }

  .cart-body .cart-box .upload-pic {
    position: absolute;
    top: calc(100% - 70%);
    right: 10px;
  }

  .cart-box .addition {
    margin: 24px 5px 0px 0px;
  }

  .cart-box .addition .iconfont {
    font-size: 24px;
  }

  .cart-box .maininfo {
    width: 88%;
    position: relative;
  }

  .cart-box .maininfo .img {
    width: 30%;
    height: 73px;
  }

  .cart-box .maininfo .msg {
    width: 65%;
    margin-left: 5px;
  }
  .cart-box .maininfo .msg .name {
    line-height: 20px;
    word-break: break-all;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
  .cart-box .maininfo .msg .format {
    line-height: 18px;
    word-break: break-all;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .cart-box .money {
    font-weight: bold;
    text-align: center;
    margin: 0px 10px 0;
    position: absolute;
    bottom: 0px;
    left: 29%;
  }
  .cart-box .icon-shanchu {
    font-size: 26px;
    line-height: 50px;
    color: #808080;
    position: absolute;
    top: 22px;
    right: 10px;
  }
  /* cart-box end */

  /* cart-nothing start */
  .cart-nothing {
    width: 153px;
    margin: 132px auto;
    line-height: 50px;
    text-align: center;
  }

  .cart-nothing .cart-pic {
    width: 153px;
  }

  .cart-nothing .cart-desc {
    color: #8c8c8c;
  }

  /* cart-nothing end */
</style>

<style>
  .el-message-box {
    width: 85%;
  }

  .el-message-box__content {
    padding: 18px 20px;
  }
</style>
