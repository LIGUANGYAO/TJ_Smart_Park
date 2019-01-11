<?php

/**
 * Project:www.tongji.gov
 * Editor:xpwsg
 * Time:10:28
 * Date:2019/1/11
 */

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

if (!function_exists('getEnterpriseNameByEnterpriseId')) {

    /**
     * @param $enterprise_id
     * @return mixed
     * 根据企业ID返回企业名称
     */
    function getEnterpriseNameByEnterpriseId($enterprise_id)
    {
        $name = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('id', 'eq', $enterprise_id)
            ->value('enterprise_name');
        if (empty($name)){
            return '未知企业';
        }else{
            return $name;
        }
    }
}