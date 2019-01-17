<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 11:12
 */

namespace app\park_enterprise_intellectual_property\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual_property\model\ParkEnterprisePatentList;

/**
 * Class Patent
 * @package app\park_enterprise_intellectual_property\admin
 * 企业专利控制器
 */
class Patent extends Admin
{
    /**
     * @var
     * 专利模型
     */
    protected $patentModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->patentModel = new ParkEnterprisePatentList();
    }

    /**
     * @return \app\common\layout\Content
     * 专利列表
     */
    public function index()
    {
        list($data_list, $total) = $this->patentModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('name', '名称')
            ->keyListItem('type', '专利类型')
            ->keyListItem('publication_number', '公开号')
            ->keyListItem('publication_date', '公开日期')
            ->setPageTips('<code>数据来源于企查查,无需人工干预</code>')
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="输入企业名称"']
            ])
            ->content($content);
    }
}