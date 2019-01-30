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
