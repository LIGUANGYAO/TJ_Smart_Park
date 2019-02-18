<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/15
 * Time: 11:53
 */

namespace app\admin\api\v1;

use app\common\controller\Api;
use think\Db;

/**
 * Class Index
 * @package app\admin\api\v1
 * 后台首页数据接口
 */
class Index extends Api
{
    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
    }


    /**
     * @throws \think\Exception
     * 园区首页数据整体统计
     */
    public function index()
    {
        //已租房源数量
        $rentedRoom = Db::name('ParkRoom')->where('room_status', 'eq', 2)->count();
        //入驻企业数量=企业总数-退出企业数
        $enterpriseNum = (Db::name('ParkEnterpriseQichachaBasicInfo')->count()) - (Db::name('ParkEnterpriseOutList')->count());
        //前台用户数量
        $userNum = Db::name('Users')->count();
        //房源总数
        $roomNum = Db::name('ParkRoom')->count();
        //未租房源数量
        $akiRoomNum = Db::name('ParkRoom')->where('room_status', 'eq', 1)->count();
        //已定房源
        $bookedRoomNum = Db::name('ParkRoom')->where('room_status', 'eq', 3)->count();
        //自留房源
        $selfRoomNum = Db::name('ParkRoom')->where('room_status', 'eq', 4)->count();
        //待缴费=水费+电费+?
        $toPayNum = (Db::name('CostWaterList')->where('pay_status', 'eq', 2)->count()) + (Db::name('CostElectricList')->where('pay_status', 'eq', 2)->count());
        //已完成缴费
        $paidNum = (Db::name('CostWaterList')->where('pay_status', 'eq', 1)->count()) + (Db::name('CostElectricList')->where('pay_status', 'eq', 1)->count());
        //会议室预约数量
        $meetingRoomBookingNum = Db::name('ServiceMeetingRoomBookingList')->where('status', 'eq', 0)->count();
        //实验室预约数量
        $laboratoryBookingNum = Db::name('ServiceLaboratoryBookingList')->where('status', 'eq', 0)->count();
        //待处理报修数量
        $torepairNum = Db::name('ServiceRepairList')->where('status', 'eq', 1)->count();
        $result = [
            'rentedRoom' => $rentedRoom,
            'enterpriseNum' => $enterpriseNum,
            'userNum' => $userNum,
            'roomNum' => $roomNum,
            'akiRoomNum' => $akiRoomNum,
            'bookedRoomNum' => $bookedRoomNum,
            'selfRoomNum' => $selfRoomNum,
            'toPayNum' => $toPayNum,
            'paidNum' => $paidNum,
            'meetingRoomBookingNum' => $meetingRoomBookingNum,
            'laboratoryBookingNum' => $laboratoryBookingNum,
            'torepairNum' => $torepairNum,
        ];
        $this->success('OK', $result);
    }
}
