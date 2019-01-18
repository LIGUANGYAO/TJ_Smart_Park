<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '停车位管理',
            'name' => 'parking_space/Space',
            'icon' => 'fa fa-car',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '车位列表',
                    'name' => 'parking_space/Space/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加车位',
                    'name' => 'parking_space/Space/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除车位',
                    'name' => 'parking_space/Space/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '租赁管理',
                    'name' => 'parking_space/Lease/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加租赁',
                    'name' => 'parking_space/Lease/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除租赁',
                    'name' => 'parking_space/Lease/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ],
        ]
    ]
];