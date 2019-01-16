<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/16
 * Time: 11:12
 */

namespace app\park_enterprise_finance_info\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_finance_info\model\ParkEnterpriseFinanceInfo;
use think\Db;

/**
 * Class Finance
 * @package app\park_enterprise_finance_info\admin
 * 企业财务信息控制器
 */
class Finance extends Admin
{
    /**
     * @var
     * 财务信息模型
     */
    protected $financeModel;
    /**
     * @var
     * 企业列表
     */
    protected $enterpriseList;
    /**
     * @var
     * 本年度年份
     */
    protected $year;
    /**
     * @var
     * 下拉框用的年度列表
     */
    protected $yearList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->financeModel = new ParkEnterpriseFinanceInfo();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
        $this->year = \date('Y');
        $yearList = Db::name('ParkEnterpriseFinanceInfo')
            ->column('year');
        $this->yearList = \array_combine($yearList, $yearList);
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        list($data_list, $total) = $this->financeModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('year', '年度')
            ->keyListItem('income', '收入(元)')
            ->keyListItem('profit', '利润(元)')
            ->keyListItem('tax', '税收(元)')
            ->keyListItem('liabilities', '负债(元)')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkEnterpriseFinanceInfo'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('企业财务信息')
            ->search([
                ['name' => 'year', 'type' => 'select', 'title' => '年度', 'options' => $this->yearList
                ],
                ['name' => 'keyword',
                    'type' => 'text', 'extra_attr' => 'placeholder="输入企业名称"'],
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加/编辑信息
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->financeModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->financeModel->getError());
            }
        } else {
            $info = [
                'year' => $this->year,
                'liabilities' => 0.00,
            ];
            if ($id > 0) {
                $info = ParkEnterpriseFinanceInfo::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '企业名称', '请选择企业(企业管理中添加)', $this->enterpriseList)
                ->addFormItem('year', 'text', '年度', '默认为本年度', $this->year)
                ->addFormItem('income', 'text', '收入(元)','必须是数字,默认保留两位小数')
                ->addFormItem('profit', 'text', '利润(元)','必须是数字,默认保留两位小数')
                ->addFormItem('tax', 'text', '税收(元)','必须是数字,默认保留两位小数')
                ->addFormItem('liabilities', 'text', '负债(元)','必须是数字,默认保留两位小数')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '企业财务信息')
                ->content($content);
        }
    }
}