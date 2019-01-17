<?php
//模块自定义函数文件
if (!function_exists('displayRemoteImage')) {
    /**
     * @param $path
     * @return string
     * 将image地址显示为图片
     */
    function displayRemoteImage($path)
    {
        $img = "<img class='picture' src=$path height='100' width='100'>";
        return $img;
    }
}