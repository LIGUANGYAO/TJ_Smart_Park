<?php
namespace plugins\ThirdLogin\validate;

use app\common\model\User;

use think\captcha\Captcha;
use think\Validate;

class OauthInfo extends Validate
{
    protected $regex = [ 'username' => '/^[a-zA-Z0-9_]{3,16}$/u'];
    // 验证规则
    protected $rule = [
        'openid'      => 'require',
        'access_token'   => 'require',
        'refresh_token'   => 'require',
        'platform' => 'require',
        'uid'    => 'number',
    ];

    protected $message = [
        'openid.require'      => '请填写邮箱',
        'access_token.require'   => 'access_token不能为空',
        'refresh_token.require'   => 'refresh_token不能为空',
        'platform.require'   => '平台标识不能为空',
        'uid.require'   => '用户名ID不能为空',
    ];

    protected $scene=[
        'step1' => ['email','captcha','password','repassword'],
    ];


}