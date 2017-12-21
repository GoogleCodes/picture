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

class PhotoModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_photo';

    //相框列表
    //请求方式 get
    //cid 分类id
    //spec 规格（格式为以“-”分隔开的规格选项id，如：1,1-2-3,1-2-3-4 ）
    //pagenum 分页数
    public function photoList($cid=0,$spec=false,$where=array(),$pagenum=15,$field='*',$order=''){

        //规格
        if($spec){
            $arr = explode("-", $spec);
            $sarr = array();
            foreach($arr as $v){
                $sarr[]='%{'.$v.'}%';
            }
            $swhere['item_path'] = array('like',$sarr);
            $garr = db("photo_sku")->field('photo_id')->where($swhere)->select();
            foreach($garr as $v){
                $garr2[] = $v['photo_id'];
            }
            $garr = array_unique($garr2);
            $where['photo_id'] = array('in',$garr);
        }

        if($cid){
            $where['cat_id'] = $cid;
        }

        $where['is_on_sale'] = 1;

        $pa = $this->where($where)
                    ->field($field)
                    ->order($order)
                    ->paginate($pagenum);
        $data = $pa->toArray();

        //图片格式化
        foreach($data['data'] as &$v){
            $v['photo_thumb'] = json_decode($v['photo_thumb'],true);
            foreach($v['photo_thumb'] as &$v2){
                $v2['url'] = cmf_get_image_preview_url($v2['url']);
            }
        }
        //图片格式化

        $data['page'] = $pa->render();
        return $data;

    }

    //通过id获取相框
    public function photoById($id){

        $where['photo_id'] = $id;
        $where['is_on_sale'] = 1;
        $data = $this->where($where)->find();
        if(!$data){
            return false;
        }
        $data = $data->toArray();

        //图片处理
        $arr = json_decode($data['photo_thumb'],true);
        $img = array();
        foreach($arr as $v){
            $img_['url'] = cmf_get_image_preview_url($v['url']);
            $img[] = $img_;
        }
        $data['photo_thumb'] = json_encode($img);
        //图片处理

        $myspec = model('photospec')->getspec($id);
        if($myspec){
            //$myspec = model('photospec')->specmake($myspec);
            $data['myspec'] = $myspec;
        }else{
            $data['myspec'] = [];
        }
        return $data;

    }

}

