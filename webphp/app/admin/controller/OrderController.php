<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use FontLib\Table\Type\name;
use think\Db;
use \think\Request;
use app\admin\model\AdminMenuModel;

class OrderController extends AdminBaseController
{
    //会员管理
    public function _initialize()
    {
        parent::_initialize();
    }

    //
    public function index()
    {

        $where = array();

        $get = Request::instance()->get();

        $where = array();
        $status = -1;
        if(isset($get['status'])&&$get['status']!=-1){
            $where['status'] = $get['status'];
            $status = $get['status'];
        }

        if(isset($get['orderid'])&&$get['orderid']){
            $where['orderid|goodsdata'] = array('like','%'.$get['orderid'].'%');
        }

        $pa = db('order')->where($where)->order('id desc')->paginate();
        $page = $pa->render();

        //格式转换
        $starr[0] = '未付款';
        $starr[1] = '已付款';
        $starr[2] = '已发货';
        $starr[3] = '已收货';
        $starr[4] = '已取消';
        $data = array();
        foreach($pa as &$v){
            $v['goodsdata'] = json_decode($v['goodsdata'],true);
            $v['address'] = json_decode($v['address'],true);
            $v['sta'] = $starr[$v['status']];
            $data[] = $v;
        }
        //格式转换

        $this->assign('status',$status);
        $this->assign('starr',$starr);
        $this->assign('data',$data);
        $this->assign('page',$page);
        return $this->fetch();

    }

    //订单详情
    public function orderdetail($id){

        $where['id'] = $id;
        $data = db("order")->where($where)->find();
        if(!$data){
            $this->error("非法载入");
        }

        $data['goodsdata'] = json_decode($data['goodsdata'],true);
        $data['address'] = json_decode($data['address'],true);

        $starr[0] = '未付款';
        $starr[1] = '已付款';
        $starr[2] = '已发货';
        $starr[3] = '已收货';
        $starr[4] = '已取消';

        $this->assign('starr',$starr);
        $this->assign('data',$data);
        return $this->fetch();

    }

}
