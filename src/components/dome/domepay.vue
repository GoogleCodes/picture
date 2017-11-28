<template>
  <div>
    <el-button @click="alipay">支付宝支付</el-button>
    <div id="box"></div>
    <iframe v-html="dome"></iframe>
  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        dome: ''
      }
    },
    mounted() {

    },
    methods: {
      alipay() {
        this.$ajax.HttpPost('/api/home/pay/alpay',{
          id:28,
          uid:8
        }).then((res) => {
          $("#box").html(res);
        })
      },
    }
  }
</script>
