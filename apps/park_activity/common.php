<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getActivityStatusName')) {
    /**
     * @param $id
     * @return string
     * 获取活动标记的中文
     */
    function getActivityStatusName($id)
    {
        switch ($id) {
            case 1:
                return '置顶';
                break;
            case 2:
                return '推荐';
                break;
            case 3:
                return '火爆';
                break;
            default:
                return '未知';
                break;
        }
    }
}

if (!function_exists('getActivityNameById')) {
    /**
     * @param $id
     * @return mixed
     * 根据活动ID获取活动名称
     */
    function getActivityNameById($id)
    {
        $name = Db::name('ActivityList')
            ->where('id', $id)
            ->value('title');
        return $name;
    }
}

if (!function_exists('getUserNameById')) {
    /**
     * @param $uid
     * @return mixed
     * 根据用户ID获取用户名
     */
    function getUserNameById($uid)
    {
        $name = Db::name('Users')
            ->where('uid', $uid)
            ->value('username');
        return $name;
    }
}

if (!function_exists('getApplyStatusName')) {
    /**
     * @param $status_id
     * @return string
     * 返回报名状态的中文
     */
    function getApplyStatusName($status_id)
    {
        switch ($status_id) {
            case 1:
                return '待确认';
                break;
            case 2:
                return '已通过';
                break;
            case 3:
                return '已拒绝';
                break;
            default:
                return '未知';
                break;
        }
    }
}