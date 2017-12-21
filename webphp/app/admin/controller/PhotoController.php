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

use app\portal\model\PhotoModel;
use app\portal\model\Photo_specModel;
use app\portal\model\Photo_specItemModel;


class PhotoController extends AdminBaseController
{
    //相框管理
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


    public function index()
    {
        // echo "上传相框  有规格分类";
    }


    //相框列表
    public function photolist()
    {

        $categoryTree = db('photo_type')->select();
//
//        //  $where['is_on_sale']=1;//上架状态
        $goodslist =  db('photo a')->join('photo_type b','a.cat_id = b.id','left')
            //  ->where($where)
            ->select();
//
        $this->assign('goodslist',$goodslist);
        $this->assign('category_tree', $categoryTree);
        return $this->fetch();


    }


    //添加相框
    public function add_photo(){

//        $goods_type = db('photo_type')->order('id desc')->select();

        $categoryTree = db('photo_type')->select();
        $this->assign('category_tree', $categoryTree);
//        $this->assign('goods_type', $goods_type);

        return $this->fetch();
    }

    public function ajaxGetSpec(){
        $request = $this->request;
        $type_id = $request->param('type_id',0,'intval');

        $where['type_id']=$type_id;
        $speclist = Db::name('photo_spec a')
            ->where($where)
            ->order('a.id desc')
            ->select();


        foreach($speclist as $key=>$v){
            $speclist[$key]['items'] = $this->specItems($v['id']);
        }

        $goods_id = $request->param('id',0,'intval');

        //获取规格id
        $items_id = Db::name('photo_sku')->where(array("photo_id"=>$goods_id))->column("GROUP_CONCAT(`item_path` SEPARATOR '-') AS items_id");

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

    public function ajaxGetSpecInput(){

        $GoodsLogic = \think\Loader::model('Photo','logic');

        $request = $this->request;
        $goods_id = $request->param('goods_id',0,'intval');
        $arr = $request->param('spec_arr/a');

        $str = $GoodsLogic->getSpecInput($goods_id ,$arr);
        exit($str);
    }


    public function add_photo_Post()
    {
        $request = $this->request;
        if ($request->isPost()){
            $data = $request->param();
//            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
//                // $data['post']['more']['photos'] = [];
//                foreach ($data['photo_urls'] as $key => $url) {
//                    $photoUrl = cmf_asset_relative_url($url);
//                    $img['photo'][]=array("url"=>$photoUrl,"name"=>$data['photo_names'][$key]);
//                    // array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
//                }
//            }
//            if (!empty($data['file_names']) && !empty($data['file_urls'])) {
//                //    $data['post']['more']['files'] = [];
//                foreach ($data['file_urls'] as $key => $url) {
//                    $fileUrl = cmf_asset_relative_url($url);
//                    $file['path'][]=array("url"=>$fileUrl,"name"=>$data['file_names'][$key]);
//                    //  array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
//                }
//            }

            if (!empty($data['goods_thumb'])) {
                $thumbUrl = cmf_asset_relative_url($data['goods_thumb']);
                $thumb['path'][]=array("url"=>$thumbUrl);
            }

            $info = $data['post'];

            if($info['photo_name'] == ''){
                $this->error("相框名称不能为空！");
            }
            if($info['cat_id'] == '' || $info['cat_id'] == 0){
                $this->error("请选择分类！");
            }
//            $info['photo'] = isset($img['photo']) ? json_encode($img['photo']) : '';
//            $info['file'] = isset($file['path']) ? json_encode($file['path']) : '';
            $info['photo_thumb'] = isset( $thumb['path']) ? json_encode( $thumb['path']) : '';
//            $info['goods_content'] = htmlspecialchars_decode($info['goods_content']);
            $info['last_update'] = time();

            $item = $data['item'];

            $result = PhotoModel::create($info);
            $id = $result->photo_id;


            $GoodsModel = new PhotoModel();
            $res1 = $GoodsModel->addPhotoSku($id,$item);//增加sku

            if ($result){
                $this->success('添加成功!',url('photo/photolist'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            $this->error('参数错误');
        }

    }

    public function edit_photo(){

        $request = $this->request;
        $id = $request->param('id');
        if (!$id){
            $this->error('参数错误');
        }

        $data=Db::table('cmf_photo a')
//            ->field('a.*,b.')
            ->join('photo_type b','a.cat_id=b.id','left')
            ->where(array("photo_id" => $id))
            ->find();

        $categoryTree = db('photo_type')->select();

        if (!empty($data['photo_thumb'])){
            $this->assign('photo_thumb', json_decode($data['photo_thumb'],true)[0]);
        }


        $this->assign('category_tree', $categoryTree);
        $this->assign('data', $data);
        return $this->fetch();


    }

    public function edit_photo_post(){
        $request = $this->request;


        if ($request->isPost()){

            $data = $request->param();

            if (!empty($data['photo_thumb'])) {
                $thumbUrl = cmf_asset_relative_url($data['photo_thumb']);
                $thumb['path'][]=array("url"=>$thumbUrl);
            }

            $info = $data['post'];

            if($info['photo_name'] == ''){
                $this->error("商品名称不能为空！");
            }
            if($info['cat_id'] == '' || $info['cat_id'] == 0){
                $this->error("请选择分类！");
            }
            $info['photo_thumb'] = isset( $thumb['path']) ? json_encode( $thumb['path']) : '';

            $info['last_update'] = time();

            $item = $data['item'];

            $result = PhotoModel::update($info);
            $id = $result->photo_id;
            $GoodsModel = new PhotoModel();

            $res1 = $GoodsModel->saveGoodsSku($id,$item);



            if ($result){
                $this->success('添加成功!',url('photo/photolist'));
            }else{
                $this->error('添加失败!');
            }

        }else{
            $this->error('参数错误');
        }
    }
    public function del_photo(){
        $request = $this->request;
        $id = $request->param('id');

        if (!$id){
            $this->error('参数错误');
        }

        $info = db('photo')->where(['photo_id' => $id])->find();

        $res1 = photoModel::destroy(['photo_id' => $id]);

        $res2 = db('photo_sku')->where(['photo_id' => $id])->delete();

        if($res1){
            $this->success('删除成功',url('photo/photolist'));
        }else{
            $this->error('删除失败');
        }
    }


    //类型列表
    public function photo_type(){

        $format = db('photo_type')->order('id desc')->select();
        $this->assign('format', $format);
        return $this->fetch();

    }

    //添加类型
    public function add_photo_type()
    {
        $request = $this->request;
        if ($request->isAjax() && $request->isPost()) {
            $val = trim($request->post('key'));
            if (empty($val)) {
                $this->error('未填写类型名称');
            }
            $propkey = db('photo_type');
            $check = $propkey->where('key', $val)->find();
            if ($check) {
                $this->error('类型名称已存在');
            }
            $add = $propkey->insert(['key' => $val]);
            if (!$add) {
                $this->error('添加失败');
            } else {
                $this->success('添加成功', url('photo/photo_type'));
            }
        }
        return $this->fetch();
    }

    //编辑类型
    public function edit_photo_type()
    {
        $request = $this->request;

        $propkey = db('photo_type');
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
                $this->success('修改成功', url('photo/photo_type'));
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
        return $this->fetch();
    }

    //删除类型
    public function del_photo_type()
    {
        $request = $this->request;
        if ($request->param()) {
            $id = intval($request->param('id'));
            if (!$id) {
                $this->error('参数错误');
            }
            $del = db('photo_type')->where('id', $id)->delete();
            if (!$del) {
                $this->error('删除失败');
            } else {
                $this->success('删除成功', url('photo/photo_type'));
            }
        } else {
            $this->error('非法操作');
        }
    }



    //规格列表
    public function photo_spec(){

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
                $speclist = Db::name('photo_spec a')
                    ->field('a.*,b.key')
                    ->join('cmf_photo_type b', 'a.type_id = b.id', 'left')
                    ->where($where)
                    ->order('a.id desc')
                    ->select();
            }else{
                $speclist = Db::name('photo_spec a')
                    ->field('a.*,b.key')
                    ->join('cmf_photo_type b', 'a.type_id = b.id', 'left')
                    //  ->where($where)
                    ->order('a.id desc')
                    ->select();
            }
            foreach ($speclist as $key => $v) {
                $speclist[$key]['items'] = $this->specItem($v['id']);
            }
            $good_type = db('photo_type')->order('id desc')->select();
            $this->assign('good_type', $good_type);
            $this->assign('speclist', $speclist);
            return $this->fetch('good_spec');
        }

        $good_type = db('photo_type')->order('id desc')->select();
        $speclist = Db::name('photo_spec a')
            ->field('a.*,b.key')
            ->join('cmf_photo_type b', 'a.type_id = b.id', 'left')
            //  ->where($where)
            ->order('a.id desc')
            ->select();


        foreach ($speclist as $key => $v) {
            $speclist[$key]['items'] = $this->specItem($v['id']);
        }


        $this->assign('speclist', $speclist);
        $this->assign('good_type', $good_type);
        return $this->fetch();

    }

    public function add_photo_spec(){
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


            $result = Photo_specModel::create($val);
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
            $SpecItem = new Photo_specItemModel();
            $result2 = $SpecItem->saveAll($dataList);
            if ($result && $result2) {
                $this->success("添加成功！", url('photo/photo_spec'));
            } else {
                $this->error("添加失败！");
            }
        }


        $good_type = db('photo_type')->order('id desc')->select();
        $this->assign('good_type', $good_type);

        return $this->fetch();

    }

    public function edit_photo_spec(){

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

            $user = new Photo_specModel;
            $user->data($thing);
            $res = $user->save();
            $newid = $user->id;
            $id = $request->param('id');
            $db_items = Db::table('cmf_photo_spec_item')->where(array("spec_id" => $id))->Field('id,item')->select();

            foreach($item as $key => $val){
                if(!in_array($val, $db_items)){//post的规格是否存在数据库
                    $dataList[] = array('spec_id'=>$newid,'item'=>$val);//不存在则添加
                }
            }
            $SpecItem = new Photo_specItemModel();
            $result2 = $SpecItem->saveAll($dataList);

            foreach($db_items as $k=>$v){
                if(!in_array($v,$item)){//数据库是否存在post的规格
                    Photo_specItemModel::destroy(['id' => $k]);
                }
            }
            $res1 = Photo_specModel::destroy(['id' => $id]);
            if ($newid){
                $this->success("保存成功！",url('photo/photo_spec'));
            }else {
                $this->error("保存失败！");
            }
        }


        $id = $request->param('id', 0, 'intval');
        $spec = Photo_specModel::get(['id' => $id]);
        if($spec){
            $data = $spec->toArray();
        }else{
            $data = array();
        }
        $good_type = db('photo_type')->order('id desc')->select();
        $item = Db::table('cmf_photo_spec_item')->where(array("spec_id"=>$id))->order('id')->select();
        $arr2 = array();
        foreach($item as $key => $val){
            $arr2[$val['id']] = $val['item'];
        }
        $items = implode(PHP_EOL,$arr2);

        $this->assign('good_type',$good_type);
        $this->assign('data',$data);
        $this->assign('items',$items);
        //  $this->display();
        return $this->fetch();



    }

    public function del_photo_spec(){

        $request = $this->request;

        $id = $request->param('id');

        if (empty($id)){

            $this->error('参数错误');
        }

        $res1 = Photo_specModel::destroy(['id' => $id]);

        $res2 = Photo_specItemModel::destroy(['spec_id' => $id]);

        if($res1!==false&&$res2!==false){
            $this->success('删除成功',url('photo/photo_spec'));
        }else{
            $this->error('删除失败');
        }
    }


    public function specItem($id)
    {

        $where['spec_id'] = $id;
        $SpecItem = new Photo_specItemModel();
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

    public function specItems($id){

        $where['spec_id'] = $id;
        $SpecItem = new Photo_specItemModel();
        $item = $SpecItem->where($where)->order('id')->column('id,item');
        return $item;
    }

}
