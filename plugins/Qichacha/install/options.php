<?php

/**
 * 插件配置
 * 参考文档：https://www.kancloud.cn/youpzt/eacoo/413033
 */

return [
    'status' => [
        'title' => '是否开启企查查接口:',
        'type' => 'radio',
        'options' => [
            '1' => '开启',
            '0' => '关闭'
        ],
        'value' => '1',
    ],
    'appKey'=>[
        'title' => 'AppKey',
        'type' => 'text',
        'value' => '',
        'description' => '请通过<a href="http://www.yjapi.cn" target="_blank">企查查接口平台</a>申请',
    ],
    'secretKey' => [
        'title' => 'SecretKey',
        'type' => 'text',
        'value' => '',
        'description' => '请通过<a href="http://www.yjapi.cn" target="_blank">企查查接口平台</a>申请',
    ],
];