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

class PhotoskuModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_photo_sku';

    //获取规格对应价格
    //spec 以“-”连接规格id的字符串
    public function sku($spec,$pid){

        $arr = explode("-", $spec);
        foreach($arr as $v){
            $sarr[]='%{'.$v.'}%';
        }
        $where['photo_id'] = $pid;
        $where['item_path'] = array('like',$sarr);
        $data = $this->where($where)->select()->toArray();
        foreach($data as &$v){
            $v['img'] = cmf_get_image_preview_url($v['img']);
        }
        return $data;

    }

    //根据指定id获取price
    public function skuBySid($sid){

        $where['sku_id'] = $sid;
        $data = $this->where($where)->find();
        if(!$data){
            return false;
        }
        $img = cmf_get_image_preview_url($data['img']);
        return $img;

    }

}

