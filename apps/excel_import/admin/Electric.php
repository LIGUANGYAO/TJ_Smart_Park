<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/30
 * Time: 13:42
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\excel_import\model\CostElectricList;
use think\Db;

/**
 * Class Electric
 * @package app\excel_import\admin
 * 导入电费控制器
 */
class Electric extends Admin
{
    /**
     * @var
     * 大楼列表
     */
    protected $buildList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->buildList = Db::name('ParkBuilding')
            ->where('status', 1)
            ->column('id,title');
    }

    /**
     * @return \app\common\layout\Content
     * 列表页
     */
    public function index()
    {
        $import = [
            'icon' => 'fa fa-folder-open-o',
            'title' => '导入',
            'class' => 'btn btn-default btn-sm',
            'href' => url('import')
        ];
        list($data_list, $total) = (new CostElectricList())->search(['keyword_condition' => 'enterprise_name',])->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('self', $import)
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('year', '年份')
            ->keyListItem('month', '月份')
            ->keyListItem('park', '园区名称')
            ->keyListItem('build_id', '楼宇', 'array', $this->buildList)
            ->keyListItem('floor', '楼层')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('area', '面积')
            ->keyListItem('s_date', '租赁开始日期')
            ->keyListItem('e_date', '租赁结束日期')
            ->keyListItem('meter_number', '电表号')
            ->keyListItem('days', '计费天数')
            ->keyListItem('last_number', '上月抄见数')
            ->keyListItem('this_number', '本月抄见数')
            ->keyListItem('used_number', '使用度数')
            ->keyListItem('round_amount', '四舍五入用电金额')
            ->keyListItem('share_amount', '均摊金额')
            ->keyListItem('round_share_amount', '四舍五入均摊金额')
            ->keyListItem('real_amount', '合计金额')
            ->keyListItem('aki_share_amount', '空置均摊')
            ->keyListItem('round_aki_share_amount', '四舍五入空置均摊')
            ->keyListItem('tongpu_pay', '同普应付四舍五入金额')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('delete', ['model' => 'CostElectricList'])
            ->setListData($data_list)
            ->setListPage($total, 10)
            ->fetch();
        return (new Iframe())
            ->search([
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="请输入企业名"',],
                ['name' => 'build_id', 'type' => 'select', 'title' => '按楼宇', 'options' => $this->buildList],
            ])
            ->content($content);
    }

    /**
     * @throws \think\Exception
     * 导入表格
     */
    public function import()
    {
        $url = '/admin.php/excel_import/electric/import.html';
        $sheetData = hook('importFromTable', $url, true);
        if (!empty($sheetData[0])) {
            $parkName = $sheetData[0][0][0];
            $buildName = $sheetData[0][1][10];
            $year = $sheetData[0][1][11];
            $month = $sheetData[0][1][12];
            $newData = \array_slice($sheetData[0], 3);
            $sqlData = [];
            foreach ($newData as $k => $v) {
                $sqlData[$k]['enterprise_id'] = \getEnterpriseIdByEnterpriseName($v[0]);
                $sqlData[$k]['enterprise_name'] = $v[0];
                $sqlData[$k]['year'] = $year;
                $sqlData[$k]['month'] = $month;
                $sqlData[$k]['park'] = $parkName;
                $sqlData[$k]['build_id'] = \getBuildIdByBuildName($parkName, $buildName);
                $sqlData[$k]['floor'] = \substr($v[1], 2, 1);
                $sqlData[$k]['room_number'] = \substr($v[1], 4);
                $sqlData[$k]['area'] = $v[2];
                $sqlData[$k]['s_date'] = \substr($v[3], 0, 10);
                $sqlData[$k]['e_date'] = \substr($v[3], 11);
                $sqlData[$k]['meter_number'] = $v[4];
                $sqlData[$k]['days'] = $v[5];
                $sqlData[$k]['last_number'] = $v[6];
                $sqlData[$k]['this_number'] = $v[7];
                $sqlData[$k]['used_number'] = $v[8];
                $sqlData[$k]['used_amount'] = $v[9];
                $sqlData[$k]['round_amount'] = \round($v[10], 1);
                $sqlData[$k]['share_amount'] = $v[11];
                $sqlData[$k]['round_share_amount'] = \round($v[12], 1);
                $sqlData[$k]['real_amount'] = $v[13];
                $sqlData[$k]['aki_share_amount'] = $v[14];
                $sqlData[$k]['round_aki_share_amount'] = \round($v[15], 1);
                $sqlData[$k]['tongpu_pay'] = $v[16];
                $sqlData[$k]['marks'] = $v[17];
            }
            $eleModel = new CostElectricList();
            $map = [
                'enterprise_name' => $sqlData[0]['enterprise_name'],
                'year' => $sqlData[0]['year'],
                'month' => $sqlData[0]['month'],
            ];
            $count = $eleModel::where($map)->count();
            if ($count > 0) {
                $this->error('请勿重复导入');
            } else {
                $eleModel->saveAll($sqlData);
                $this->success('导入成功', \url('index'));
            }
        }
    }
}
