<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getBuildNameByBuildId')) {
    /**
     * @param $parkName
     * @param $buildName
     * @return mixed
     * 根据园区名称获取园区ID，再获取该园区内的楼宇id
     */
    function getBuildIdByBuildName($parkName, $buildName)
    {
        if ($parkName == '同济科技园沪西园区') {
            $parkId = 1;
        }
        $id = Db::name('ParkBuilding')
            ->where('park', $parkId)
            ->where('title', 'eq', $buildName)
            ->value('id');
        return $id;
    }
}
if (!function_exists('getEnterpriseIdByEnterpriseName')) {
    /**
     * @param $enterpriseName
     * @return mixed|null
     * 根据企业名称获取企业ID
     */
    function getEnterpriseIdByEnterpriseName($enterpriseName)
    {
        $id = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_name', 'eq', trim($enterpriseName))
            ->value('id');
        if (empty($id)) {
            return 0;
        } else {
            return $id;
        }
    }
}

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
    if (empty($name)) {
        return '未知企业';
    } else {
        return $name;
    }
}

if (!function_exists('getRoomIdByEnterpriseId')) {
    /**
     * @param $enterprise_id
     * @return mixed
     * 根据企业id获取房间id
     */
    function getRoomIdByEnterpriseId($enterprise_id)
    {
        $room_id = Db::name('ParkEnterpriseEntryInfo')
            ->where('enterprise_id', 'eq', $enterprise_id)
            ->value('room_number');
        return $room_id;
    }
}

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
