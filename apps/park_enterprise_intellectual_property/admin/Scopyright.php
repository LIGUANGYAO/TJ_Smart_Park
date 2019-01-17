<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 14:55
 */

namespace app\park_enterprise_intellectual_property\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual_property\model\ParkEnterpriseScopyrightList;

/**
 * Class Scopyright
 * @package app\park_enterprise_intellectual_property\admin
 * 企业软件著作权控制器
 */
class Scopyright extends Admin
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
     * 软件著作权列表
     */
    public function index()
    {
        list($data_list, $total) = (new ParkEnterpriseScopyrightList())
            ->search(['keyword_condition' => 'enterprise_name'])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('title', '软件全称')
            ->keyListItem('shortname', '软件简称')
            ->keyListItem('version_no', '版本号')
            ->keyListItem('category', '类别')
            ->keyListItem('publish_day', '发布日期')
            ->keyListItem('register_no', '登记号')
            ->keyListItem('register_aper_day', '登记批准日期')
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