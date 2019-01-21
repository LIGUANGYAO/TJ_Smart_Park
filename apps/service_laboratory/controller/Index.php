<?php
// service_laboratory模块前台控制器

namespace app\service_laboratory\controller;
use app\home\controller\Home;

class Index extends Home {

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
     */
    public function index() {

        $this->pageInfo('首页','index');
        $logo = [
            'name' => 'logo',
            'value' => '',
        ];
        $this->assign('logo', $logo);
        return $this->fetch();
    }

}