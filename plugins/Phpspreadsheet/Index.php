<?php
/**
 * 插件入口类
 * 参考文档https://www.kancloud.cn/youpzt/eacoo/540653
 */

namespace plugins\Phpspreadsheet;

use app\common\controller\Plugin;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment as PHPExcel_Style_Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType as PHPExcel_Cell_DataType;
use PhpOffice\PhpSpreadsheet\Style\Fill as PHPExcel_Style_Fill;
use PhpOffice\PhpSpreadsheet\Style\Border as Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class Index
 * @package plugins\Phpspreadsheet
 * PHPspreadsheet控制器
 * 表格导入：读取表格数据，生成数组，处理数组
 * 表格导出：构建表格结构，构建表格数据，输出数据至表格，浏览器下载
 */
class Index extends Plugin
{

    /**
     * @var array 插件钩子
     */
    public $hooks = [
        'importFromTable',
        'exportToTable'
    ];

    /**
     * 插件安装方法
     */
    public function install()
    {
        return true;
    }

    /**
     * 插件卸载方法
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * @param string $url 传入处理表格数据的控制器
     * 如"/admin.php/cost_management/bill/import"
     * @return array|mixed|void
     * 在上述控制器中接收返回的array，然后进行相关的逻辑处理
     * 如果直接打印 $Data = hook('import', $url, true);返回的数据格式如下：
     * array(1) {
     * [0] => NULL
     * }
     * 导入数据逻辑处理完毕后，需要return一个json给前端页面不然会报错
     * 如：return json(['state' => 1, 'msg' => '处理成功']);
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * 导入表格
     */
    public function importFromTable($url = '')
    {
        if (\request()->file("file")) {
            $file = \request()->file('file');
            $info = $file->move('./uploads/excel');
            if ($info) {
                $path = './uploads/excel/' . $info->getSaveName();
                $inputFileType = IOFactory::identify($path);
                $excelReader = IOFactory::createReader($inputFileType);
                $PHPExcel = $excelReader->load($path);
                $sheet = $PHPExcel->getActiveSheet();
                $sheetData = $sheet->toArray();
                //删除上传的文件，防止占用大量磁盘
                \unlink($path);
                return $sheetData;
            }
        }
        $this->assign('url', $url);
        return $this->fetch('import');
    }

    /**
     * @param array $param
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * $param=['Excel','expTableData']
     */
    public function exportToTable($param = [])
    {
        $cellName = $param['Excel']['cellName'];
        $xlsCell = $param['Excel']['xlsCell'];
        $cellNum = count($xlsCell);//计算总列数
        $dataNum = count($param['expTableData']);//计算数据总行数
        $spreadsheet = new Spreadsheet();
        $sheet0 = $spreadsheet->getActiveSheet();
        $sheet0->setTitle("Sheet1");
        //设置表格标题A1
        $sheet0->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//表头合并单元格
        // ------------- 表头 -------------
        // $sheet0->setCellValue('A1',"测试表头");
        $sheet0->setCellValue('A1', $param['Excel']['sheetTitle']);

        $sheet0->getStyle('A1')->getFont()->setSize(20);
        $sheet0->getStyle('A1')->getFont()->setName('微软雅黑');
        //设置行高和列宽
        // ------------- 横向水平宽度 -------------
        if (isset($param['Excel']['H'])) {
            foreach ($param['Excel']['H'] as $key => $value) {
                $sheet0->getColumnDimension($key)->setWidth($value);
            }
        }

        // ------------- 纵向垂直高度 -------------
        if (isset($param['Excel']['V'])) {
            foreach ($param['Excel']['V'] as $key => $value) {
                $sheet0->getRowDimension($key)->setRowHeight($value);
            }
        }

        // ------------- 第二行：表头要加粗和居中，加入颜色 -------------
        $sheet0->getStyle('A1')
            ->applyFromArray(['font' => ['bold' => false], 'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER]]);
        $setcolor = $sheet0->getStyle("A2:" . $cellName[$cellNum - 1] . "2")->getFill();
        $setcolor->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $colors = ['00a000', '53a500', '3385FF', '00a0d0', 'D07E0E', 'c000c0', '0C8080', 'EFE4B0'];//设置总颜色
        $selectcolor = $colors[mt_rand(0, count($colors) - 1)];//获取随机颜色
        $setcolor->getStartColor()->setRGB($selectcolor);

        // ------------- 根据表格数据设置列名称 -------------

        for ($i = 0; $i < $cellNum; $i++) {
            $sheet0->setCellValue($cellName[$i] . '2', $xlsCell[$i][1])
                ->getStyle($cellName[$i] . '2')
                ->applyFromArray(['font' => ['bold' => true], 'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER]]);
        }

        // ------------- 渲染表中数据内容部分 -------------

        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $sheet0->getStyle($cellName[$j] . ($i + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER]]);
                $sheet0->setCellValueExplicit($cellName[$j] . ($i + 3), $param['expTableData'][$i][$xlsCell[$j][0]], PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet0->getStyle($cellName[$j] . ($i + 3))->getNumberFormat()->setFormatCode("@");
            }
        }

        // ------------- 设置边框 -------------
        // $sheet0->getStyle('A2:'.$cellName[$cellNum-1].($i+2))->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]]);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF505050'],
                ],
            ],
        ];

        $sheet0->getStyle('A2:' . $cellName[$cellNum - 1] . ($i + 2))->applyFromArray($styleArray);

        //$sheet0->setCellValue("A".($dataNum+10)," ");//多设置一些行

        // ------------- 输出 -------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
        //header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header("Content-Disposition: attachment;filename=" . $param['Excel']['fileName'] . ".xlsx");//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    /**
     *导出使用示例
     */
    public function export()
    {
        $Excel['fileName'] = "表格导出示例-" . date('Y年m月d日-His', time());
        $Excel['cellName'] = ['A', 'B', 'C', 'D'];
        $Excel['H'] = ['A' => 12, 'B' => 20, 'C' => 14, 'D' => 16];//横向水平宽度
        $Excel['V'] = ['1' => 40, '2' => 23];//纵向垂直高度
        $Excel['sheetTitle'] = "我是表头";//大标题，自定义
        $Excel['xlsCell'] = [['autoid', '序号'], ['school', '学校'], ['addr', '省份'], ['type', '类型']];
        $param = [
            'Excel' => $Excel,
            'expTableData' => [
                ['autoid' => '1', 'school' => '云南大学', 'addr' => '云南省', 'type' => '综合'],
                ['autoid' => '2', 'school' => '云南财经大学', 'addr' => '云南省', 'type' => '财经'],
                ['autoid' => '3', 'school' => '云南民族大学', 'addr' => '云南省', 'type' => '综合'],
                ['autoid' => '4', 'school' => '云南师范大学', 'addr' => '云南省', 'type' => '师范'],
                ['autoid' => '5', 'school' => '云南旅游大学', 'addr' => '云南省', 'type' => '综合'],
                ['autoid' => '6', 'school' => '贵州大学', 'addr' => '贵州省', 'type' => '综合'],
                ['autoid' => '7', 'school' => '贵州财经大学', 'addr' => '贵州省', 'type' => '财经'],
                ['autoid' => '7', 'school' => '贵州师范大学', 'addr' => '贵州省', 'type' => '师范']
            ],
        ];
        hook('exportToTable', $param);
    }
}
