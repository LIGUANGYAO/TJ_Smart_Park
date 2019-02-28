<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [

    // 后台菜单及权限节点配置
    'admin_menus' => [
        [
            'title' => '数据库字典',
            'name' => 'home/plugin/execute?_plugin=DataDictionary&_controller=Index&_action=index',
            'icon' => 'fa fa-database',
            'is_menu' => 1,
            'pid' => 10,
        ]

    ],
];