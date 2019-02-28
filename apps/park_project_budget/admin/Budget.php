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
use think\Db;

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
     * @var array
     * 前置操作
     */
    protected $beforeActionList = [
        'changeRemainDays' => ['only' => 'index']
    ];

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 执行index之前需要先计算剩余天数
     */
    protected function changeRemainDays()
    {
        $list = Db::name('ParkProjectBudgetList')->select();
        foreach ($list as $v) {
            $remain_days = $this->calculateDays($v['e_time'], \date('Y-m-d H:i:s'));
            Db::name('ParkProjectBudgetList')
                ->where('id', 'eq', $v['id'])
                ->setField('remain_days', $remain_days);
        }
    }

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->budgetModel = new ParkProjectBudgetList();
        $this->budgetType = Db::name('ParkProjectBudgetCategory')
            ->where('type', 'eq', 1)
            ->column('id,name');
    }

    /**
     * @return \app\common\layout\Content
     * 预算列表
     */
    public function index()
    {
        list($data_list, $total) = $this->budgetModel
            ->search([
                ['name' => 'project_status', 'title' => '按照状态', 'type' => 'select', 'options' => [1 => '未执行', 2 => '执行中', 3 => '执行完毕']],
                ['keyword_condition' => 'project'],
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('project_name', '项目名称')
            ->keyListItem('project_number', '预算编号')
            ->keyListItem('type', '项目类别')
            ->keyListItem('s_time', '开始时间')
            ->keyListItem('e_time', '结束时间')
            ->keyListItem('mid_check_time', '中期验收时间')
            ->keyListItem('amount', '项目总额')
            ->keyListItem('spent_amount', '执行金额')
            ->keyListItem('balance', '剩余金额')
            ->keyListItem('remain_days', '剩余天数')
            ->keyListItem('project_status', '项目状态')
            ->keyListItem('marks', '备注')
//            ->keyListItem('confirmor', '确认人', 'callback', 'getAdminNameByAdminId')
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
            $param['confirmor'] = \session('admin_login_auth.uid');
            $param['spent_amount'] = $param['amount'] - $param['balance'];
            if ($this->budgetModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->budgetModel->getError());
            }
        } else {
            $info = [
                'project_status' => 1,
                'amount' => 0.00,
                'balance' => 0.00,
                'equipment_cost' => 0.00,
                'material_cost' => 0.00,
                'test_processing_cost' => 0.00,
                'fuel_cost' => 0.00,
                'business_cost' => 0.00,
                'knowledge_cost' => 0.00,
                'service_cost' => 0.00,
                'advisory_cost' => 0.00,
                'other_cost' => 0.00,
            ];
            if ($id > 0) {
                $info = ParkProjectBudgetList::get($id);
            }
            $html = \logic('park_project_budget')->formExtraHtml();
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('project_name', 'text', '项目名称')
                ->addFormItem('project_number', 'text', '预算编号')
                ->addFormItem('type', 'select', '预算类型', '', $this->budgetType)
                ->addFormItem('project_status', 'radio', '项目状态', '', [1 => '未执行', 2 => '执行中', 3 => '执行完毕'])
                ->addFormItem('s_time', 'datetime', '开始时间')
                ->addFormItem('e_time', 'datetime', '结束时间')
                ->addFormItem('mid_check_time', 'datetime', '中期验收时间')
                ->addFormItem('amount', 'text', '执行总金额', '*单位:元')
                ->addFormItem('balance', 'text', '剩余金额', '系统自动计算', '', 'readonly')
                ->addFormItem('equipment_cost', 'text', '设备费', '*单位:元')
                ->addFormItem('material_cost', 'text', '材料费', '*单位:元')
                ->addFormItem('test_processing_cost', 'text', '测试化验加工费', '*单位:元')
                ->addFormItem('fuel_cost', 'text', '燃料动力费', '*单位:元')
                ->addFormItem('business_cost', 'text', '差旅/会议/国际合作与交流费', '*单位:元')
                ->addFormItem('knowledge_cost', 'text', '出版/文献/信息传播/知识产权事务费', '*单位:元')
                ->addFormItem('service_cost', 'text', '劳务费', '*单位:元')
                ->addFormItem('advisory_cost', 'text', '专家咨询费', '*单位:元')
                ->addFormItem('other_cost', 'text', '其他费用', '*单位:元')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->setExtraHtml($html)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '项目预算')
                ->content($content);
        }
    }

    /**
     * @param $sd   开始时间
     * @param $ed   结束时间
     * @return mixed
     * 计算两个时间的相差天数
     */
    function calculateDays($sd, $ed)
    {
        $days = \date_diff(\date_create($sd), \date_create($ed))->days;
        return $days;
    }

    function projectInfo()
    {
        $project_id = \input('project_id');
        $info = ParkProjectBudgetList::get($project_id);
        $res = [
            'code' => 1,
            'data' => $info,
            'msg' => 'OK',
        ];
        return \json($res);
    }
}
