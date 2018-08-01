<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
class Manager extends Base
{
    public function index()
    {
        $data = request()->param();
        $info = '';
        //如果接收到post请求数据，查询一条管理员数据x
        if(request()->isPost()) {
            $info = \app\admin\model\Manager::where(['username' => $data['name']])->find()->toArray();
        }
        //查询管理员数据表
        $list = \app\admin\model\Manager::select();
        //渲染管理员列表
        return view('index', ['list' => $list, 'info' => $info]);
    }
    public function refresh() {
        $data = \app\admin\model\Manager::select();
        //判断数据查询若是查询失败，查询失败返回错误信息
        if (!$data) {
            $res = [
                'code' => 701,
                'msg' => '数据查询失败',
            ];
            return json($res);
        }
        //查询成功返回相应数据
        $res = [
            'code' => 700,
            'msg' => '数据查询成功',
            'data' => $data
        ];
        return json($res);
    }
    public function create()
    {
        return view();
    }
    public function save(Request $request)
    {
    }
    public function edit($id)
    {
        dump($id);
        //渲染修改模版
        return view('edit');
    }
    public function editSuccessful($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function delete($id)
    {
    }
    //处理使用ajax方式搜索管理员
    public function getFindManager() {
        $data = request()->param();
        $info = \app\admin\model\Manager::where('username', 'like', '%'.$data['name'].'%')->select();
        $res = [
            'code' => 700,
            'msg' => 'success',
            'data' => $info
        ];
        echo json_encode($res);die;
    }
    //保存新增管理员
    public function managersave(){
        $data=request()->param();
        $data['ip']=request()->ip();
        $data['password']=setEncryptPassword($data['password']);
        //dump($data);die;
        //写验证器
        $rule=[
            'username'=>'require',
            'email'=>"regex:/^\w[\w\.-]*@[a-z0-9][a-z0-9-]*(\.[a-z]+)*(\.[a-z]{2,6})$/i",
            'password'=>'require',
            'nickname'=>'require',
            'role_id'=>'require',
        ];
        $msg=[
            'username.require'=>'用户名不能为空',
            'email.regex'=>'邮箱不符合规则',
            'password.require'=>'密码不能为空',
            'nickname.require'=>'昵称不能为空',
            'role_id.require'=>'用户角色不能为空',
        ];
        //实例化验证器
        $validate=new \think\Validate($rule,$msg);
        if($validate->check($data)){
            \app\admin\model\Manager::create($data,true);
            return json(['code'=>10001,'msg'=>'添加成功']);
        }else{
            $error=$validate->getError();
            return json(['code'=>10000,'msg'=>$error]);
        }
    }
}
