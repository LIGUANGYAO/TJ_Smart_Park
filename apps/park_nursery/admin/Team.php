<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/14
 * Time: 16:55
 */

namespace app\park_nursery\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_nursery\model\ParkNurseryTeamList;
use think\Db;

/**
 * Class Team
 * @package app\park_nursery\admin
 * 苗圃团队控制器
 */
class Team extends Admin
{
    /**
     * @var
     * 团队模型
     */
    protected $teamModel;
    /**
     * @var
     * 楼宇列表
     */
    protected $buildList;
    /**
     * @var
     * 楼层
     */
    protected $floors;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->teamModel = new ParkNurseryTeamList();
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 'eq', 1)
            ->column('id,title');
        $floors = Db::name('ParkNurseryList')
            ->column('floor');
        $this->floors = \array_combine($floors, $floors);
    }

    /**
     * @return \app\common\layout\Content
     * 团队列表
     */
    public function index()
    {
        list($data_list, $total) = $this->teamModel
            ->search([
                'keyword_condition' => 'name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名称')
            ->keyListItem('id', 'ID')
            ->keyListItem('name', '团队名称')
            ->keyListItem('build_id', '楼宇')
            ->keyListItem('floor', '楼层')
            ->keyListItem('station_id', '工位号')
            ->keyListItem('real_station_fee', '实缴工位费')
            ->keyListItem('property_fee', '物业费')
            ->keyListItem('aircon_fee', '空调费')
            ->keyListItem('entry_time', '入驻时间')
            ->keyListItem('end_time', '到期时间')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete')
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('苗圃团队列表')
            ->search([
                ['name' => 'build_id', 'type' => 'select', 'title' => '楼宇', 'options' => $this->buildList],
                ['name' => 'floor', 'type' => 'select', 'title' => '楼层', 'options' => $this->floors],
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"'],
            ])
            ->content($content);
    }


    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\Exception
     * @throws \think\exception\DbException
     * 新增/编辑团队
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            //检查数据
            //1,检查团队名称
            $teamNameCount = Db::name('ParkNurseryTeamList')
                ->where('name', 'eq', $param['name'])
                ->count();
            if ($teamNameCount>0){
                $this->error('该团队名称已存在');
            }
            //2,检查工位是否已被占用todo

            if ($this->teamModel->editData($param)) {
                //修改工位号状态
                $station_ids = \explode('|', $param['station_id']);
                Db::name('ParkNurseryList')
                    ->where('build_id', 'eq', $param['build_id'])
                    ->where('floor', 'eq', $param['floor'])
                    ->where('station_number', 'in', $station_ids)
                    ->setField('station_status', 2);
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->roomModel->getError());
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = ParkNurseryTeamList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('build_id', 'select', '楼宇', '请选择楼宇', $this->buildList)
                ->addFormItem('floor', 'text', '楼层', '请输入数字')
                ->addFormItem('station_id', 'text', '工位号', '请输入工位号')
                ->addFormItem('name', 'text', '企业名称', '请输入企业名称')
                ->addFormItem('real_station_fee', 'text', '实际缴纳工位费')
                ->addFormItem('property_fee', 'text', '物业费')
                ->addFormItem('aircon_fee', 'text', '空调费')
                ->addFormItem('entry_time', 'datetime', '入驻时间')
                ->addFormItem('end_time', 'datetime', '到期时间')
                ->addFormItem('marks', 'textarea', '备注')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '团队')
                ->content($content);
        }
    }

}