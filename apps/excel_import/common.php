<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getBuildNameByBuildId')) {
    function getBuildIdByBuildName($name)
    {
        $id = Db::name('ParkBuilding')
            ->where('title', 'eq', $name)
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
