<?php

return [

    // 后台菜单及权限节点配置
    'admin_menus' =>[
        [
            'title'   =>'邮件Mailer',
            'name'    =>'admin/plugins/config?name=eacooMailer',
            'icon'    => 'fa fa-envelope',
            'is_menu' => 1,
            'pid'     => 10,
        ]
        
    ],
];