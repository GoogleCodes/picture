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
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use FontLib\Table\Type\name;
use think\Db;
use app\admin\model\AdminMenuModel;
use think\Validate;

use app\portal\service\GoodsService;
use app\portal\model\GoodsCategoryModel;
use app\portal\model\GoodsPostModel;
use app\portal\model\SpecModel;
use app\portal\model\GoodsModel;
use app\portal\model\Good_skuModel;
use app\portal\model\SpecItemModel;

class GoodsController extends AdminBaseController
{

    public function _initialize()
    {
//        $adminSettings = cmf_get_option('admin_settings');
//        if (empty($adminSettings['admin_password']) || $this->request->path() == $adminSettings['admin_password']) {
//            $adminId = cmf_get_current_admin_id();
//            if (empty($adminId)) {
//                session("__LOGIN_BY_CMF_ADMIN_PW__", 1);//设置后台登录加密码
//            }
//        }

        parent::_initialize();
    }




    //商品列表
    public function goodslist()
    {
        $goodsCategoryModel = new GoodsCategoryModel();
        $categoryTree = $goodsCategoryModel->adminCategoryTree();

      //  $where['is_on_sale']=1;//上架状态
        $goodslist =  db('goods a')->join('product_classify b','a.cat_id = b.id','left')
          //  ->where($where)
            ->select();


// dump($goodslist);

        $this->assign('goodslist',$goodslist);
        $this->assign('category_tree', $categoryTree);
        return $this->fetch();


    }


    //添加商品
    public function add_goods()
    {

        $goods_type = db('good_type')->order('id desc')->select();
        $mlevel = db('member_level')->select();
        $this->assign('mlevel', $mlevel);
        $this->assign('goods_type', $goods_type);

        return $this->fetch();
    }

    //异步获取类型
    public function ajaxGetSpec(){
        $request = $this->request;
        $type_id = $request->param('type_id',0,'intval');
        $where['type_id']=$type_id;
        $speclist = Db::name('Spec a')
//            ->field('a.*,b.key')
//            ->join('cmf_good_type b', 'a.type_id = b.id', 'left')
            ->where($where)
            ->order('a.id desc')
            ->select();
        foreach($speclist as $key=>$v){
            $speclist[$key]['items'] = $this->specItems($v['id']);
        }
        $goods_id = $request->param('id',0,'intval');
        //获取规格id
        $items_id = Db::name('good_sku')->where(array("goods_id"=>$goods_id))->column("GROUP_CONCAT(`item_path` SEPARATOR '-') AS items_id");



//        dump($items_id);
//        exit;

      //  dump($items_id);
        if (current($items_id)!==null){
            $items_ids = explode('-', $items_id[0]);
            foreach ($items_ids as &$v){
//            $list = str_repeat()
                $v = str_replace('{','',$v);
                $v = str_replace('}','',$v);
            }

        }else{
            $items_ids = '';
        }

        $this->assign('spec',$speclist);
        $this->assign('items_ids',$items_ids);
        $this->assign("goods_id",$goods_id);

        return $this->fetch('ajaxspec');
    }

    //异步获取规格
    public function ajaxGetSpecInput(){

        $GoodsLogic = \think\Loader::model('Goods','logic');

        $request = $this->request;
        $goods_id = $request->param('goods_id',0,'intval');
        $arr = $request->param('spec_arr/a');
        $str = $GoodsLogic->getSpecInput($goods_id ,$arr);


       // $goods_id = I("goods_id",0,'intval');
       // $str = $GoodsLogic->getSpecInput($goods_id ,$_POST['spec_arr']);
       exit($str);
    }

