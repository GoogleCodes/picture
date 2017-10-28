<template>
  <div>
    <div class="admin-right">
      <div class="trade_status" style="padding: 52px 0px 80px;">
        <div class="vip-content">
          <div class="vip-title ft-21">
            <div class="line"></div>
          </div>
          <div class="vip-item">
            <h4 class="ft-14">一、会员等级说明</h4>
            <p class="desc">根据成长值将用户划分为6个不同的等级，成长值越高，等级越高，享有的特权就越高</p>
            <div class="vip-icon">
              <img src="../../../static/images/53.png" alt="" class="w100 h100">
            </div>
            <h4 class="ft-14" style="margin-top: 50px;">二、会员等级规则</h4>

            <table class="vip-table">
              <thead class="thead">
              <tr>
                <td>会员等级</td>
                <td>成长值</td>
                <td>(年)成长值</td>
                <td>说明</td>
              </tr>
              </thead>
              <tbody class="tbody">
              <tr>
                <td>
                  <i class="icon w1 block"></i>
                  注册会员
              </td>
                <td>无</td>
                <td>--</td>
                <td>排除</td>
              </tr>
              <tr>
                <td>
                  <i class="icon w2 block"></i>
                  普通会员
              </td>
                <td>600~1000</td>
                <td>--</td>
                <td>排除</td>
              </tr>
              <tr>
                <td>
                  <i class="icon w3 block"></i>
                  中级会员
              </td>
                <td>1000~2500</td>
                <td>600</td>
                <td>说明描述</td>
              </tr>
              <tr>
                <td>
                  <i class="icon w4 block"></i>
                  高级会员
              </td>
                <td>2500~4000</td>
                <td>1000</td>
                <td>说明描述</td>
              </tr>
              <tr>
                <td>
                  <i class="icon w5 block"></i>
                  <span>高级会员</span>
              </td>
                <td>4000~10000</td>
                <td>2000</td>
                <td>说明描述</td>
              </tr>
              </tbody>
            </table>
            <p class="desc">
              举例：会员小A在2015年2月1日升级为普通会员，截止至2016年1月31日总成长值为1050，此时扣除500成长值，剩余成长值为550，系统根据剩余成长值重新判断会员小A为普通会员，有效期为1年。
            </p>
            <h4 class="ft-14">三、会员活动</h4>
            <p class="desc">我们的技术正在夜以继日的开发呢，敬请期待哟~~</p>
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
          tableData: [{
            date: '注册会员',
            name: '王小虎',
            province: '上海',
            city: '普陀区',
            address: '上海市普陀区金沙江路 1518 弄',
            zip: 200333
          }, {
            date: '普通会员',
            name: '王小虎',
            province: '上海',
            city: '普陀区',
            address: '上海市普陀区金沙江路 1518 弄',
            zip: 200333
          }, {
            date: '中级会员',
            name: '王小虎',
            province: '上海',
            city: '普陀区',
            address: '上海市普陀区金沙江路 1518 弄',
            zip: 200333
          }, {
            date: '高级会员',
            name: '王小虎',
            province: '上海',
            city: '普陀区',
            address: '上海市普陀区金沙江路 1518 弄',
            zip: 200333
          }]
        }
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
