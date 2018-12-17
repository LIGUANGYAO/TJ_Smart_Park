<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/14
 * Time: 11:53
 */

namespace app\park_building\model;


use app\common\model\Base;
use think\Db;

/**
 * Class ParkRoom
 * @package app\park_building\model
 */
class ParkRoom extends Base
{

    /**
     * @param $value
     * @param $data
     * @return string
     * 获取楼宇名称
     */
    public function getBuildingTextAttr($value, $data)
    {
        $status = Db::name('ParkBuilding')->column('id,title');
        return isset($status[$data['status']]) ? $status[$data['status']] : '未知';
    }

    /**
     * @param $value
     * @param $data
     * @return mixed|string
     * 获取状态的中文字符
     */
    public function getStatusTextAttr($value, $data)
    {
        $status = [
            1 => '未租',
            2 => '已租'
        ];
        return isset($status[$data['status']]) ? $status[$data['status']] : '未知';
    }

    /**
     * @param $value
     * @param $data
     * @return mixed|string
     * 获取装修类型的中文字符
     */
    public function getDecorationTextAttr($value, $data)
    {
        $status = [
            1 => '毛坯',
            2 => '简装'
        ];
        return isset($status[$data['status']]) ? $status[$data['status']] : '未知';
    }


    /**
     * @param $value
     * @param $data
     * 获取企业名称
     */
    public function getEnterpriseTextAttr($value, $data)
    {

    }
}