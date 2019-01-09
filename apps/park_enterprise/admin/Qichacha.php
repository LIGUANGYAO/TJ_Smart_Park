<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/27
 * Time: 16:22
 */

namespace app\park_enterprise\admin;


use app\admin\controller\Admin;

/**
 * Class Qichacha
 * @package app\park_enterprise\admin
 * 企查查接口控制器
 */
class Qichacha extends Admin
{
    /**
     * @return mixed
     * 入口方法
     */
    public function index()
    {
        $keyword = \input('keyword', '');
        $data = hook('qichacha', $keyword, true);
        return $data;
    }
}