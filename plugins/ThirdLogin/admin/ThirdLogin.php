<?php

namespace plugins\ThirdLogin\admin;
use app\admin\builder\Builder;

use app\admin\controller\Plugins; 
use plugins\ThirdLogin\model\ThirdLogin as ThirdLoginModel;

class ThirdLogin extends Plugins{
    protected $tab_list;
    protected $thirdLoginModel;
    protected $plugin_name='ThirdLogin';

    function _initialize()
    {
        parent::_initialize();
        $this->thirdLoginModel = new ThirdLoginModel();
    }
    
    /*列表*/
    public function index(){
        // 获取所有链接
        $paged=input('param.p',1);
        $map['status'] = ['egt', '0'];  // 禁用和正常状态
        list($data_list,$totalCount) =$this->thirdLoginModel->getListByPage($map,$paged,'level asc,id asc','*',20);

        $builder = new AdminListBuilder();
        $builder->setMetaTitle('第三方登录列表')  // 设置页面标题
                ->addTopButton('addnew',array('href'=>url('adminManage',['name'=>$this->plugin_name,'action'=>'edit'])))    // 添加新增按钮
                ->addTopButton('resume',array('model'=>'ThirdLogin'))  // 添加启用按钮
                ->addTopButton('forbid',array('model'=>'ThirdLogin'))  // 添加禁用按钮
                ->setSearch('请输入uid/openid',array('href'=>url('adminManage',array('name'=>$this->plugin_name,'action'=>'edit'))))
                ->keyListItem('uid', 'UID')
                ->keyListItem('type', '类别')
                ->keyListItem('openid', 'openid')
                ->keyListItem('status', '状态', 'status')
                ->keyListItem('right_button', '操作', 'btn')
                ->setListData($data_list)     // 数据列表
                ->setListPage($totalCount,20)  // 数据列表分页
                ->addRightButton('edit')           // 添加编辑按钮
                ->addRightButton('forbid')  // 添加禁用/启用按钮
                ->addRightButton('delete')  // 添加删除按钮
                ->display();
    }
        /**
     * 编辑链接
     */
    public function edit() {
        $id = input('get.id',0);
        $title= $id ? "编辑" : "新增";
        if (IS_POST) {
            $data = $this->thirdLoginModel->create();
            if ($data) {
                $id = $this->thirdLoginModel->editData($data);
                if ($id !== false) {
                    $this->success($title.'成功', url('adminManage',array('name'=>$this->plugin_name)));
                } else {
                    $this->error($title.'失败');
                }
            } else {
                $this->error($this->thirdLoginModel->getError());
            }
        } else {
            if ($id!=0) {
                $data_list=$this->thirdLoginModel->find($id);
            }
            $builder = new AdminFormBuilder();
            $builder->setMetaTitle($title.'SNS登录账号')  // 设置页面标题
                    ->setPostUrl(url('adminManage',array('name'=>$this->plugin_name,'action'=>'edit')))
                    ->addFormItem('uid', 'number', '用户', '绑定的系统用户ID')
                    ->addFormItem('type', 'radio', '类别', '第三方账号类型',array('Weixin'=>'Weixin','Qq'=>'Qq','Sina'=>'Sina','Renren'=>'Renren'))
                    ->addFormItem('openid', 'text', 'openid', '')
                    ->addFormItem('access_token', 'text', 'access_token', '')
                    ->addFormItem('refresh_token', 'text', 'refresh_token', '')
                    ->setFormData($data_list)
                    ->addButton('submit')->addButton('back')    // 设置表单按钮
                    ->display();
        }
    }

}
