<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\home\controller;

use FontLib\Table\Type\name;
use think\Db;
use \think\Request;
use think\Validate;
use cmf\controller\RestBaseController;
class UserController extends RestBaseController
{
    //用户中心
    //1.注册方法
    //2.注册获取短信验证码
    //3.登录方法
    //4.重置密码
    //5.重置密码获取短信验证码
    //6.用户中心-修改密码
    //7.添加收货地址
    //8.删除收货地址
    //9.设置默认收货地址

    //注册方法
    public function reg()
    {
        //1.检查必填项
        //2.对比密码
        //3.检查手机号码格式
        //4.检查手机是否注册
        //5.检查验证码
        //6.增加用户

//        header('Access-Control-Allow-Origin:*');//允许跨域
        $validate = new Validate([
            'uname' => 'require',
            'tel' => 'require',
            'pwd' => 'require',
            'repwd' => 'require',
            'code' => 'require',
        ]);
        $validate->message([
            'uname.require' => '请输入用户名！',
            'tel.require' => '请输入手机号码！',
            'pwd.require' => '请输入密码!',
            'repwd.require' => '请输入确认密码!',
            'code.require' => '请输入验证码！',
        ]);

        $data = $this->request->param();


        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        //1.[pwd] [repwd]对比密码
        if(!$this->machpwd($data['pwd'],$data['repwd'])){

            $this->error('两次密码输入不一致');

        };

        //2.[tel]检查手机号码格式
        $mach = $this->machtel($data['tel']);

        if($mach==0){

            $this->error('请输入正确手机号');

        }

        if ($this->findtel($data['tel'])){
            //@true 有  @flase  没有
            $this->error('该手机号码已经注册');
        }

        //3.[code]检查验证码
        $code = Db::name('verification_code')
            ->where('account',$data['tel'])
            ->where('action',1)
            ->where('status',0)
            ->order('send_time desc')->find();

        if ($data['code']!==$code['code']){

            $this->error('验证码错误');
        }

        //更改验证码状态
        $a = Db::name('verification_code')
            ->where('code', $code['code'])
            ->update(['status' => '2']);

       // unset($code);

        //5.[uname]用户注册成功
        $info = [
            'uname'=>$data['uname'],
            'pwd'=>md5($data['pwd']),
            'tel'=>$data['tel'],
            'creatime'=>time(),
        ];

        if( Db::name('member')->insert($info) ){

            $this->success('注册成功');

        }else{

            $this->error('注册失败');
        };

    }

