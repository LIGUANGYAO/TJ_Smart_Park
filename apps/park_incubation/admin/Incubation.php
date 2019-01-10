<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/10
 * Time: 16:52
 */

namespace app\park_incubation\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_incubation\model\ParkIncubationList;

/**
 * Class Incubation
 * @package app\park_incubation\admin
 * 孵化企业控制器
 */
class Incubation extends Admin
{
    /**
     * @var
     * 孵化企业模型
     */
    protected $incubationModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->incubationModel = new ParkIncubationList();
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        //获取页面需要的数据
        list($data_list, $total) = $this->incubationModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('entry_time', '入孵时间')
            ->keyListItem('enterprise_status', '状态')
            ->keyListItem('out_time', '退出时间')
            ->keyListItem('liaison', '联络员')
            ->keyListItem('counselor', '辅导员')
            ->keyListItem('entrepreneurship_tutor', '创业导师')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkIncubationList'])
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