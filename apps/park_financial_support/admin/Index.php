<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/17
 * Time: 17:03
 */

namespace app\park_financial_support\admin;


use app\admin\controller\Admin;
use app\park_financial_support\model\ParkEnterpriseFinanceSupport;
use think\Db;

class Index extends Admin
{
    protected $supportModel;
    protected $enterpriseList;

    public function _initialize()
    {
        parent::_initialize();
        $this->supportModel = new ParkEnterpriseFinanceSupport();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
    }

    public function index()
    {

    }

    public function edit()
    {

    }
}