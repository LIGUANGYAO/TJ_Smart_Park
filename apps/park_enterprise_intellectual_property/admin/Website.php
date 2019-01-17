<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 15:14
 */

namespace app\park_enterprise_intellectual_property\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual_property\model\ParkEnterpriseWebsiteList;

/**
 * Class Website
 * @package app\park_enterprise_intellectual_property\admin
 * 网站信息控制器
 */
class Website extends Admin
{
    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * @return \app\common\layout\Content
     * 网站列表
     */
    public function index()
    {
        list($data_list, $total) = (new ParkEnterpriseWebsiteList())
            ->search(['keyword_condition' => 'enterprise_name'])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('title', '标题')
            ->keyListItem('home_site', '网址')
            ->keyListItem('yuming', '域名')
            ->keyListItem('beian', '备案')
            ->keyListItem('s_day', '审核日期')
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