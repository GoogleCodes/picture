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

use app\admin\model\RouteModel;
use think\Model;
use tree\Tree;

class GoodsCategoryModel extends Model
{

    protected $type = [
        'more' => 'array',
    ];
    protected $table = 'cmf_product_classify';

    /**
     * 生成分类 select树形结构
     * @param int $selectId 需要选中的分类 id
     * @param int $currentCid 需要隐藏的分类 id
     * @return string
     */
    public function adminCategoryTree($selectId = 0, $currentCid = 0)
    {
       // $where = ['delete_time' => 0];
        $where = [];

        if (!empty($currentCid)) {
            $where['id'] = ['neq', $currentCid];
        }
        $categories = $this->order("createtime ASC")->where($where)->select()->toArray();

        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';

        $newCategories = [];
        foreach ($categories as $item) {
            $item['selected'] = $selectId == $item['id'] ? "selected" : "";

            array_push($newCategories, $item);
        }

        $tree->init($newCategories);
        $str     = '<option value=\"{$id}\" {$selected}>{$spacer}{$title}</option>';
        $treeStr = $tree->getTree(0, $str);

        return $treeStr;
    }

    /**
     * @param int|array $currentIds
     * @param string $tpl
     * @return string
     */
    public function adminCategoryTableTree($currentIds = 0, $tpl = '')
    {
       // $where = ['delete_time' => 0];
//        if (!empty($currentCid)) {
//            $where['id'] = ['neq', $currentCid];
//        }

        $where = [];
        $categories = $this->order("createtime ASC")->where($where)->select()->toArray();

        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';

        if (!is_array($currentIds)) {
            $currentIds = [$currentIds];
        }

        $newCategories = [];
        foreach ($categories as $item) {
            $item['checked'] = in_array($item['id'], $currentIds) ? "checked" : "";
            $item['url']     = '';
//            cmf_url('portal/List/index', ['id' => $item['id']]);
            $item['str_action'] = '<a href="' . url("Goods/edit_goods_Category", ["id" => $item['id']]) . '">' . lang('EDIT') . '</a>  <a class="js-ajax-delete" href="' . url("Goods/del_goods_Category", ["id" => $item['id']]) . '">' . lang('DELETE') . '</a> ';

//            <a href="' . url("Goods/add_goods_Category", ["parent" => $item['id']]) . '">添加子分类</a>

            array_push($newCategories, $item);
        }

        $tree->init($newCategories);

        if (empty($tpl)) {
            $tpl = "<tr>
                        <td>#</td>
                        <td>\$id</td>
                        <td>\$spacer <a href='\$url' target='_blank'>\$title</a></td>
                
                        <td>\$str_action</td>
                    </tr>";
        }
//        <td>$description</td>
        $treeStr = $tree->getTree(0, $tpl);
        return $treeStr;
    }

    /**
     * 添加文章分类
     * @param $data
     * @return bool
     */
    public function addCategory($data)
    {
        $result = true;
        self::startTrans();
        try {
            if (!empty($data['shotcut'])) {
                $data['shotcut'] = cmf_asset_relative_url($data['shotcut']);
            }
            $data['createtime'] = time();
            $this->allowField(true)->save($data);
            $id = $this->id;
            if (empty($data['parent_id'])) {

                $this->where( ['id' => $id])->update(['path' => '0-' . $id]);
            } else {
                $parentPath = $this->where('id', intval($data['parent_id']))->value('path');
                $this->where( ['id' => $id])->update(['path' => "$parentPath-$id"]);

            }
            self::commit();
        } catch (\Exception $e) {
            self::rollback();
            $result = false;
        }
//
//        if ($result != false) {
//            //设置别名
//            $routeModel = new RouteModel();
//            if (!empty($data['alias']) && !empty($id)) {
//                $routeModel->setRoute($data['alias'], 'portal/List/index', ['id' => $id], 2, 5000);
//                $routeModel->setRoute($data['alias'] . '/:id', 'portal/Article/index', ['cid' => $id], 2, 4999);
//            }
//            $routeModel->getRoutes(true);
//        }
        return $result;
    }

    public function editCategory($data)
    {
        $result = true;

        $id          = intval($data['id']);
        $parentId    = intval($data['parent_id']);
        $oldCategory = $this->where('id', $id)->find();

        if (empty($parentId)) {
            $newPath = '0-' . $id;
        } else {
            $parentPath = $this->where('id', intval($data['parent_id']))->value('path');
            if ($parentPath === false) {
                $newPath = false;
            } else {
                $newPath = "$parentPath-$id";
            }
        }

        if (empty($oldCategory) || empty($newPath)) {
            $result = false;
        } else {


            $data['path'] = $newPath;
            if (!empty($data['shotcut'])) {
                $data['shotcut'] = cmf_asset_relative_url($data['shotcut']);
            }
            $this->isUpdate(true)->allowField(true)->save($data, ['id' => $id]);

            $children = $this->field('id,path')->where('path', 'like', "%-$id-%")->select();

            if (!empty($children)) {
                foreach ($children as $child) {
                    $childPath = str_replace($oldCategory['path'] . '-', $newPath . '-', $child['path']);
                    $this->isUpdate(true)->save(['path' => $childPath], ['id' => $child['id']]);
                }
            }

//            $routeModel = new RouteModel();
//            if (!empty($data['alias'])) {
//                $routeModel->setRoute($data['alias'], 'portal/List/index', ['id' => $data['id']], 2, 5000);
//                $routeModel->setRoute($data['alias'] . '/:id', 'portal/Article/index', ['cid' => $data['id']], 2, 4999);
//            } else {
//                $routeModel->deleteRoute('portal/List/index', ['id' => $data['id']]);
//                $routeModel->deleteRoute('portal/Article/index', ['cid' => $data['id']]);
//            }
//
//            $routeModel->getRoutes(true);
        }


        return $result;
    }


}