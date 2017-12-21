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
class CeshiController extends RestBaseController
{
    
    //上传测试
    public function imgupload(){

        $request = Request::instance();
        $file=$request->file("img");
        if($file){
            $path=ROOT_PATH . 'public' . DS . 'upload'.DS.'kp';
            $info = $file->move($path);
            if($info){
                $fullpath=$path.DS.$info->getSaveName();
                die($fullpath);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

    }

    public function getPrdClassify(){

        $get = Request::instance()->get();

        $paginate=config("paginate");
        $pagenum=$paginate['list_rows'];
        if(isset($get['pagenum'])){
            $pagenum=$get['pagenum'];
        }

        $where=1;
        if(isset($get['parent_id'])){
            $where=array();
            $where['parent_id']=$get['parent_id'];
        }

        $data=model("home/productclassify")->getPrdClassify($where=$where,$field="*",$pagenum=$pagenum);
        dump($data);
        
    }

}
