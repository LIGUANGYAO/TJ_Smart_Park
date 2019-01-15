<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/15
 * Time: 15:16
 */

namespace app\tech_project\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\tech_project\model\TechProjectList;
use think\Db;

/**
 * Class Project
 * @package app\tech_project\admin
 * 科技项目控制器
 */
class Project extends Admin
{
    /**
     * @var
     * 科技项目模型
     */
    protected $techModel;
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
        $this->techModel = new TechProjectList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        list($data_list, $total) = $this->techModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('type', '投资类型', 'array', [1 => '贷款', 2 => '企业投资人投资', 3 => '个人投资人投资'])
            ->keyListItem('project', '项目名称')
            ->keyListItem('start_time', '开始时间')
            ->keyListItem('end_time', '结束时间')
            ->keyListItem('department', '立项委办局')
            ->keyListItem('amount', '获得资助资金额度')
            ->keyListItem('total', '项目总投入')
            ->keyListItem('pics', '荣誉证书', 'pictures')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkInvestmentList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('科技项目资金列表')
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
     * 新增/编辑
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->techModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {
            $info = [
                'type' => 1,
            ];
            if ($id > 0) {
                $info = TechProjectList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '企业名称', '请选择企业', $this->enterpriseList)
                ->addFormItem('type', 'select', '投资类型', '选择投资类型', [1 => '贷款', 2 => '企业投资人投资', 3 => '个人投资人投资'])
                ->addFormItem('project', 'text', '项目名称','请输入项目名称')
                ->addFormItem('start_time', 'datetime', '开始时间')
                ->addFormItem('end_time', 'datetime', '结束时间')
                ->addFormItem('department', 'text', '立项委办局')
                ->addFormItem('amount', 'text', '获得资助资金额度','必须输入数字')
                ->addFormItem('total', 'text', '项目总投入','必须输入数字')
                ->addFormItem('pics', 'pictures', '荣誉证书')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '科技项目')
                ->content($content);
        }
    }
}