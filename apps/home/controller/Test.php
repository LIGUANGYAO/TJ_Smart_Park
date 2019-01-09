<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/25
 * Time: 10:38
 */

namespace app\home\controller;


use app\common\controller\Base;

class Test extends Base
{
    public function index()
    {
        $keyword = \input('keyword');
        $data = hook('qichacha', $keyword, true);
        \print_r($data);
    }

    public function up(){
        return $this->fetch();
    }
}