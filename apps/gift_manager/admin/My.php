<?php
/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/11/27
 * Time: 13:55
 */

namespace app\gift_manager\admin;


use app\admin\controller\Admin;
use app\common\layout\Iframe;
use app\gift_manager\model\GiftManagerCategory;
use app\gift_manager\model\GiftManagerList;

class My extends Admin
{
    function _initialize()
    {
        parent::_initialize();
        $this->giftModel = new GiftManagerList();
        $this->giftCate = new GiftManagerCategory();
    }

    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('礼金列表')// 设置页面标题
            ->search([
                ['name' => 'pay_status', 'type' => 'select', 'title' => '状态', 'options' => [1 => '需还礼', 2 => '无需还礼']],
                ['name' => 'create_time_range', 'type' => 'daterange', 'extra_attr' => 'placeholder="时间范围"'],
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入查询关键字"'],
            ])
            ->content($this->grid());
    }

    public function grid()
    {
        $search_setting = $this->buildModelSearchSetting();
        $map = [
            ''
        ];
        list($data_list, $total) = $this->giftModel->search($search_setting)->getListByPage($map, true, 'when desc');
        return builder('list')
            ->addTopButton('addnew')// 添加新增按钮
            ->addTopButton('delete')// 添加删除按钮
            ->keyListItem('id', 'ID')
            ->keyListItem('cate_id', '类别')
            ->keyListItem('why', '事由')
            ->keyListItem('when', '时间')
            ->keyListItem('who', '称呼')
            ->keyListItem('money', '礼金')
            ->keyListItem('pay_status', '状态')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')//设置数据主键，默认是id
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'GiftManagerList'])// 删除按钮
            ->fetch();
    }

    public function edit()
    {
        \halt(\input());
    }

    public function buildModelSearchSetting()
    {
        //时间范围
        $timegap = input('create_time_range');
        $extend_conditions = [];
        if ($timegap) {
            $gap = explode('—', $timegap);
            $reg_begin = $gap[0];
            $reg_end = $gap[1];

            $extend_conditions = [
                'when' => ['between', [$reg_begin . ' 00:00:00', $reg_end . ' 23:59:59']]
            ];
        }
        //自定义查询条件
        $search_setting = [
            'keyword_condition' => 'title',
            //忽略数据库不存在的字段
            'ignore_keys' => ['create_time_range'],
            //扩展的查询条件
            'extend_conditions' => $extend_conditions
        ];

        return $search_setting;
    }
}