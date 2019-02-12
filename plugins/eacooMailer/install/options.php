<?php
return [
    'debug'=>[
        'title'=>'开启Debug:',
        'type'=>'radio',
        'options'=>[
            1=>'开启',
            0=>'关闭',
        ],
        'value'=>1,
    ],
    'smtp_sender'=>[
        'title' =>'发件人昵称:',
        'description'=>'发件人昵称',
        'type'  =>'text',
        'value' =>'EacooPHP', 
    ],
    'smtp_address'=>[
        'title' =>'发件人地址:',
        'description'=>'填写邮箱地址',
        'type'  =>'email',
        'value' =>'', 
    ],
    'smtp_host'=>[
        'title'       =>'SMTP服务器地址:',
        'description' =>'SMTP服务器地址',
        'type'        =>'text',
        'value'       =>'', 
    ],
    'smtp_secure'=>[
        'title'       =>'SMTP加密方式:',
        'description' =>'',
        'type'        =>'radio',
        'options'     =>['none'=>'无','ssl'=>'SSL','tls'=>'TLS'],
        'value'       =>'ssl', 
    ],
    'smtp_port'=>[
        'title' =>'SMTP端口:',
        'description'=>'默认为25',
        'type'  =>'number',
        'value' =>'', 
    ],
    'smtp_login'=>[
        'title' =>'发件箱帐号:',
        'description'=>'完整邮件地址',
        'type'  =>'email',
        'value' =>'', 
    ],
    'smtp_password'=>[
        'title' =>'发件箱密码:',
        'description'=>'',
        'type'  =>'password',
        'value' =>'', 
    ],
    
];
                    