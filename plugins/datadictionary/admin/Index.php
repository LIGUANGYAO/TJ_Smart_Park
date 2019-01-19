<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/18
 * Time: 15:36
 */

namespace plugins\DataDictionary\admin;


use app\admin\controller\Admin;

/**
 * Class DataDictionary
 * @package plugins\DataDictionary\admin
 *
 */
class Index extends Admin
{
    /**
     * @var string
     * 插件名称
     */
    protected $plugin_name = 'DataDictionary';

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     *字典入口
     */
    public function index()
    {
        //配置数据库
        $config = \config('database');
        $dbserver = $config['hostname'];
        $dbusername = $config['username'];
        $dbpassword = $config['password'];
        $database = $config['database'];
        //其他配置
        $title = \config('web_site_title') . '数据字典';
        $pdo = new \PDO("mysql:host=" . $dbserver . ";dbname=" . $database, $dbusername, $dbpassword);
        $pdo->query('SET NAMES utf8');
        $table_result = $pdo->query('show tables');
        $arr = $table_result->fetchAll(\PDO::FETCH_ASSOC);

        $s = "Tables_in_$database";
        //取得所有的表名
        foreach ($arr as $val) {
            $tables[]['TABLE_NAME'] = $val[$s];
        }


        //循环取得所有表的备注及表中列消息
        foreach ($tables AS $k => $v) {
            $sql = 'SELECT * FROM ';
            $sql .= 'INFORMATION_SCHEMA.TABLES ';
            $sql .= 'WHERE ';
            $sql .= "table_name = '{$v['TABLE_NAME']}'  AND table_schema = '{$database}'";
            $table_result = $pdo->query($sql);
            $t = $table_result->fetchAll(\PDO::FETCH_ASSOC);


            foreach ($t as $v) {
                $tables[$k]['TABLE_COMMENT'] = $v['TABLE_COMMENT'];
            }
            $sql = 'SELECT * FROM ';
            $sql .= 'INFORMATION_SCHEMA.COLUMNS ';
            $sql .= 'WHERE ';
            $sql .= "table_name = '{$v['TABLE_NAME']}' AND table_schema = '{$database}'";
            $fields = array();
            $field_result = $pdo->query($sql);
            $t = $field_result->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($t as $v) {
                $fields[] = $v;
            }
            $tables[$k]['COLUMN'] = $fields;
        }


        $html = '';
//循环所有表
        foreach ($tables AS $k => $v) {
            $html .= '<table  border="1" cellspacing="0" cellpadding="0" align="center">';
            $html .= '<caption>' . $v['TABLE_NAME'] . '  ' . $v['TABLE_COMMENT'] . '</caption>';
            $html .= '<tbody><tr><th>字段名</th><th>数据类型</th><th>默认值</th>  
     <th>允许非空</th>  
     <th>自动递增</th><th>备注</th></tr>';
            $html .= '';
            foreach ($v['COLUMN'] AS $f) {
                $html .= '<tr><td class="c1">' . $f['COLUMN_NAME'] . '</td>';
                $html .= '<td class="c2">' . $f['COLUMN_TYPE'] . '</td>';
                $html .= '<td class="c3"> ' . $f['COLUMN_DEFAULT'] . '</td>';
                $html .= '<td class="c4"> ' . $f['IS_NULLABLE'] . '</td>';
                $html .= '<td class="c5">' . ($f['EXTRA'] == 'auto_increment' ? '是' : ' ') . '</td>';
                $html .= '<td class="c6"> ' . $f['COLUMN_COMMENT'] . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody></table></p>';
        }
//输出
        echo '<html>  
 <head>  
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 <title>' . $title . '</title>  
 <style>  
 body,td,th {font-family:"宋体"; font-size:12px;}  
 table{border-collapse:collapse;border:1px solid #CCC;background:#efefef;}  
 table caption{text-align:left; background-color:#fff; line-height:2em; font-size:14px; font-weight:bold; }  
 table th{text-align:left; font-weight:bold;height:26px; line-height:26px; font-size:12px; border:1px solid #CCC;}  
 table td{height:20px; font-size:12px; border:1px solid #CCC;background-color:#fff;}  
 .c1{ width: 120px;}  
 .c2{ width: 120px;}  
 .c3{ width: 70px;}  
 .c4{ width: 80px;}  
 .c5{ width: 80px;}  
 .c6{ width: 270px;}  
 </style>  
 </head>  
 <body>';
        echo '<h1 style="text-align:center;">' . $title . '</h1>';
        echo $html;
        echo '</body></html>';
    }
}