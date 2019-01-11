<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/11
 * Time: 14:08
 */

namespace app\software_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\software_enterprise\model\ParkSoftEnterpriseList;
use app\software_enterprise\model\ParkSoftProjectList;
use think\Db;

/**
 * Class EnterpriseList
 * @package app\software_enterprise\admin
 * 软件企业控制器
 */
class EnterpriseList extends Admin
{
    /**
     * @var
     * 软件企业模型
     */
    protected $softModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->softModel = new ParkSoftEnterpriseList();
    }

    /**
     * @return \app\common\layout\Content
     * 软件企业列表
     */
    public function index()
    {
        list($data_list, $total) = $this->softModel->search([
            'keyword_condition' => 'enterprise_name',
        ])
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('delete', ['model' => 'ParkSoftEnterpriseList'])
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('self', ['title' => '添加项目', 'class' => 'btn btn-success btn-xs', 'href' => url('add_project', ['id' => '__data_id__'])])
            ->addRightButton('delete', ['model' => 'ParkSoftEnterpriseList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('孵化企业列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名"',
                ]
            ])
            ->content($content);
    }

    /**
     * @return \app\common\layout\Content
     * 添加软件项目
     */
    public function add_project()
    {
        $param = \input();
        $enterprise_id = Db::name('ParkSoftEnterpriseList')
            ->where('id', $param['id'])
            ->value('enterprise_id');
        $param['enterprise_name'] = Db::name('ParkSoftEnterpriseList')
            ->where('enterprise_id', 'eq', $enterprise_id)
            ->value('enterprise_name');
        //软件企业列表
        $enterpriseList = Db::name('ParkSoftEnterpriseList')
            ->column('enterprise_id,enterprise_name');
        if (IS_POST) {
            if ((new ParkSoftProjectList())->editData($param)) {
                $this->success('添加项目成功', \url('software_enterprise/soft_list/index'));
            } else {
                $this->error('添加项目失败');
            }
        } else {
            $info = [
                'enterprise_id' => $enterprise_id,
            ];
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
            ->setMetaTitle('添加软件项目')
            ->content($content);
    }
}