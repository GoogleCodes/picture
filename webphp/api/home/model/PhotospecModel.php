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

class PhotospecModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_photo_spec';

    //获取规格
    //tid 规格类型
    public function speclist($tid=0){

        $where=array();
        if($tid!=0){
            $where['type_id']=$tid;
        }
        $sel = $this->where($where)->order("id asc")->select()->toArray();
        $data = array();
        foreach($sel as $v){
            $where = array();
            $itemsel = model("specitem")->itemlist($v['id']);
            if($itemsel){
                $v['children'] = $itemsel;
            }
            $data[] = $v;
        }
        return $data;

    }

    //获取指定商品规格
    public function getspec($pid){

        $where = array();
        $where['photo_id'] = $pid;
        $data = db('photo_sku')->where($where)->select();
        if($data){

            //获取spec_item的id
            $skuarr = array();
            $arr = array("{","}");
            $exarr = array();
            foreach($data as $v){
                $item = $v['item_path'];
                $item = str_replace($arr,'', $item);
                $ex = explode('-', $item);
                $ex_['s'] = $ex;
                $ex_['m'] = $v['img'];
                $exarr[] = $ex_;
                $skuarr = array_merge($skuarr,$ex);
            }
            $skuarr = array_unique($skuarr);
            //获取spec_item的id

            //spec_item 的选项
            $where = array();
            $where['id'] = array('in',$skuarr);
            $itemsel = db('photo_spec_item')
                        ->where($where)
                        ->order('item_order desc')
                        ->select();
            $itemarr = array();
            $specidarr = array();
            foreach($itemsel as $v){
                $itemarr[$v['id']] = $v;
                $specidarr[] = $v['spec_id'];
            }
            $specidarr = array_unique($specidarr);
            //spec_item 的选项

            //spec
            $where['id'] = array('in',$specidarr);
            $specsel = db('photo_spec')->where($where)->select();
            $spec = array();
            foreach($specsel as $v){
                $spec[$v['id']] = $v;
            }
            //spec

            //ret1
            $ret1 = array();
            foreach($exarr as $v){
                $ret_ = array();
                $ret_3 = array();
                foreach($v['s'] as $v2){
                    $tet_2 = array();
                    $ret_2['id'] = $v2;
                    $ret_2['item'] = $itemarr[$v2]['item'];
                    $ret_3[] = $ret_2;
                }
                $ret_['spec'] = $ret_3;
                $ret_['img'] = $v['m'];
                $ret1[] = $ret_;
            }
            //ret1

            //ret2
            $ret2 = array();
            foreach($spec as $v){
                $ret2_ = array();
                $ret2_['spec'] = $v['spec_name'];
                $ret2[$v['id']] =  $ret2_;
            }
            foreach($itemarr as $v){
                $ret2[$v['spec_id']]['item'][] = $v;
            }
            //ret2
            
            /*$ret[] = $ret1;
            $ret[] = $ret2;*/
            return $ret2;
            
        }else{
            return false;
        }

    }

    //规格处理
    public function specmake($spec){

        $data = array();
        foreach($spec as $v){
            $data[$v['spec']] = $v;
        }
        return $data;

    }

}

