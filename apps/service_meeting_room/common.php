<?php
//模块自定义函数文件
use app\service_meeting_room\model\ServiceMeetingRoomList;

if (!function_exists('getMeetingRoomAddress')) {
    /**
     * @param $meeting_room_id
     * @return string
     * @throws \think\exception\DbException
     * 返回拼接好的会议室具体地址
     */
    function getMeetingRoomAddress($meeting_room_id)
    {
        $meetingRoomInfo = ServiceMeetingRoomList::get($meeting_room_id);
        $phase = $meetingRoomInfo['phase'];
        $roomNumber = $meetingRoomInfo['room_number'];
        $address = $phase . '号楼' . $roomNumber . '室';
        return $address;
    }
}