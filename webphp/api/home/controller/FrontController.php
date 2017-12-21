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
use EasyWeChat\Foundation\Application;
header('Access-Control-Allow-Origin:*');
class FrontController extends RestBaseController
{

    public function csde(){

        $dir=ROOT_PATH.'public/qrcode/';
        $file=scandir($dir);
        $overtime = time() - 3600*12;
        foreach($file as $v){
            if($v != '.' && $v != '..'){
                $path = $dir.$v;
                $time = filectime($path);
                if($time < $overtime){
                    unlink($path);
                }
            }
        }

    }

    //上传测试
    public function imgupload(){

        $request = Request::instance();
        $file=$request->file("img");
        if($file){
            $path=ROOT_PATH . 'public' . DS . 'upload'.DS.'kp';
            $info = $file->move($path);
            if($info){
                $fullpath = 'https://'.$path.DS.$info->getSaveName();
                $fullpath = str_replace('/www/', '', $fullpath);
                //$fullpath = "http://yuyin.ittun.com".DS.'public' . DS . 'upload'.DS.'kp'.DS.$info->getSaveName();
                $to['path'] = $fullpath;
                $to['num'] = 1;
                $this->success("上传成功",$to);
            }else{
                // 上传失败获取错误信息
                $this->error("上传失败",$file->getError());
            }
        }

    }

    public function cs(){
        $data = model('goods')->goodsList();
        dump($data);
    }

    //获取列表分类
    public function getPrdClassify(){

        $get = Request::instance()->get();

        $where=array();
        $where['parent_id']=0;
        if(isset($get['parent_id'])){
            $where['parent_id']=$get['parent_id'];
        }

        if(isset($get['top'])){
            $where['top']=$get['top'];
        }

        $data=model("productclassify")->getPrdClassify($where=$where,$field="*");
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error("请求失败",$data);
        }
        
    }

    //根据id获取分类
    public function PrdClassifyById(){

        $get = Request::instance()->get();
        $id = $get['id'];
        $where['id'] = $id;
        $data=model("productclassify")->getPrdClassify($where=$where,$field="*");
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error("请求失败",$data);
        }

    }

    //获取产品信息
    public function productInfo(){

        $get = Request::instance()->get();
        $id = $get['id'];
        $data = model('product')->productInfo($id);
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error("请求失败",$data);
        }

    }

    //获取随机产品
    public function randGoods(){

        $get = Request::instance()->get();
        $cid = 0;
        if(isset($get['cid'])){
            $cid = $get['cid'];
        }
        $num = 4;
        if(isset($get['num'])){
            $num = $get['num'];
        }
        $data = model('goods')->randGoods($cid,$num);
        if($data){
            $this->success("请求成功",$data);
        }else{
            $this->error("请求失败",$data);
        }

    }

    //规格获取
    public function speclist(){

        $data = model("spec")->speclist();
        $this->success("请求成功",$data);

    }

    //产品搜索
    public function goodsList(){

        $get = Request::instance()->get();

        $spec = false;
        if(isset($get['spec'])){
            $spec = $get['spec'];
        }

        $cid = 0;
        if(isset($get['cid'])){
            $cid = $get['cid'];
        }

        $all = false;
        if(isset($get['all'])){
            $all = $get['all'];
        }

        $limit = 0;
        if(isset($get['limit'])){
            $limit = $get['limit'];
        }

        $where = array();
        if(isset($get['is_hot'])){
            $where['is_hot'] = 1;
        }

        if(isset($get['keyword'])){
            $where['goods_name'] = array('like','%'.$get['keyword'].'%');
        }

        $data = model('goods')->goodsList($cid=$cid,$all=$all,$spec=$spec,$where=$where,$limit=$limit);
        $this->success("请求成功",$data);

    }

    //获取产品
    public function getgoods(){

        $get = Request::instance()->get();
        $id = $get['id'];
        $data = model('goods')->goodsById($id);
        $this->success('请求成功',$data);

    }

    //获取banner
    public function banner(){

        $data = db('banner')->select();
        foreach($data as &$v){
            $v['img'] = cmf_get_image_preview_url($v['img']);
        }
        $this->success("获取成功",$data);

    }

    public function bbb(){

        $uid = 7;
        $data = model('shopcar')->dataByuid($uid);
        dump($data);

    }

}
