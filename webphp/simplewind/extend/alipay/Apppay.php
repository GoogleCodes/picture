<?php
namespace alipay;
use think\Loader;
Loader::import('alipay.pay.service.AlipayTradeService');
loader::import('alipay.pay.buildermodel.AlipayTradePagePayContentBuilder');
class Apppay {
    /**
     * 主入口
     * @param array $params 支付参数, 具体如下
     * @param string $params['subject'] 订单标题
     * @param string $params['out_trade_no'] 订单商户号
     * @param float $params['total_amount'] 订单金额
     */
    public static function pay($params) {
        // 1.校检参数
        self::checkParams($params);
        // 2.构造参数
        $payRequestBuilder = new AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setSubject($params['subject']);
        $payRequestBuilder->setTotalAmount($params['total_amount']);
        $payRequestBuilder->setOutTradeNo($params['out_trade_no']);
        // 3.获取配置
        $config = config('alipay');
        $aop = new AlipayTradeService($config);
        $res = $aop->appPay($payRequestBuilder, $config["return_url"], $config['notify_url']);
        return $res;
    }
    /**
     * 校检参数
     */
    private static function checkParams($params) {
        if (empty(trim($params['out_trade_no']))) {
            self::processError('商户订单号(out_trade_no)必填');
        }
        if (empty(trim($params['subject']))) {
            self::processError('商品标题(subject)必填');
        }
        if (floatval(trim($params['total_amount'])) <= 0) {
            self::processError('退款金额(total_amount)为大于0的数');
        }
    }
    /**
     * 统一错误处理接口
     * @param string $msg 错误描述
     */
    private static function processError($msg) {
        throw new thinkException($msg);
    }
}