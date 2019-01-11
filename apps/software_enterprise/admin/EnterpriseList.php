<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/11
 * Time: 14:08
 */

namespace app\software_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\software_enterprise\model\ParkSoftEnterpriseList;

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

        $projectAddBtn = [
            'icon' => 'fa fa-plus',
            'title' => '添加项目',
            'class' => 'btn btn-success btn-xs',
            'href' => url('software_enterprise/SoftList/edit')
        ];
        $content = (new BuilderList())
            ->addTopButton('delete', ['model' => 'ParkSoftEnterpriseList'])
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('self', $projectAddBtn)
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
}