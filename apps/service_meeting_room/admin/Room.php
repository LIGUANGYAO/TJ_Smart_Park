<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/21
 * Time: 9:47
 */

namespace app\service_meeting_room\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\service_meeting_room\model\ServiceMeetingRoomList;
use think\Db;

/**
 * Class Room
 * @package app\service_meeting_room\admin
 * 会议室控制器
 */
class Room extends Admin
{
    /**
     * @var
     * 会议室模型
     */
    protected $roomModel;
    /**
     * @var
     * 楼宇列表
     */
    protected $buildList;
    /**
     * @var
     * 设备列表
     */
    protected $equipmentList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->roomModel = new ServiceMeetingRoomList();
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 'eq', 1)
            ->column('id,title');
        $this->equipmentList = \config('meeting_room_equipment');
    }

    /**
     * @return \app\common\layout\Content
     * 会议室列表
     */
    public function index()
    {
        list($data_list, $total) = $this->roomModel->search()->getListBypage([], true, 'listorder asc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('phase', '楼宇号', 'array', $this->buildList)
            ->keyListItem('room_number', '房间号')
            ->keyListItem('area', '面积')
            ->keyListItem('capacity', '可容纳人数')
            ->keyListItem('equipment', '设备')
            ->keyListItem('room_img', '封面图', 'picture')
            ->keyListItem('content', '会议室描述')
            ->keyListItem('listorder', '排序')
            ->keyListItem('status', '状态', 'array', [1 => '启用', 0 => '禁用'])
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ServiceMeetingRoomList'])
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'phase', 'type' => 'select', 'title' => '所在楼宇', 'options' => $this->buildList]
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 添加/编辑会议室
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->roomModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->roomModel->getError());
            }
        } else {
            $info = [
                'listorder' => '50'
            ];
            if ($id > 0) {
                $info = ServiceMeetingRoomList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('phase', 'select', '楼宇', '', $this->buildList)
                ->addFormItem('room_number', 'text', '房间号')
                ->addFormItem('area', 'text', '面积(㎡)')
                ->addFormItem('capacity', 'text', '可容纳人数')
                ->addFormItem('equipment', 'text', '会议室设备', '请输入该会议室配备设施')
                ->addFormItem('room_img', 'pictures', '会议室图片', '首张图片将作为封面图展示')
                ->addFormItem('listorder', 'text', '排序')
                ->addFormItem('content', 'wangeditor', '房间介绍', '请对该会议室进行描述')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '会议室')
                ->content($content);
        }
    }
}