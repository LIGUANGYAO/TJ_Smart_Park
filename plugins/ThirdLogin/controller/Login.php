<?php
namespace plugins\ThirdLogin\controller;
use think\Hook;
use think\Db;
use app\home\controller\Plugin;
use plugins\ThirdLogin\model\ThirdLogin as ThirdLoginModel;

use plugins\ThirdLogin\EacooSDK\ThirdOauth;
use plugins\ThirdLogin\EacooSDK\ThirdOauthInfo;
use app\common\model\User;

/**
 * 第三方登录控制器
 */
class Login extends Plugin {

    public $thirdLoginModel;

    public function _initialize() {
        parent::_initialize();

        //$this->pluginPath = ROOT_PATH.'plugins/ThirdLogin/';

        $this->thirdLoginModel = new ThirdLoginModel();
    }
    /**
     * 登录地址
     */
    public function login(){
        $platform = input('param.platform');
        empty($platform) && $this->error('参数错误');
        $sns  = ThirdOauth::getInstance($platform); //加载ThinkOauth类并实例化一个对象

        $this->redirect($sns->getRequestCodeURL()); //跳转到授权页面
    }

    /**
     * 登陆后回调地址
     */
    public function callback(){
        $code     = input('param.code');
        $platform = input('param.platform');
        $oauth_obj = ThirdOauth::getInstance($platform);

        //腾讯微博需传递的额外参数
        $extend = null;
        if($platform == 'tencent'){
            $extend = array('openid' => input('param.openid'), 'openkey' =>  input('param.openkey'));
        }

        $token = $oauth_obj->getAccessToken($code , $extend); //获取第三方Token
        $third_oauth_info = ThirdOauthInfo::$platform($token); //获取第三方传递回来的用户信息
        $user_third_info = ThirdLoginModel::where(['openid'=>$token['openid'], 'platform'=>$platform])->find(); //根据openid等参数查找同步登录表中的用户信息

        if (!empty($user_third_info)) {//库里存在信息
            
            $is_user = User::where(['uid'=>$user_third_info['uid']])->count();
            if ($is_user) {//存在该登录用户
                //直接去登录
                ThirdLoginModel::updateTokenByTokenAndPlatform($token,$platform);
                $user_info = User::get($user_third_info['uid']);
                User::autoLogin($user_info->toArray());
                $this->redirect('home/index/index');
            }
        } else{
            session('token', $token);
            session('third_oauth_info', $third_oauth_info);
            //$this->register();
            $this->assign('third_oauth_info', $third_oauth_info);
            $this->assign('meta_title', "登陆" );
            return $this->fetch('register');
        }
        
    }

    /**
     * 授权注册用户
     * @return [type] [description]
     * @date   2017-10-09
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function register() {
        $third_oauth_info = session('third_oauth_info');
        $token            = session('token');
        $data             = input('post.');
        $data['nickname'] = !empty($data['nickname']) ? $data['nickname'] : $data['username'];
        $data['password'] = $token['openid'].$token['access_token'];
        //验证信息头
        //$result = $this->validate($data,'Register.thirdLogin');
        $result = true;
        if(true !== $result){
            //$this->paramError = true;
            // 验证失败 输出错误信息
            $this->error($result);
            exit;
        } else{
            // 启动事务
            Db::startTrans();
            try {
                $data['url'] = !empty($third_oauth_info['url']) ? $third_oauth_info['url']:'';

                $user_model = new User();
                $user_model->allowField(true)->isUpdate(false)->data($data)->save();
                $uid = $user_model->uid;
                if ($uid>0 ) {
                    if (!$this->thirdLoginModel->addInfo($uid)) {
                        // 回滚事务
                        Db::rollback();
                    } else{
                        action_log(0, $uid, ['register_data'=>$data],'third_login_oauth注册');
                        session('third_oauth_info',null);
                        $result = true;

                        // 提交事务
                        Db::commit();     
                    }

                }
            } catch (\Exception $e) {
                $result = false;
                $error = $e;
                // 回滚事务
                Db::rollback();
                
            }

            if ($result==true) {
                $result = User::login($data['email'],$data['password']);
                if ($result['code']==1) {
                    $uid = !empty($result['data']['uid']) ? $result['data']['uid']:0;
                    action_log(0, $uid, ['login_data'=>$data],'eacooserver注册并登录');
                    $this->success('注册成功，并已登录',url('home/index/index'));

                } elseif ($result['code']==0) {
                    $this->error($result['msg']);
                } else {
                    $this->logout();
                }
                
            } else{

                $this->error('注册失败!'.$error);
            }
        }
        
    }

    /**
     * 绑定本地帐号
     */
    public function bind(){
        $third_oauth_info = session('third_oauth_info');

        $email    = input('param.email');
        $password = input('param.password');

        $result = User::login($email, $password);
        if ($result['code']==1) {
            $uid = !empty($result['data']['uid']) ? $result['data']['uid']:0;
            action_log(0, $uid, ['from_data'=>input('param.')],'ThirdLogin登录');
            $this->success('登录成功！',url('home/index/index'));

        } elseif ($result['code']==0) {
            $this->error($result['msg']);
        } else {
            $this->logout();
        }

        if($uid > 0){
            //新增SNS登录账号
            if($this->thirdLoginModel->addInfo($uid)){
                session('third_oauth_info', null);
                $this->success('微信账号绑定成功', cookie('__forward__') ? : url('home/index/index'));
            } else{
                $this->error('新增SNS登录账号失败');
            }
        }else{
            $this->error('绑定失败'.$user_object->getError()); // 绑定失败
        }
    }

    /**
     * 取消绑定本地帐号
     */
    public function cancelBind($uid){
        $map['uid'] = $uid;
        $map['type'] = $_GET['type'];
        $ret = $this->thirdLoginModel->where($map)->delete();
        if($ret){
            $this->success('取消绑定成功');
        }else{
            $this->error('取消绑定失败');
        }
    }
}
