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

class ShopcarModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_shop_car';

    //添加数据
    //uid 用户id
    //data 数据
    public function add($data){

        $data['time'] = time();
        $insert = $this->insert($data);
        return $insert;

    }

    //获取指定id购物车数据
    //uid 用户id
    public function dataById($id,$uid){

        $level = model('member')->level($uid);

        $where = array();
        $where['s.id'] = $id;
        $where['s.uid'] = $uid;
        $where['d.lv'] = $level;
        $field = 'g.goods_name,g.goods_thumb,g.goods_remark,k.price,k.sku_id,s.num,s.id,s.specdata,s.upimg,s.id,d.discount';
        $data = $this->where($where)
                        ->alias('s')
                        ->join('cmf_good_sku k','k.sku_id=s.sid')
                        ->join('cmf_goods g','g.goods_id=s.gid')
                        ->join('cmf_good_discount d','d.gid=s.gid')
                        ->field($field)
                        ->find();
        if(!$data){
            return false;
        }
        $data = $data->toArray();

        //图片处理
        $tarr = json_decode($data['goods_thumb'],true);
        foreach($tarr as &$v2){
            $v2['url'] = cmf_get_image_preview_url($v2['url']);
        }
        $data['goods_thumb'] = $tarr;
        $data['upimg'] = json_decode($data['upimg'],true);
        //图片处理

        return $data;

    }

    //根据用户id获取数据
    //uid 用户id
    public function dataByuid($uid){

        $level = model('member')->level($uid);

        $where['s.uid'] = $uid;
        $where['d.lv'] = $level;
        $field = 'g.goods_name,g.goods_thumb,g.goods_remark,k.price,k.sku_id,s.num,s.id,s.specdata,s.id,s.upimg,d.discount';
        $data = $this->where($where)
                        ->alias('s')
                        ->join('cmf_good_sku k','k.sku_id=s.sid')
                        ->join('cmf_goods g','g.goods_id=s.gid')
                        ->join('cmf_good_discount d','d.gid=s.gid')
                        ->field($field)
                        ->select()
                        ->toArray();

        //图片处理
        foreach($data as &$v){
            $tarr = json_decode($v['goods_thumb'],true);
            foreach($tarr as &$v2){
                $v2['url'] = cmf_get_image_preview_url($v2['url']);
            }
            $v['goods_thumb'] = $tarr;
            $v['upimg'] = json_decode($v['upimg'],true);
        }
        //图片处理

        return $data;

    }

    //更改数据
    //uid 用户id
    public function editdata($id,$uid,$data){

        $where['id'] = $id;
        $where['uid'] = $uid;
        $data['time'] = time();
        $update = $this->where($where)->update($data);
        return $update;

    }

    //删除数据
    //uid 用户id
    public function deldata($id,$uid){

        $where['id'] = $id;
        $where['uid'] = $uid;
        $del = $this->where($where)->delete();
        return $del;

    }

    //清空购物车
    //uid 用户id
    public function clear($uid){

        $where['uid'] = $uid;
        $del = $this->where($where)->delete();
        return $del;

    }

    //删除对应的购物车
    public function delByArr($arr){

        $where['id'] = array('in',$arr);
        $this->where($where)->delete();

    }

    //上传图片保存
    public function upSave($id,$img){

        $where['id'] = $id;

        if($img != 'a'){
            $img = str_replace('&quot;', '"', $img);
            $arr = json_decode($img,true);
            //个数
            $num = 0;
            foreach($arr as $v){
                $num = $num + $v['num'];
            }
            //个数
        }

        $data['upimg'] = $img;
        $data['num'] = $num;
        $re = $this->where($where)->update($data);
        return $re;

    }

}

