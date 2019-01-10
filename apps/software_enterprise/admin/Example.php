<?php
// software_enterprise模块后台控制器

namespace app\software_enterprise\admin;
use app\admin\controller\Admin;

class Example extends Admin {

    /**
     * 初始化
     * @return [type] [description]
     */
    function _initialize()
    {
        parent::_initialize();

    }

    /**
     * 入口操作
     * @return [type] [description]
     */
    public function index()
    {
        $this->assign('meta_title','例子');
        return $this->fetch();
    }

}