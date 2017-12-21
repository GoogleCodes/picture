<?php

namespace Quguo;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;

class Wechat
{
    protected $config;
    protected $app;
    protected $error;

    public function __construct($config = '')
    {
        $options = config('easywechat');
        if ($config) {
            $options = array_merge($options, $config);
        }
        $this->config = $options;
        $this->app = new Application($this->config);
    }
    
    private function setConfig($config)
    {
        self::$config = $config;
    }

    /**
     * 获取错误信息.
     *
     * @return void
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 微信登录.
     *
     * @param string $redirect_uri
     *
     * @return void
     */
    public function oauth($redirect_uri = '')
    {
        if ($redirect_uri) {
            session('redirect_uri', $redirect_uri);
        }

        $response = $this->app->oauth->redirect();
        $url = $response->getTargetUrl();

        return $url;
    }

    /**
     * 微信登录回调.
     */
    public function callback()
    {
        try {
            $user = $this->app->oauth->user();
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return $user;
    }

    /**
     * 发送模板消息.
     *
     * @param [type] $template
     *
     * @return void
     */
    public function sendNotify($template)
    {
        $app = $this->app;
        $notice = $app->notice;

        try {
            $notice->send($template);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * 获取用户信息.
     *
     * @param [type] $openId
     *
     * @return void
     */
    public function getUserInfo($openId)
    {
        $userService = $this->app->user;

        try {
            $user = $userService->get($openId);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return $user;
    }

    /**
     * 获取批量用户信息.
     *
     * @param [type] $openIds
     *
     * @return void
     */
    public function getUsersInfo($openIds)
    {
        $userService = $this->app->user;

        try {
            $users = $userService->batchGet($openId);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return $users;
    }

    /**
     * 获取JSSDK配置.
     *
     * @param [type] $openIds
     *
     * @return void
     */
    public function getJsSdk()
    {
        $js = $this->app->js;

        return $js;
    }

    /**
     * 获取支付配置.
     *
     * @param [type] $attributes
     *
     * @return void
     */
    public function getPayConfig($attributes)
    {
        $orderConfig = new Order($attributes);
        $payment = $this->app->payment;
        $result = $payment->prepare($orderConfig);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $config = $payment->configForPayment($prepayId);
        } else {
            $this->error = '支付配置错误'.$result->return_msg;

            return false;
        }

        return $config;
    }

    /**
     * 微信支付回调.
     *
     * @return void
     */
    public function notify()
    {
        $app = $this->app;

        try {
            $res = $app->payment->handleNotify(function ($notify, $successful) {
            });

            return $res;
        } catch (\Exception $e) {
        }
    }

    /**
     * 撤销订单.
     *
     * @param [type] $orderNo 商户系统内部的订单号 out_trade_no
     *
     * @return void
     */
    public function cancelOrder($orderNo)
    {
        try {
            $this->app->payment->reverse($orderNo);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * 查询订单详情.
     *
     * @param [type] $transactionId 微信的订单号 transaction_id
     *
     * @return void
     */
    public function queryOrder($transactionId)
    {
        try {
            $this->app->payment->queryByTransactionId($transactionId);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * 关闭订单.
     *
     * @param [type] $orderNo 商户系统内部的订单号
     *
     * @return void
     */
    public function closeOrder($orderNo)
    {
        try {
            $this->app->payment->close($orderNo);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }
}
