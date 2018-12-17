<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/13
 * Time: 13:50
 */

namespace app\park_building\validate;


use think\Validate;

class Building extends Validate
{
    protected $rule = [
        'title' => 'require|length:1,80|unique:links',
        'sort' => 'number',
    ];

    protected $message = [
        'title.require' => '名称不能为空',
        'title.length' => '名称长度为1-80个字符',
        'title.unique' => '楼宇已经存在',
        'sort.number' => '排序必须是数字',
    ];

    protected $scene = [
        'edit' => ['title', 'sort']
    ];
}