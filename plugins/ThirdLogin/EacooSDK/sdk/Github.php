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

class Github extends ThirdOauth{
	/**
	 * 获取requestCode的api接口
	 * @var string
	 */
	protected $GetRequestCodeURL = 'https://github.com/login/oauth/authorize';

	/**
	 * 获取access_token的api接口
	 * @var string
	 */
	protected $GetAccessTokenURL = 'https://github.com/login/oauth/access_token';

	/**
	 * API根路径
	 * @var string
	 */
	protected $ApiBase = 'https://api.github.com/';

	/**
	 * 请求code 
	 */
	public function getRequestCodeURL(){
		$this->config();
		//Oauth 标准参数
		$params = [
			'client_id'    => $this->AppKey,
			'redirect_uri' => $this->Callback,
			'scope'        => 'user',
			'state'        => rand_code(20),
		];
		
		return $this->GetRequestCodeURL . '?' . http_build_query($params);
	}

	/**
	 * 获取access_token
	 * @param string $code 上一步请求到的code
	 */
	public function getAccessToken($code, $extend = null){
		$this->config();
		$params = [
				'client_id'     => $this->AppKey,
				'client_secret' => $this->AppSecret,
				'code'          => $code,
				'redirect_uri'  => $this->Callback,
		];

		$data = $this->http($this->GetAccessTokenURL, $params, 'GET');
		$this->Token = $this->parseToken($data, $extend);
		return $this->Token;
	}

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
		parse_str($result, $data);
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