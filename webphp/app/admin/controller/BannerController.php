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

use \think\Request;
use cmf\controller\AdminBaseController;

class BannerController extends AdminBaseController
{
    
    //banner列表
    public function index(){

        $info = db("banner")->paginate();
        $this->assign('info',$info);
        $this->assign('page',$info->render());
        return $this->fetch();

    }

    //添加banner
    public function add(){

        if(Request::instance()->isPost()){

            $post = Request::instance()->post();
            $insert = db('banner')->insert($post);
            if(!$insert){
                $this->error('添加失败');
            }
            $url = url('admin/banner/index');
            $this->success('添加成功',$url);

        }else{
            return $this->fetch();
        }

    }

    //编辑
    public function edit($id){

        $where['id'] = $id;
        $data = db('banner')->where($where)->find();
        if($data['img']){
            $data['img2'] = cmf_get_image_preview_url($data['img']);
        }
        $this->assign('data',$data);
        return $this->fetch();

    }

    //编辑
    public function editpost(){

        if(Request::instance()->isPost()){

            $post = Request::instance()->post();
            $where['id'] = $post['id'];
            unset($post['id']);
            $insert = db('banner')->where($where)->update($post);
            if(!$insert){
                $this->error('编辑失败');
            }
            $url = url('admin/banner/index');
            $this->success('编辑成功',$url);

        }

    }

    //删除
    public function del(){

        if(Request::instance()->isPost()){

            $post = Request::instance()->post();
            $where['id'] = $post['id'];
            $del = db('banner')->where($where)->delete();
            if(!$del){
                $this->error('编辑失败');
            }
            $url = url('admin/banner/index');
            $this->success('编辑成功',$url);

        }

    }

}