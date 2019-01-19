<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '费用账单管理',
            'name' => 'cost_management/index',
            'icon' => 'fa fa-money',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '收费项目',
                    'name' => 'cost_management/Category/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加项目',
                    'name' => 'cost_management/Category/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除项目',
                    'name' => 'cost_management/Category/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '账单列表',
                    'name' => 'cost_management/Bill/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加账单',
                    'name' => 'cost_management/Bill/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除账单',
                    'name' => 'cost_management/Bill/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ]
        ]
    ]
];
