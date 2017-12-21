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

class GoodsModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_goods';

    //获取产品
    //请求方式 get
    //cid 分类id
    //all 是否读取子分类下的产品
    //spec 规格（格式为以“-”分隔开的规格选项id，如：1,1-2-3,1-2-3-4 ）
    //pagenum 分页数
    public function goodsList($cid=0,$all=false,$spec=false,$where=array(),$limit=0,$field='*',$order=""){

        //规格
        if($spec){
            $arr = explode("-", $spec);
            $sarr = array();
            foreach($arr as $v){
                $sarr[]='%{'.$v.'}%';
            }
            $swhere['item_path'] = array('like',$sarr);
            $garr = db("good_sku")->field('goods_id')->where($swhere)->select();
            $garr2 = array();
            foreach($garr as $v){
                $garr2[] = $v['goods_id'];
            }
            if($garr2){
                $garr = array_unique($garr2);
                $where['goods_id'] = array('in',$garr);
            }else{
                return [];
            }
        }

        if($cid!=0){
            if($all){
                $arr = model('productclassify')->getPrdClassifyAcId($cid);
                $where['cat_id'] = array('in',$arr);
            }else{
                $where['cat_id'] = $cid;
            }
        }

        $where['is_on_sale'] = 1;
        $order = 'sort desc,goods_id desc';
        $field = 'goods_id,goods_name,shop_price,goods_thumb,goods_remark,cat_id';

        if($limit==0){
            $pa = $this->where($where)
                    ->field($field)
                    ->order($order)
                    ->select();
        }else{
            $pa = $this->where($where)
                    ->field($field)
                    ->order($order)
                    ->limit($limit)
                    ->select();
        }
        
        $data = $pa->toArray();

        //图片处理
        foreach($data as &$v){
            $tarr = json_decode($v['goods_thumb'],true);
            foreach($tarr as &$v2){
                $v2['url'] = cmf_get_image_preview_url($v2['url']);
            }
            $v['goods_thumb'] = $tarr;
        }
        //图片处理

        return $data;

    }

    //随机个数的产品
    //cid 分类id
    //num 获取个数
    public function randGoods($cid=0,$num=4){

        $where = array();
        if($cid){
            $where['cat_id']=$cid;
        }
        $field = 'goods_id,goods_name,shop_price,goods_thumb,goods_remark';
        $data = $this->where($where)
                    ->order("rand()")
                    ->field($field)
                    ->limit($num)->select()->toArray();

        //图片处理
        foreach($data as &$v){
            $tarr = json_decode($v['goods_thumb'],true);
            foreach($tarr as &$v2){
                $v2['url'] = cmf_get_image_preview_url($v2['url']);
            }
            $v['goods_thumb'] = $tarr;
        }
        //图片处理
        
        return $data;

    }

    //通过id获取产品
    public function goodsById($id){

        $where['goods_id'] = $id;
        $data = $this->where($where)->find()->toArray();
        if(!$data){
            return false;
        }

        //图片处理
        $arr = json_decode($data['photo'],true);
        $img = array();
        if($arr){
            foreach($arr as $v){
                $img_['url'] = cmf_get_image_preview_url($v['url']);
                $img_['name'] = $v['name'];
                $img[] = $img_;
            }
        }
        $data['photo'] = json_encode($img);
        //图片处理
        
        //图片处理
        $arr = json_decode($data['goods_thumb'],true);
        $img = array();
        if($arr){
            foreach($arr as $v){
                $img_['url'] = cmf_get_image_preview_url($v['url']);
                $img[] = $img_;
            }
        }
        $data['goods_thumb'] = json_encode($img);
        //图片处理
        
        //goods_content处理
        $data['goods_content'] = str_replace('/public/upload/admin', 'https://xinye-art.com/public/upload/admin', $data['goods_content']);
        //goods_content处理

        //产品分类图
        $where = array();
        $where['id'] = $data['cat_id'];
        $cla = db('product_classify')->where($where)->field('shotcut')->find();
        $data['shotcut'] = cmf_get_image_preview_url($cla['shotcut']);
        //产品分类图
        
        //数量等于0
        $data['num'] = 0;
        //数量等于0

        $myspec = model('spec')->getspec($id);
        if($myspec){
            //$myspec = model('spec')->specmake($myspec);
            $data['myspec'] = $myspec;
        }else{
            $data['myspec'] = [];
        }
        return $data;

    }

    //获取产品 id
    public function oneGoods($id,$field='*'){

        $where['goods_id'] = $id;
        $data = $this->where($where)->field($field)->find();
        return $data;

    }

    //订单商品信息出列
    public function orderGoods($arr){

        $field = 'goods_name,goods_thumb,goods_remark';
        foreach($arr as &$v){
            $re = $this->oneGoods($v['gid'],$field);
            $v['gname'] = $re['goods_name'];
            $v['gremark'] = $re['goods_remark'];
            $gthumb = json_decode($re['goods_thumb'],true);
            if($gthumb){
                foreach($gthumb as &$v2){
                    $v2['url'] = cmf_get_image_preview_url($v2['url']);
                }
                $v['gthumb'] = $gthumb;
            }else{
                $v['gthumb'] = array();
            }
        }
        return $arr;

    }

}

