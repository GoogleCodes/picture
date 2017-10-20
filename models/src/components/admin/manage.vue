<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Order History</h1>
        <div class="line"></div>
        <h5 class="order-h5">历史订单</h5>
      </div>

      <div class="order-title">
        <ul>
          <li class="fl">商品信息</li>
          <li class="fl">单价</li>
          <li class="fl" style="width: 104px;">数量</li>
          <li class="fl">实付金额</li>
          <li class="fl" style="width: 145px;">订单状态</li>
          <li class="fl">操作</li>
        </ul>
      </div>

      <div class="order-table">
        <table>
          <thead class="thead-item">
          <tr class="tr-item">
            <td colspan="6" style="padding-left: 18px;">
              <span class="fl">2017-9-25 15:20:38</span>
              <span class="orderNumber" style="padding-left: 25px;">订单号 ：50681150656</span>
            </td>
          </tr>
          </thead>
          <tbody class="tbody-item">
          <tr class="tr-item">
            <td class="itme-pic" style="width: 316px;">
              <img src="../../assets/images/18.png" alt="" class="J_ItemImg fl" />
              <a href="javascript:void(0);" class="item-title fl">金色古典MP14533-2B 高雅复古风</a>
            </td>
            <td class="itme-money">¥360.00</td>
            <td class="itme-number">1</td>
            <td class="itme-all">
              <p style="color: #b11e25;">¥360.00</p>
              <p>包邮</p>
            </td>
            <td class="itme-pic">
              <p>待付款</p>
              <p>订单详情</p>
            </td>
            <td style="width: 130px;">
              <a href="javascript:void(0);" class="nowpay privateBtn">立即付款</a>
              <a href="javascript:void(0);" class="cancel protected-Btn">取消订单</a>
              <a href="javascript:void(0);" class="select protected-Btn">查看物流</a>
              <a href="javascript:void(0);" class="delete protected-Btn">X</a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
