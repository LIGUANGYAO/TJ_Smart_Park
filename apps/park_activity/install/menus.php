<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [
    'admin_menus' => [
        [
            'title' => '活动管理',
            'name' => 'park/activity',
            'icon' => 'fa fa-soccer-ball-o',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '活动列表',
                    'name' => 'park_activity/activity/index',
                    'is_menu' => 1,
                    'icon' => '',
                ],
                [
                    'title' => '报名列表',
                    'name' => 'park_activity/apply/index',
                    'is_menu' => 1,
                ],
            ],
        ],
    ],
];