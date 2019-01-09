<?php
// 文章控制器      
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
use app\cms\model\Postmeta as PostmetaModel;
use app\common\model\Terms as TermsModel;
use app\common\model\TermRelationships as TermRelationshipsModel;

class Posts extends Admin {

    protected $postModel;
    protected $termsModel;

    function _initialize()
    {
        parent::_initialize();
        $this->postModel  = new PostsModel();
        $this->termsModel = new TermsModel();
        
    }
    
    /**
     * 文章管理
     * @param  integer $term_id [description]
     * @return [type] [description]
     * @date   2017-09-29
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function index(){

        $optCategory = logic('cms/Category')->getOptTerms('post_category');
        $optCategory = [0=>'全部分类']+ $optCategory;
        return Iframe()
                ->setMetaTitle('文章管理') // 设置页面标题
                ->search([
                    ['name'=>'create_time_range','type'=>'daterange','extra_attr'=>'placeholder="注册时间"'],
                    ['name'=>'term_id','type'=>'select','title'=>'分类','options'=>$optCategory],
                    ['name'=>'is_admin','type'=>'select','title'=>'是否后台用户','options'=>[1=>'是',0=>'否']],
                    ['name'=>'author_id','type'=>'number','title'=>'作者UID','extra_attr'=>'placeholder="请输入作者UID，区分前后台"'],
                    ['name'=>'istop','type'=>'select','title'=>'是否置顶','options'=>[1=>'是',0=>'否']],
                    ['name'=>'recommended','type'=>'select','title'=>'是否推荐','options'=>[1=>'是',0=>'否']],
                    ['name'=>'status','type'=>'select','title'=>'状态','options'=>[1=>'正常',0=>'待审核']],
                    ['name'=>'keyword','type'=>'text','extra_attr'=>'placeholder="请输入查询关键字"'],
                ])
                ->content($this->grid());
    }

    /**
     * 文章列表构建器
     * @return [type] [description]
     * @date   2018-10-03
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function grid($term_id=0)
    {
        if($term_id>0){
            $post_ids = TermRelationshipsModel::where(['term_id'=>$term_id,'table'=>'posts'])->select();
            if(count($post_ids)){
                $post_ids   = array_column($post_ids,'object_id');
                //$post_ids = array_merge(array($post_ids),$post_ids);
                $map['id']  = ['in',$post_ids];
            } else{
                $map['id']  = 0;
            }
        }
        // 获取所有文章
        //$map['status'] = 1; // 禁用和正常状态
        $map['type']='post';

        //配置高级查询
        $search_setting = $this->buildPostsSearchSetting();
         //获取表格数据
        list($data_list,$total) = $this->postModel
                                ->search($search_setting) //添加搜索查询
                                ->getListByPage($map,true,'create_time desc');
        //遍历posts遍历的数据
        foreach($data_list as &$row){
            $row['category_name'] = get_term_info($row['id'],'name')['name'] ? :'暂无';//获得term名称
        }


        //移动按钮属性
        $move_attr = [
            'title'   =>'移动分类',
            'icon'    =>'fa fa-exchange',
            'class'   =>'btn btn-info btn-sm',
            'onclick' =>'move()'
        ];

        //置顶按钮属性
        $top_attr = [
            'title'   =>'置顶',
            'icon'    =>'fa fa-long-arrow-up',
            'class'   =>'btn btn-info btn-sm',
            'onclick' =>''
        ];
        //$extraTop_html=$this->moveCategoryHtml($optCategory,$term_id);//添加移动按钮html
        //推荐按钮属性
        $recommended_attr = [
            'title'   =>'推荐',
            'icon'    =>'fa fa-thumbs-o-up',
            'class'   =>'btn btn-info btn-sm',
            'onclick' =>''
        ];
        //$extraTop_html=$this->moveCategoryHtml($optCategory,$term_id);//添加移动按钮html
        
        $optCategory = logic('cms/Category')->getOptTerms('post_category');
        $optCategory = [0=>'全部分类']+ $optCategory;
        $extra_html = logic('Category')->moveCategoryHtml($optCategory,$term_id);//添加移动按钮html

        return builder('List')
            ->setTabNav(logic('cms/Base')->getBuilderTab('post'),'index') // 设置页面Tab导航
            ->addTopButton('addnew',['data-pjax'=>'true'])  // 添加新增按钮
            ->addTopButton('resume')  // 添加启用按钮
            ->addTopButton('forbid')  // 添加禁用按钮
            ->addTopButton('recycle',array('model'=>'posts')) //添加回收按钮
            ->addTopButton('self', $move_attr) //添加移动按钮
            //->addTopButton('self', $top_attr)
            //->addTopButton('self', $recommended_attr)
            //->addSelect('分类','term_id',$optCategory)//添加分类筛选
            //->setSearch('输入关键字','')
            ->setActionUrl(url('grid')) //设置请求地址
            ->keyListItem('id', 'ID')
            ->keyListItem('img','缩略图','picture')
            ->keyListItem('title', '标题','link',['link'=>url('edit',['id'=>'__data_id__'])])
            ->keyListItem('category_name','分类')
            ->keyListItem('views','浏览量')
            ->keyListItem('author','作者','author')
            ->keyListItem('publish_time','发布时间')
            ->keyListItem('istop', '置顶', 'status')
            ->keyListItem('sort', '排序')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)    // 数据列表
            ->setListPage($total) // 数据列表分页
            ->setExtraHtml($extra_html)
            ->addRightButton('edit')
            //->addRightButton('recycle')
            ->addRightButton('forbid')
            ->fetch();
    }

    /**
     * 新增或编辑
     * @param  integer $id [description]
     * @return [type] [description]
     * @date   2017-10-15
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function edit($id = 0){

        $title = $id>0 ? "编辑":"新增"; 
        
        //修改
        if(IS_POST){
            $data = $this->request->param();
    
            $data['author_id']    = is_admin_login();
            $data['is_admin']    = 1;
            $data['type']         = 'post';
            $data['content']      = htmlspecialchars_decode($data['content']);
            //$data['fields']     =input('fields');
            
            //验证数据
            $this->validateData($data,'Post.edit');
            $result = $this->postModel->editData($data);
            if($result){
                $postmeta = input('param.postmeta/a');
                if (!empty($postmeta)) {
                    $post_meta_model = new PostmetaModel;
                    $meta_keys = $post_meta_model->where('post_id',$id)->column('meta_key');
                     /* 提交过来的 跟数据库中比较 不存在 删除*/
                     $del_metas = [];
                     $postmeta_keys = array_column($postmeta,'meta_key');
                     if (!empty($meta_keys)) {
                         foreach ($meta_keys as $key => $value) {
                            if(!in_array($value,$postmeta_keys)) $del_metas[] = $value; 
                        }
                     }
                     //这是元数据
                    foreach ($postmeta as $key => $val) {
                        if (!empty($val['meta_value'])) {
                            $post_meta_model->setMeta($id,$val['meta_key'],$val['meta_value']);
                        }
                        
                    }
                    //删除不存在的
                    foreach ($del_metas as $key => $value) {
                        $post_meta_model->deleteMeta($id,$value);
                    }
                }
                update_post_term($id,input('post.category_id',false));
                $this ->success($title.'成功','');
            } else{
                $this ->error($this->postModel->getError());
            }

        } else{
            $this->assign('page_config',['disable_panel'=>true,'back'=>true]);
            $this->assign('meta_title',$title.'文章');

            $info = [
                'content'=>'',
                'img'=>''
            ];
            if ($id>0) {
                $info = PostsModel::get($id);
                $this->assign('category_id',get_the_category($id));
                $this->assign('tag_ids',get_the_category($id));
                $this->assign('meta_list',PostmetaModel::getMetas($id));
            } else {
                $this->assign('category_id',0);
                $this->assign('tag_ids',0);
            }
            $this->assign('info',$info);
            
            $this->assign('form_url',url('edit',['id'=>$id]));

            $this->assign('post_category',logic('Category')->getOptTerms('post_category'));
            $this->assign('post_tags',logic('Category')->getOptTerms('post_tag'));
            $this->assign('tag_id',1);//测试
            return $this->fetch();
        }
        
    }

    /**
     * 构建模型搜索查询条件
     * @return [type] [description]
     * @date   2018-09-30
     * @author 心云间、凝听 <981248356@qq.com>
     */
    private function buildPostsSearchSetting()
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
            'ignore_keys' => ['create_time_range','term_id'],
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
                $exist = $this->postModel->where($map)->find();
                if ($exist) {
                    $result = $this->postModel->where($map)->delete();
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