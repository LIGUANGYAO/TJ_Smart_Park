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
            return '未知企业';
        } else {
            return $name;
        }
    }
}