    // 注册发送短信
    public function regsend()
    {
        //1.检查必填项
        //2.检查手机号码格式
        //3.检查手机是否注册
        //4.检查验证码发送时间
        //5.发送验证码
//        header('Access-Control-Allow-Origin:*');//允许跨域

        $validate = new Validate([
            'tel' => 'require',
        ]);
        $validate->message([
            'tel.require' => '请输入手机号!',
        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        //2.[tel]检查手机号码格式
        $mach = $this->machtel($data['tel']);

        if($mach==0){
            $this->error('请输入正确手机号');
        }

        if ($this->findtel($data['tel'])){
            //@true 有  @flase  没有
            $this->error('该手机号码已经注册');
        }

        $check = Db::name('verification_code')
            ->where('account',$data['tel'])
            ->where('action',1)//注册场景
            ->where('status',0)//未使用状态
            ->order('send_time desc')
            ->find();

        if($check&&(time()-$check['send_time']<=120)){

            $this->error('请勿频繁操作');

        }
        //  `action` tinyint(3) NOT NULL DEFAULT '0' COMMENT '触发场景,@1:注册,@2:找回密码',
        //  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '使用状态,@-1:发送失败,@0:未使用,@1:已使用',
        //  `time` int(11) NOT NULL,
        //  `error` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '错误信息',

        $code = rand(100000,999999);

        $text="【杺叶相框】你的验证为".$code;

        $res = sendSms($text,$data['tel']);
//            dump($res);
//            exit;
        $info = [];
        $info['account'] = $data['tel']; //账号
        $info['code'] = $code; //验证码
        $info['action'] = 1 ; //触发场景@注册
        $info['send_time'] = time();//发送时间

        if ($res['code']==0){
            $info['status'] = 0;//发送成功
        }else{
            $info['status'] = -1;//发送失败
            $info['error'] = $res['msg'];//失败信息
        }

        //更改验证码状态
        Db::name('verification_code')->insert($info);

        if ($res['code']==0){

            $this->success("短信发送成功请注意查收");

        }else{

            $this->error('失败');

        }
    }

    //登录方法
    public function login()
    {

//        header('Access-Control-Allow-Origin:*');//允许跨域
        $validate = new Validate([
            'tel' => 'require',
            'pwd' => 'require',
        ]);
        $validate->message([
            'tel.require' => '请输入手机号!',
            'pwd.require' => '请输入密码!',
        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $info = Db::name('member')->where('tel',$data['tel'])->find();

        if ($info){
            if($info['pwd']!==md5($data['pwd'])){
                $this->error('用户密码不正确');
            }else{
                $this->success('登录成功',
                    ['id'=>$info['id'],
                        'uname'=>$info['uname'],
                        'tel'=>$info['tel'],
                        'img'=>$info['img'],
                    ]
                );
            }
        }else{
            $this->error('该手机号码尚未注册');
        }

    }

    //重置密码
    public function findpwd(){

        //1.检查必填项
        //2.检查手机号码格式
        //3.检查手机是否注册  未注册XXX
        //4.检查二次密码是否一致
        //5.检查验证码
        //6.重置密码

//        header('Access-Control-Allow-Origin:*');//允许跨域

        $validate = new Validate([
            'tel' => 'require',
            'code' => 'require',
            'pwd' => 'require',
            'repwd' => 'require',

        ]);
        $validate->message([
            'tel.require' => '请输入手机号!',
            'code.require' => '请输入验证码！',
            'pwd.require' => '请输入密码!',
            'repwd.require' => '请输入确认密码!',
        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        //2.[tel]检查手机号码格式
        $mach = $this->machtel($data['tel']);

        if($mach==0){

            $this->error('请输入正确手机号');
        }

        if (!$this->findtel($data['tel'])){

            //@true 有  @flase  没有
            $this->error('该手机号码尚未注册');

        }

        //4.检查二次密码是否一致
        if($data['pwd']!=$data['repwd']){

            $this->error('二次输入密码不一致');

        }

        //5.检查验证码
        $code = Db::name('verification_code')
            ->where('account',$data['tel'])
            ->where('action',2)
            ->where('status',0)
            ->order('send_time desc')->find();

        if ($data['code']!==$code['code']){

            $this->error('验证码错误');
        }

        $a = Db::name('verification_code')
            ->where('code', $code['code'])
            ->update(['status' => '2']);

        //6.重置密码
        $info = [
            'pwd'=>md5($data['pwd']),
        ];

        if( Db::name('member')->where('tel',$data['tel'])->update($info) ){

            $this->success('重置密码成功');

        }else{

            $this->error('重置密码失败');
        };
    }

    //重置密码发送短信
    public function findsend(){

        //1.检查必填项
        //2.检查手机号码格式
        //3.检查手机是否注册
        //4.检查验证码发送时间
        //5.发送验证码

//        header('Access-Control-Allow-Origin:*');//允许跨域

        $validate = new Validate([
            'tel' => 'require',
        ]);
        $validate->message([
            'tel.require' => '请输入手机号!',
        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        //2.[tel]检查手机号码格式
        $mach = $this->machtel($data['tel']);

        if($mach==0){
            $this->error('请输入正确手机号');
        }

        if (!$this->findtel($data['tel'])){
            //@true 有  @flase  没有
            $this->error('该手机号码尚未注册');
        }

        $check = Db::name('verification_code')
            ->where('account',$data['tel'])
            ->where('action',2)//注册找回
            ->where('status',0)//未使用状态
            ->order('send_time desc')
            ->find();

        if($check&&(time()-$check['send_time']<=120)){

            $this->error('请勿频繁操作');

        }
        //  `action` tinyint(3) NOT NULL DEFAULT '0' COMMENT '触发场景,@1:注册,@2:找回密码',
        //  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '使用状态,@-1:发送失败,@0:未使用,@1:已使用',
        //  `time` int(11) NOT NULL,
        //  `error` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '错误信息',

        $code = rand(100000,999999);

        $text="【杺叶相框】你的验证为".$code;

        $res = sendSms($text,$data['tel']);
//            dump($res);
//            exit;
        $info = [];
        $info['account'] = $data['tel']; //账号
        $info['code'] = $code; //验证码
        $info['action'] = 2 ; //触发场景@1注册@2重置
        $info['send_time'] = time();//发送时间

        if ($res['code']==0){
            $info['status'] = 0;//发送成功
        }else{
            $info['status'] = -1;//发送失败
            $info['error'] = $res['msg'];//失败信息
        }

        //更改验证码状态
        Db::name('verification_code')->insert($info);

        if ($res['code']==0){

            $this->success("短信发送成功请注意查收");

        }else{

            $this->error('失败');

        }
    }

    //用户中心->修改密码
    public function chapwd(){

        //1.检查必填项
        //2.对比新密码
        //3.对比旧密码
        //4.修改密码

        $validate = new Validate([
            'id' => 'require',
            'opwd' => 'require',
            'npwd' => 'require',
            'nrepwd' => 'require',
        ]);
        $validate->message([
            'id.require' => '参数错误！',
            'opwd.require' => '请输入当前密码',
            'npwd.require' => '请输入新密码',
            'nrepwd.require' => '请输入确认密码',

        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        //2.对比新密码
        $check = $this->machpwd($data['npwd'],$data['nrepwd']);

        if (!$check){

            $this->error('两次新密码输入不一致');
        };

        $id = $data['id'];

        $info  = Db::name('member')->where('id',$id)->find();

        if($info){

            $check2 = $this->machpwd(md5($data['npwd']),$info['pwd']);

            if ($check2){

                $this->error('新旧密码一致请重新输入');

            }

            $check3 = $this->machpwd(md5($data['opwd']),$info['pwd']);

            if ($check3){

                $arr = ['pwd'=>md5($data['npwd'])];

                $res = Db::name('member')->where('id',$id)->update($arr);

                if ($res){

                    $this->success("修改密码成功");

                }else{

                    $this->error('修改密码失败');
                }

            }else{

                $this->error('账号当前密码不正确');

            }


        }else{

            $this->error('参数错误');

        }
    }

    //添加收货地址
    public function addadr(){

        //1.匹配手机格式
        //2.格式化地址
        //3.找ID
        //4.新增地址

        $validate = new Validate([
            'id' => 'require',
            'sname' => 'require',
            'tel' => 'require',
            'adr' => 'require',
        ]);
        $validate->message([
            'id.require' => '参数错误！',
            'sname.require' => '请输入收件人名称',
            'tel.require' => '请输入收件人手机号码',
            'adr.require' => '请输入收件人地址',

        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $mach = $this->machtel($data['tel']);

        if($mach==0){
            $this->error('请输入正确手机号');
        }

        $adr = str_replace(',', '', $data['adr']);

        $info = [
            'uid'=>$data['id'],
            'sname' => $data['sname'],
            'tel' => $data['tel'],
            'adr' => $adr,
            'select'=>0,
        ];

        $sid = Db::name('member_adr')->insertGetId($info);

        if (!empty($data['select'])){

            Db::name('member')->where('id',$data['id'])->update(['adrid'=>$sid]);
        }

        if ($sid){
            $this->success('地址添加成功');
        }else{
            $this->error('地址添加失败');
        }

    }

    //查收货地址
    public function findadr(){

        //1.get id
        //2.查找信息
        $validate = new Validate([
            'id' => 'require',
        ]);

        $validate->message([
            'id.require' => '参数错误！',

        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $info = db('member_adr a')
            ->join('member b','a.uid=b.id','left')
            ->field('a.sname,a.tel,a.adr,a.select,a.id,b.adrid')
            ->where('b.id',$data['id'])
            ->select();



        foreach ($info as &$v){
            if ($v['id']==$v['adrid']){
               $v['select']=1;
            }

        }


        if(empty($info)){

            $this->error('该用户未添加地址');

        }else{

            $this->success('该用户有地址',$info);

        }

    }

    //删除收货地址
    public function deladr(){

        $validate = new Validate([
            'id' => 'require',
        ]);

        $validate->message([
            'id.require' => '参数错误！',

        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        if(db('member_adr')->where('id',$data['id'])->delete()){

            $this->success('删除成功');

        }else{

            $this->error('删除失败');

        }
    }

    //设置默认地址
    public function selectadr(){

        $validate = new Validate([
            'id' => 'require',
            'uid' => 'require',
        ]);

        $validate->message([
            'id.require' => '参数错误！',
            'uid.require' => '参数错误！',

        ]);

        $data = $this->request->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $info=db('member_adr')->where('id',$data['id'])->find();

        if ($info){

            $res = db('member')->where('id',$data['uid'])->update(['adrid'=>$data['id']]);
            if ($res!=false){
                $this->success('设置成功');
            }else{
                $this->error('设置失败');
            }

        }else{
            $this->error('参数错误！');
        }

    }




    //对比密码方法
    function machpwd($pwd,$repwd){

        if ($pwd==$repwd){
            return true;
        }else{
            return false;
        }
    }


    //匹配手机号码
    function machtel($tel){

        return preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $tel);
    }


    //检查手机是否注册

    function findtel($tel){

        $res = Db::name('member')->where('tel',$tel)->find();

        if ($res!==null){

            return true;  //有

        }else{

            return false; //没有
        }

    }

    //http://192.168.0.13/public/api/home/index/
    
    //获取会员等级信息
    public function getLevelInfo(){

        $data = db('member_level')->select();
        $this->success("请求成功",$data);

    }

    //设置用户
    public function setmember(){

        $post = Request::instance()->post();
        if($post){
            $where['id'] = $post['id'];
            unset($post['id']);
            $update = db('member')->where($where)->update($post);
            if(!$update){
                $this->error('修改失败');
            }
            $this->success('修改成功');
        }

    }

    //用户信息
    public function userinfo(){

        $post = Request::instance()->post();
        if($post){
            $data = db('member')->where($post)->find();
            if(!$data){
                $this->error('修改失败');
            }
            $this->success('修改成功',$data);
        }

    }

}


//api/home/slides/id    获取幻灯片
//api/portal/categories/  获取文章分类

//api/portal/lists/getCategoryPostLists?category_id=10