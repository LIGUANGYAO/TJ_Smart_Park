<?php
namespace plugins\ThirdLogin;
use app\common\controller\Plugin;
/**
 * 第三方登陆插件
 */
class Index extends Plugin {
    
    /**
     * 自定义插件后台
     */
    //public $custom_adminlist = './Plugins/ThirdLogin/admin.html';
    
    /**
     * 插件所需钩子
     */
    public $hooks = array(
        'ThirdLogin',
        'PageHeader'
    );

    /**
     * 插件后台数据表配置
     */
    public $admin_list = array(
        '1' => array(
            'title' => '第三方登录列表',
            'model' => 'third_login',
        )
    );

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
     * 登录按钮钩子
     */
    public function ThirdLogin($param){
        $this->assign($param);
        $config = $this->getConfig();
        $this->assign('config',$config);
        
        echo $this->fetch('login');
    }

    /**
     * meta代码钩子
     */
    public function PageHeader($param){
        $platform_options = $this->getConfig();
        echo $platform_options['meta'];
    }
}
