<?php
/**
 * 插件入口类
 * 参考文档https://www.kancloud.cn/youpzt/eacoo/540653
 */

namespace plugins\Qichacha;

use app\common\controller\Plugin;

/**
 * Class Index
 * @package plugins\Qichacha
 * 企查查插件
 * 调用方式:
 *        在需要的地方添加代码如下:
 *        $res = hook('qichacha','搜索关键字',true);
 *        return $res;
 */
class Index extends Plugin
{

    /**
     * @var array 定义插件钩子
     */
    public $hooks = [
        'qichacha'
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
     * @param string $keyword
     * @return bool|string
     * 实现钩子方法
     */
    public function qichacha($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/ECIV4/GetDetailsByName?key=$appkey&keyword=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        }
    }

    /**
     * @param $header
     * @param $url
     * @return bool|string
     * 发送HTTP请求
     */
    function qichacha_get($header, $url)
    {

        $ch = curl_init();
        $header[] = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);
        return $temp;
    }


    /**
     *调用示例
     */
    public function test()
    {
        $keyword = \input('keyword');
        $data = hook('qichacha', $keyword, true);
        \dump($data);
    }
}
