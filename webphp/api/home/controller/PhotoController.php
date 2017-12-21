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
header("Content-type:text/html;charset=utf-8");
class PhotoController extends RestBaseController
{
    
    //获取相框类型类型
    public function typeList(){

        $data = model('phototype')->typeList();
        if($data){
            $this->success('获取成功',$data);
        }else{
            $this->error('获取失败');
        }

    }

    //规格类型
    public function speclist(){

        $get = Request::instance()->get();
        $tid = $get['tid'];
        $data = model('photospec')->speclist($tid);
        if($data){
            $this->success('获取成功',$data);
        }else{
            $this->error('获取失败');
        }

    }

    //相框列表
    public function photoList(){

        $get = Request::instance()->get();
        $cid = 0;
        if(isset($get['cid'])){
            $cid = $get['cid'];
        }
        $order = 'photo_id desc';
        $field = 'photo_id,photo_name,photo_thumb,photo_remark';
        $data = model('photo')->photoList($cid=$cid,$spec=false,$where=array(),$pagenum=15,$field=$field,$order=$order);
        if($data){
            $this->success('获取成功',$data);
        }else{
            $this->error('获取失败');
        }

    }

    //单个相框
    public function photoById(){

        $post = Request::instance()->post();
        if(!isset($post['id'])){
            $this->error('非法载入');
        }
        $id = $post['id'];

        $data = model('photo')->photoById($id);
        if($data){
            $this->success('请求成功',$data);
        }else{
            $this->error('请求失败');
        }

    }

    //规格对应照片
    public function sku(){

        $post = Request::instance()->post();
        if(!isset($post['spec'])||!isset($post['pid'])){
            $this->error('非法载入');
        }
        $spec = $post['spec'];
        $pid = $post['pid'];

        $data = model('photosku')->sku($spec,$pid);
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error('请求失败');
        }

    }

    //根据id获取sku中的图片
    public function skuBySid(){

        $post = Request::instance()->post();
        if(!isset($post['sid'])){
            $this->error('非法载入');
        }
        $sid = $post['sid'];

        $data = model('photosku')->skuBySid($sid);
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error('请求失败');
        }

    }

}
