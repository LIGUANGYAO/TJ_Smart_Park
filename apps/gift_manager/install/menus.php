<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [
    'admin_menus' => [
        [
            'title' => '礼金管家',
            'name' => 'gift_manager/Index',
            'icon' => 'fa fa-money',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '我的红包',
                    'name' => 'gift_manager/my/index',
                    'is_menu' => 1,
                ],
                [
                    'title' => '添加类别',
                    'name' => 'gift_manager/category/index',
                    'is_menu' => 1,
                ]
            ],
        ],
    ]
];