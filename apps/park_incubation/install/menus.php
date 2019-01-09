<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '孵化企业管理',
            'name' => 'park/incubation',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '孵化企业列表',
                    'name' => 'park_incubation/Incubation/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加孵化企业',
                    'name' => 'park_incubation/Incubation/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除孵化企业',
                    'name' => 'park_incubation/Incubation/del',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '走访记录',
                    'name' => 'park_incubation/IncubationVisit/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加走访记录',
                    'name' => 'park_incubation/IncubationVisit/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除走访记录',
                    'name' => 'park_incubation/IncubationVisit/del',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],

        ]
    ]
];