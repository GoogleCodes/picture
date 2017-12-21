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
use cmf\lib\Upload;
use \think\Request;
header('Access-Control-Allow-Origin:*');
class OrderController extends RestBaseController
{

    public function csss(){

        $data = model('shopcar')->dataByuid(7);

    }
    
    //添加订单数据
    public function add(){

        $post = Request::instance()->post();
        if($post){
            
            $data = model('order')->add($post);
            if($data['code']){
                $this->success('添加成功',$data['data']);
            }else{
                $this->error($data['msg']);
            }

        }
        
    }

    //获取订单信息
    public function orderList(){

        $post = Request::instance()->post();
        $uid = $post['uid'];
        if($uid){
            $data = model('order')->orderList($uid);
            if($data){
                $this->success('获取成功',$data);
            }else{
                $this->error("获取失败");
            }
        }
        
    }

    //获取订单
    public function oneorder(){

        $post = Request::instance()->post();
        $uid = $post['uid'];
        $id = $post['id'];
        if($uid){
            $data = model('order')->oneorder($id,$uid);
            if($data){
                $this->success('获取成功',$data);
            }else{
                $this->error("获取失败");
            }
        }

    }

    //改变订单状态
    public function cgStatus($id,$uid,$status){

        $re = model('order')->cgStatus($id,$uid,$status);
        if($re){
            $this->success('修改成功');
        }else{
            $this->error("修改失败");
        }

    }

    //改变支付方式
    public function setPayType(){

        $post = Request::instance()->post();
        if($post){
            $id = $post['id'];
            $uid = $post['uid'];
            $type = $post['type'];
            $re = model('order')->setPayType($id,$uid,$type);
            if($re){
                $this->success('修改成功');
            }else{
                $this->error("修改失败");
            }
        }
        
    }

    public function ceshi(){

        $uid = 7;
        $data = model('order')->orderList($uid);
        dump($data);

    }

}
