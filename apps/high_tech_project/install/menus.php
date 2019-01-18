<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '高新技术成果管理',
            'name' => 'high_tech_project/Index',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '成果列表',
                    'name' => 'high_tech_project/Index/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加成果',
                    'name' => 'high_tech_project/Index/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除成果',
                    'name' => 'high_tech_project/Index/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];