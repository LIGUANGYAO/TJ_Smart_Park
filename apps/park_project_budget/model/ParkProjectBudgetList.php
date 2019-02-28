<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/16
 * Time: 9:49
 */

namespace app\park_project_budget\model;


use app\common\model\Base;
use think\Db;

/**
 * Class ParkProjectBudgetList
 * @package app\park_project_budget\model
 * 项目列表模型层
 */
class ParkProjectBudgetList extends Base
{
    /**
     * @param $value
     * @return mixed
     * 返回type中文名
     */
    public function getTypeAttr($value)
    {
        $type = Db::name('ParkProjectBudgetCategory')
            ->where('type', 'eq', 1)
            ->column('id,name');;
        return $type[$value];
    }

    /**
     * @param $value
     * @return mixed
     * 返回状态中文名
     */
    public function getProjectStatusAttr($value)
    {
        $project_status = [1 => '未执行', 2 => '执行中', 3 => '执行完毕'];
        return $project_status[$value];
    }
}
