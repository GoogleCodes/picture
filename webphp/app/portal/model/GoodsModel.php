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
namespace app\portal\model;

use think\Model;

class GoodsModel extends Model
{
    //添加编辑规格
    public function addGoodsSku($goods_id, $arr)
    {
        db('GoodSku')->where(array('goods_id' => $goods_id))->delete();

        foreach ($arr as $key => $val) {
            $dataList[] = array('goods_id' => $goods_id, 'item_path' => $key, 'price' => $val,);
        }
        db('GoodSku')->insertAll($dataList);
    }

    public function saveGoodsSku($goods_id, $arr)
    {
        db('GoodSku')->where(array('goods_id' => $goods_id))->delete();

        foreach ($arr as $key => $val) {
            $dataList[] = array('goods_id' => $goods_id, 'item_path' => $key, 'price' => $val);
        }

        db('GoodSku')->insertAll($dataList);
    }


    public function adddiscount($goods_id,$arr){

        db('GoodDiscount')->where(array('gid' => $goods_id))->delete();

        foreach ($arr as $key => $val) {
            if($val['discount']==''){
                $val['discount'] = 1;
            }
            $dataList[] = array('gid' => $goods_id, 'lv' => $val['lv'], 'discount' => $val['discount'],);
        }

        db('GoodDiscount')->insertAll($dataList);

    }

    public function savediscount($goods_id,$arr){

        db('GoodDiscount')->where(array('gid' => $goods_id))->delete();

        foreach ($arr as $key => $val) {
            $dataList[] = array('gid' => $goods_id, 'lv' => $val['lv'], 'discount' => $val['discount'],);
        }

        db('GoodDiscount')->insertAll($dataList);

    }


}