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
          <div class="vip-item">
            <h4 class="ft-14">{{ list.id }}、{{ list.lname }}</h4>
            <div v-html="list.content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  import { mapGetters } from 'vuex'
  import { GET_USER_INFO } from '../../store/getters/type'

  export default {
      data() {
          return {
              list: []
          }
      },
      computed: {
        ...mapGetters({
          get_user_info: GET_USER_INFO
        }),
      },
      mounted() {
        this.$ajax.HttpPost('/api/home/user/userinfo',{
          id: this.get_user_info.user.id
        }).then((res) => {
          let data = res.data;
          this.$ajax.HttpPost('/api/home/user/getLevelInfo').then((res) => {
            let leven = res.data;
            for (let i in leven) {
              if (leven[i].id == data.level) {
                this.list = leven[i]
                console.log(this.list);
              }
            }
          });
        });
      },
      methods: {

      },
  }
</script>
