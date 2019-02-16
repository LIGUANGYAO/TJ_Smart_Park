<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getBuildingNameById')) {
    /**
     * @param $id
     * @return mixed
     * 根据楼宇ID获取楼名称
     */
    function getBuildingNameById($id)
    {
        $name = Db::name('ParkBuilding')
            ->where('id', $id)
            ->value('title');
        return $name;
    }
}

if (!function_exists('getRoomTypeText')) {
    /**
     * @param $type
     * @return string
     * 根据房间状态获取中文字符
     */
    function getRoomTypeText($type)
    {
        switch ($type) {
            case 1:
                return '办公';
                break;
            case 2:
                return '商铺';
                break;
            case 3:
                return '自用';
                break;
            case 4:
                return '会议室';
                break;
            case 5:
                return '苗圃';
                break;
            case 6:
                return '展览室';
                break;
            default:
                return '其他';
                break;
        }
    }
}

if (!function_exists('getRoomDecorationText')) {
    /**
     * @param $decoration
     * @return string
     * 返回房间装修状态的中文字符
     */
    function getRoomDecorationText($decoration)
    {
        if ($decoration == 1) {
            return '毛坯';
        } else {
            return '简装';
        }
    }
}

if (!function_exists('getBuildingNameById')) {
    /**
     * @param $id
     * @return mixed
     * 根据楼宇ID获取楼名称
     */
    function getBuildingNameById($id)
    {
        $name = Db::name('ParkBuilding')
            ->where('id', $id)
            ->value('title');
        return $name;
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
        if (empty($name)) {
            return '暂无企业';
        } else {
            return $name;
        }
    }
}

if (!function_exists('getRoomStatusText')) {
    /**
     * @param $room_status
     * @return string
     * 返回房间状态的中文
     */
    function getRoomStatusText($room_status)
    {
        $status_array = config('room_status');
        return $status_array[$room_status];
    }
}
if (!function_exists('getParkNameByParkId')) {
    /**
     * @param $park_id
     * @return mixed
     * 根据园区id获取园区名称
     */
    function getParkNameByParkId($park_id)
    {
        $park_list = config('park_list');
        return $park_list[$park_id];
    }
}
