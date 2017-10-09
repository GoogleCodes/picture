<template>
  <div>
    <div class="admin-right fr">
      <div class="orderHistory">
        <h1 class="ft-26">Order History</h1>
        <div class="line"></div>
        <h5 class="order-h5">历史订单</h5>
      </div>

      <div class="order-title" style="display: none;">
        <ul>
          <li class="fl">商品信息</li>
          <li class="fl">单价</li>
          <li class="fl" style="width: 104px;">数量</li>
          <li class="fl">实付金额</li>
          <li class="fl" style="width: 145px;">订单状态</li>
          <li class="fl">操作</li>
        </ul>
      </div>

      <div class="trade_status" style="border: none;margin: 53px 0px 0px">
        <div class="infoBlock fl" style="margin: 35px 0 0px 0px">
          <div class="infor-title">
            <h3>订单信息</h3>
          </div>
          <div class="table-list">
            <ul>
              <li>
                <span>客户：</span>
                <span>恩小猫</span>
              </li>
              <li>
                <span>客户：</span>
                <span>13672964196</span>
              </li>
              <li>
                <span>地址：</span>
                <span>广东省佛山市顺德区佛山市顺德区大良街道家电城41号</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="table-td fr" style="width: 665px;">
          <div class="trade-detail">
            <dl>
              <dt class="ft-18 trade-title">
                <span style="color: #3e3a39;">订单状态:  快递中，等待买家确认</span>
              </dt>
              <dd class="imfor-title">确认收货,超时订单自动确认收货</dd>
              <dd class="imfor-title">物流：中通快递运单号:450733789022</dd>
              <dd class="imfor-title">2017-08-24 04:19:33</dd>
              <dd class="imfor-title" style="margin-top: 10px;">
                <span class="fl">您可以</span>
                <a href="javascript:void(0);" class="ui-btn block fl confirm">确认订单</a>
                <a href="javascript:void(0);" class="ui-btn block fl select">查看物流</a>
              </dd>
            </dl>
          </div>
        </div>
      </div>

      <div class="order-table">
        <table>
          <thead class="thead-item">
          <tr class="tr-item" style="background: #f7f8f8;text-align: center;border-bottom: 1px solid #ccc;">
            <td>商品信息</td>
            <td>单价</td>
            <td>数量</td>
            <td>实付金额</td>
            <td>订单状态</td>
            <td>操作</td>
          </tr>
          </thead>
          <tbody class="tbody-item">
          <tr class="tr-item ordertime">
            <td colspan="6">
              <span class="fl">2017-9-25 15:20:38</span>
              <span class="orderNumber fl">订单号 ：50681150656</span>
            </td>
          </tr>
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

      <div class="BarHolder">
        <div class="fr bar-picre">
          <p>商品总价：￥<i>360.00</i></p>
          <p>实际付款：￥<i>360.00</i></p>
        </div>
      </div>
    </div>
  </div>
</template>
