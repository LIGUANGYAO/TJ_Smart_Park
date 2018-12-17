<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 https://www.eacoophp.com, All rights reserved.         
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace plugins\DemoExample;
use app\common\controller\Plugin;

/**
 * 演示Builder示例
 */
class Index extends Plugin{

    /**
     * @var array 插件钩子
     */
    public $hooks = [];

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

}
