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
namespace app\portal\validate;

use think\Validate;

class GoodsValidate extends Validate
{
    protected $rule = [
        'post_title' => 'require',
        'categories' => 'require',
        'goods_type' => 'require',
    ];
    protected $message = [
        'post_title.require' => '文章标题不能为空！',
        'categories.require' => '产品分类未选择',
        'goods_type.require' => '产品规格未选择！',
    ];

    protected $scene = [
//        'add'  => ['user_login,user_pass,user_email'],
//        'edit' => ['user_login,user_email'],
    ];
}