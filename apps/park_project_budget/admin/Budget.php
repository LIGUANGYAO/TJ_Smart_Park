<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/16
 * Time: 9:47
 */

namespace app\park_project_budget\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_project_budget\model\ParkProjectBudgetList;

/**
 * Class Budget
 * @package app\park_project_budget\admin
 * 项目预算控制器
 */
class Budget extends Admin
{
    /**
     * @var
     * 项目预算模型
     */
    protected $budgetModel;
    /**
     * @var
     * 项目预算类型
     */
    protected $budgetType;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->budgetModel = new ParkProjectBudgetList();
        $this->budgetType = \config('budget_type');
    }

    /**
     * @return \app\common\layout\Content
     * 预算列表
     */
    public function index()
    {
        list($data_list, $total) = $this->budgetModel
            ->search([
                'keyword_condition' => 'project',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('project', '项目名称')
            ->keyListItem('type', '预算分类', 'array', $this->budgetType)
            ->keyListItem('amount', '总预算(元)')
            ->keyListItem('real_amount', '实际执行预算(元)')
            ->keyListItem('confirmor', '确认人')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkProjectBudgetList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('项目预算管理')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输项目名称"',
                ]
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/添加
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->budgetModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = ParkProjectBudgetList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('type', 'select', '预算类型', '', $this->budgetType)
                ->addFormItem('project', 'text', '项目名称')
                ->addFormItem('amount', 'text', '总预算')
                ->addFormItem('real_amount', 'text', '实际执行预算')
                ->addFormItem('confirmor', 'text', '确认人')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '项目预算')
                ->content($content);
        }
    }
}