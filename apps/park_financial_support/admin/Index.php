<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 17:03
 */

namespace app\park_financial_support\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_financial_support\model\ParkEnterpriseFinanceSupport;
use think\Db;

/**
 * Class Index
 * @package app\park_financial_support\admin
 * 财政扶持控制器
 */
class Index extends Admin
{
    /**
     * @var
     * 扶持列表模型
     */
    protected $supportModel;
    /**
     * @var
     * 企业列表,源于企业管理添加
     */
    protected $enterpriseList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->supportModel = new ParkEnterpriseFinanceSupport();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 扶持列表
     */
    public function index()
    {
        list($data_list, $total) = $this->supportModel
            ->search(['keyword_condition' => 'enterprise_name',])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('vat', '增值税')
            ->keyListItem('income_tax', '所得税')
            ->keyListItem('is_support', '是否扶持', 'array', [1 => '是', 2 => '否'])
            ->keyListItem('support', '扶持金额')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkEnterpriseFinanceSupport'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('财政扶持列表')
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
     * 添加/编辑扶持
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            $param['support'] = ($param['vat'] * 0.325 + $param['income_tax'] * 0.2) * 0.7 * 0.7 * 0.5;
            if ($this->supportModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->supportModel->getError());
            }
        } else {
            $info = [
                'is_support' => 1,
            ];
            if ($id > 0) {
                $info = ParkEnterpriseFinanceSupport::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '选择企业', '', $this->enterpriseList)
                ->addFormItem('vat', 'text', '增值税')
                ->addFormItem('income_tax', 'text', '所得税')
                //->addFormItem('support', 'text', '扶持金额', '由系统自动计算')
                ->addFormItem('is_support', 'radio', '是否扶持', '', [1 => '是', 2 => '否'])
                ->addFormItem('marks', 'textarea', '备注')
                ->setPageTips('<code>扶持金额由系统自动计算,无需手动输入:(增值税*0.325+所得税*0.2)*0.7*0.7*0.5</code>')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '财政扶持')
                ->content($content);
        }
    }
}