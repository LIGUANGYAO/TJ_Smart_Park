<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/16
 * Time: 16:00
 */

namespace app\park_enterprise_intellectual_property\admin;


use app\admin\controller\Admin;

class Trademark extends Admin
{
    public function index()
    {
        $keyword = '苏州朗动网络科技有限公司';
        $return = hook('qichachaTm', $keyword, true);
        $data = \json_decode($return[0], true);
        \halt($data);
    }
}