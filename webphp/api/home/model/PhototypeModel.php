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

class PhototypeModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'cmf_photo_type';

    //获取产品分类
    public function typeList($where=array(),$field="*"){

        $data = $this->where($where)->field($field)->select()->toArray();
        return $data;

    }

}

