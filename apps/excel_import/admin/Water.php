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

/**
 * Class Water
 * @package app\excel_import\admin
 * 导入水费控制器
 */
class Water extends Admin
{
    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
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
            ->keyListItem('build_id', '楼宇')
            ->keyListItem('floor', '楼层')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('area', '面积')
            ->keyListItem('s_date', '租赁开始日期')
            ->keyListItem('e_date', '租赁结束日期')
            ->keyListItem('meter_number', '水表号')
            ->keyListItem('last_number', '上月抄见数')
            ->keyListItem('this_numner', '本月抄见数')
            ->keyListItem('year', '年份')
            ->keyListItem('month', '月份')
            ->keyListItem('marks', '备注')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('delete', ['model' => 'CostWaterList'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('水费账单列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名"',
                ]
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
        if (!empty($Data[0])) {
            $newData = \array_slice($Data[0], 4);
            $sqlData = [];
            foreach ($newData as $k => $v) {
                $sqlData[$k]['enterprise_id'] = \getEnterpriseIdByEnterpriseName($v[0]);
                $sqlData[$k]['enterprise_name'] = $v[0];
                $sqlData[$k]['build_id'] = \getBuildIdByBuildName($Data[0][0][0]);
                $sqlData[$k]['year'] = $Data[0][1][6];
                $sqlData[$k]['month'] = $Data[0][1][7];
                $sqlData[$k]['floor'] = \substr($v[1], 2, 1);
                $sqlData[$k]['room_number'] = \substr($v[1], 4);
                $sqlData[$k]['area'] = $v[2];
                $sqlData[$k]['s_date'] = \substr($v[3], 0, 10);
                $sqlData[$k]['e_date'] = \substr($v[3], 11);
                $sqlData[$k]['meter_number'] = $v[4];
                $sqlData[$k]['last_number'] = $v[5];
                $sqlData[$k]['this_number'] = $v[6];
                $sqlData[$k]['marks'] = $v[7];

            }
            $waterModel = new CostWaterList();
            $waterModel->saveAll($sqlData);
            $this->success('操作成功', \url('index'));
        }
    }
}
