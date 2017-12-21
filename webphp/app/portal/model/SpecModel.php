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

class SpecModel extends Model
{
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('spec_name', 'require', '规格名称不能为空！', 1, 'regex', 3),
        array('type_id', 'require', '规格类型不能为空！', 1, 'regex', 3),
    );

    protected $_auto = array (
        array('spec_name', 'trim', 3, 'function' ),
    );

//
//    protected function _before_write(&$data) {
//        parent::_before_write($data);
//    }



}