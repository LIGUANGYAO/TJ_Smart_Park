<?php
//模块自定义函数文件
use think\Db;

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
        if (empty($name)) {
            return '其他企业';
        } else {
            return $name;
        }
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
            return null;
        } else {
            return $id;
        }
    }
}