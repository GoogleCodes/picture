<template>
  <div>
    <div class="admin-right">
      <div class="trade_status" style="padding: 20px 0px 35px;">
        <div class="vip-content">
          <div class="vip-title ft-21">
            <div class="line"></div>
          </div>
          <div class="vip-item" v-for="(k, i) in list">
            <h4 class="ft-14">{{ k.id }}、{{ k.lname }}</h4>
            <div v-html="k.content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        list: []
      }
    },
    mounted() {
      this.$ajax.HttpPost('/api/home/user/getLevelInfo').then((res) => {
        this.list = res.data;
      });
    },
  }
</script>

<style type="text/css">
  /* vip start */
  .trade_status{
    background: #fff;
  }
  .vip-item {
    padding: 0px 10px;
  }
  .vip-item .vip-icon {
    width: 300px;
  }
  .vip-item .desc {
    color: #999;
    margin-top: 15px;
  }
  /* vip end */
</style>


