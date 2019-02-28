<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/27
 * Time: 9:38
 */

namespace app\park_project_budget\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_project_budget\model\ParkProjectBudgetCategory;

/**
 * Class Category
 * @package app\park_project_budget\admin
 *项目预算种类控制器
 */
class Category extends Admin
{
    /**
     * @var
     * 种类模型
     */
    protected $cateModel;

    /**
     *
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->cateModel = new ParkProjectBudgetCategory();
    }

    /**
     * @return \app\common\layout\Content
     * 列表页
     */
    public function index()
    {
        list($data_list, $total) = $this->cateModel->search()->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('type', '类别', 'array', [1 => '项目类别', 2 => '预算类别'])
            ->keyListItem('name', '名称')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkProjectBudgetCategory'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('类别列表')
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/新增种类
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->cateModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->cateModel->getError());
            }
        } else {
            $info = ['type' => 2];
            if ($id > 0) {
                $info = ParkProjectBudgetCategory::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('type', 'radio', '类别', '', [1 => '项目类别', 2 => '预算类别'])
                ->addFormItem('name', 'text', '名称')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '类别')
                ->content($content);
        }
    }
}
