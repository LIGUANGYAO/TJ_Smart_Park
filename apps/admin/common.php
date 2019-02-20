<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 https://www.eacoophp.com, All rights reserved.
// +----------------------------------------------------------------------
// | [EacooPHP] 并不是自由软件,可免费使用,未经许可不能去掉EacooPHP相关版权。
// | 禁止在EacooPHP整体或任何部分基础上发展任何派生、修改或第三方版本用于重新分发
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
//添加或更新多媒体附件分类
use think\Db;

function update_media_term($media_id, $term_id)
{
    update_object_term($media_id, $term_id, 'attachment');
}

//删除多媒体附件分类
function delete_media_term($media_id, $term_id)
{
    delete_object_term($media_id, $term_id, 'attachment');
}

function get_type($type)
{
    $res = $type > 1 ? '我是一' : '我是二';
    return $res;
}

if (!function_exists('getEnterpriseNameByEnterpriseId')) {

    /**
     * @param $enterprise_id
     * @return mixed
     * 根据企业ID返回企业名称
     */
    function getEnterpriseNameByEnterpriseId($enterprise_id)
    {
        $name = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('id', 'eq', $enterprise_id)
            ->value('enterprise_name');
        if (empty($name)) {
            return '暂无入住企业';
        } else {
            return $name;
        }
    }
}
if (!function_exists('getBuildIdByEnterpriseId')) {
    /**
     * @param $id
     * @return mixed
     * 根据楼宇ID获取所在楼宇的名称
     */
    function getBuildNameByBuildId($id)
    {
        $build_name = Db::name('ParkBuilding')
            ->where('id', $id)
            ->value('title');
        return $build_name;
    }
}
