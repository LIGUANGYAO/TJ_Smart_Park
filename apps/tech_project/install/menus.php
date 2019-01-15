<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '科技项目资金管理',
            'name' => 'park/tech_project',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '科技项目资金列表',
                    'name' => 'tech_project/Project/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加科技项目',
                    'name' => 'tech_project/Project/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除科技项目',
                    'name' => 'tech_project/Project/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];