<?php
//模块自定义函数文件
use think\Db;

if (!function_exists('getCarouselPositionNameById')) {
    /**
     * @param $id
     * @return mixed
     * 根据轮播位ID获取位置名称
     */
    function getCarouselPositionNameById($id)
    {
        $name = Db::name('CarouselPosition')
            ->where('id', $id)
            ->value('name');
        return $name;
    }
}