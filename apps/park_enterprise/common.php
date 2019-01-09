<?php
//模块自定义函数文件
use app\admin\model\Modules;
use think\Db;

if (!function_exists('getRoomNumberByEnterpriseId')) {
    /**
     * @param $id
     * @return mixed
     * 根据企业ID获取入驻房间号
     */
    function getRoomNumberByEnterpriseId($id)
    {
        $room_number = Db::name('ParkEnterpriseEntryInfo')
            ->where('enterprise_id', $id)
            ->value('room_number');
        return $room_number;
    }
}

if (!function_exists('getBuildIdByEnterpriseId')) {
    /**
     * @param $id
     * @return mixed
     * 根据企业ID获取所在楼宇的名称
     * 懒得join了
     */
    function getBuildNameByEnterpriseId($id)
    {
        $build_id = Db::name('ParkEnterpriseEntryInfo')
            ->where('enterprise_id', $id)
            ->value('build_id');
        $build_name = Db::name('ParkBuilding')
            ->where('id', $build_id)
            ->value('title');
        return $build_name;
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

if (!function_exists('check_install_module_my')) {
    /**
     * @param $name
     * @return bool
     * @throws \think\Exception
     * 直接调用系统内置的这个方法会报错,自己写一个先替代
     */
    function check_install_module_my($name)
    {
        if ($name != '') {
            $res = Modules::where(['name' => $name, 'status' => 1])->count();
            if ($res > 0) {
                return true;
            }
        }
        return false;
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

if (!function_exists('getContractNumbering')) {

    /**
     * @param $build_id
     * @return string
     * @throws \think\Exception
     * 生成租房合同编号
     */
    function getFangZuContractNumbering($build_id)
    {
        //楼宇号
        $build_count = Db::name('ParkBuilding')->count();
        if ($build_count < 10) {
            $build_num = '0' . $build_id;
        } else {
            $build_num = $build_id;
        }
        $str = 'HT';
        //年份
        $year = date('Y');
        //本年度已有合同数量
        $contract_count = Db::name('ParkEnterpriseContract')
            ->whereTime('create_time', 'year')
            ->count();
        $num = substr((1000 + $contract_count + 1), 1);

        //最后的编号
        $numbering = $build_num . $str . $year . $num;
        return $numbering;
    }
}

if (!function_exists('getKuaijiContractNumbering')) {
    /**
     * @return string
     * @throws \think\Exception
     * 生成财务合同编号
     */
    function getKuaijiContractNumbering()
    {
        $num = Db::name('ParkEnterpriseKuaijiContract')
            ->whereTime('create_time', 'year')
            ->count();
        $num2 = substr((1000 + $num + 1), 1);
        $numbering = 'CWDL' . date('Y') . $num2;
        return $numbering;
    }
}