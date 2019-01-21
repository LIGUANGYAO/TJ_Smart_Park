<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/21
 * Time: 14:21
 */

namespace app\service_laboratory\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\service_laboratory\model\ServiceLaboratoryList;
use think\Db;

/**
 * Class Room
 * @package app\service_laboratory\admin
 * 实验室列表控制器
 */
class Room extends Admin
{
    /**
     * @var
     * 实验室模型
     */
    protected $laboModel;
    /**
     * @var
     * 楼宇列表
     */
    protected $buildList;
    /**
     * @var
     * 实验室类别
     */
    protected $laboType;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->laboModel = new ServiceLaboratoryList();
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 'eq', 1)
            ->column('title', 'id');
        $this->laboType = \config('laboratory_type');
    }

    /**
     * @return \app\common\layout\Content
     * 实验室列表
     */
    public function index()
    {
        list($data_list, $total) = $this->laboModel->search()->getListByPage([], true, 'id asc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('building_id', '所在楼宇', 'array', $this->buildList)
            ->keyListItem('room_number', '房间号')
            ->keyListItem('type', '实验室类别', 'array', $this->laboType)
            ->keyListItem('equipment', '可用设备')
            ->keyListItem('capacity', '可容纳人数')
            ->keyListItem('status', '状态', 'array', [1 => '启用', 2 => '禁用'])
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => $this->laboModel])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'building_id', 'type' => 'select', 'title' => '所属楼宇', 'options' => $this->buildList],
                ['name' => 'type', 'type' => 'select', 'title' => '实验室类别', 'options' => $this->laboType],
                ['name' => 'status', 'type' => 'select', 'title' => '实验室状态', 'options' => [1 => '启用', 2 => '禁用']],
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/添加实验室
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->laboModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->laboModel->getError());
            }
        } else {
            $info = [
                'status' => 1,
            ];
            if ($id > 0) {
                $info = ServiceLaboratoryList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('building_id', 'select', '楼宇', '', $this->buildList)
                ->addFormItem('room_number', 'text', '房间号')
                ->addFormItem('type', 'select', '实验室类别', '', $this->laboType)
                ->addFormItem('equipment', 'text', '可用设备')
                ->addFormItem('capacity', 'text', '可容纳人数')
                ->addFormItem('status', 'radio', '状态', '', [1 => '启用', 2 => '禁用'])
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '实验室')
                ->content($content);
        }
    }
}