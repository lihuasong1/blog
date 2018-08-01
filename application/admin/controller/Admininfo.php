<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use \app\admin\model\Manager;
class Admininfo extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        // dump(session('session_admin'));die;
        //遍历取出对应管理员信息ase
        $data = Manager::where(['id'=> session('session_admin')['id']])->find()->toArray();
        //渲染管理员个人信息模板
        return view('index', ['data'=>$data]);
    }

    public function setModifyPassword()
    {
        //获取参数
        $request = request()->param();
        $password_new = setEncryptPassword($request['password_new']);
        $password_old = setEncryptPassword($request['password_old']);
        $repassword = setEncryptPassword($request['repassword']);
        //从session获取当前用户id
        $id = session('session_admin')['id'];
        //查询数据库
        $data = Manager::where(['id'=>$id])->find()->toArray();
        
        // 比对输入的旧密码跟数据库的密码
        if ($password_old != $data['password']) {
            echo "旧密码输入不正确";die;
        }else {
            
            if ($password_new != $repassword) {
                echo '密码前后不一致';
            }else {
                // 密码比对正确修改旧密码 
                // $password = $request['password_new']);
                $manager = new Manager();

                $info = $manager->save(['password' => $password_new], ['id' => $id]);
                $this->success('密码修改成功');
            }
        }

    }

    

}
