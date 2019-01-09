<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/13
 * Time: 11:48
 */

namespace app\park_building\admin;

use app\admin\controller\Admin;
use app\common\layout\Iframe;
use app\park_building\model\ParkRoom;
use think\Db;

/**
 * Class Room房源控制器
 * @package app\park_building\admin
 */
class Room extends Admin
{
    /**
     * @var
     * 楼宇数据
     */
    protected $buildData;
    /**
     * @var
     * 租赁状态
     */
    protected $statusType;

    protected $roomType;
    /**
     * @var
     * 装修类型
     */
    protected $decoration;
    /**
     * @var
     * 楼层数据
     */
    protected $floors;
    /**
     * @var
     * 房源模型
     */
    protected $roomModel;

    /**
     *初始方法
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->statusType = [
            1 => '未租',
            2 => '已租',
        ];
        $this->roomType = [
            1 => '办公',
            2 => '商铺',
            3 => '自用',
            4 => '会议室',
            5 => '苗圃',
            6 => '展览室',
        ];
        $this->decoration = [
            1 => '毛坯',
            2 => '简装',
        ];
        $floors = Db::name('ParkRoom')->column('floor');
        $this->floors = \array_combine($floors, $floors);
        $this->roomModel = new ParkRoom();
        $this->buildData = Db::name('ParkBuilding')
            //只显示启用的楼宇
            ->where('status', 1)
            ->column('id,title');
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('房源列表')
            ->search([
                ['name' => 'status', 'type' => 'select', 'title' => '租赁状态', 'options' => $this->statusType],
                ['name' => 'building_id', 'type' => 'select', 'title' => '楼宇', 'options' => $this->buildData],
                ['name' => 'floor', 'type' => 'select', 'title' => '楼层', 'options' => $this->floors]
            ])
            ->content($this->grid());
    }


    /**
     * @return mixed
     * 表格内容
     */
    public function grid()
    {
        list($data_list, $total) = $this->roomModel
            ->search('status,building_id,floor')
            ->getListByPage([], true, 'create_time desc');

        $content = builder('list')
            ->addTopButton('addnew', ['model' => 'ParkRoom'])
            ->addTopButton('delete', ['model' => 'ParkRoom'])
            ->setSearch('请输入关键字')
            ->keyListItem('building_id', '楼宇', 'callback', 'getBuildingNameById')
            ->keyListItem('floor', '楼层')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('area', '面积')
            ->keyListItem('unit_price', '单价')
            ->keyListItem('property_price', '物业费')
            ->keyListItem('aircon_price', '空调费')
            ->keyListItem('type', '房间类型', 'callback', 'getRoomTypeText')
            ->keyListItem('decoration', '装修', 'callback', 'getRoomDecorationText')
            ->keyListItem('enterprise_id', '入驻企业', 'callback', 'getEnterpriseNameByEnterpriseId')
            ->keyListItem('room_status', '状态', 'callback', 'getRoomStatusText')
            ->keyListItem('room_img', '封面', 'picture')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkRoom'])
            ->fetch();

        return Iframe()
            ->setMetaTitle('房间管理')
            ->content($content);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \think\exception\DbException
     * 新增/修改房间
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $data = \input('param.');
            //先不做数据校验
            if ($this->roomModel->editData($data)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->roomModel->getError());
            }
        } else {
            //设置默认值
            $info = [
                'decoration' => 1,
                'status' => 1
            ];

            if ($id > 0) {
                $info = ParkRoom::get($id);
                if (empty($info)) {
                    $this->error($this->buildingModel->getError());
                }
            }

            $return = builder('form')
                ->addFormItem('id', 'hidden', 'ID', 'ID')
                ->addFormItem('building_id', 'select', '楼宇', '请选择楼宇', $this->buildData)
                ->addFormItem('floor', 'text', '楼层', '请输入数字', '', 'data-rule="number" data-tip="请输入数字"')
                ->addFormItem('room_number', 'text', '房间号', '请输入数字', '', 'data-rule="number" data-tip="请输入数字"')
                ->addFormItem('area', 'text', '房间面积', '*平方米')
                ->addFormItem('unit_price', 'text', '房租', '*元/平方米')
                ->addFormItem('property_price', 'text', '物业费', '*元/平方米')
                ->addFormItem('aircon_price', 'text', '空调费', '*元/平方米')
                ->addFormItem('type', 'select', '房间类型', '', $this->roomType)
                ->addFormItem('decoration', 'radio', '装修', '', $this->decoration)
                ->addFormItem('room_status', 'radio', '状态', '', [1 => '未租', 2 => '已租'])
                ->addFormItem('room_img', 'picture', '封面', '上传房间的图片')
                ->addFormItem('content', 'wangeditor', '详情内容', '房间详情')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return Iframe()
                ->setMetaTitle($title . '房间')
                ->content($return);
        }
    }
}