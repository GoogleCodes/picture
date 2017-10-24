<template>
  <div>
    <div>
      <div class="cart-body">
        <div class="cart-box">
          <div class="addition fl">
            <i class="iconfont icon-quxiaoquanxuan c_9e9d9d" @click="unActIt()" v-show="showValue"></i>
            <i class="iconfont icon-checked-fill c_b11e25" @click="actIt()" v-show="!showValue"></i>
          </div>
          <div class="maininfo fl">
            <div class="img fl">
              <img :src="img" alt="" class="w100 h100">
            </div>
            <div class="msg fl">
              <p class="name ft-16">{{ pname }}</p>
              <p class="format c_898989">{{ pformat }}</p>
            </div>
          </div>
          <div class="money fr c_e64147 ft-14" v-show="mode !== 1">
            <label class="unit">¥</label>
            <label>{{ pprice }}</label>
            <p class="c_898989">x{{ pnums }}</p>
          </div>
          <div class="money fr iconfont icon-shanchu" v-show="mode == 1" @click="deleteShopItem()"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
      props: {
        pid: {
            type: [Number,String],
            required: true,
        },
        img: {
            type: String,
            required: true,
        },
        pname: {
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
        showValue: {
            type: Boolean,
            required: false
        },
        chosen: {
          type: Array,
          twoWay: true,
          required: true
        }
      },
      data() {
          return {
//            showVal: false
          }
      },
      computed: {
          className() {
              const obj = {};
              if (this.chosen.length > 0) {
                  for (let ch = 0; ch < this.chosen.length; ch++) {
                      if (this.chosen[ch].id == this.pid) {
                          obj['active'] = true;
                      } else {
                          obj['active'] = false;
                      }
                  }
              } else {
                  obj['active'] = false;
              }
              return obj;
          },
          showVal() {
              if(this.className.active){
                  return true;
              }else{
                  return false;
              }
          }
      },
      methods: {
          deleteShopItem() {
              this.$confirm('确定不要这件商品吗？, 是否继续?', '提示', {
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
          unActIt() {
              if(this.className.active){
                  let getIndex = null;
                  for(let ch = 0;ch < this.chosen.length; ch++) {
                      if(this.chosen[ch].id == this.pid && this.chosen[ch].format == this.pformat) {
                          getIndex = ch;
                          break;
                      }
                  }
                  if(getIndex >= 0) {
                      this.chosen.splice(getIndex,1);
                  }
              }
          },
          actIt() {
              if(!this.className.active) {
                  this.chosen.push({
                      id: this.pid,
                  });
              }
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
    margin: 10px 0px 0px;
    background: #fff;
    overflow: hidden;
    padding: 10px;
  }

  .cart-box .addition {
    margin: 24px 12px 0px 0px;
  }

  .cart-box .addition .iconfont {
    font-size: 24px;
  }

  .cart-box .maininfo {
    width: 72%;
    height: 72px;
  }

  .cart-box .maininfo .img {
    width: 30%;
    height: 73px;
  }

  .cart-box .maininfo .msg {
    width: 65%;
    margin-left: 10px;
  }
  .cart-box .maininfo .msg .name {
    font-size: 1rem;
    line-height: 20px;
    height: 42px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .cart-box .maininfo .msg .format {
    height: 35px;
    line-height: 18px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cart-box .money {
    width: 3rem;
    font-weight: bold;
    text-align: center;
    margin: 10px 0px 0px 0px;
  }
  .cart-box .icon-shanchu {
    font-size: 26px;
    line-height: 50px;
    color: #808080;
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
