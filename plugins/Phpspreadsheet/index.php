<?php
/**
 * 插件入口类
 * 参考文档https://www.kancloud.cn/youpzt/eacoo/540653
 */

namespace plugins\Phpspreadsheet;

use app\common\controller\Plugin;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class Index
 * @package plugins\Phpspreadsheet
 * PHPspreadsheet控制器
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

    public function exportToTable()
    {
        return \view();
    }

}
