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

class MemberController extends AdminBaseController
{
    //会员管理
    public function _initialize()
    {
//        $adminSettings = cmf_get_option('admin_settings');
//        if (empty($adminSettings['admin_password']) || $this->request->path() == $adminSettings['admin_password']) {
//            $adminId = cmf_get_current_admin_id();
//            if (empty($adminId)) {
//                session("__LOGIN_BY_CMF_ADMIN_PW__", 1);//设置后台登录加密码
//            }
//        }

        parent::_initialize();
    }

    //
    public function index()
    {

        $info = Db::name('member')->paginate();

        $level = Db::name('member_level')->select();
        $this->assign('info', $info);
        $this->assign('page', $info->render());
        $this->assign('level', $level);
        return $this->fetch();

    }

    //设置会员等级
    public function setlevel(){

        $post = Request::instance()->post();
        $where['id'] = $post['mid'];
        $data['level'] = $post['level'];
        $update = db('member')->where($where)->update($data);
        if(!$update){
            $this->error('更新失败');
        }
        $this->success('更新成功');

    }

    //订单
    public function order($uid){

        if(!$uid){
            $this->error('非法载入');
        }
        $where['uid'] = $uid;

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

        $pa = db('order')->where($where)->paginate();
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
        $this->assign('uid',$uid);
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

    //设置订单状态
    public function setstatus(){

        $post = Request::instance()->post();
        $where['id'] = $post['id'];
        $data['status'] = $post['status'];
        $re = db('order')->where($where)->update($data);
        if(!$re){
            $this->error('更新失败');
        }
        $this->success('更新成功');

    }

    //会员级别
    public function level(){

        $data = db('member_level')->select();
        $this->assign('data',$data);
        return $this->fetch();
        
    }

    //编辑会员级别
    public function editlevel($id){

        if($id){
            $where['id'] = $id;
            $data = db('member_level')->where($where)->find();
            $this->assign('data',$data);
            return $this->fetch();
        }

    }

    //编辑会员级别post
    public function editlevelpost(){

        $post = Request::instance()->post();
        if($post){
            $where['id'] = $post['id'];
            unset($post['id']);
            $post['content'] = html_entity_decode($post['content']);
            $update = db("member_level")->where($where)->update($post);
            if(!$update){
                $this->error('修改失败');
            }
            $this->success('修改成功');
        }

    }

    //添加级别
    public function addlevel(){

        $post = Request::instance()->post();
        if($post){
            $insert = db('member_level')->insert($post);
            if(!$insert){
                $this->error("添加失败");
            }
            $this->success("添加成功");
        }else{
            return $this->fetch();
        }

    }

}
