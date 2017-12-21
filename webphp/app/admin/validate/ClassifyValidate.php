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
namespace app\admin\validate;

use think\Validate;
use think\Db;

class ClassifyValidate extends Validate
{
    protected $rule = [
        'title|分类名称' => 'require|checkName:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]{1,60}$/u',
      //  'shotcut|缩略图' => 'url',
//        'sort|排序' => 'require|number'
    ];


    protected $message = [
//        'name.require'       => '名称不能为空',
//        'app.require'        => '应用不能为空',
//        'parent_id'          => '超过了4级',
//        'controller.require' => '名称不能为空',
//        'action.require'     => '名称不能为空',
//        'action.unique'      => '同样的记录已经存在!',
    ];


    // 自定义验证规则
    protected function checkName($val,$rule,$data){
        $res = preg_match($rule,$val);
        return $res ? true : '分类名称为1-60个字符(字母、数字和中文)';
    }
}