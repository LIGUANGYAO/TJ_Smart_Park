<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '会议室管理',
            'name' => 'service_meeting_room/Room',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '会议室列表',
                    'name' => 'service_meeting_room/Room/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加会议室',
                    'name' => 'service_meeting_room/Room/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除会议室',
                    'name' => 'service_meeting_room/Room/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '预约管理',
                    'name' => 'service_meeting_room/Booking/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加预约',
                    'name' => 'service_meeting_room/Booking/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除预约',
                    'name' => 'service_meeting_room/Booking/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];