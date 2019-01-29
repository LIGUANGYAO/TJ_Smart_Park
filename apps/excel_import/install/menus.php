<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '费用账单管理',
            'name' => 'excel_import/index',
            'icon' => 'fa fa-money',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '水费管理',
                    'name' => 'excel_import/Water/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '电费管理',
                    'name' => 'excel_import/Electric/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
            ]
        ]
    ]
];
