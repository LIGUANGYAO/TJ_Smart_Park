<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/15
 * Time: 11:53
 */

namespace app\park_investment\admin;


use app\admin\controller\Admin;
use app\park_investment\model\ParkInvestmentList;
use think\Db;

/**
 * Class Investment
 * @package app\park_investment\admin
 * 投资管理控制器
 */
class Investment extends Admin
{
    /**
     * @var
     * 投资列表模型
     */
    protected $investModel;
    /**
     * @var
     * 企业列表
     */
    protected $enterpriseList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->investModel = new ParkInvestmentList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    public function index()
    {

    }
}