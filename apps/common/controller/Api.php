<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/15
 * Time: 13:58
 */

namespace app\common\controller;


use think\exception\HttpResponseException;
use think\Request;
use think\Response;

/**
 * Class Api
 * @package app\common\controller
 * api基础控制器
 */
class Api
{
    /**
     * @var
     * 客户端header数据
     */
    private $header;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->header = \request()->header();
    }

    /**
     *检测sign
     * 目前只是网页直接请求,没什么必要了
     */
    public function checkSign()
    {

    }

    /**
     * 操作成功返回的数据
     * @param string $msg 提示信息
     * @param mixed $data 要返回的数据
     * @param int $code 错误码，默认为1
     * @param string $type 输出类型
     * @param array $header 发送的 Header 信息
     */
    protected function success($msg = '', $data = null, $code = 1, $type = 'json', array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }


    /**
     * 操作失败返回的数据
     * @param string $msg 提示信息
     * @param mixed $data 要返回的数据
     * @param int $code 错误码，默认为1
     * @param string $type 输出类型
     * @param array $header 发送的 Header 信息
     */
    protected function error($msg = '', $data = null, $code = 0, $type = 'json', array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * @param mixed $msg
     * @param null $data
     * @param int $code
     * @param string $type
     * @param array $header
     * @throws HttpRequestException
     */
    protected function result($msg, $data = null, $code = 0, $type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'time' => Request::instance()->server('REQUEST_TIME'),
            'data' => $data,
        ];
        if (isset($header['statuscode'])) {
            $code = $header['statuscode'];
            unset($header['statuscode']);
        } else {
            //未设置状态码,根据code值判断
            $code = $code >= 1000 || $code < 200 ? 200 : $code;
        }
        $response = Response::create($result, $type, $code)->header($header);
        throw new HttpResponseException($response);
    }
}
