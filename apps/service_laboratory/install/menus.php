<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '实验室管理',
            'name' => 'service_laboratory/Room',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '实验室列表',
                    'name' => 'service_laboratory/Room/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加实验室',
                    'name' => 'service_laboratory/Room/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除实验室',
                    'name' => 'service_laboratory/Room/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '预约管理',
                    'name' => 'service_laboratory/Booking/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加预约',
                    'name' => 'service_laboratory/Booking/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除预约',
                    'name' => 'service_laboratory/Booking/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];