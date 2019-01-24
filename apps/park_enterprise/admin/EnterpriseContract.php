<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/5
 * Time: 14:14
 */

namespace app\park_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise\model\ParkEnterpriseContract;
use think\Db;

/**
 * Class EnterpriseContract
 * @package app\park_enterprise\admin
 * 合同管理控制器
 */
class EnterpriseContract extends Admin
{
    /**
     * @var
     * 合同模型
     */
    protected $contractModel;
    /**
     * @var
     * 办公项目
     */
    protected $contractType;
    /**
     * @var
     * 是否到期
     */
    protected $expirationText;
    /**
     * @var
     * 缴费周期
     */
    protected $jiaofeiPeriodText;

    /**
     * @var
     * 合同期限
     */
    protected $contract_period;
    /**
     * @var
     * 是否续签合同
     */
    protected $continuousText;
    /**
     * @var
     * 是否退租
     */
    protected $withdrawText;

    /**
     * @var
     * 企业名称列表
     */
    protected $enterpriseNameList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->contractModel = new ParkEnterpriseContract();
        $this->contractType = [
            1 => '办公室合同',
        ];
        $this->expirationText = [
            0 => '未到期',
            1 => '已到期',
        ];
        $this->jiaofeiPeriodText = [
            1 => '半年缴',
            2 => '季度缴',
            3 => '一年缴',
            4 => '二年缴',
            5 => '三年缴',
            6 => '五年缴',
        ];
        $this->contract_period = [
            1 => '一年',
            2 => '两年',
            3 => '三年',
            4 => '四年',
            5 => '五年',
        ];
        $this->continuousText = [
            0 => '否',
            1 => '是',
        ];
        $this->withdrawText = [
            0 => '未退租',
            1 => '已退租',
        ];
        $this->enterpriseNameList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('合同列表')
            ->search([
                ['name' => 'expiration', 'type' => 'select', 'title' => '合同到期', 'options' => $this->expirationText
                ],
                ['name' => 'contract_type', 'type' => 'select', 'title' => '合同项目', 'options' => $this->contractType],
                ['name' => 'withdraw', 'type' => 'select', 'title' => '是否退租', 'options' => $this->withdrawText],
                ['name' => 'keyword',
                    'type' => 'text', 'extra_attr' => 'placeholder="输入企业名称或者合同编号"'],
            ])
            ->content($this->grid());
    }

    /**
     * @return \app\common\layout\Content
     * 表格内容
     */
    public function grid()
    {
        $search_setting = $this->buildModelSearchSetting();
        list($data_list, $total) = $this->contractModel
            ->search($search_setting)
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete', ['model' => 'ParkEnterpriseContract'])
            ->setSearch('请输入关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('numbering', '合同编号')
            ->keyListItem('room_number', '门牌号')
//            ->keyListItem('miaopu_number', '苗圃工位')
            ->keyListItem('contract_type', '合同项目', 'array', $this->contractType)
            ->keyListItem('margin', '保证金')
            ->keyListItem('start_day', '开始日期')
            ->keyListItem('end_day', '结束日期')
            ->keyListItem('expiration', '是否到期', 'array', $this->expirationText)
            ->keyListItem('jiaofei_period', '缴费周期', 'array', $this->jiaofeiPeriodText)
//            ->keyListItem('continuous', '是否续签合同', 'array', $this->continuousText)
//            ->keyListItem('withdraw', '是否退租', 'array', $this->withdrawText)
//            ->keyListItem('withdraw_money', '退租金额')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkEnterpriseContract'])
//            ->addRightButton('self', $renew)
            ->fetch();

        return $content;
    }

    /**
     * @return array
     * 搜索条件
     */
    private function buildModelSearchSetting()
    {
        $search_setting = [
            'keyword_condition' => 'numbering|enterprise_name',
        ];
        return $search_setting;
    }

    /**
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 新增/编辑租房合同
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';

        if (IS_POST) {
            $param = \input('param.');
            //todo数据校验
            if ($this->contractModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($title . '失败');
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = ParkEnterpriseContract::get($id);
            }
            $return = (new BuilderForm())
                ->addFormItem('enterprise_name', 'text', '企业名称')
                ->addFormItem('contract_type', 'select', '项目名称', '', $this->contractType)
                ->addFormItem('total_fee', 'text', '总费用', '(单位:元,包含物业费)')
                ->addFormItem('real_fee', 'text', '实际费用', '(单位:元,包含物业费)')
                ->addFormItem('paid_day', 'datetime', '支付时间')
                ->addFormItem('contract_period', 'select', '合同期限', '', $this->contract_period)
                ->addFormItem('start_day', 'datetime', '合同生效日期')
                ->addFormItem('end_day', 'datetime', '合同结束日期')
                ->addFormItem('fangzu_pic', 'pictures', '房租合同', '上传合同图片')
//                ->addFormItem('caiwudaili_pic', 'pictures', '财务代理合同', '上传合同图片')
                ->addFormItem('numbering', 'text', '合同编号', '手动输入合同编号')
                ->addFormItem('contractor', 'text', '合同签订人')
                ->addFormItem('contractor_tel', 'text', '签订人电话')
                ->addFormItem('handler', 'text', '操作人')
                ->addFormItem('issuer', 'text', '开票人')
                ->addFormItem('confirmor', 'text', '确认人')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle('续约合同')
                ->content($return);
        }
    }
}