<?php
// 页面控制器      
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 https://www.eacoophp.com, All rights reserved.         
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace app\cms\admin;
use app\admin\controller\Admin;
use app\admin\controller\Terms as TermsController;

use app\cms\model\Posts as PostsModel;

class Page extends Admin {

    protected $postModel;

    function _initialize()
    {
        parent::_initialize();
        $this->postModel  = new PostsModel();
        
    }
    
    /**
     * 页面列表
     * @return [type] [description]
     * @date   2017-09-28
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function index(){

        return Iframe()
                ->setMetaTitle('页面管理') // 设置页面标题
                ->search([
                    ['name'=>'create_time_range','type'=>'daterange','extra_attr'=>'placeholder="注册时间"'],
                    ['name'=>'is_admin','type'=>'select','title'=>'是否后台用户','options'=>[1=>'是',0=>'否']],
                    ['name'=>'author_id','type'=>'number','title'=>'作者UID','extra_attr'=>'placeholder="请输入作者UID，区分前后台"'],
                    ['name'=>'status','type'=>'select','title'=>'状态','options'=>[1=>'正常',0=>'待审核']],
                    ['name'=>'keyword','type'=>'text','extra_attr'=>'placeholder="请输入查询关键字"'],
                ])
                ->content($this->grid());
    }

    /**
     * 页面列表构建
     * @return [type] [description]
     * @date   2018-10-03
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function grid()
    {
        //配置高级查询
        $search_setting = $this->buildModerSearchSetting();
        // 获取所有页面列席
        $map = [
            'status' =>1,
            'type'   =>'page'
        ];
        list($data_list,$total) = $this->postModel->search($search_setting)->getListByPage($map,true,'create_time desc');

        return builder('List')
                ->addTopButton('addnew')  // 添加新增按钮
                ->addTopButton('recycle',array('model'=>'posts'))  // 添加删除按钮
                //->setSearch('搜索页面', url('page'))
                ->keyListItem('title', '标题')
                ->keyListItem('views','浏览量')
                ->keyListItem('author','作者','author')
                ->keyListItem('publish_time','发布时间')
                ->keyListItem('status', '状态', 'status')
                ->keyListItem('right_button', '操作', 'btn')
                ->setListPrimaryKey('id')
                ->setListData($data_list)    // 数据列表
                ->setListPage($total) // 数据列表分页
                ->addRightButton('edit')  // 添加编辑按钮
                ->addRightButton('recycle')        // 添加删除按钮
               ->fetch();
    }

    /**
     * 编辑页面
     * @author 
     */
    public function edit($id=0) {
        $title = $id ? "编辑":"新增";
        if (IS_POST) {
            $data = input('param.');
            if(!empty($data)){
                $data['type']='page';
                if ($this->postModel->editData($data)) {
                    $this->success($title.'成功', url('index'));
                } else {
                    $this->error($this->postModel->getError());
                }

            }
        } else {
            
            return Iframe()
                    ->setMetaTitle($title.'页面')  // 设置页面标题
                    ->row($this->form($id));
        }
    }

    /**
     * 表单构建
     * @param  integer $id [description]
     * @return [type] [description]
     * @date   2018-10-03
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function form($id = 0)
    {
        if ($id>0) {
           $info = PostsModel::get($id);
        } else{
            $info = [];
        }
        $authors = db('users')->where(['status'=>1])->column('nickname','uid');
        return builder('Form')
                ->addFormItem('id', 'hidden', '')
                ->addFormItem('title', 'text', '标题')
                ->addFormItem('content', 'wangeditor', '内容','',['width'=>'100%','height'=>'300px','config'=>'all'])
                ->addFormItem('author_id', 'select2', '作者', '',$authors)
                ->addFormItem('tags', 'tags', '标签', '')
                ->addFormItem('seo_keywords', 'text', 'SEO关键字', '')
                ->addFormItem('excerpt', 'text', 'SEO描述', '')
                ->setFormData($info)
                ->addButton('submit')->addButton('back')    // 设置表单按钮
                ->fetch();
    }

    /**
     * 构建模型搜索查询条件
     * @return [type] [description]
     * @date   2018-09-30
     * @author 心云间、凝听 <981248356@qq.com>
     */
    private function buildModerSearchSetting()
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

    /**
     * 设置一条或者多条数据的状态
     */
    public function setStatus($model = 'Posts',$script = false) {
        $ids    = input('param.ids/a');
        $status = input('param.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        $map['id'] = ['in',$ids];
        switch ($status) {
            case 'delete' :  // 删除条目
                $map['status'] = -1;
                $exist = $this->postModel->get($map);
                if ($exist) {
                    $result = $this->postModel->delete($ids);
                } else {
                    $result = true;
                }
                if ($result) {
                    foreach ($ids as $key => $id) {
                        $term_id = get_term_info($id,'term_id')['term_id'];
                        delete_post_term($id,$term_id);//删除分类
                    }       
                    $this->success('彻底删除成功');

                } else {
                    $this->error('删除失败');
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }
}