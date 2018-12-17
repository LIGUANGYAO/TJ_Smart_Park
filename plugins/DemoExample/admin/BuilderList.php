<?php
// 构建器Builder列表示例-后台
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 https://www.eacoophp.com, All rights reserved.         
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace plugins\DemoExample\admin;

use app\home\admin\Plugin;
use plugins\DemoExample\model\DemoExample as DemoExampleModel;

class BuilderList extends Plugin{

    protected $plugin_name = 'DemoExample';

    function _initialize()
    {
        parent::_initialize();
        $this->demoExampleModel = new DemoExampleModel();
    }
    
    /**
     * 用户列表(构建器列表，该方法是以获取用户列表来举例)
     * @return [type] [description]
     * @date   2018-02-23
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function index(){
        
        return Iframe()
                ->setMetaTitle('DemoExample列表示例') // 设置页面标题
                ->search([
                    ['name'=>'status','type'=>'select','title'=>'状态','options'=>[1=>'正常',2=>'待审核']],
                    ['name'=>'sex','type'=>'select','title'=>'性别','options'=>[0=>'保密',1=>'男',2=>'女']],
                    ['name'=>'create_time_range','type'=>'daterange','extra_attr'=>'placeholder="创建时间范围"'],
                    ['name'=>'keyword','type'=>'text','extra_attr'=>'placeholder="请输入查询关键字"'],
                ])
                ->content($this->grid());
    }
    
    /**
     * 构建器列表
     * @return [type] [description]
     * @date   2018-09-08
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function grid()
    {
        $search_setting = $this->buildModelSearchSetting();
        // 获取构建器列表数据
        $map = [
            'status'=>['egt',0],// 禁用和正常状态
        ];
        list($data_list,$total) = $this->demoExampleModel->search($search_setting)->getListByPage($map,true,'create_time desc');

        $tab_list = [
                'builderlist'=>['title'=>'列表示例','href'=>plugin_url('DemoExample/BuilderList/index')],
                'builderform'=>['title'=>'表单示例','href'=>plugin_url('DemoExample/BuilderForm/index')],
            ];
        return builder('List')
                ->setTabNav($tab_list, 'builderlist')  // 设置页面Tab导航
                ->addTopButton('addnew')  // 添加新增按钮
                ->addTopButton('resume',['model'=>'DemoExample'])  // 添加启用按钮
                ->addTopButton('forbid',['model'=>'DemoExample'])  // 添加禁用按钮
                ->addTopButton('delete',['model'=>'DemoExample'])  // 添加删除按钮
                //->setSearch('custom','请输入关键字')
                ->keyListItem('id', 'ID')
                ->keyListItem('picture', '图像', 'picture')
                ->keyListItem('title', '标题')
                ->keyListItem('email', '邮箱')
                ->keyListItem('sex', '性别','array',[0=>'保密',1=>'男',2=>'女'])
                ->keyListItem('file', '文件')
                ->keyListItem('create_time', '创建时间')
                ->keyListItem('status', '状态', 'status')
                ->keyListItem('right_button', '操作', 'btn')
                ->setListPrimaryKey('id')//设置数据主键，默认是id
                ->setListData($data_list)    // 数据列表
                ->setListPage($total) // 数据列表分页
                ->addRightButton('edit',['href'=>plugin_url('DemoExample/BuilderForm/index',['id'=>'__data_id__'])])
                ->addRightButton('forbid',['model'=>'DemoExample'])
                ->addRightButton('delete',['model'=>'DemoExample'])  // 添加编辑按钮
                ->fetch();
    }

    /**
     * 编辑
     * @return [type] [description]
     * @date   2018-03-08
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function edit()
    {
        $form = new BuilderForm();
        return $form->index();
    }

    /**
     * 构建模型搜索查询条件
     * @return [type] [description]
     * @date   2018-09-30
     * @author 心云间、凝听 <981248356@qq.com>
     */
    private function buildModelSearchSetting()
    {
        //时间范围
        $timegap = input('create_time_range');
        $extend_conditions = [];
        if($timegap){
            $gap = explode('—', $timegap);
            $reg_begin = $gap[0];
            $reg_end = $gap[1];

            $extend_conditions =[
                'create_time'=>['between',[$reg_begin.' 00:00:00',$reg_end.' 23:59:59']]
            ];
        }
        //自定义查询条件
        $search_setting = [
            'keyword_condition'=>'title',
            //忽略数据库不存在的字段
            'ignore_keys' => ['create_time_range'],
            //扩展的查询条件
            'extend_conditions'=>$extend_conditions
        ];

        return $search_setting;
    }
}
