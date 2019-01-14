<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/14
 * Time: 16:15
 */

namespace app\park_nursery\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_nursery\model\ParkNurseryList;
use think\Db;

/**
 * Class Nursery
 * @package app\park_nursery\admin
 * 苗圃列表控制器
 */
class Nursery extends Admin
{
    /**
     * @var
     * 苗圃列表模型
     */
    protected $nurseryModel;
    /**
     * @var
     * 可用楼宇列表
     */
    protected $buildList;
    /**
     * @var
     * 楼层
     */
    protected $floors;
    /**
     * @var
     * 工位状态类型
     */
    protected $statusType;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->nurseryModel = new ParkNurseryList();
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 'eq', 1)
            ->column('id,title');
        $floors = Db::name('ParkNurseryList')
            ->column('floor');
        $this->floors = \array_combine($floors, $floors);
        $this->statusType = [
            1 => '未租',
            2 => '已租',
            3 => '自用',
        ];
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        list($data_list, $total) = $this->nurseryModel->search([
            ['name' => 'build_id', 'type' => 'select', 'title' => '楼宇', 'options' => $this->buildList],
            ['name' => 'floor', 'type' => 'select', 'title' => '楼层', 'options' => $this->floors],
            ['name' => 'status', 'type' => 'select', 'title' => '苗圃状态', 'options' => $this->statusType],
        ])->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('resume')
            ->addTopButton('forbid')
            ->addTopButton('delete')
            ->setSearch('请输入关键字')
            ->keyListItem('build_id', '楼宇', 'callback', 'getBuildingNameById')
            ->keyListItem('floor', '楼层')
            ->keyListItem('station_number', '工位号')
            ->keyListItem('station_fee', '工位费')
            ->keyListItem('station_deposit', '押金')
            ->keyListItem('station_status', '工位状态', 'array', $this->statusType)
            ->keyListItem('marks', '备注')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkNurseryList'])
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('苗圃工位列表')
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException'
     * 添加/修改
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->nurseryModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->roomModel->getError());
            }
        } else {
            $info = [
                'station_status' => 1,
            ];

            if ($id > 0) {
                $info = ParkNurseryList::get($id);
            }

            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('build_id', 'select', '楼宇', '请选择楼宇', $this->buildList)
                ->addFormItem('floor', 'text', '楼层', '请输入数字')
                ->addFormItem('station_number', 'text', '工位号', '请输入工位号')
                ->addFormItem('station_fee', 'text', '工位费', '单位:元')
                ->addFormItem('station_deposit', 'text', '押金', '单位:元')
                ->addFormItem('station_status', 'radio', '工位状态', '', $this->statusType)
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return (new Iframe())
                ->setMetaTitle($title . '工位')
                ->content($content);
        }
    }
}