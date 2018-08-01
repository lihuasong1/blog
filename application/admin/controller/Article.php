<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Article extends Base
{
    /**
     * 显示文章列表页
     *
     * @return \think\Response
     */
    public function index()
    {
        //渲染文章列表
        return view();
    }

    /**
     * 显示文章添加页面.
     *
     * @return \think\Response
     */
    public function create()
    {
        //渲染添加模板
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定文章资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //渲染模板
        return view('detail');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    public function danyeList()
    {
        //渲染单页文章显示
        return view('danye-list');

    }

}
