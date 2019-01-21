<?php

use app\service_laboratory\model\ServiceLaboratoryList;

if (!function_exists('getLaboratoryAddress')) {
    /**
     * @param $labo_id
     * @return string
     * @throws \think\exception\DbException
     * 返回拼接好的实验室地址
     */
    function getLaboratoryAddress($labo_id)
    {
        $laboInfo = ServiceLaboratoryList::get($labo_id);
        $type = getLaboratoryType($laboInfo['type']);
        return $laboInfo['building_id'] . '号楼' . $laboInfo['room_number'] . '室' . "($type)";
    }

    /**
     * @param $labo_type_id
     * @return string
     * 返回实验室类型的中文
     */
    function getLaboratoryType($labo_type_id)
    {
        switch ($labo_type_id) {
            case 1:
                return "生物实验室";
                break;
            case 2:
                return '化学实验室';
                break;
            case 3:
                return '物理实验室';
                break;
            case 4:
                return '机械实验室';
                break;
            case 5:
                return '电气实验室';
                break;
            default:
                return '未知类型';
                break;
        }
    }
}