<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '企业管理',
            'name' => 'park/enterprise',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '企业列表',
                    'name' => 'park_enterprise/EnterpriseBasic/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加企业',
                    'name' => 'park_enterprise/EnterpriseBasic/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除企业',
                    'name' => 'park_enterprise/EnterpriseBasic/del',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '租房合同',
                    'name' => 'park_enterprise/EnterpriseContract/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加租房合同',
                    'name' => 'park_enterprise/EnterpriseContract/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除租房合同',
                    'name' => 'park_enterprise/EnterpriseContract/del',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '财务代理合同',
                    'name' => 'park_enterprise/EnterpriseCwdlContract/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加财务代理合同',
                    'name' => 'park_enterprise/EnterpriseCwdlContract/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],

        ]
    ]
];