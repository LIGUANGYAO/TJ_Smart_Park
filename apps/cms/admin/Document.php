<?php
// 文档管理 
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

use app\cms\model\Posts as PostsModel;
use app\common\model\Terms as TermsModel;

class Document extends Admin
{

    protected $postModel;
    protected $postTypeGroup = [];

    function _initialize()
    {
        parent::_initialize();
        $this->postModel = new PostsModel();
        $post_type = config('cms_config.post_type');
        if (!empty($post_type)) {
            foreach ($post_type as $key => $val) {
                $this->postTypeGroup[$val['name']] = $val['title'];
            }
        }
    }

    /**
     * 文档列表
     * @return [type] [description]
     * @date   2017-09-28
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function index()
    {

        $optCategory = logic('cms/Category')->getOptTerms('post_category');
        $optCategory = [0 => '全部分类'] + $optCategory;
        return Iframe()
            ->setMetaTitle('文章管理')// 设置页面标题
            ->search([
                ['name' => 'create_time_range', 'type' => 'daterange', 'extra_attr' => 'placeholder="注册时间"'],
                ['name' => 'type', 'type' => 'select', 'title' => '类型', 'options' => $this->postTypeGroup],
                ['name' => 'term_id', 'type' => 'select', 'title' => '分类', 'options' => $optCategory],
                ['name' => 'is_admin', 'type' => 'select', 'title' => '是否后台用户', 'options' => [1 => '是', 0 => '否']],
                ['name' => 'author_id', 'type' => 'number', 'title' => '作者UID', 'extra_attr' => 'placeholder="请输入作者UID，区分前后台"'],
                ['name' => 'istop', 'type' => 'select', 'title' => '是否置顶', 'options' => [1 => '是', 0 => '否']],
                ['name' => 'recommended', 'type' => 'select', 'title' => '是否推荐', 'options' => [1 => '是', 0 => '否']],
                ['name' => 'status', 'type' => 'select', 'title' => '状态', 'options' => [1 => '正常', 0 => '待审核']],
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入查询关键字"'],
            ])
            ->content($this->grid());
    }


    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 文档列表构建
     */
    public function grid()
    {
        $term_id = $this->request->param('term_id');
        // 获取所有页面列席
        $map = [];
        if ($term_id > 0) {
            $post_ids = \model('TermRelationships')->where(['term_id' => $term_id, 'table' => 'posts'])->select();
            if (count($post_ids)) {
                $post_ids = array_column($post_ids, 'object_id');
                //$post_ids = array_merge(array($post_ids),$post_ids);
                $map['id'] = ['in', $post_ids];
            } else {
                $map['id'] = 0;
            }
        }

        //配置高级查询
        $search_setting = $this->buildModerSearchSetting();
        //获取表格数据
        list($data_list, $total) = $this->postModel
            ->search($search_setting)//添加搜索查询
            ->getListByPage($map, true, 'create_time desc');
        foreach ($data_list as &$row) {
            $row['category_name'] = get_term_info($row['id'], 'name')['name'] ?: '暂无';//获得term名称
        }

        //移动按钮属性
        $move_attr = [
            'title' => '移动分类',
            'icon' => 'fa fa-exchange',
            'class' => 'btn btn-info btn-sm',
            'onclick' => 'move()'
        ];
        $optCategory = logic('Category')->getOptTerms('post_category');
        $optCategory = [0 => '全部分类'] + $optCategory;
        $extra_html = logic('Category')->moveCategoryHtml($optCategory, $term_id);//添加移动按钮html

        return builder('List')
            ->setMetaTitle('文档管理')// 设置页面标题
            ->setTabNav(logic('cms/Base')->getBuilderTab(), 'index')// 设置页面Tab导航
            ->addTopButton('addnew')// 添加新增按钮
            ->addTopButton('resume')// 添加启用按钮
            ->addTopButton('forbid')// 添加禁用按钮
            ->addTopButton('recycle', ['model' => 'posts'])// 添加删除按钮
            ->addTopButton('self', $move_attr)//添加移动按钮
            //->addSelect('分类','term_id',$optCategory)//添加分类筛选
            ->setSearch('搜索关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('title', '标题')
            ->keyListItem('type', '类型', 'array', $this->postTypeGroup)
            ->keyListItem('category_name', '分类')
            ->keyListItem('views', '浏览量')
            ->keyListItem('author', '作者')
            ->keyListItem('is_admin_text', '后台用户', 'label')
            ->keyListItem('publish_time', '发布时间')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->setExtraHtml($extra_html)
            ->addRightButton('edit')// 添加编辑按钮
            ->addRightButton('recycle', ['model' => 'Posts'])// 添加删除按钮
            ->fetch();
    }

    /**
     * 编辑页面
     * @author
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? "编辑" : "新增";
        if (IS_POST) {
            $data = input('param.');
            if (!empty($data)) {
                if ($this->postModel->editData($data)) {
                    $this->success($title . '成功', url('index'));
                } else {
                    $this->error($this->postModel->getError());
                }

            }
        } else {

            return Iframe()
                ->setMetaTitle($title . '文档')// 设置页面标题
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
        $info = ['sort' => 99, 'status' => 1];
        if ($id > 0) {
            $info = PostsModel::get($id);
        }

        $authors = db('users')->where(['status' => 1])->column('nickname', 'uid');
        return builder('Form')
            ->addFormItem('id', 'hidden', '')
            ->addFormItem('title', 'text', '标题')
            ->addFormItem('type', 'select', '文档类型', '', $this->postTypeGroup)
            ->addFormItem('content', 'wangeditor', '内容', '', ['width' => '100%', 'height' => '300px', 'config' => 'all'])
            ->addFormItem('author_id', 'select2', '作者', '', $authors)
            ->addFormItem('tags', 'tags', '标签', '')
            ->addFormItem('seo_keywords', 'text', 'SEO关键字', '')
            ->addFormItem('excerpt', 'text', 'SEO描述', '')
            ->addFormItem('sort', 'number', '排序', '按照数值大小的倒叙进行排序，数值越小越靠前')
            ->addFormItem('status', 'radio', '状态', '', [1 => '正常', 0 => '禁用'])
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')// 设置表单按钮
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
        if ($timegap) {
            $gap = explode('—', $timegap);
            $reg_begin = $gap[0];
            $reg_end = $gap[1];

            $extend_conditions = [
                'create_time' => ['between', [$reg_begin . ' 00:00:00', $reg_end . ' 23:59:59']]
            ];
        }
        //自定义查询条件
        $search_setting = [
            'keyword_condition' => 'title',
            //忽略数据库不存在的字段
            'ignore_keys' => ['create_time_range', 'term_id'],
            //扩展的查询条件
            'extend_conditions' => $extend_conditions
        ];

        return $search_setting;
    }

    /**
     * 回收站页面
     * @author 心云间、凝听 <981248356@qq.com>
     */
    function trash()
    {
        return Iframe()
            ->setMetaTitle('回收站')// 设置页面标题
            ->row($this->trashGrid());
    }

    /**
     * 回收站列表构建
     * @return [type] [description]
     * @date   2018-10-03
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function trashGrid()
    {
        // 获取所有文章
        $map['status'] = '-1'; // 禁用和正常状态
        list($data_list, $total) = $this->postModel->getListByPage($map, 'id,title,author_id,is_admin,type,publish_time,status', 'create_time desc');
        //遍历posts遍历的数据
        foreach ($data_list as $k => $data) {
            $data_list[$k]['category_name'] = get_term_info($data['id'], 'name')['name'] ?: '暂无';//获得term名称
            $data_list[$k]['author'] = get_user_info($data['author_id'], 'nickname')['nickname'];//获取用户名
        }

        return builder('List')
            ->addTopButton('restore', ['model' => 'posts'])// 添加启用按钮
            ->addTopButton('delete', ['model' => 'posts'])// 添加删除按钮
            ->setSearch()
            ->setActionUrl(url('trashGrid'))
            ->keyListItem('title', '标题')
            ->keyListItem('category_name', '分类')
            ->keyListItem('type', '类型', 'array', $this->postTypeGroup)
            ->keyListItem('author', '作者', 'author')
            ->keyListItem('publish_time', '发布时间')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('edit', array('href' => url('page/edit', ['id' => '__data_id__'])))// 添加编辑按钮
            ->addRightButton('delete')// 添加删除按钮
            ->fetch();
    }

    /**
     * 设置一条或者多条数据的状态
     */
    public function setStatus($model = 'Posts', $script = false)
    {
        $ids = input('param.ids/a');
        $status = input('param.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        $map['id'] = ['in', $ids];
        switch ($status) {
            case 'delete' :  // 删除条目
                $map['status'] = -1;
                $exist = PostsModel::get($map);
                if ($exist) {
                    $result = $this->postModel->delete($ids);
                } else {
                    $result = true;
                }
                if ($result) {
                    foreach ($ids as $key => $id) {
                        $term_id = get_term_info($id, 'term_id')['term_id'];
                        delete_post_term($id, $term_id);//删除分类
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