<?php

/**
 * 菜单配置文件
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413039
 */

return [

    // 后台菜单及权限节点配置
    'admin_menus' =>[
        [
            'title'   =>'企查查',
            'name'    =>'admin/plugins/config?name=Qichacha',
            'icon'    => 'fa fa-quora',
            'is_menu' => 1,
            'pid'     => 10,
        ]

    ],
];