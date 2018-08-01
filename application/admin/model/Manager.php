<?php

namespace app\admin\model;

use think\Model;

class Manager extends Model
{
    //验证器获取人员角色
    public function getRoleIdAttr($value){
        $status=['超级管理员','主管','经理','普通员工'];
        return $status[$value];
    }
}
