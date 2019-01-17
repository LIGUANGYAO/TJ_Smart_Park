<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 13:55
 */

namespace app\park_enterprise_intellectual\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual\model\ParkEnterpriseEcicertificationList;

/**
 * Class Certificate
 * @package app\park_enterprise_intellectual_property\admin
 * 企业证书控制器
 */
class Certificate extends Admin
{
    /**
     * @var
     * 企业证书模型
     */
    protected $cerModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->cerModel = new ParkEnterpriseEcicertificationList();
    }

    /**
     * @return \app\common\layout\Content
     * 证书列表
     */
    public function index()
    {
        list($data_list, $total) = $this->cerModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('title', '证书名称')
            ->keyListItem('type', '证书类型')
            ->keyListItem('numbering', '证书编号')
            ->keyListItem('start_date', '证书生效时间')
            ->keyListItem('end_date', '证书截止日期')
            ->setPageTips('<code>数据来源于企查查,无需人工干预</code>')
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="输入企业名称"'],
            ])
            ->content($content);
    }
}