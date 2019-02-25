<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/25
 * Time: 9:39
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\excel_import\model\CostRentPropertyList;
use think\Db;

/**
 * Class Rentproperty
 * @package app\excel_import\admin
 * 房租物业控制器
 */
class Rentproperty extends Admin
{
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
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->feeType = [
            1 => '房租',
            2 => '物业'
        ];
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 费用列表
     */
    public function index()
    {
        $export = [
            'icon' => 'fa fa-folder-open-o',
            'title' => '导出列表',
            'class' => 'btn btn-default btn-sm',
            'href' => url('import')
        ];
        list($data_list, $total) = (new CostRentPropertyList())->search()->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('self', $export)
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('room_id', '房间号')
            ->keyListItem('type', '类别', 'array', $this->feeType)
            ->keyListItem('s_day', '起始日期')
            ->keyListItem('e_day', '结束日期')
            ->keyListItem('fee_amount', '总金额')
            ->keyListItem('pay_time', '缴费日期')
            ->keyListItem('pay_status', '是否已缴费', 'array', [1 => '已缴费', 2 => '未缴费'])
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('delete', ['model' => 'CostRentPropertyList'])
            ->setListData($data_list)
            ->setListPage($total, 10)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"',],
                ['name' => 'pay_status', 'type' => 'select', 'title' => '按缴费状态', 'options' => [1 => '已缴费', 2 => '未缴费']],
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加编辑费用
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ((new CostRentPropertyList())->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error((new CostRentPropertyList())->getError());
            }
        } else {
            $info = [
                'pay_status' => 1
            ];
            if ($id > 0) {
                $info = CostRentPropertyList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '选择企业', '', $this->enterpriseList)
                ->addFormItem('s_day', 'date', '起始日期')
                ->addFormItem('e_day', 'date', '结束日期')
                ->addFormItem('pay_status', 'radio', '缴费状态', '选择缴费状态', [1 => '已缴费', 0 => '未缴费'])
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
