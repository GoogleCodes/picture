<?php
// +----------------------------------------------------------------------
// | 文件说明：用户-幻灯片
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-5-25
// +----------------------------------------------------------------------

namespace api\home\model;

use think\Model;
use think\Db;

class OrderModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_order';

    //添加数据
    public function add($post){

        $re = $this->dataHandle($post['goodsdata'],$post['uid']);
        if($re['code']==0){
            return $re;
        }
        $data['uid'] = $post['uid'];
        $data['goodsdata'] = json_encode($re['data']['goods']);
        $data['fee'] = $re['data']['fee'];
        $data['address'] = json_encode($post['address']);
        $data['uname'] = $post['uname'];
        $data['paytype'] = $post['paytype'];
        $data['orderid'] = time().rand(10000,99999);
        $data['time'] = time();
        $re = $this->insert($data);
        if(!$re){
            $re = array();
            $re['code'] = 0;
            $re['msg'] = '添加失败';
        }else{
            $re = array();
            $re['code'] = 1;
            $re['data'] = $this->getLastInsID();
            $re['msg'] = '添加成功';
        }
        return $re;

    }

    //处理商品信息
    public function dataHandle($goodsdata,$uid){

        $level = model('member')->level($uid);

        $fee = 0;
        $re = array();
        $data = array();
        $delarr = array();
        foreach($goodsdata as $v){

            $where = array();
            $where['id']=$v;
            $ofind = db('shop_car')->where($where)->find();
            $delarr[] = $v;

            //商品信息
            $find = model('goods')->oneGoods($ofind['gid'],'goods_name');
            $data_['gid'] = $ofind['gid'];
            $data_['gname'] = $find['goods_name'];
            //商品信息

            $data_['specdata'] = $ofind['specdata'];

            //价格
            $price = model('Goodsku')->priceBySid($ofind['sid']);
            if(!$price){
                $re['code'] = 0;
                $re['msg'] = '规格已修改请重新下单';
                return $re;
            }
            $data_['price'] = $price;
            //价格

            //折扣
            $where = array();
            $where['gid'] = $ofind['gid'];
            $where['lv'] = $level;
            $find = db('good_discount')->where($where)->find();
            if($find){
                $data_['discount'] = $find['discount'];
            }else{
                $data_['discount'] = 1;
            }
            //折扣

            $data_['num'] = $ofind['num'];
            $data_['allprice'] = $data_['num']*$data_['price']*$data_['discount'];
            $fee = $fee + $data_['allprice'];

            if($ofind['upimg'] == 'a'){
                $data_['upimg'] = $ofind['upimg'];
            }else{
                $data_['upimg'] = json_decode($ofind['upimg']);
            }
            
            $data[] = $data_;

        }

        //删除购物车
        model('shopcar')->delByArr($delarr);
        //删除购物车

        $re['code'] = 1;
        $re['msg'] = '成功';
        $re['data']['goods'] = $data;
        $re['data']['fee'] = $fee;
        return $re;

    }

    //订单列表
    public function orderList($uid){

        $where['uid'] = $uid;
        $pa = $this->where($where)->paginate();
        $data = $pa->toArray();
        $page = $pa->render();
        foreach($data['data'] as &$v){

            $arr = json_decode($v['goodsdata'],true);
            $gdata = model('goods')->orderGoods($arr);
            $v['goodsdata'] = $gdata;

        }
        $re['data'] = $data;
        $re['page'] = $page;
        return $re;

    }

    //获取单个订单
    public function oneorder($id,$uid){

        $where['uid'] = $uid;
        $where['id'] = $id;
        $data = $this->where($where)->find();
        if(!$data){
            return false;
        }else{
            $data = $data->toArray();
        }

        $arr = json_decode($data['goodsdata'],true);
        $gdata = model('goods')->orderGoods($arr);
        $data['goodsdata'] = $gdata;

        return $data;

    }

    //改变订单状态
    public function cgStatus($id,$uid,$status){

        $where['id'] = $id;
        $where['uid'] = $uid;
        $data['status'] = $status;
        $re = $this->where($where)->update($data);
        return $re;

    }

    //改变支付方式
    public function setPayType($id,$uid,$type){

        $where['id'] = $id;
        $where['uid'] = $uid;
        $data['paytype'] = $type;
        $re = $this->where($where)->update($data);
        return $re;

    }

}

