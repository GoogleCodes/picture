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

class ProductModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_product';

    //获取产品列表
    public function productList($cid=0,$all=false,$pagenum=15,$where=array(),$field='*',$order="id desc"){

        if($cid){
            if($all){
                $cidarr=model('productclassify')->getPrdClassifyAcId($cid);
                $where['cid']=array('in'.$cidarr);
            }else{
                $where['cid']=$cid;
            }
        }

        $pa = $this->where($where)->field($field)->order($order)->paginate($pagenum);
        $data = $pa->toArray();
        $data['page'] = $pa->render();
        return $data;

    }

    //产品信息
    public function productInfo($id){

        $where['id']=$id;
        $data=$this->where($where)->find();
        return $data;

    }

    //随机个数的产品
    public function randPrd($cid,$num){

        $where['cid']=$cid;
        return $this->where($where)->order("rand()")->limit($num)->select()->toArray();

    }

}

