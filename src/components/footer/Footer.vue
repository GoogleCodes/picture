<template>
  <!-- footer start -->
  <div class="footer clear" v-show="$route.meta.footer">
    <div class="footer-quality">
      <ul>
        <li class="quality-li fl fm">印刷遍色 免费重印</li>
        <li class="quality-li fl zs">质量保证 终身保修</li>
        <li class="quality-li fl yg">人工检查 严格质检</li>
        <li class="quality-li fl bz">真材实料 保证品质</li>
      </ul>
    </div>
    <div class="footer-message">
      <div class="footer-list">
        <ul class="fl">
          <li>Character</li>
          <li class="list-desc">匠杺是顺德区杏坛水乡，专门制作手工相框、字画装裱、等工艺品的工坊。</li>
        </ul>
        <ul class="fl">
          <li>Character</li>
          <li class="list-desc">
            客服热线一 ：13250144303 <br />
            客服热线二 ：18923203209 <br />
            邮箱 ：jiang23 @jiangmuxin.com
        </li>
        </ul>
        <ul class="fl">
          <li>Character</li>
          <li class="list-desc">佛山市杏坛镇和泰居（麦当劳附近）3座114</li>
        </ul>
        <ul class="fl webchat">
          <li class="qrcode">
            <img src="../../assets/images/14.png" alt="" style="width: 104px;height: 104px;">
            <p>扫一扫</p>
          </li>
        </ul>
      </div>
      <div class="footer-copy">
        © {{ getYear }} jiangmuxin All Rights Reserved.
        <a href="http://www.miibeian.gov.cn/" style="color: #595757">粤ICP备17069217号-1</a>
        扫一扫New Business Inquiries
    </div>
    </div>
  </div>
  <!-- footer end -->
</template>

<script type="text/javascript">
  export default {
    name: 'foots',
    data() {
        return {

        }
    },
    computed: {
      getYear() {
        return new Date().getFullYear()
      }
    },
    watch: {

    },
    created() {

    },
    methods: {

    }
  };
</script>

<style>
  .footer .footer-quality ul .fm {
    background: url('../../assets/images/10.png') no-repeat;
  }

  .footer .footer-quality ul .zs {
    background: url('../../assets/images/11.png') no-repeat;
  }

  .footer .footer-quality ul .yg {
    background: url('../../assets/images/12.png') no-repeat;
  }

  .footer .footer-quality ul .bz {
    background: url('../../assets/images/13.png') no-repeat;
    margin: 26px 0 0 0;
  }
</style>
