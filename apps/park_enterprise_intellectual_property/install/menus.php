<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '知识产权管理',
            'name' => 'park/intellectual_property',
            'icon' => '',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '商标信息列表',
                    'name' => 'park_enterprise_intellectual_property/Trademark/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加商标',
                    'name' => 'park_enterprise_finance_info/Trademark/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除商标',
                    'name' => 'park_enterprise_finance_info/Trademark/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '专利信息列表',
                    'name' => 'park_enterprise_intellectual_property/Patent/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加专利',
                    'name' => 'park_enterprise_finance_info/Patent/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除专利',
                    'name' => 'park_enterprise_finance_info/Patent/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '企业证书列表',
                    'name' => 'park_enterprise_intellectual_property/Certificate/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加证书',
                    'name' => 'park_enterprise_finance_info/Certificate/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除证书',
                    'name' => 'park_enterprise_finance_info/Certificate/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '作品著作权列表',
                    'name' => 'park_enterprise_intellectual_property/Wcopyright/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加作品著作权',
                    'name' => 'park_enterprise_finance_info/Wcopyright/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除作品著作权',
                    'name' => 'park_enterprise_finance_info/Wcopyright/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '软件著作权列表',
                    'name' => 'park_enterprise_intellectual_property/Scopyright/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加软件著作权',
                    'name' => 'park_enterprise_finance_info/Scopyright/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除软件著作权',
                    'name' => 'park_enterprise_finance_info/Scopyright/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '网站信息列表',
                    'name' => 'park_enterprise_intellectual_property/Website/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加网站信息',
                    'name' => 'park_enterprise_finance_info/Website/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除网站信息',
                    'name' => 'park_enterprise_finance_info/Website/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];