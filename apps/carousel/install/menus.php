<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */
return [
    'admin_menus' => [
        [
            'title' => '轮播图管理',
            'name' => 'carousel/index',
            'icon' => 'fa fa-picture-o',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '轮播图配置',
                    'name' => 'admin/modules/config?name=carousel',
                    'icon' => 'fa fa-cog ',
                    'is_menu' => 1,
                ],
                [
                    'title' => '轮播位设置',
                    'name' => 'carousel/carousel_position/index',
                    'icon' => 'fa fa-th-large',
                    'is_menu' => 1,
                ],
                [
                    'title' => '轮播图列表',
                    'name' => 'carousel/carousel_list/index',
                    'icon' => 'fa fa-file-image-o',
                    'is_menu' => 1,
                ],
            ],
        ],
    ]
];