<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getAdminNameByAdminId')) {
    /**
     * @param $admin_id
     * @return mixed
     * 根据管理员ID获取管理员用户名
     */
    function getAdminNameByAdminId($admin_id)
    {
        $admin_name = Db::name('Admin')
            ->where('uid', $admin_id)
            ->value('username');
        return $admin_name;
    }
}
