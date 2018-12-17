<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [
    'admin_menus' => [
        [
            'title' => '房源管理',
            'name' => 'park/building',
            'icon' => 'fa fa-institution',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '楼宇列表',
                    'name' => 'park_building/building/index',
                    'is_menu' => 1,
                    'icon' => 'fa fa-institution',
                ],
                [
                    'title' => '房源列表',
                    'name' => 'park_building/room/index',
                    'is_menu' => 1,
                ],
            ],
        ],
    ],
];