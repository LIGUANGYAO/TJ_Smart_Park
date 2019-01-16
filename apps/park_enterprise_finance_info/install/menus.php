<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '公司财务信息',
            'name' => 'park/enterprise_finance',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '科技项目资金列表',
                    'name' => 'park_enterprise_finance_info/Finance/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加科技项目',
                    'name' => 'park_enterprise_finance_info/Finance/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除科技项目',
                    'name' => 'park_enterprise_finance_info/Finance/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];