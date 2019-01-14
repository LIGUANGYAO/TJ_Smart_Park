<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '高新企业管理',
            'name' => 'high-tech/index',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '企业列表',
                    'name' => 'high_tech_enterprise/Index/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加企业',
                    'name' => 'high_tech_enterprise/Index/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除企业',
                    'name' => 'high_tech_enterprise/Index/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ]
        ]
    ]
];
