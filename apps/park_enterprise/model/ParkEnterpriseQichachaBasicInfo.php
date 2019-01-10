<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/2
 * Time: 15:45
 */

namespace app\park_enterprise\model;


use app\common\model\Base;

class ParkEnterpriseQichachaBasicInfo extends Base
{
    /**
     * @param $value
     * @param $data
     * @return mixed|string
     * 返回企业入驻状态
     */
    public function getEnterpriseStatusTextAttr($value, $data)
    {
        $status = [
            1 => '正常',
            2 => '退租'
        ];
        return isset($status[$data['status']]) ? $status[$data['status']] : '未知';
    }
}