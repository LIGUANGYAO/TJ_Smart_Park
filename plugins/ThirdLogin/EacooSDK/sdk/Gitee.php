<?php
// Github 2017-10-07
// +----------------------------------------------------------------------
// | PHP version 5.4+                
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.eacoo123.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace plugins\ThirdLogin\EacooSDK\sdk;
use plugins\ThirdLogin\EacooSDK\ThirdOauth;

class Gitee extends ThirdOauth{
	/**
	 * 获取requestCode的api接口
	 * @var string
	 */
	protected $GetRequestCodeURL = 'https://gitee.com/oauth/authorize';

	/**
	 * 获取access_token的api接口
	 * @var string
	 */
	protected $GetAccessTokenURL = 'https://gitee.com/oauth/token';

	/**
	 * API根路径
	 * @var string
	 */
	protected $ApiBase = 'https://gitee.com/api/v5/';

	/**
	 * 组装接口调用参数 并调用接口
	 * @param  string $api    githubAPI
	 * @param  string $param  调用API的额外参数
	 * @param  string $method HTTP请求方法 默认为GET
	 * @return json
	 */
	public function call($api, $param = '', $method = 'GET', $multi = false){
		/* Github 调用公共参数 */
		$params = ['access_token'=>$this->Token['access_token']];
		$header = [];
		$data = $this->http($this->url($api), $this->param($params, $param), $method, $header);
		return json_decode($data, true);
	}
	
	/**
	 * 解析access_token方法请求后的返回值
	 * @param string $result 获取access_token的方法的返回值
	 */
	protected function parseToken($result, $extend){
		$data = json_decode($result,true);
		if($data['access_token'] && $data['token_type']){
			$this->Token = $data;
			$data['openid'] = $this->openid();
			return $data;
		} else
			throw new \Exception("获取 Github ACCESS_TOKEN出错：未知错误");
	}
	
	/**
	 * 获取当前授权应用的openid
	 * @return string
	 */
	public function openid(){
		if(isset($this->Token['openid']))
			return $this->Token['openid'];
		
		$data = $this->call('user');
		if(!empty($data['id']))
			return $data['id'];
		else
			throw new \Exception('没有获取到 Github 用户ID！');
	}
	
}