<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '苗圃管理',
            'name' => 'park/nursery',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '苗圃工位列表',
                    'name' => 'park_nursery/Nursery/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加苗圃工位',
                    'name' => 'park_nursery/Nursery/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除苗圃工位',
                    'name' => 'park_nursery/Nursery/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '苗圃团队管理',
                    'name' => 'park_nursery/Team/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加苗圃团队',
                    'name' => 'park_nursery/Team/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除苗圃团队',
                    'name' => 'park_nursery/Team/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],

        ]
    ]
];