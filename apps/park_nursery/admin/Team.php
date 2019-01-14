<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/14
 * Time: 16:55
 */

namespace app\park_nursery\admin;


use app\admin\controller\Admin;
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
        list($data_list, $total) = $this->teamModel->search([
            ['name' => 'build_id', 'type' => 'select', 'title' => '楼宇', 'options' => $this->buildList],
            ['name' => 'floor', 'type' => 'select', 'title' => '楼层', 'options' => $this->floors],
            ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"'],
        ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名称')
            ->keyListItem('id', 'ID')
            ->keyListItem('name', '团队名称')
            ->keyListItem('build_id', '楼宇')
            ->keyListItem('station_id', '工位号')
            ->keyListItem('real_station_fee', '实缴工位费')
            ->keyListItem('property_fee', '物业费')
            ->keyListItem('aircon_fee', '空调费')
            ->keyListItem('entry_time', '入驻时间')
            ->keyListItem('end_time', '到期时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete')
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('苗圃团队列表')
            ->content($content);
    }


    public function edit($id = 0)
    {

    }

}