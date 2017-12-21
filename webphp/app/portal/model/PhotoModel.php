<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\model;

use think\Model;

class PhotoModel extends Model
{
    //添加编辑规格
    public function addPhotoSku($goods_id, $arr)
    {
        db('PhotoSku')->where(array('photo_id' => $goods_id))->delete();

        foreach ($arr as $key => $val) {

            $dataList[] = array('photo_id' => $goods_id, 'item_path' => $key, 'img' => cmf_asset_relative_url($val["photo_thumb"]));
        }


        db('PhotoSku')->insertAll($dataList);
    }

    public function saveGoodsSku($goods_id, $arr)
    {
        db('PhotoSku')->where(array('photo_id' => $goods_id))->delete();

        foreach ($arr as $key => $val) {
            $dataList[] = array('photo_id' => $goods_id, 'item_path' => $key, 'img' => cmf_asset_relative_url($val["photo_thumb"]));
        }

        db('PhotoSku')->insertAll($dataList);
    }



}