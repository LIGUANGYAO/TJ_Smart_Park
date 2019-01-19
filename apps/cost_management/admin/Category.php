<?php
// cost_management模块后台控制器

namespace app\cost_management\admin;

use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\cost_management\model\CostCategoryList;

/**
 * Class Category
 * @package app\cost_management\admin
 */
class Category extends Admin
{
    /**
     * @var
     * 收费项目控制器
     */
    protected $cateModel;

    /**
     *初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->cateModel = new CostCategoryList();
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        list($data_list, $total) = $this->cateModel->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('name', '费用名称')
            ->keyListItem('status', '状态', 'array', [1 => '启用', 2 => '禁用'])
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'CostCategoryList'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('收费项目列表')
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加/编辑
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['creator_id'] = \session('admin_login_auth.uid');
            if ($this->cateModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->cateModel->getError());
            }
        } else {
            $info = [
                'status' => 1,
            ];
            if ($id > 0) {
                $info = CostCategoryList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('name', 'text', '项目名称')
                ->addFormItem('status', 'radio', '状态', '', [1 => '启用', 2 => '禁用'])
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '费用项目')
                ->content($content);
        }
    }
}