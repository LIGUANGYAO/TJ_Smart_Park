<?php
/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/12/3
 * Time: 14:16
 */

namespace app\carousel\admin;


use app\admin\controller\Admin;

class CarouselList extends Admin
{
    public function index(){
        $this->assign('meta_title', '轮播图列表');
        //添加高级查询
        $searchFields = [
            ['name' => 'path_type', 'type' => 'select', 'title' => '来源', 'options' => [0 => '默认']],
            ['name' => 'media_type', 'type' => 'select', 'title' => '类型', 'options' => [
                1 => '图像',
                2 => '音频',
                3 => '视频',
                4 => '文件',
            ]],
            ['name' => 'term_id', 'type' => 'select', 'title' => '分类', 'options' => model('terms')->where(['taxonomy' => 'media_cat'])->column('name', 'term_id')],//获取分类数据
            ['name' => 'choice_date_range', 'type' => 'text', 'extra_attr' => 'placeholder="选择日期" id="choice_date_range"'],
            ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入查询关键字"'],
        ];
        $this->assign('searchFields', $searchFields);
        $this->assign('search_template_path', APP_PATH . '/common/view/layout/iframe/search.html');
        return $this->fetch();
    }
}