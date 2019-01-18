<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/18
 * Time: 10:03
 */

namespace app\high_tech_project\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\high_tech_project\model\HighTechProjectList;
use think\Db;

/**
 * Class Index
 * @package app\high_tech_project\admin
 * 高新技术项目控制器
 */
class Index extends Admin
{
    /**
     * @var
     * 高新技术项目模型
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
        $this->techModel = new HighTechProjectList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    /**
     * @return \app\common\layout\Content
     * 项目列表
     */
    public function index()
    {
        list($data_list, $total) = $this->techModel
            ->search(['keyword_condition' => 'enterprise_name',])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('project', '项目名称')
            ->keyListItem('project_time', '立项时间')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'HighTechProjectList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('高新技术成果转化项目列表')
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
     * 添加/编辑项目
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
                $this->error($this->techModel->getError());
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = HighTechProjectList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'select', '选择企业', '', $this->enterpriseList)
                ->addFormItem('project', 'text', '项目名称')
                ->addFormItem('project_time', 'datetime', '立项时间')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '高新技术转化成果')
                ->content($content);
        }
    }
}