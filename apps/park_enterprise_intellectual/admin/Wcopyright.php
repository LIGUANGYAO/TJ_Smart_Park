<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 14:34
 */

namespace app\park_enterprise_intellectual\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise_intellectual\model\ParkEnterpriseWcopyrightList;

/**
 * Class Wcopyright
 * @package app\park_enterprise_intellectual_property\admin
 * 作品著作权控制器
 */
class Wcopyright extends Admin
{
    /**
     * @var
     * 作品著作权模型
     */
    protected $wModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->wModel = new ParkEnterpriseWcopyrightList();
    }

    /**
     * @return \app\common\layout\Content
     * 作品著作权列表
     */
    public function index()
    {
        list($data_list, $total) = $this->wModel
            ->search(['keyword_condition' => 'enterprise_name'])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('title', '作品名称')
            ->keyListItem('category', '类别')
            ->keyListItem('register_no', '登记号')
            ->keyListItem('publish_day', '首次发布日期')
            ->keyListItem('finish_day', '创作完成日期')
            ->keyListItem('register_day', '登记日期')
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