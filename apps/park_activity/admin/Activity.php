<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/21
 * Time: 17:07
 */

namespace app\park_activity\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_activity\model\ActivityList;

/**
 * Class Activity
 * @package app\park_activity\admin
 * 活动管理控制器
 */
class Activity extends Admin
{
    /**
     * @var
     * 活动列表模型
     */
    protected $activityModel;
    /**
     * @var
     * 活动类型
     */
    protected $activityType;

    /**
     * @var
     * 活动flag
     */
    protected $activityStatusType;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->activityModel = new ActivityList();
        $this->activityType = [
            1 => '普通活动',
            2 => '讲座',
            3 => '公益',
            //根据实际情况添加
        ];
        $this->activityStatusType = [
            1 => '置顶',
            2 => '推荐',
            3 => '火爆',
        ];
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('活动列表')
            ->search([
                ['name' => 'status', 'type' => 'select', 'title' => '状态', 'options' => [0 => '禁用', 1 => '正常']],
                ['name' => 'create_time_range', 'type' => 'daterange', 'extra_attr' => 'placeholder="创建时间范围"'],
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入查询关键字"'],
            ])
            ->content($this->grid());
    }

    /**
     *表格内容
     */
    public function grid()
    {
        $search_setting = $this->buildModelSearchSetting();
        $map = [
            'status' => ['egt', 0],
        ];
        list($data_list, $total) = $this->activityModel
            ->search($search_setting)
            ->getListByPage($map, true, 'create_time desc');

        return (new BuilderList())
            ->addTopButton('addnew',['model'=>'ActivityList'])
            ->addTopButton('resume',['model'=>'ActivityList'])
            ->addTopButton('forbid',['model'=>'ActivityList'])
            ->addTopButton('delete',['model'=>'ActivityList'])
            ->setSearch('请输入关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('title', '标题')
            ->keyListItem('type', '类型', 'array', $this->activityType)
            ->keyListItem('hold_time', '举办时间')
            ->keyListItem('deadline', '报名截止时间')
            ->keyListItem('img', '封面', 'picture')
            ->keyListItem('max_apply', '单人最多报名人数')
            ->keyListItem('max_number', '活动最大报名人数')
            ->keyListItem('price', '预付定金')
            ->keyListItem('activity_status', '活动标记','callback','getActivityStatusName')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('create_time', '创建时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)
            ->setListPage($total)
//            ->addRightButton('self', ['title' => '查看', 'class' => 'btn btn-info btn-xs', 'href' => url('detail', ['id' => '__data_id__'])])
            ->addRightButton('edit',['model'=>'ActivityList'])
            ->addRightButton('forbid',['model'=>'ActivityList'])
            ->addRightButton('delete',['model'=>'ActivityList'])
            ->fetch();
    }

    /**
     * @return array
     * 构建模型搜索查询条件
     */
    private function buildModelSearchSetting()
    {
        //时间范围
        $timegap = input('create_time_range');
        $extend_conditions = [];
        if ($timegap) {
            $gap = explode('—', $timegap);
            $reg_begin = $gap[0];
            $reg_end = $gap[1];

            $extend_conditions = [
                'create_time' => ['between', [$reg_begin . ' 00:00:00', $reg_end . ' 23:59:59']]
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

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 修改或者新增
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();

            //todo数据校验

            if ($this->activityModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->module->getError());
            }
        } else {
            $info = [
                'price' => '0.00',
                'status' => 1,
            ];

            if ($id > 0) {
                $info = ActivityList::get($id);
                if (empty($info)) {
                    $this->error($this->activityModel->getError());
                }
            }

            $return = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('title', 'text', '活动标题', '请输入活动标题')
                ->addFormItem('type', 'select', '活动类型', '请选择活动类型', $this->activityType)
                ->addFormItem('hold_time', 'datetime', '活动时间', '请选择活动时间')
                ->addFormItem('deadline', 'datetime', '报名截止时间', '请选择报名截止时间')
                ->addFormItem('img', 'picture', '封面', '请选择活动封面')
                ->addFormItem('max_apply', 'number', '单人最大报名人数')
                ->addFormItem('max_number', 'number', '活动最大报名人数')
                ->addFormItem('price', 'text', '预付定金')
                ->addFormItem('activity_status', 'select', '活动标记', '',$this->activityStatusType)
                ->addFormItem('content', 'wangeditor', '详情内容')
                ->addFormItem('status', 'radio', '状态', '', [1 => '正常', 0 => '禁用'])
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return (new Iframe())
                ->setMetaTitle($title . '活动')
                ->content($return);
        }
    }
}