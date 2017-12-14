<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26" style="font-weight: 500;">Member Introduction</h1>
        <div class="line"></div>
        <h5 class="order-h5">我的会员</h5>
      </div>
      <div class="trade_status" style="width:99%;padding-bottom: 116px;">
        <div class="vip-content">
          <div class="vip-title ft-21">
            <div class="line"></div>
            <span>我的会员</span>
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
              console.log(this.list);
          });
      },
      methods: {

      },
  }
</script>
