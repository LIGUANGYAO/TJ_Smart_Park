<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.eacoo123.com, All rights reserved.         
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace plugins\eacooMailer;
use app\common\controller\Plugin;

/**
 * 站内信插件
 */
class Index extends Plugin {
    
    /**
     * @var array 插件钩子
     */
    public $hooks = [
        'SendMail',
    ];
    
    /**
     * 插件安装方法
     */
    public function install(){
        return true;
    }

    /**
     * 插件卸载方法
     */
    public function uninstall(){
        return true;
    }

    /**
     * MailSmtp发送
     * @param  array $param [description]
     * @return [type] [description]
     * @date   2017-11-17
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function SendMail($params=[])
    {
        $config = $this->getConfig();
        require_once PLUGIN_PATH.'eacooMailer/library/swiftmailer/swift_required.php';

        // Create the Transport
        $transport = (new \Swift_SmtpTransport($config['smtp_host'], $config['smtp_port']))
          ->setUsername($config['smtp_login'])
          ->setPassword($config['smtp_password'])
          ->setEncryption($config['smtp_secure'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message($params['subject']))
          ->setFrom([$config['smtp_address'] => $config['smtp_sender']])
          ->setTo([$params['email']])
          ->setContentType('text/html')
          ->setCharset('utf-8')
          ->setBody($params['body'])
          ;

        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
}
