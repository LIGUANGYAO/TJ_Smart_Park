<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/25
 * Time: 15:37
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\excel_import\model\CostOtherFeeList;
use think\Db;

/**
 * Class Other
 * @package app\excel_import\admin
 * 其他费用控制器
 */
class Other extends Admin
{
    /**
     * @var
     * 其他费用模型
     */
    protected $otherModel;
    /**
     * @var
     * 费用类别
     */
    protected $feeType;
    /**
     * @var
     * 企业列表
     */
    protected $enterpriseList;

    /**
     *
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->otherModel = new CostOtherFeeList();
        $this->feeType = Db::name('CostFeeType')
            ->where('status', 'eq', 1)
            ->column('id,name');
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
        $this->enterpriseList['0'] = '其他企业';
    }

    /**
     * @return \app\common\layout\Content
     * 费用列表
     */
    public function index()
    {
        list($data_list, $total) = $this->otherModel->search()->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '公司名称')
            ->keyListItem('room', '房间号')
            ->keyListItem('fee_type', '费用类型', 'array', $this->feeType)
            ->keyListItem('amount', '应缴金额')
            ->keyListItem('is_paid', '是否缴费', 'array', [1 => '是', 0 => '否'])
            ->keyListItem('pay_time', '缴费时间')
            ->keyListItem('real_amount', '实际缴费')
            ->keyListItem('handler', '操作人', 'callback', 'getAdminNameByAdminId')
            ->keyListItem('marks', '备注')
            ->setListData($data_list)
            ->setListPage($total, 10)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"',],
                ['name' => 'is_paid', 'type' => 'select', 'title' => '按缴费状态', 'options' => [1 => '已缴费', 2 => '未缴费']],
            ])
            ->setMetaTitle('其他费用管理')
            ->content($content);
    }

    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($param['enterprise_id'] != 0) {
                $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            }
            if (empty($param['room'])) {
                $param['room'] = getRoomIdByEnterpriseId($param['enterprise_id']);
            }
            $param['handler'] = \session('admin_login_auth.uid');
            if ($this->otherModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->otherModel->getError());
            }
        } else {
            $info = [
                'enterprise_id' => 0,//手动输入的企业id=0
                'is_paid' => 1,
            ];
            if ($id > 0) {
                $info = CostOtherFeeList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '选择企业', '非园区入驻企业请选择其他企业', $this->enterpriseList)
                ->addFormItem('enterprise_name', 'text', '企业名称', '非园区入驻企业请手动输入')
                ->addFormItem('fee_type', 'select', '选择费用类型', '', $this->feeType)
                ->addFormItem('room', 'text', '房间号','非园区入驻企业需手动输入')
                ->addFormItem('amount', 'text', '缴费金额')
                ->addFormItem('real_amount', 'text', '实缴金额')
                ->addFormItem('is_paid', 'radio', '是否缴费', '', [1 => '是', 0 => '否'])
                ->addFormItem('pay_time', 'datetime', '缴费时间')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '费用')
                ->content($content);
        }
    }
}
