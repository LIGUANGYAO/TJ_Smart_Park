<?php 
//模块自定义函数文件
use think\Db;

if (!function_exists('getBuildingNameById')){
    /**
     * @param $id
     * @return mixed
     * 根据楼宇ID获取楼名称
     */
    function getBuildingNameById($id){
        $name = Db::name('ParkBuilding')
            ->where('id', $id)
            ->value('title');
        return $name;
    }
}

if (!function_exists('getEnterpriseNameById')){
    function getEnterpriseNameById($id){

    }
}