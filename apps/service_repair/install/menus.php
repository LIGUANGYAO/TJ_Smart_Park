<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '报修管理',
            'name' => 'service_repair/Index',
            'icon' => 'fa fa-cog',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '报修列表',
                    'name' => 'service_repair/Index/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '处理报修',
                    'name' => 'service_repair/Index/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],

                [
                    'title' => '删除报修',
                    'name' => 'service_repair/Index/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];