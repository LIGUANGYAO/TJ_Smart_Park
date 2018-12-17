<?php
// 构建器Builder表单示例-后台
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 https://www.eacoophp.com, All rights reserved.         
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace plugins\DemoExample\admin;
//命名空间引入后台基类
use app\admin\controller\Admin;
//可以实例化任意模型
use plugins\DemoExample\model\DemoExample as DemoExampleModel;

class BuilderForm extends Admin
{

    protected $plugin_name = 'DemoExample';

    function _initialize()
    {
        parent::_initialize();
        $this->demoExampleModel = new DemoExampleModel();
    }

    /**
     * 编辑表单
     * @param  integer $uid [description]
     * @return [type] [description]
     * @date   2018-02-23
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function index($id = 0)
    {
        $title = $id ? "编辑" : "新增";
        if (IS_POST) {

            $params = input('param.');
            $this->validateData($params, [
                ['title', 'require|chsAlpha', '标题不能为空|标题只能是汉字和字母'],
                ['description', 'chsAlphaNum', '描述只能是汉字字母数字']
            ]);//验证数据

            $params['files'] = implode(',', $params['files']);
            $params['region'] = isset($params['region']) ? json_encode($params['region']) : '';
            $params['repeater_content'] = json_encode($params['repeater_content']);
            //halt($params);
            // 提交数据
            $result = $this->demoExampleModel->editData($params);

            if ($result) {
                $this->success($title . '成功', plugin_url('DemoExample/BuilderList/index'));
            } else {
                $this->error($this->demoExampleModel->getError());
            }

        } else {
            return Iframe()
                ->setMetaTitle('DemoExample表单示例')// 设置页面标题
                ->row($this->form($id));

        }
    }

    /**
     * 表单
     * @param  integer $id [description]
     * @return [type] [description]
     * @date   2018-09-09
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function form($id = 0)
    {
        //可以通过该数组定义BuilderForm的默认值
        $info = [
            'sex' => 0,
            'picture' => 4,
            'image' => '/logo.png',
            'pictures' => '94,95,96',
            'file' => '/uploads/attachment/2016-07-27/579857b5aca95.mp3',
            'files' => '10,12',
            'repeater_content' => [
                ['img' => 94, 'url' => 'https://www.eacoophp.com', 'text' => 'EacooPHP快速开发框架'],
                ['img' => 95, 'url' => 'https://forum.eacoophp.com', 'text' => 'EacooPHP讨论社区'],
                ['img' => 94, 'url' => 'https://www.eacoophp.com', 'text' => 'EacooPHP快速开发框架'],
            ],
            'description' => '默认描述内容',
            'region' => '',
            'content' => '默认内容',
            'content1' => '默认内容',
            'sort' => 99,
            'status' => 1
        ];
        // 读取数据库的数据
        if ($id > 0) {
            $info = DemoExampleModel::get($id);
            $info = $info->toArray();
            $info['repeater_content'] = json_decode($info['repeater_content'], true);
        }

        $tab_list = [
            'builderlist' => ['title' => '列表示例', 'href' => plugin_url('DemoExample/BuilderList/index')],
            'builderform' => ['title' => '表单示例', 'href' => plugin_url('DemoExample/BuilderForm/index')],
        ];
        // 使用FormBuilder快速建立表单页面。
        return Builder('Form')
            ->setTabNav($tab_list, 'builderform')// 设置页面Tab导航
            ->addFormItem('id', 'hidden', 'ID', '')//这个字段一般是默认添加
            ->addFormItem('title', 'text', '标题', '使用文本字段text', '', 'required')
            ->addFormItem('password', 'password', '密码', '密码字段password', '', 'placeholder="留空则不修改密码"')
            ->addFormItem('email', 'email', '邮箱', '邮箱字段email', '', 'required')
            ->addFormItem('sex', 'radio', '性别', '单选框形式radio', [0 => '保密', 1 => '男', 2 => '女'])
            ->addFormItem('sex', 'select', '性别', '下拉框形式select', ['none' => '请设置性别', 0 => '保密', 1 => '男', 2 => '女'])
            ->addFormItem('picture', 'picture', '单图片1', '添加单个图片picture，基于图片选择器')
            ->addFormItem('image', 'image', '单图片2', '添加单个图片image，直接上传并保持图片地址')
            ->addFormItem('pictures', 'pictures', '多图片', '添加多个图片pictures，基于图片选择器')
            ->addFormItem('file', 'file', '单个文件', '添加单个文件file')
            ->addFormItem('files', 'files', '多个文件', '添加多个文件files')
            ->addFormItem('region', 'region', '地区三级', '地区字段region，实现地区三级联动选择。基于地区管理插件', json_decode($info['region'], true))
            //基于repeater控件
            ->addFormItem('repeater_content', 'repeater', '自定义数据', '根据repeater控件生成，该示例一个处理多图', [
                    'options' =>
                        [
                            'img' => ['title' => '图片', 'type' => 'image', 'default' => '', 'placeholder' => ''],
                            'url' => ['title' => '链接', 'type' => 'url', 'default' => '', 'placeholder' => 'http://'],
                            'text' => ['title' => '文字', 'type' => 'text', 'default' => '', 'placeholder' => '输入文字'],
                        ]
                ]
            )
            ->addFormItem('description', 'textarea', '个人说明', '大文本框texarea')
            ->addFormItem('content', 'wangeditor', '详情内容', '使用编辑器wangeditor')
            ->addFormItem('content1', 'ueditor', '详情内容', '使用编辑器ueditor')
            ->addFormItem('datetime', 'datetime', '时间选取器', '时间选择器组件datetime')
            ->addFormItem('daterange', 'daterange', '时间范围', '时间范围选择器组件daterange')
            ->addFormItem('sort', 'number', '排序', '按照数值大小的倒叙进行排序，数值越小越靠前')
            ->addFormItem('status', 'radio', '状态', '', [1 => '正常', 0 => '禁用'])
            ->setFormData($info)
            //->setAjaxSubmit(false)//是否禁用ajax提交，普通提交方式
            ->addButton('submit')->addButton('back')// 设置表单按钮
            ->fetch();
    }

}
