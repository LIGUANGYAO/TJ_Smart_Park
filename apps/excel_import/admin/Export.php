<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/14
 * Time: 9:47
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use think\Db;

/**
 * Class Export
 * @package app\excel_import\admin
 * 费用相关的到处操作全部在此
 */
class Export extends Admin
{
    /**
     *
     */
    public function index()
    {

    }

    /**
     *房租物业费用导出
     */
    public function rent_property()
    {
        $Excel['fileName'] = "房租水电费" . \date('Y-m-d');
        $Excel['cellName'] = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $Excel['H'] = ['A' => 12, 'B' => 20, 'C' => 14, 'D' => 16, 'E' => 16, 'F' => 16, 'G' => 16, 'H' => 16, 'I' => 16, 'J' => 16];
        $Excel['V'] = ['1' => 40, '2' => 23];
        $Excel['sheetTitle'] = "房租水电费";
        $Excel['xlsCell'] = [
            ['id', '序号'],
            ['enterprise_name', '企业名称'],
            ['room_id', '房间号'],
            ['fee_type', '费用类型'],
            ['s_day', '开始日期'],
            ['e_day', '结束日期'],
            ['fee_amount', '缴费金额'],
            ['pay_time', '缴费日期'],
            ['pay_status', '缴费状态'],
            ['marks', '备注']
        ];

        $field = "id,enterprise_name,room_id,fee_type,s_day,e_day,fee_amount,pay_time,pay_status,marks";
        $data = Db::name('CostRentPropertyList')
            ->field($field)
            ->select();
        foreach ($data as $k => $v) {
            if ($data[$k]['fee_type'] == 1) {
                $data[$k]['fee_type'] = '房租';
            } else {
                $data[$k]['fee_type'] = '物业';
            }
            if ($data[$k]['pay_status'] == 1) {
                $data[$k]['pay_status'] = '是';
            } else {
                $data[$k]['pay_status'] = '否';
            }
        }
        $param = [
            'Excel' => $Excel,
            'expTableData' => $data,
        ];
        hook('exportToTable', $param);
    }
}
