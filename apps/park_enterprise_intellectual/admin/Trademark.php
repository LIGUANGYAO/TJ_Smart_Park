<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/16
 * Time: 16:00
 */

namespace app\park_enterprise_intellectual\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual\model\ParkEnterpriseTrademarkList;

/**
 * Class Trademark
 * @package app\park_enterprise_intellectual_property\admin
 * 企业商标控制器
 */
class Trademark extends Admin
{
    /**
     * @var
     * 商标模型
     */
    protected $tmModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->tmModel = new ParkEnterpriseTrademarkList();
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        list($data_list, $total) = $this->tmModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('image_url', '商标LOGO', 'callback', 'displayRemoteImage')
            ->keyListItem('name', '商标名称')
            ->keyListItem('tm_status', '状态')
            ->keyListItem('app_date', '申请日期')
            ->keyListItem('reg_no', '注册号')
            ->keyListItem('intcis', '国际分类')
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