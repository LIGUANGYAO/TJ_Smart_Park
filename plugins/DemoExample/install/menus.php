<?php

return [

    // 后台菜单及权限节点配置
    'admin_menus' =>[
        [
            'title'   =>'Builder构建器示例',
            'name'    =>'DemoExample',
            'icon'    => '',
            'is_menu' => 1,
            //'sort'    => 3,
            'sub_menu'=>[
                [
                    'title'=>'表单Form',
                    'name' => 'home/plugin/execute?_plugin=DemoExample&_controller=BuilderForm&_action=Index',
                    'is_menu'=>1
                ],
                [
                    'title'=>'列表List',
                    'name' => 'home/plugin/execute?_plugin=DemoExample&_controller=BuilderList&_action=Index',
                    'is_menu'=>1
                ],
            ]
        ]
        
    ],
];