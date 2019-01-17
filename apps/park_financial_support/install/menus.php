<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '财政扶持管理',
            'name' => 'park/park_financial_support',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '扶持列表',
                    'name' => 'park_financial_support/Index/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加扶持',
                    'name' => 'park_financial_support/Index/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除扶持',
                    'name' => 'park_financial_support/Index/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];