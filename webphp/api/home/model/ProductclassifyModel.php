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

class ProductclassifyModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_product_classify';

    //获取产品分类
    public function getPrdClassify($where=array(),$field="*"){

        $data = $this->where($where)->field($field)->select()->toArray();
        foreach($data as &$v){
            if($v['title'] == '照片冲印'){
                $v['is_up'] = 0;
            }else{
                $v['is_up'] = 1;
            }
            $v['shotcut'] = cmf_get_image_preview_url($v['shotcut']);
        }
        return $data;

    }

    //获取所有子分类id
    public function getPrdClassifyAcId($parent_id=0){

        if(!$parent_id){
            $re=$this->field("id")->select()->toArray();
            return $re;
        }else{
            $re=array();
            $where=array();
            $where['parent_id']=$parent_id;
            $data=$this->where($where)->field("id")->select()->toArray();
            $re[] = $parent_id;
            if($data){
                foreach($data as &$v){
                    $re[]=$v['id'];
                    $re2=$this->getPrdClassifyAcId($v['id']);
                    if($re2){
                        $re=array_merge($re,$re2);
                    }
                }
                $re = array_unique($re);
                return $re;
            }else{
                $re = array_unique($re);
                return $re;
            }
        }

    }

    //获取子分类
    public function children($parent_id=0){

        $where['parent_id']=$parent_id;
        $data=$this->where($where)->field("id")->select()->toArray();
        return $data;

    }

}

