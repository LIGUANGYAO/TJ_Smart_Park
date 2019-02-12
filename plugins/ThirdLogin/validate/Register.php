<?php
namespace plugins\ThirdLogin\validate;

use app\common\model\User;

use think\captcha\Captcha;
use think\Validate;

class Register extends Validate
{
    protected $regex = [ 'username' => '/^[a-zA-Z0-9_]{3,16}$/u'];
    // 验证规则
    protected $rule = [
        'email'      => 'require|email|unique:users,email,,uid',
        'username'   => 'require|length:1,20|regex:username|unique:users,username,,uid|checkDenyUser',
        'password'   => 'require|length:8,32',
        'repassword' => 'require|length:6,32|confirm:password',
        'captcha'    => 'require|length:4|checkCaptcha',
    ];

    protected $message = [
        'email.require'      => '请填写邮箱',
        'email.email'        => '邮箱格式不正确',
        'email.unique'        => '注册邮箱已存在',
        'username.require'   => '请填写用户名',
        'username.unique'   => '用户名已存在',
        'username.length'    => '用户名长度不正确',
        'username.regex'     => '用户名格式不正确',
        'username.checkDenyUser' => '该用户名禁止注册',
        'captcha.require'    => '请填写验证码',
        'captcha.length'     => '验证码格式不正确',
        'captcha.checkCaptcha' => '验证码不正确',
        'password.require'   => '请输入密码',
        'password.length'    => '密码长度不符合，请重新输入',
        'repassword.require' => '请输入重复密码',
        'repassword.length'  => '重复密码格式不正确',
        'repassword.confirm' => '两次密码不一致，请重新输入',
    ];

    protected $scene=[
        'step1' => ['email','captcha','password','repassword'],
        'step2' => ['email','username','password','repassword'],
        'thirdLogin' => ['email','username'=>'require|length:1,20|regex:username|unique:users,username,,uid'],
    ];

    /**
     * 验证码
     * @param  [type] $value [description]
     * @param  [type] $rule [description]
     * @param  [type] $data [description]
     * @return [type] [description]
     * @date   2017-09-24
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function checkCaptcha($value,$rule,$data)
    {
        $captcha = new Captcha();
        if(!$captcha->check($value,2)){
            return false;
        }

        return true;
    }

    /**
     * 检测禁止用户名
     * @param  [type] $value [description]
     * @param  [type] $rule [description]
     * @param  [type] $data [description]
     * @return [type] [description]
     * @date   2017-09-27
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function checkDenyUser($value,$rule,$data)
    {
        $res = User::checkDenyUser($value);
        if ($res) {
            return true;
        }
        return false;
    }
}