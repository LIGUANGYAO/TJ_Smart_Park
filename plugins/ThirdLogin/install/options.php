<?php

return array(
    'platforms'=>[
        'title'=>'开启同步登录',
        'type'=>'checkbox',
        'value'=>'',
        'options'=>[
            'Weixin' =>'微信登录',
            'Qq'     =>'QQ互联',
            'Sina'   =>'新浪登录',
            'Github' =>'Github登录',
            'Gitee'  =>'码云登录',
        ],
    ],
    'meta'=>[
        'title'=>'接口验证代码',
        'type'=>'textarea',
        'value'=>'',
        'description'=>'需要在Meta标签中写入验证信息时，拷贝代码到这里。'
    ],
    'WeixinKey'=>array(
                    'title'=>'微信APPKEY',
                    'type'=>'text',
                    'value'=>'',
                    'description'=>'申请地址：http://open.weixin.qq.com/',
                ),
    'WeixinSecret'=>array(
        'title'=>'微信APPSECRET',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：http://open.weixin.qq.com/',
    ),
    'QqKey'=>array(
        'title'=>'QQ互联APPKEY',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：http://connect.qq.com',
    ),
    'QqSecret'=>array(
        'title'=>'QQ互联APPSECRET',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：http://connect.qq.com',
    ),
    'SinaKey'=>array(
        'title'=>'新浪APPKEY',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：http://open.weibo.com/',
    ),
    'SinaSecret'=>array(
        'title'=>'新浪APPSECRET',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：http://open.weibo.com/',
    ),
    'GiteeKey'=>array(
        'title'=>'码云Client ID',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：https://gitee.com/oauth/applications',
    ),
    'GiteeSecret'=>array(
        'title'=>'码云Client Secret',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：https://gitee.com/oauth/applications',
    ),
    'GithubKey'=>array(
        'title'=>'Github Client ID',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：https://github.com/settings/applications/',
    ),
    'GithubSecret'=>array(
        'title'=>'Github Client Secret',
        'type'=>'text',
        'value'=>'',
        'description'=>'申请地址：https://github.com/settings/applications/',
    ),
);
