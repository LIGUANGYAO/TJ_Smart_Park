<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '投资管理',
            'name' => 'park/investment',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '投资列表',
                    'name' => 'park_investment/Investment/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加投资',
                    'name' => 'park_investment/Investment/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除投资',
                    'name' => 'park_investment/Investment/del',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];