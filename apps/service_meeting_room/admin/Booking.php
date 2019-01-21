<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/21
 * Time: 11:07
 */

namespace app\service_meeting_room\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\service_meeting_room\model\ServiceMeetingRoomBookingList;
use think\Db;

/**
 * Class Booking
 * @package app\service_meeting_room\admin
 * 会议室预约控制器
 */
class Booking extends Admin
{
    /**
     * @var
     * 预约模型
     */
    protected $bookModel;
    /**
     * @var
     * 预约状态
     */
    protected $bookStatus;
    /**
     * @var
     * 管理员列表
     */
    protected $adminList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->bookModel = new ServiceMeetingRoomBookingList();
        $this->bookStatus = [
            0 => '待处理',
            1 => '已通过',
            2 => '已拒绝'
        ];
        $this->adminList = Db::name('Admin')
            ->column('uid,username');
    }

    /**
     * @return \app\common\layout\Content
     * 列表页
     */
    public function index()
    {
        list($data_list, $total) = $this->bookModel->search()->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
//            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('meetingroom_id', '会议室', 'callback', 'getMeetingRoomAddress')
            ->keyListItem('user_name', '预约人')
            ->keyListItem('phone', '联系方式')
            ->keyListItem('s_time', '开始时间')
            ->keyListItem('e_time', '结束时间')
            ->keyListItem('create_time', '申请时间')
            ->keyListItem('status', '预约状态', 'array', $this->bookStatus)
            ->keyListItem('marks', '备注')
            ->keyListItem('handler_id', '操作人', 'array', $this->adminList)
            ->keyListItem('handle_time', '处理时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ServiceMeetingRoomBookingList'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'status', 'type' => 'select', 'title' => '预约状态', 'options' => $this->bookStatus]
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑预约
     */
    public function edit($id = 0)
    {
        $info = ServiceMeetingRoomBookingList::get($id);
        if (IS_POST) {
            $param = \input();
            $param['handler_id'] = \is_admin_login();
            $param['handle_time'] = date("Y-m-d H:i:s");
            if ($this->bookModel->editData($param)) {
                $this->success('操作成功', \url('index'));
            } else {
                $this->error($this->bookModel->getError());
            }
        }
        $content = (new BuilderForm())
            ->addFormItem('status', 'radio', '处理预约', '', [1 => '通过', 2 => '拒绝'])
            ->addFormItem('marks', 'textarea', '备注')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('处理会议室预约')
            ->content($content);
    }
}
