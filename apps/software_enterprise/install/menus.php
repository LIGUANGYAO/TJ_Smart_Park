<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '软件企业',
            'name' => 'park/software_enterprise',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '企业列表',
                    'name' => 'software_enterprise/EnterpriseList/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '新增企业',
                    'name' => 'software_enterprise/EnterpriseList/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除企业',
                    'name' => 'software_enterprise/EnterpriseList/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '项目列表',
                    'name' => 'software_enterprise/SoftList/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '新增项目',
                    'name' => 'software_enterprise/SoftList/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除项目',
                    'name' => 'software_enterprise/SoftList/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ]
        ]
    ]
];