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
        'qichacha',
        'qichachaTm',
        'qichachaPatent',
        'qichachaCertificate',
        'qichachaWcopyright',
        'qichachaScopyright',
        'qichachaWebsite'
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
     * 根据企业名称获取工商Master信息
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
        } else {
            return false;
        }
    }

    /**
     * @param string $keyword
     * @return bool|string
     * 全国商标查询--查询商标列表
     * 请求参数：key=>'接口ApiKey',keyword=>'查询关键字（商标名称，商标注册号，申请人/代理人名称）'
     */
    public function qichachaTm($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/tm/Search?key=$appkey&keyword=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param string $keyword
     * @return bool|string
     * 专利查询--公司专利多重查询
     * keyword=>关键字(公司名或keyNo)
     */
    public function qichachaPatent($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/PatentV4/SearchMultiPatents?key=$appkey&searchKey=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param string $keyword
     * @return bool|string
     * 企业证书查询--企业证书查询
     */
    public function qichachaCertificate($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/ECICertification/SearchCertification?key=$appkey&searchKey=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param string $keyword
     * @return bool|string
     * 著作权软著查询--著作权查询
     */
    public function qichachaWcopyright($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/CopyRight/SearchCopyRight?key=$appkey&searchKey=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param string $keyword
     * @return bool|string
     * 著作权查询--软件著作权查询
     */
    public function qichachaScopyright($keyword = '')
    {
        $qichacha_config = $this->getConfig('Qichacha');
        if ($qichacha_config['status']) {
            $appkey = $qichacha_config['appKey'];
            $secretKey = $qichacha_config['secretKey'];

            $Timespan = \time();
            $Token = \strtoupper(\md5($appkey . $Timespan . $secretKey));

            $header[] = "Token: $Token";
            $header[] = "Timespan: $Timespan";

            $url = "http://api.qichacha.com/CopyRight/SearchSoftwareCr?key=$appkey&searchkey=$keyword";
            $result = $this->qichacha_get($header, $url);
            return $result;
        } else {
            return false;
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
