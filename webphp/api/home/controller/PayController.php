<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\home\controller;

use think\Db;
use cmf\controller\RestBaseController;
use \think\Request;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use Endroid\QrCode\QrCode;
use alipay\Pagepay;
use alipay\Notify;
use Quguo\Wechat;
use think\Cookie;
use Exception;
header('Access-Control-Allow-Origin:*');
class PayController extends RestBaseController
{

    public function getcode(Wechat $wechat){

        /*$reurl = $_SERVER['HTTP_REFERER'];
        cookie('reurl', $reurl, 3600);*/
        $reurl = cookie('reurl');
        $url = $wechat->oauth();
        header('location:'.$url);   
        exit;

    }

    public function getopenid(Wechat $wechat){

        $user = $wechat->callback();
        $error = $wechat->getError();
        if(!$error){
            $openid = $user['id'];
            //cookie('zzm_admin_storage_openid',$openid,3600,'');
            Cookie::set('zzm_admin_storage_openid',$openid,['domain'=>'.xinye-art.com']);
            $reurl = 'https://www.xinye-art.com/mobile/index.html?#/';
            header("Location: ".$reurl);
        }else{
            dump($error);

        }

    }

    //手机支付
    public function mobilepay2(){

        $post = Request::instance()->post();
        if($post){

            $openid = $post['openid'];

            $options = config('easywechat');
            $app = new Application($options);
            $payment = $app->payment;

            /////////////////////////////////////////////
            
            //$fee = $find['fee']*100;
            $fee = 1;

            $out_trade_no = time().rand(100000,999999);

            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '相框',
                'detail'           => '相框',
                'out_trade_no'     => $out_trade_no,
                'total_fee'        => $fee, // 单位：分
                'notify_url'       => 'https://www.xinye-art.com/public/api/home/pay/wxnotify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $openid
            ];
            $order = new Order($attributes);

            ///////////////////////////////////////////
            
            $result = $payment->prepare($order);
            $prepayId = $result->prepay_id;
            $config = $payment->configForPayment($prepayId);
            $this->success('请求成功',$config);

        }

    }

    //手机支付
    public function mobilepay(){

        $post = Request::instance()->post();
        if($post){

            //订单资料
            $id = $post['id'];
            $uid = $post['uid'];
            $where = array();
            $where['id'] = $id;
            $where['uid'] = $uid;
            $where['status'] = 0;
            $find = db('order')->where($where)->find();
            if(!$find){
                $this->error("没有订单");
            }

            if($find['isuse']==0){
                $out_trade_no = $find['orderid'];
                $up['isuse'] = 1;
                db('order')->where($where)->update($up);
            }else{
                $out_trade_no = time().rand(10000,99999);
                $up['orderid'] = $out_trade_no;
                db('order')->where($where)->update($up);
            }
            //订单资料

            $openid = $post['openid'];

            $options = config('easywechat');
            $app = new Application($options);
            $payment = $app->payment;

            /////////////////////////////////////////////
            
            //$fee = $find['fee']*100;
            $fee = 1;

            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '相框',
                'detail'           => '相框',
                'out_trade_no'     => $out_trade_no,
                'total_fee'        => $fee, // 单位：分
                'notify_url'       => 'https://www.xinye-art.com/public/api/home/pay/wxnotify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $openid
            ];
            $order = new Order($attributes);

            ///////////////////////////////////////////
            
            $result = $payment->prepare($order);
            $prepayId = $result->prepay_id;
            $config = $payment->configForPayment($prepayId);
            $this->success('请求成功',$config);

        }

    }


    //扫码支付
    public function wxpay(){

        $post = Request::instance()->post();
        if($post){

            $id = $post['id'];
            $uid = $post['uid'];
            $where = array();
            $where['id'] = $id;
            $where['uid'] = $uid;
            $where['status'] = 0;
            $find = db('order')->where($where)->find();
            if(!$find){
                $this->error("没有订单");
            }

            if($find['isuse']==0){
                $out_trade_no = $find['orderid'];
                $up['isuse'] = 1;
                db('order')->where($where)->update($up);
            }else{
                $out_trade_no = time().rand(10000,99999);
                $up['orderid'] = $out_trade_no;
                db('order')->where($where)->update($up);
            }

            $certpath = ROOT_PATH.'public/payfile/apiclient_cert.pem';
            $keypath = ROOT_PATH.'public/payfile/apiclient_key.pem';
            $options = [
                // 前面的appid什么的也得保留哦
                'app_id' => 'wxb4835407f8bd7f6c',
                // ...
                // payment
                'payment' => [
                    'merchant_id'        => '1489874452',
                    'key'                => '9596d74328a28edadc1069095885abc8',
                    'cert_path'          => $certpath, // XXX: 绝对路径！！！！
                    'key_path'           => $keypath,      // XXX: 绝对路径！！！！
                    'notify_url'         => 'https://www.xinye-art.com/public/api/home/pay/wxnotify',       // 你也可以在下单时单独设置来想覆盖它
                    // 'device_info'     => '013467007045764',
                    // 'sub_app_id'      => '',
                    // 'sub_merchant_id' => '',
                    // ...
                ],
            ];

            $app = new Application($options);

            $payment = $app->payment;

            /////////////////////////////////////////////
            
            //$fee = $find['fee']*100;
            $fee = 1;

            $attributes = [
                'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
                'body'             => '相框',
                'detail'           => '相框',
                'out_trade_no'     => $out_trade_no,
                'total_fee'        => $fee, // 单位：分
                'notify_url'       => 'https://www.xinye-art.com/public/api/home/pay/wxnotify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                // ...
            ];
            $order = new Order($attributes);

            ///////////////////////////////////////////
            
            $result = $payment->prepare($order);
            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                $code_url = $result->code_url;
                $renderer = new \BaconQrCode\Renderer\Image\Png();
                $renderer->setHeight(256);
                $renderer->setWidth(256);
                $writer = new \BaconQrCode\Writer($renderer);
                $savepath = ROOT_PATH.'public/qrcode/'.$out_trade_no.'.png';
                $writer->writeFile($code_url,$savepath);
                $repath = str_replace('/www/', 'https://', $savepath);
                $this->success("请求成功",$repath);
            }
            $this->error("请求失败");

        }

    }

    //微信支付异步
    public function wxnotify(){

        $certpath = ROOT_PATH.'public/payfile/apiclient_cert.pem';
        $keypath = ROOT_PATH.'public/payfile/apiclient_key.pem';
        $options = [
            // 前面的appid什么的也得保留哦
            'app_id' => 'wxb4835407f8bd7f6c',
            // ...
            // payment
            'payment' => [
                'merchant_id'        => '1489874452',
                'key'                => '9596d74328a28edadc1069095885abc8',
                'cert_path'          => $certpath, // XXX: 绝对路径！！！！
                'key_path'           => $keypath,      // XXX: 绝对路径！！！！
                'notify_url'         => 'https://www.xinye-art.com/public/api/home/pay/wxnotify',       // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];

        $app = new Application($options);

        try {
            
            $response = $app->payment->handleNotify(function($notify, $successful){

                if($notify->result_code == 'SUCCESS'){
                    $out_trade_no = $notify->out_trade_no;
                    $where['orderid'] = $out_trade_no;
                    $where['status'] = 0;
                    $to['status'] = 1;
                    db('order')->where($where)->update($to);
                    return true; // 或者错误消息
                }else{
                    return false;
                }
            });
            $response->send(); // Laravel 里请使用：return $response;

        } catch (\Exception $e) {
            file_put_contents('./kkk.txt', print_r($e,true),FILE_APPEND);
        }

    }

    //微信支付异步测试
    public function wxnotify2(){

        $date = date("Y-m-d H:i:s",time());
        $ftext = $date;
        file_put_contents('./bbb.txt', $ftext);

        $certpath = ROOT_PATH.'public/payfile/apiclient_cert.pem';
        $keypath = ROOT_PATH.'public/payfile/apiclient_key.pem';
        $options = [
            // 前面的appid什么的也得保留哦
            'app_id' => 'wxb4835407f8bd7f6c',
            // ...
            // payment
            'payment' => [
                'merchant_id'        => '1489874452',
                'key'                => '9596d74328a28edadc1069095885abc8',
                'cert_path'          => $certpath, // XXX: 绝对路径！！！！
                'key_path'           => $keypath,      // XXX: 绝对路径！！！！
                'notify_url'         => 'https://www.xinye-art.com/public/api/home/pay/wxnotify ',       // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];

        $app = new Application($options);

        $response = $app->payment->handleNotify(function($notify, $successful){
            $ftext = $ftext."<br>".print_r($notify,true);
            file_put_contents('./bbb.txt', $ftext,file_append);
        });
        $response->send(); // Laravel 里请使用：return $response;

    }

    //支付宝支付
    public function alpay(){

        $post = Request::instance()->post();
        if($post){

            $id = $post['id'];
            $uid = $post['uid'];
            $where = array();
            $where['id'] = $id;
            $where['uid'] = $uid;
            $where['status'] = 0;
            $find = db('order')->where($where)->find();
            if(!$find){
                $this->error("没有订单");
            }

            if($find['isuse']==0){
                $out_trade_no = $find['orderid'];
                $up['isuse'] = 1;
                db('order')->where($where)->update($up);
            }else{
                $out_trade_no = time().rand(10000,99999);
                $up['orderid'] = $out_trade_no;
                db('order')->where($where)->update($up);
            }

            $params['subject'] = '相框';
            $params['out_trade_no'] = $out_trade_no;
            //$params['total_amount'] = $find['fee'];
            $params['total_amount'] = 0.01;
            $Pagepay = new Pagepay();
            $data = $Pagepay->pay($params);

        }

    }

    //同步
    public function alret(){

        $get = Request::instance()->get();
        if($get['out_trade_no']){
            $where['orderid'] = $get['out_trade_no'];
            $find = db('order')->where($where)->find();
            header('location:http://www.xinye-art.com/#/admin/shoping?id='.$find['id']);
            exit;
        }

    }

    //异步
    public function alnotify(){

        $date = date("Y-m-d H:i:s",time());
        file_put_contents('./kkk.txt', $date.':'.print_r($_POST,true));
        $Notify = new Notify();
        $signResult = $Notify->check2();
        if($signResult){

            $post = Request::instance()->post();
            $where['orderid'] = $post['out_trade_no'];
            $where['status'] = 0;
            $to['status'] = 1;
            db('order')->where($where)->update($to);
            return true;

        }else{
            return false;
        }

    }

}
