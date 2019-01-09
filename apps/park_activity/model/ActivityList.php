<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/21
 * Time: 17:08
 */

namespace app\park_activity\model;


use app\common\model\Base;

/**
 * Class ActivityList
 * @package app\park_activity\model
 */
class ActivityList extends Base
{


    /**
     * @param $value
     * @param $data
     * @return mixed|string
     * 活动标记中文
     * bug,禁用的时候会返回'未知',原因未知,用自定义函数取代
     */
    public function getActivityStatusTextAttr($value, $data)
    {
        $status = [
            1 => '置顶',
            2 => '推荐',
            3 => '火爆',
        ];

        return isset($status[$data['status']]) ? $status[$data['status']] : '未知';
    }
}