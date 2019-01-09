<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/22
 * Time: 10:37
 */

namespace app\park_activity\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_activity\model\ActivityApplyList;
use think\Db;

/**
 * Class Apply
 * @package app\park_activity\admin
 * 活动报名
 */
class Apply extends Admin
{
    /**
     * @var
     * 报名模型
     */
    protected $applyModel;
    /**
     * @var
     * 报名列表
     */
    protected $activityList;

    /**
     * @var
     * 报名状态
     */
    protected $applyStatus;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->applyModel = new ActivityApplyList();
        $this->activityList = Db::name('ActivityList')
            ->where('status', '1')
            ->column('id,title');
        $this->applyStatus = [
            1 => '待确认',
            2 => '已通过',
            3 => '已拒绝',
        ];
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('报名列表')
            ->search([
                ['name' => 'activity_id', 'type' => 'select', 'title' => '活动', 'options' => $this->activityList],
            ])
            ->content($this->grid());
    }

    /**
     * @return mixed
     * 表格内容
     */
    public function grid()
    {
        list($data_list, $total) = $this->applyModel
            ->search('activity_id')
            ->getListByPage([], true, 'create_time desc');
        $change = [
            'icon' => 'fa fa-recycle',
            'title' => '批量通过',
            'class' => 'btn btn-default ajax-table-btn confirm btn-sm',
            'confirm-info' => '',
            'href' => url('change')
        ];
        return (new BuilderList())
            ->addTopButton('delete', ['model' => 'ActivityApplyList'])
//            ->addTopButton('self',$change)
            ->keyListItem('id', 'ID')
            ->keyListItem('activity_id', '活动名称', 'callback', 'getActivityNameById')
            ->keyListItem('user_id', '用户名', 'callback', 'getUserNameById')
            ->keyListItem('apply_number', '报名人数')
            ->keyListItem('paid_money', '预付金额')
            ->keyListItem('create_time', '报名时间')
            ->keyListItem('apply_status', '状态','callback','getApplyStatusName')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit', ['model' => 'ActivityApplyList'])
            ->addRightButton('delete', ['model' => 'ActivityApplyList'])
            ->fetch();
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑报名状态
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            //todo数据校验
            if ($this->applyModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->module->getError());
            }
        } else {

            $info = ActivityApplyList::get($id);
            if (empty($info)) {
                $this->error($this->applyModel->getError());
            } else {
                $return = (new BuilderForm())
                    ->addFormItem('id', 'hidden', 'ID')
                    ->addFormItem('apply_status', 'select', '报名状态', '', $this->applyStatus)
                    ->setFormData($info)
                    ->addButton('submit')
                    ->addButton('back')
                    ->fetch();

                return (new Iframe())
                    ->setMetaTitle($title . '报名状态')
                    ->content($return);
            }
        }
    }

    /**
     *预留做批量通过的
     */
    public function change(){
        $param = \input();
        \halt($param);
    }
}