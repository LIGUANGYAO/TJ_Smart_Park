<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/11
 * Time: 14:32
 */

namespace app\software_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\software_enterprise\model\ParkSoftProjectList;
use think\Db;

/**
 * Class SoftList
 * @package app\software_enterprise\admin
 * 软件项目控制器
 */
class SoftList extends Admin
{
    /**
     * @var
     * 软件项目模型
     */
    protected $softModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->softModel = new ParkSoftProjectList();
    }


    /**
     * @return \app\common\layout\Content
     * 项目列表
     */
    public function index()
    {
        list($data_list, $total) = $this->softModel->search([
            'keyword_condition' => 'enterprise_name|project_name',
        ])
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete', ['model' => 'ParkSoftProjectList'])
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('project_name', '项目名称')
            ->keyListItem('start_time', '立项时间')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkSoftProjectList'])
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('软件项目列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名或者项目名称"',
                ],
            ])
            ->content($content);
    }


    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加/编辑企业项目
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        //软件企业列表
        $enterpriseList = Db::name('ParkSoftEnterpriseList')
            ->column('enterprise_id,enterprise_name');

        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = Db::name('ParkSoftEnterpriseList')
                ->where('enterprise_id', 'eq', $param['enterprise_id'])
                ->value('enterprise_name');
            if ($this->softModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = ParkSoftProjectList::get($id);
            }
        }

        $content = (new BuilderForm())
            ->addFormItem('id', 'hidden', 'ID')
            ->addFormItem('enterprise_id', 'select', '选择企业', '', $enterpriseList)
            ->addFormItem('project_name', 'text', '项目名称')
            ->addFormItem('start_time', 'datetime', '立项时间')
            ->addFormItem('marks', 'textarea', '备注')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();

        return (new Iframe())
            ->setMetaTitle($title . '软件项目')
            ->content($content);
    }
}