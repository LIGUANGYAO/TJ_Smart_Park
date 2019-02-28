<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/28
 * Time: 11:50
 */

namespace app\park_project_budget\model;


use app\common\model\Base;

class ParkProjectBudgetComplyList extends Base
{
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
