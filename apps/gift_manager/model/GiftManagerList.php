<?php
/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/11/27
 * Time: 15:05
 */

namespace app\gift_manager\model;


use app\common\model\Base;

class GiftManagerList extends Base
{
    public function getPayStatusAttr($s)
    {
        if ($s == 1) {
            return '需要还礼';
        } else {
            return '无需还礼';
        }
    }

    public function category()
    {
        return $this->hasOne('GiftManagerCategory', 'cate_id', 'id');
    }
}