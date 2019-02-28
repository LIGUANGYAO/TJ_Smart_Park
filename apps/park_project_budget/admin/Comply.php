<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/28
 * Time: 11:38
 */

namespace app\park_project_budget\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_project_budget\model\ParkProjectBudgetComplyList;
use think\Db;

/**
 * Class Comply
 * @package app\park_project_budget\admin
 * 预算执行控制器
 */
class Comply extends Admin
{
    /**
     * @var
     * 项目列表
     */
    protected $projectList;
    /**
     * @var
     * 预算种类列表
     */
    protected $cateList;

    /**
     * @var
     * 执行记录模型
     */
    protected $complyModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->projectList = Db::name('ParkProjectBudgetList')
            ->where('project_status', 'neq', 3)
            ->column('id,project_name');
        $this->cateList = Db::name('ParkProjectBudgetCategory')
            ->where('type', 'eq', 2)
            ->column('id,name');
        $this->complyModel = new ParkProjectBudgetComplyList();
    }

    public function index()
    {
        list($data_list, $total) = $this->complyModel->search()->getListByPage([], true, 'create_time');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('预算执行列表')
            ->content($content);
    }

    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($param['project_status'] == '未执行') {
                $param['project_status'] = 1;
            } elseif ($param['project_status'] == '执行中') {
                $param['project_status'] = 2;
            } else {
                $param['project_status'] = 3;
            }
            if ($this->complyModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->complyModel->getError());
            }
        } else {
            $info = [
                'price' => 0.00,
                'number' => 0,
                'actual_total' => 0.00,
            ];
            if ($id > 0) {
                $info = ParkProjectBudgetComplyList::get($id);
            }
            $getProjectInfo = \logic('park_project_budget')->getProjectInfo();
            $content = (new BuilderForm())
                ->addFormItem('project_name', 'select', '项目名称', '请选择项目名称', $this->projectList)
                ->addFormItem('project_numbering', 'text', '预算编号', '系统自动完成', '', 'readonly')
                ->addFormItem('project_category', 'text', '项目类别', '系统自动完成', '', 'readonly')
                ->addFormItem('project_status', 'text', '项目状态', '系统自动完成', '', 'readonly')
                ->addFormItem('category', 'select', '预算类别', '请选择预算类别', $this->cateList)
                ->addFormItem('amount', 'text', '预算总金额', '系统自动完成', '', 'readonly')
                ->addFormItem('name', 'text', '名称')
                ->addFormItem('price', 'number', '单价')
                ->addFormItem('number', 'number', '数量')
                ->addFormItem('actual_total', 'number', '实际支付金额')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->setExtraHtml($getProjectInfo)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '预算执行')
                ->content($content);
        }
    }
}
