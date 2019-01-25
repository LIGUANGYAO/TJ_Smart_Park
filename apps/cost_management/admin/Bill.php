<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/19
 * Time: 10:56
 */

namespace app\cost_management\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\cost_management\model\CostBillList;
use think\Db;

/**
 * Class Bill
 * @package app\cost_management\admin
 * 账单控制器
 */
class Bill extends Admin
{
    /**
     * @var
     * 账单模型
     *
     */
    protected $billModel;
    /**
     * @var
     * 费用类型
     */
    protected $billType;
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
        $this->billModel = new CostBillList();
        $this->billType = Db::name('CostCategoryList')
            ->where('status', 'eq', 1)
            ->column('id,name');
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
        $this->enterpriseList[0] = '其他';
    }

    /**
     * @return \app\common\layout\Content
     * 账单列表
     */
    public function index()
    {
        $import = [
            'icon' => 'fa fa-folder-open-o',
            'title' => '导入',
            'class' => 'btn btn-default btn-sm',
            'href' => url('import')
        ];
        list($data_list, $total) = $this->billModel->search(['keyword_condition' => 'enterprise_name',])->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete', ['model' => 'CostBillList'])
            ->addTopButton('self', $import)
            ->keyListItem('id', 'ID')
            ->keyListItem('bill_type', '费用类型', 'array', $this->billType)
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('bill_time', '账单时间')
            ->keyListItem('bill_status', '状态', 'array', [1 => '已缴费', 2 => '未缴费'])
            ->keyListItem('amount', '总费用')
            ->keyListItem('real_amount', '实际支付')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'CostBillList'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('账单列表')
            ->search([
                ['name' => 'bill_type', 'type' => 'select', 'title' => '账单类型', 'options' => $this->billType],
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
     * 添加/编辑账单
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->billModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->billModel->getError());
            }
        } else {
            $info = [
                'bill_status' => 2,
            ];
            if ($id > 0) {
                $info = CostBillList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('bill_type', 'select', '费用类型', '', $this->billType)
                ->addFormItem('enterprise_id', 'select', '公司名', '', $this->enterpriseList)
                ->addFormItem('bill_time', 'text', '账单日期')
                ->addFormItem('bill_status', 'radio', '状态', '', [1 => '已缴费', 2 => '未缴费'])
                ->addFormItem('amount', 'text', '总费用')
                ->addFormItem('real_amount', 'text', '实际支付')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '账单')
                ->content($content);
        }
    }

    /**
     * @return \think\response\Json
     * 表格导入示例
     */
    public function import()
    {
        $url = '/admin.php/cost_management/bill/import';
        $Data = hook('importFromTable', $url, true);
        if (!empty($Data[0])) {

            //组装需要入库的数组，从Data中取值
            //todo
            $sqlData = [
                'bill_type' => 1,
                'enterprise_id' => \getEnterpriseIdByEnterpriseName($Data[0][1][2]),
                'enterprise_name' => \trim($Data[0][1][2]),
                'bill_time' => \date('Y-m-d H:i:s'),
                'bill_status' => 1,
                'amount' => 200,
                'real_amount' => 180,
                'marks' => '表格导入测试',
            ];

            //校验数据完整性
            //todo
            $res = Db::name('CostBillList')->insert($sqlData);
            if ($res > 0) {
                return json(['state' => 1, 'msg' => '处理成功']);
            } else {
                return json(['state' => 0, 'msg' => '处理错误']);
            }
        }
    }
}