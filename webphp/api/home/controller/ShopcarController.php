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
class ShopcarController extends RestBaseController
{
    
    //购物车添加数据
    public function add(){

        $post = Request::instance()->post();
        if($post){
            $re = model("shopcar")->add($post);
            if($re){
                $this->success("添加成功");
            }else{
                $this->error("添加失败");
            }
        }

    }

    //获取数据
    public function getById(){

        $post = Request::instance()->post();
        if($post){
            $id = $post['id'];
            $uid = $post['uid'];
            $re = model("shopcar")->dataById($id,$uid);
            if($re){
                $this->success("请求成功",$re);
            }else{
                $this->error("请求失败");
            }
        }

    }

    //获取数据
    public function getByUid(){

        $post = Request::instance()->post();
        if($post){
            $uid = $post['uid'];
            $re = model("shopcar")->dataByuid($uid);
            if($re){
                $this->success("请求成功",$re);
            }else{
                $this->error("请求失败");
            }
        }

    }

    //更改数据
    public function edit(){

        $post = Request::instance()->post();
        if($post){
            $id = $post['id'];
            $uid = $post['uid'];
            unset($post['id']);
            unset($post['uid']);
            $re = model("shopcar")->editdata($id,$uid,$post);
            if($re){
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }
        }

    }

    //删除数据
    public function del(){

        $post = Request::instance()->post();
        if($post){
            $id = $post['id'];
            $uid = $post['uid'];
            $re = model("shopcar")->deldata($id,$uid);
            if($re){
                $this->success("删除成功");
            }else{
                $this->error("删除失败");
            }
        }

    }

    //删除数据
    public function clear(){

        $post = Request::instance()->post();
        if($post){
            $uid = $post['uid'];
            $re = model("shopcar")->clear($uid);
            if($re){
                $this->success("删除成功");
            }else{
                $this->error("删除失败");
            }
        }

    }

    //获取规格对应价格
    //spec 以“-”连接规格id的字符串
    public function price(){

        $post = Request::instance()->post();
        if($post){
            $spec = $post['spec'];
            $gid = $post['gid'];
            $re = model("goodsku")->price($spec,$gid);
            if($re){
                $this->success("获取成功",$re);
            }else{
                $this->error("获取失败");
            }
        }

    }

    //上传图片保存
    public function upSave(){

        $post = Request::instance()->post();
        $id = $post['id'];
        $img = $post['img'];
        $re = model('shopcar')->upSave($id,$img);
        if($re){
            $this->success("修改成功",$re);
        }else{
            $this->error("修改失败");
        }

    }

}
