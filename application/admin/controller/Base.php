<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
	
	function __construct()
	{
		//没检测到session跳回登录页面
		if (!session('session_admin')) {
			$this->redirect('admin/login/index');
		}

	}

	
}