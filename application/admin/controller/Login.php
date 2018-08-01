<?php

namespace app\admin\controller;

use app\admin\model\Manager;
use think\Controller;
use think\Request;
use think\Validate;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        dump(setEncryptPassword(123456));die;
        //渲染登录模板
        return view();
    }

    /**
     * 登录成功
     * @return \think\Response
     */
    public function doLogin(Request $request) {
        // 接收参数
        $data = $request->param();
        //dump($data);die;
        // 参数检测
       // dump(setEncryptPassword($data['password']));die; //密码 123456
        $rules = [
            'username' => 'require',
            'password' => 'require'
        ];

        $msg = [
            'username.require' => '用户名不能为空',
            'password.require' => '密码不能为空'
        ];

        json_decode(231);

        /*if(!captcha_check($data['verity'])){
            //验证失败
            $this->error('验证码错误，请重新输入');
        };*/

        $validate = new Validate($rules, $msg);
        if (!$validate->check($data)) {
            $error = $validate->getError();
            $this->error($error);
        }
        // 查询数据库
        $info = \app\admin\model\Manager::where(['username' => $data['username']])->find();

     

        // 判断密码
        if ($info['password'] != setEncryptPassword($data['password'])) {
            $this->error('登陆失败', 'admin/login/index');
        }else {

            //登陆成功存入session
            session('session_admin', $info->toArray());

            Manager::update(['last_login_time'=>time()],['id'=>session('session_admin.id')]);
            // dump('dsaa');die;
            $this->success('登陆成功', 'admin/index/index');
        }
        
    }

    /**
     *  账号退出
     *
     * @return \think\Response
     */
    public function logout()
    {
        //删除session
        session('session_admin', null);
        $this->redirect('admin/login/index');
    }

    public function mima(){
        $dd=setEncryptPassword('123456');
        echo "$dd";
    }







}
