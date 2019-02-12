<?php
/**
 * 插件入口类
 * 参考文档https://www.kancloud.cn/youpzt/eacoo/540653
 */

namespace plugins\WxTemplateMessage;

use app\common\controller\Plugin;
use EasyWeChat\Factory;

/**
 * Class Index
 * @package plugins\WxTemplateMessage
 * 发送微信模板消息控制器
 */
class Index extends Plugin
{

    /**
     * @var
     * 当前系统已启用的微信（需要在WeChat模块中设置）
     */
    protected $wxid;
    /**
     * @var
     * 实例化
     */
    protected $app;
    /**
     * @var array 插件钩子
     */
    public $hooks = ['SendWxTemplateMsg'];

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->wxid = \get_wxid();
        $wechat_option = \get_wechat_info($this->wxid);
        $options = [
            'debug' => true,
            'app_id' => $wechat_option['appid'],
            'secret' => $wechat_option['appsecret'],
            'token' => $wechat_option['valid_token'],
            'aes_key' => $wechat_option['encodingaeskey'],
            'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file' => 'runtime/log/wechat/easywechat.logs',
            ],
        ];
        $this->app = Factory::officialAccount($options);
    }

    /**
     * 插件安装方法
     */
    public function install()
    {
        return true;
    }

    /**
     * 插件卸载方法
     */
    public function uninstall()
    {
        return true;
    }


    /**
     * @param string $touser    接收方openid
     * @param string $template_id   模板消息id
     * @param string $url   链接地址
     * @param array $data   消息内容
     */
    public function SendWxTemplateMsg($touser = '', $template_id = '', $url = '', $data = [])
    {
        $this->app->template_message->send([
            'touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'data' => $data,
        ]);
    }

}
