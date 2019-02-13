<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/29
 * Time: 16:26
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\excel_import\model\CostWaterList;
use think\Db;

/**
 * Class Water
 * @package app\excel_import\admin
 * 导入水费控制器
 */
class Water extends Admin
{
    protected $db;
    protected $buildList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->db = Db::name('CostWaterList');
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 1)
            ->column('id,title');
    }

    /**
     * @return \app\common\layout\Content
     * 列表
     */
    public function index()
    {
        $import = [
            'icon' => 'fa fa-folder-open-o',
            'title' => '导入',
            'class' => 'btn btn-default btn-sm',
            'href' => url('import')
        ];
        list($data_list, $total) = (new CostWaterList())->search(['keyword_condition' => 'enterprise_name',])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('self', $import)
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('park', '园区名称')
            ->keyListItem('build_id', '楼宇', 'array', $this->buildList)
            ->keyListItem('floor', '楼层')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('area', '面积')
            ->keyListItem('s_date', '租赁开始日期')
            ->keyListItem('e_date', '租赁结束日期')
            ->keyListItem('meter_number', '水表号')
            ->keyListItem('last_number', '上月抄见数')
            ->keyListItem('this_number', '本月抄见数')
            ->keyListItem('year', '年份')
            ->keyListItem('month', '月份')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('delete', ['model' => 'CostWaterList'])
            ->setListData($data_list)
            ->setListPage($total, 10)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('水费账单列表')
            ->search([
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"',],
                ['name' => 'build_id', 'type' => 'select', 'title' => '按楼宇', 'options' => $this->buildList],
            ])
            ->content($content);
    }

    /**
     * @throws \Exception
     * 导入
     */
    public function import()
    {
        $url = '/admin.php/excel_import/water/import.html';
        $Data = hook('importFromTable', $url, true);
//        \halt($Data);
        if (!empty($Data[0])) {
            $newData = \array_slice($Data[0], 4);
            $sqlData = [];
            foreach ($newData as $k => $v) {
                $sqlData[$k]['enterprise_id'] = \getEnterpriseIdByEnterpriseName($v[0]);
                $sqlData[$k]['enterprise_name'] = \trim($v[0]);
                $sqlData[$k]['park'] = \trim($Data[0][0][0]);
                $sqlData[$k]['build_id'] = \getBuildIdByBuildName($Data[0][0][0], $Data[0][1][5]);
                $sqlData[$k]['year'] = \trim($Data[0][1][6]);
                $sqlData[$k]['month'] = \trim($Data[0][1][7]);
                $sqlData[$k]['floor'] = \substr($v[1], 2, 1);
                $sqlData[$k]['room_number'] = \substr($v[1], 4);
                $sqlData[$k]['area'] = \trim($v[2]);
                $sqlData[$k]['s_date'] = \substr($v[3], 0, 10);
                $sqlData[$k]['e_date'] = \substr($v[3], 11);
                $sqlData[$k]['meter_number'] = \trim($v[4]);
                $sqlData[$k]['last_number'] = \trim($v[5]);
                $sqlData[$k]['this_number'] = \trim($v[6]);
                $sqlData[$k]['marks'] = $v[7];

            }
            $waterModel = new CostWaterList();
            $map = [
                'enterprise_name' => $sqlData[0]['enterprise_name'],
                'year' => $sqlData[0]['year'],
                'month' => $sqlData[0]['month'],
            ];
            $count = $waterModel::where($map)->count();
            if ($count > 0) {
                $this->error('请勿重复导入');
            } else {
                $waterModel->saveAll($sqlData);
                $this->success('导入成功', \url('index'));
            }
        }
    }

    public function export()
    {
        $map = [
            'enterprise_name' => '上海铠寻信息科技有限公司',
            'year' => '2018',
            'month' => '3-4'
        ];
        $var = Db::name('CostWaterList')
            ->where($map)
            ->sum('last_number');
        \halt($var);
    }
}
