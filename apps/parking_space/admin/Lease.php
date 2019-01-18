<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/18
 * Time: 13:38
 */

namespace app\parking_space\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\parking_space\model\ParkingSpaceLeaseList;
use think\Db;

/**
 * Class Lease
 * @package app\parking_space\admin
 * 车位租赁控制器
 */
class Lease extends Admin
{
    /**
     * @var
     * 车位租赁模型
     */
    protected $leaseModel;
    /**
     * @var
     * 企业列表
     */
    protected $enterpriseList;

    /**
     * @var
     * 缴费周期
     */
    protected $period;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->leaseModel = new ParkingSpaceLeaseList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
        $this->period = \config('parking_space_period');
    }

    /**
     * @return \app\common\layout\Content
     * 租赁列表
     */
    public function index()
    {
        list($data_list, $total) = $this->leaseModel
            ->search(['keyword_condition' => 'enterprise_name|space',])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('输入企业名称或者车位号')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('space', '车位号')
            ->keyListItem('lease_status', '租赁状态', 'array', [1 => '到期', 2 => '未到期'])
            ->keyListItem('s_date', '起始日期')
            ->keyListItem('e_date', '结束日期')
            ->keyListItem('amount', '总费用')
            ->keyListItem('period', '缴费周期', 'array', $this->period)
            ->keyListItem('pay_time', '缴费时间')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkingSpaceLeaseList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('停车位租赁列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text', 'extra_attr' => 'placeholder="输入企业名称或者车位号"'],
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加/编辑租赁
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->leaseModel->editData($param)) {
                //修改车位列表中的状态
                Db::name('ParkingSpaceList')
                    ->where('numbering', 'eq', \trim($param['space']))
                    ->setField('space_status', 1);
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->leaseModel->getError());
            }
        } else {
            $info = [
                'lease_status' => 2
            ];
            if ($id > 0) {
                $info = ParkingSpaceLeaseList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('space', 'text', '车位号', '请填写正确的车位号')
                ->addFormItem('enterprise_id', 'select', '选择企业', '', $this->enterpriseList)
                ->addFormItem('s_date', 'datetime', '租赁起始日')
                ->addFormItem('e_date', 'datetime', '租赁截止日')
                ->addFormItem('period', 'select', '缴费周期', '', $this->period)
                //->addFormItem('lease_status', 'radio', '租赁状态', '', [1 => '到期', 2 => '未到期'])
                ->addFormItem('pay_time', 'datetime', '缴费时间')
                ->addFormItem('amount', 'text', '总费用', '请输入数字')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '车位租赁')
                ->content($content);
        }
    }
}