<?php
/**
 * 插件入口类
 * 参考文档https://www.kancloud.cn/youpzt/eacoo/540653
 */

namespace plugins\DataDictionary;

use app\common\controller\Plugin;

class Index extends Plugin
{

    /**
     * @var array 插件钩子
     */
    public $hooks = [];

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
}
