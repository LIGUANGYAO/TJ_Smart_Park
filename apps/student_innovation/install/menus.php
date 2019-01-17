<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [
    'admin_menus' => [
        [
            'title' => '大学生创业',
            'name' => 'student_innovation/innovation',
            'icon' => 'fa fa-mortar-board',
            'is_menu' => 1,
            'sub_menu' => [
                [
                    'title' => '项目列表',
                    'name' => 'student_innovation/innovation/index',
                    'is_menu' => 1,
                    'icon' => ''
                ],
                [
                    'title' => '添加/编辑项目',
                    'name' => 'student_innovation/innovation/edit',
                    'is_menu' => 0,
                    'icon' => ''
                ],
                [
                    'title' => '删除项目',
                    'name' => 'student_innovation/innovation/delete',
                    'is_menu' => 0,
                    'icon' => ''
                ],
            ]
        ]
    ]
];