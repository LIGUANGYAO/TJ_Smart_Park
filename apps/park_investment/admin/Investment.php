<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/15
 * Time: 11:53
 */

namespace app\park_investment\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_investment\model\ParkInvestmentList;
use think\Db;

/**
 * Class Investment
 * @package app\park_investment\admin
 * 投资管理控制器
 */
class Investment extends Admin
{
    /**
     * @var
     * 投资列表模型
     */
    protected $investModel;
    /**
     * @var
     * 企业列表
     */
    protected $enterpriseList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->investModel = new ParkInvestmentList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 列表页
     */
    public function index()
    {
        list($data_list, $total) = $this->investModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('输入企业名称')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('type', '投资类型', 'array', [1 => '贷款', 2 => '企业投资人投资', 3 => '个人投资人投资'])
            ->keyListItem('amount', '投资金额')
            ->keyListItem('is_mortgage', '是否抵押', 'array', [1 => '是', 2 => '否'])
            ->keyListItem('percent', '所占比例')
            ->keyListItem('start_time', '开始时间')
            ->keyListItem('end_time', '结束时间')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkInvestmentList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('投资信息列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名"',
                ]
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/新增投资
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->investModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {
            $info = [
                'type' => 1,
                'is_mortgage' => 2,
            ];
            if ($id > 0) {
                $info = ParkInvestmentList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '企业', '请选择企业', $this->enterpriseList)
                ->addFormItem('type', 'select', '投资类型', '选择投资类型', [1 => '贷款', 2 => '企业投资人投资', 3 => '个人投资人投资'])
                ->addFormItem('amount', 'text', '投资金额','必须输入数字')
                ->addFormItem('is_mortgage', 'radio', '是否抵押', '', [1 => '是', 2 => '否'])
                ->addFormItem('percent', 'text', '所占比例')
                ->addFormItem('start_time', 'datetime', '开始时间')
                ->addFormItem('end_time', 'datetime', '结束时间')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '孵化企业')
                ->content($content);
        }

    }
}