    //添加产品
    public function add_goods_Post()
    {
        $request = $this->request;
        if ($request->isPost()){
            $data = $request->param();
            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                // $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    $img['photo'][]=array("url"=>$photoUrl,"name"=>$data['photo_names'][$key]);
                    // array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }
            if (!empty($data['file_names']) && !empty($data['file_urls'])) {
                //    $data['post']['more']['files'] = [];
                foreach ($data['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    $file['path'][]=array("url"=>$fileUrl,"name"=>$data['file_names'][$key]);
                    //  array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
                }
            }

            if (!empty($data['goods_thumb'])) {
                $thumbUrl = cmf_asset_relative_url($data['goods_thumb']);
                $thumb['path'][]=array("url"=>$thumbUrl);
            }

            $info = $data['post'];

            if($info['goods_name'] == ''){
                $this->error("商品名称不能为空！");
            }
            if($info['cat_id'] == '' || $info['cat_id'] == 0){
                $this->error("请选择分类！");
            }
            $info['photo'] = isset($img['photo']) ? json_encode($img['photo']) : '';
            $info['file'] = isset($file['path']) ? json_encode($file['path']) : '';
            $info['goods_thumb'] = isset( $thumb['path']) ? json_encode( $thumb['path']) : '';

            if(isset($info['goods_content'])){
                $info['goods_content'] = htmlspecialchars_decode($info['goods_content']);
            }
            
            $info['last_update'] = time();

            if(!isset($data['item'])){
                $this->error("未填写规格设置");
            }else{
                $item = $data['item'];
            }

         //  $arr = $this->chanceitem($item);

            $result = GoodsModel::create($info);
            $id = $result->goods_id;


            $GoodsModel = new GoodsModel();
            
            $res1 = $GoodsModel->addGoodsSku($id,$item);//增加sku
            if(isset($data['goods_discount'])&&$data['goods_discount']!=''){
                $discount = $data['goods_discount'];
                $res2 = $GoodsModel->adddiscount($id,$discount);//增加折扣对应
            }

            if ($result){
                $this->success('添加成功!',url('goods/goodslist'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            $this->error('参数错误');
        }
    }

    //产品规格处理
    public function chanceitem($arr){

//        $arr = [];
//        $arr['135-140']=['price'=>'10'];
//        $arr['135-141']=['price'=>'20'];
//        $arr['136-140']=['price'=>'30'];
//        $arr['136-141']=['price'=>'40'];

        foreach ($arr as $arrk=>$arrv){
            $keys = array_keys($arr);
            foreach ($keys as $kk=>$vv){
                $a = explode('-',$vv);
                foreach ($a as $k=>&$v){
                    $v = '{'.$v.'}';
                }
            $info[$a[0].'-'.$a[1]]=$arrv;
            }
        }

        return $info;

    }

    //编辑产品
    public function edit_goods()
    {

        $request = $this->request;
        $id = $request->param('id');
        if (!$id){
            $this->error('参数错误');
        }

        $data=Db::table('cmf_goods a')
            ->field('a.goods_id,a.cat_id,a.goods_name,a.shop_price,a.goods_remark,a.goods_content,a.photo,a.file,a.goods_thumb,a.is_on_sale,a.last_update,a.goods_type,a.is_hot,b.title')
            ->join('product_classify b','a.cat_id=b.id','left')
            ->where(array("goods_id" => $id))
            ->find();

        //获取折扣
        $dwhere = array();
        $dwhere['gid'] = $id;
        $dsel = db('good_discount')->where($dwhere)->select();
        $discount = '';
        $lv = '';
        foreach($dsel as $v){
            if($discount==''){
                $discount = $v['discount'];
            }else{
                $discount = $discount.','.$v['discount'];
            }
            if($lv==''){
                $lv = $v['lv'];
            }else{
                $lv = $lv.','.$v['lv'];
            }
        }
        $data['discount'] = $discount;
        $data['lv'] = $lv;
        //获取折扣

        $lv = explode(',',$data['lv']);
        $discount = explode(',',$data['discount']);

        foreach ($lv as $k=>$v){
            $list[$k]['lv']=$v;
        }
        foreach ($discount as $k=>$v){
            $list[$k]['discount']=$v;
        }
        $data['youhui']=$list;


        $goodsCategoryModel = new GoodsCategoryModel();
        $categoryTree = $goodsCategoryModel->adminCategoryTree();


        $good_type=Db::table('cmf_good_type')->select();

        if (!empty($data['goods_thumb'])){
            $this->assign('goods_thumb', json_decode($data['goods_thumb'],true)[0]);
        }


        if (!empty($data['photo'])){
            $this->assign('photo', json_decode($data['photo'],true));
        }

        if (!empty($data['file'])){
            $this->assign('file', json_decode($data['file'],true));
        }
        $mlevel = db('member_level')->select();
        $this->assign('mlevel', $mlevel);

        $this->assign('data', $data);
        $this->assign('categoryTree', $categoryTree);
        $this->assign('goods_type', $good_type);
        return $this->fetch();
    }

    //执行编辑产品
    public function edit_goods_Post(){


        $request = $this->request;


        if ($request->isPost()){

            $data = $request->param();
            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                // $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    $img['photo'][]=array("url"=>$photoUrl,"name"=>$data['photo_names'][$key]);
                    // array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }
            if (!empty($data['file_names']) && !empty($data['file_urls'])) {
                //    $data['post']['more']['files'] = [];
                foreach ($data['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    $file['path'][]=array("url"=>$fileUrl,"name"=>$data['file_names'][$key]);
                    //  array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
                }
            }

            if (!empty($data['goods_thumb'])) {
                $thumbUrl = cmf_asset_relative_url($data['goods_thumb']);
                $thumb['path'][]=array("url"=>$thumbUrl);
            }

            $info = $data['post'];

            if($info['goods_name'] == ''){
                $this->error("商品名称不能为空！");
            }
            if($info['cat_id'] == '' || $info['cat_id'] == 0){
                $this->error("请选择分类！");
            }
            $info['photo'] = isset($img['photo']) ? json_encode($img['photo']) : '';
            $info['file'] = isset($file['path']) ? json_encode($file['path']) : '';
            $info['goods_thumb'] = isset( $thumb['path']) ? json_encode( $thumb['path']) : '';
            $info['goods_content'] = htmlspecialchars_decode($info['goods_content']);
            $info['last_update'] = time();

            $item = $data['item'];


            $discount = $data['goods_discount'];


            $result = GoodsModel::update($info);
            $id = $result->goods_id;
            $GoodsModel = new GoodsModel();

            $res1 = $GoodsModel->saveGoodsSku($id,$item);

            $res2 = $GoodsModel->savediscount($id,$discount);

            if ($result){
                $this->success('添加成功!',url('goods/goodslist'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            $this->error('参数错误');
        }







    }

    //删除产品
    public function del_goods()
    {

        $request = $this->request;
        $id = $request->param('id');

        if (!$id){
            $this->error('参数错误');
        }

        $res1 = GoodsModel::destroy(['goods_id' => $id]);
        $res2 = Good_skuModel::destroy(['goods_id' => $id]);

        $res3 = db('good_discount')->where(['gid' => $id])->delete();

        if($res1){
            $this->success('删除成功',url('goods/goodslist'));
        }else{
            $this->error('删除失败');
        }
    }

    //商品分类
    public function goods_Category()
    {
//        $info = Db::name('product_classify')->order('createtime desc')->select();
//        $this->assign('info', $info);
//        return $this->fetch();
        $goodsCategoryModel = new GoodsCategoryModel();
        $categoryTree = $goodsCategoryModel->adminCategoryTableTree();

        $this->assign('category_tree', $categoryTree);
        return $this->fetch();
    }

    //增加商品分类
    public function add_goods_Category()
    {

        $request = $this->request;
        if ($request->param()) {
            $data = $request->param();
            if (!$data) {
                $this->error('没有提交数据');
            }
            $validate = validate('Classify');

            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            // $data['sort'] = intval($data['sort']);

            $goodsCategoryModel = new GoodsCategoryModel();

            $result = $goodsCategoryModel->addCategory($data);

            if ($result === false) {
                $this->error('添加失败!');
            }
            $this->success('添加成功!', url('goods/goods_Category'));

//            $add = db('product_classify')->insert($data);
//            if (!$add) {
//                $this->error('商品分类添加失败');
//            } else {
//
//            }
        }

        $categoryId = $this->request->param('parent', 0, 'intval');
        $goodsCategoryModel = new GoodsCategoryModel();
        $categoriesTree = $goodsCategoryModel->adminCategoryTree($categoryId);

        $this->assign('categories_tree', $categoriesTree);
        return $this->fetch();
    }

    //编辑产品分类
    public function edit_goods_Category()
    {

        $request = $this->request;
        $classify = db('product_classify');
        if ($request->has('id') && $request->has('title')) {
            $data = $request->param();
            if (!$data) {
                $this->error('没有提交数据');
            } else if (!$data['id']) {
                $this->error('参数错误');
            }
            $validate = validate('Classify');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            //   $data['sort'] = intval($data['sort']);

            $goodsCategoryModel = new GoodsCategoryModel();
            $result = $goodsCategoryModel->editCategory($data);

            //  dump($result);

            if ($result === false) {
                $this->error('保存失败!');
            }

            $this->success('保存成功!', url('goods/goods_Category'));
//            $up = $classify->update($data);
//            if(!$up){
//                $this->error('商品分类修改失败');
//            }else{
//                $this->success('商品分类修改成功',url('goods/goods_Category'));
//            }
        }

        $id = $this->request->param('id', 0, 'intval');
        if (!$id) {
            $this->error('参数错误');
        }
        $category = GoodsCategoryModel::get($id)->toArray();
        $goodsCategoryModel = new GoodsCategoryModel();
        $categoriesTree = $goodsCategoryModel->adminCategoryTree($category['parent_id'], $id);
        $this->assign($category);
        $this->assign('categories_tree', $categoriesTree);
        return $this->fetch();
    }

    //删除产品分类
    public function del_goods_Category()
    {
//        $goodsCategoryModel = new GoodsCategoryModel();
//        $id                  = $this->request->param('id');
//        //获取删除的内容
//        $findCategory = $goodsCategoryModel->where('id', $id)->find();
//
//        if (empty($findCategory)) {
//            $this->error('分类不存在!');
//        }
//
//        $categoryChildrenCount = $portalCategoryModel->where('parent_id', $id)->count();
//
//        if ($categoryChildrenCount > 0) {
//            $this->error('此分类有子类无法删除!');
//        }
//
//        $categoryPostCount = Db::name('portal_category_post')->where('category_id', $id)->count();
//
//        if ($categoryPostCount > 0) {
//            $this->error('此分类有文章无法删除!');
//        }
//
//        $data   = [
//            'object_id'   => $findCategory['id'],
//            'create_time' => time(),
//            'table_name'  => 'portal_category',
//            'name'        => $findCategory['name']
//        ];
//        $result = $portalCategoryModel
//            ->where('id', $id)
//            ->update(['delete_time' => time()]);
//        if ($result) {
//            Db::name('recycleBin')->insert($data);
//            $this->success('删除成功!');
//        } else {
//            $this->error('删除失败');
//        }
        $request = $this->request;
        if ($request->param()) {
            $id = $request->param('id');
            if (!$id) {
                $this->error('参数错误');
            }

            $goodsCategoryModel = new GoodsCategoryModel();

            $findCategory = $goodsCategoryModel->where('id', $id)->find();

            if (empty($findCategory)) {
                $this->error('分类不存在!');
            }

            $categoryChildrenCount = $goodsCategoryModel->where('parent_id', $id)->count();

            if ($categoryChildrenCount > 0) {
                $this->error('此分类有子类无法删除!');
            }

            $check = db('product')->where('cid', $id)->count();
            if ($check) {
                $this->error('分类下拥有所属商品,请先删除商品');
            }
            $del = db('product_classify')->where('id', $id)->delete();
            if (!$del) {
                $this->error('删除失败');
            } else {
                $this->success('删除成功', url('goods/goods_Category'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    //异步产品分类选择
    public function goods_Category_select()
    {
        $ids = $this->request->param('ids');
        $selectedIds = explode(',', $ids);
        // $portalCategoryModel = new PortalCategoryModel();
        $goodsCategoryModel = new GoodsCategoryModel();

        $tpl = <<<tpl
<tr class='data-item-tr'>
    <td>
        <input type='checkbox' class='js-check' data-yid='js-check-y' data-xid='js-check-x' name='ids[]'
               value='\$id' data-name='\$title' \$checked>
    </td>
    <td>\$id</td>
    <td>\$spacer <a href='\$url' target='_blank'>\$title</a></td>
</tr>
tpl;

        $categoryTree = $goodsCategoryModel->adminCategoryTableTree($selectedIds, $tpl);

        $where = ['status' => 0];
        $categories = $goodsCategoryModel->where($where)->select();
        //-

        $this->assign('categories', $categories);
        $this->assign('selectedIds', $selectedIds);
        $this->assign('categories_tree', $categoryTree);
        return $this->fetch();
    }

    //产品类型
    public function good_type()
    {

        $format = db('good_type')->order('id desc')->select();
        $this->assign('format', $format);
        return $this->fetch('good_type');
    }

    //添加类型
    public function add_good_type()
    {
        $request = $this->request;
        if ($request->isAjax() && $request->isPost()) {
            $val = trim($request->post('key'));
            if (empty($val)) {
                $this->error('未填写类型名称');
            }
            $propkey = db('good_type');
            $check = $propkey->where('key', $val)->find();
            if ($check) {
                $this->error('类型名称已存在');
            }
            $add = $propkey->insert(['key' => $val]);
            if (!$add) {
                $this->error('添加失败');
            } else {
                $this->success('添加成功', url('goods/good_type'));
            }
        }
        return $this->fetch('add_good_type');
    }

    //编辑类型
    public function edit_good_type()
    {
        $request = $this->request;
        $propkey = db('good_type');
        if ($request->has('id') && $request->has('key')) {
            $id = intval($request->param('id'));
            $val = trim($request->param('key'));
            if (!$id) {
                $this->error('参数错误');
            } else if (empty($val)) {
                $this->error('未填写类型名称');
            }
            $check = $propkey->where('key', $val)->where('id', 'neq', $id)->find();
            if ($check) {
                $this->error('类型名称已存在');
            }
            $add = $propkey->where('id', $id)->update(['key' => $val]);
            if (!$add) {
                $this->error('修改失败');
            } else {
                $this->success('修改成功', url('goods/good_type'));
            }
        }
        $id = intval($request->param('id'));
        if (!$id) {
            $this->error('参数错误');
        }
        $info = $propkey->where('id', $id)->find();
        if (!$info) {
            $this->error('类型名称不存在');
        }
        $this->assign('info', $info);
        return $this->fetch('edit_good_type');
    }

    //删除类型
    public function del_good_type()
    {
        $request = $this->request;
        if ($request->param()) {
            $id = intval($request->param('id'));
            if (!$id) {
                $this->error('参数错误');
            }
            $del = db('good_type')->where('id', $id)->delete();
            if (!$del) {
                $this->error('删除失败');
            } else {
                $this->success('删除成功', url('goods/good_type'));
            }
        } else {
            $this->error('非法操作');
        }
    }


    //规格列表
    public function good_spec()
    {
        $request = $this->request;
        if ($request->isPost()) {
            $param = $request->param();
            $keyword = trim($param['keyword']);
            if ($keyword) {
                $where['a.spec_name'] = array('like', "%$keyword%");
            }
            $type_id = $param['category'];
            if ($type_id) {
                $where['a.type_id'] = $type_id;
                $speclist = Db::name('Spec a')
                    ->field('a.*,b.key')
                    ->join('cmf_good_type b', 'a.type_id = b.id', 'left')
                    ->where($where)
                    ->order('a.id desc')
                    ->select();
            }else{
                $speclist = Db::name('Spec a')
                    ->field('a.*,b.key')
                    ->join('cmf_good_type b', 'a.type_id = b.id', 'left')
                  //  ->where($where)
                    ->order('a.id desc')
                    ->select();
            }
            foreach ($speclist as $key => $v) {
                $speclist[$key]['items'] = $this->specItem($v['id']);
            }
            $good_type = db('good_type')->order('id desc')->select();
            $this->assign('good_type', $good_type);
            $this->assign('speclist', $speclist);
            return $this->fetch('good_spec');
        }

        $good_type = db('good_type')->order('id desc')->select();
        $speclist = Db::name('Spec a')
            ->field('a.*,b.key')
            ->join('cmf_good_type b', 'a.type_id = b.id', 'left')
            //  ->where($where)
            ->order('a.id desc')
            ->select();
        foreach ($speclist as $key => $v) {
            $speclist[$key]['items'] = $this->specItem($v['id']);
        }
        $this->assign('speclist', $speclist);
        $this->assign('good_type', $good_type);
        return $this->fetch('good_spec');

    }

    //添加产品规格
    public function add_good_spec()
    {
        $request = $this->request;
        if ($request->isAjax() && $request->isPost()) {
            $val = $request->only(['spec_name', 'type_id']);
            if (empty($val['spec_name'])) {
                $this->error("规格名称为空");
            }
            if (empty($val['type_id'])) {
                $this->error("所属商品类型未选择");
            }
            $thing = $request->param('item');
            if (empty($thing)) {
                $this->error("可选规格为空");
            }
            $result = SpecModel::create($val);
            $id = $result->id;// 获取自增ID
            $item = explode(PHP_EOL, $thing);
            foreach ($item as $key => $val)  // 去除空格
            {
                $val = str_replace('_', '', $val); // 替换特殊字符
                $val = str_replace('@', '', $val); // 替换特殊字符

                $val = trim($val);
                if (empty($val))
                    unset($item[$key]);
                else
                    $item[$key] = $val;
            }
            foreach ($item as $key => $val) {
                $dataList[] = array('spec_id' => $id, 'item' => $val);
            }
            $SpecItem = new SpecItemModel();
            $result2 = $SpecItem->saveAll($dataList);
            if ($result && $result2) {
                $this->success("添加成功！", url('goods/good_spec'));
            } else {
                $this->error("添加失败！");
            }
        }
        $good_type = db('good_type')->order('id desc')->select();
        $this->assign('good_type', $good_type);

        return $this->fetch('add_good_spec');


    }

    public function edit_good_spec()
    {
        $request = $this->request;

        if ($request->isAjax() && $request->isPost()) {
            $thing = $request->only(['spec_name', 'type_id']);
            $item = explode(PHP_EOL,$request->param('item'));
            foreach ($item as $key => $val)  // 去除空格
            {
                $val = str_replace('_', '', $val); // 替换特殊字符
                $val = str_replace('@', '', $val); // 替换特殊字符

                $val = trim($val);
                if(empty($val))
                    unset($item[$key]);
                else
                    $item[$key] = $val;
            }

            $user = new SpecModel;
            $user->data($thing);
            $res = $user->save();
            $newid = $user->id;
            $id = $request->param('id');
            $db_items = Db::table('cmf_spec_item')->where(array("spec_id" => $id))->Field('id,item')->select();

            foreach($item as $key => $val){
                if(!in_array($val, $db_items)){//post的规格是否存在数据库
                    $dataList[] = array('spec_id'=>$newid,'item'=>$val);//不存在则添加
                }
            }
            $SpecItem = new SpecItemModel();
            $result2 = $SpecItem->saveAll($dataList);

            foreach($db_items as $k=>$v){
                if(!in_array($v,$item)){//数据库是否存在post的规格
                    SpecItemModel::destroy(['id' => $k]);
                }
            }
            $res1 = SpecModel::destroy(['id' => $id]);
            if ($newid){
                $this->success("保存成功！",url('goods/good_spec'));
            }else {
                $this->error("保存失败！");
            }
        }


        $id = $request->param('id', 0, 'intval');
        $spec = SpecModel::get(['id' => $id]);
        if($spec){
            $data = $spec->toArray();
        }else{
            $data = array();
        }
        $good_type = db('good_type')->order('id desc')->select();
        $item = Db::table('cmf_spec_item')->where(array("spec_id"=>$id))->order('id')->select();
        $arr2 = array();
        foreach($item as $key => $val){
            $arr2[$val['id']] = $val['item'];
        }
        $items = implode(PHP_EOL,$arr2);

        $this->assign('good_type',$good_type);
        $this->assign('data',$data);
        $this->assign('items',$items);
     //  $this->display();
        return $this->fetch('edit_good_spec');
    }


    public function del_good_spec()
    {

        $request = $this->request;

        $id = $request->param('id');

        if (empty($id)){

            $this->error('参数错误');
        }

        $res1 = SpecModel::destroy(['id' => $id]);

        $res2 = SpecItemModel::destroy(['spec_id' => $id]);

        if($res1!==false&&$res2!==false){
            $this->success('删除成功',url('goods/good_spec'));
        }else{
            $this->error('删除失败');
        }

    }


    public function specItems($id){

        $where['spec_id'] = $id;
        $SpecItem = new SpecItemModel();
        $item = $SpecItem->where($where)->order('id')->column('id,item');
        return $item;
    }

    public function specItem($id)
    {

        $where['spec_id'] = $id;
        $SpecItem = new SpecItemModel();
        $item = $SpecItem->where($where)->order('id')->select();
        $arr2 = array();
        foreach ($item as $key => $val) {
            $arr2[$val['id']] = $val['item'];
        }
        $items = implode(',', $arr2);

//        dump($items);
//        exit;
        return $items;
    }




}

