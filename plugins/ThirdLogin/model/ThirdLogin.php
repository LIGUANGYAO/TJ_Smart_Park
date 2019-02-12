<?php
namespace plugins\ThirdLogin\model;
use think\Model;
/**
 * 第三方登陆模型
 */
class ThirdLogin extends Model{
    /**
     * 数据库表名
     */
    protected $name = 'plugin_third_login'; 

    protected $insert = ['sort'=>0,'status' => 1];  

    /**
     * 新增SNS登录账号
     */
    public function addInfo($uid){
        $token                 = session('token');
        $third_oauth_info      = session('third_oauth_info');
        $data['uid']           = $uid;
        $data['platform']      = $third_oauth_info['platform'];
        $data['openid']        = $token['openid'];
        $data['access_token']  = $token['access_token'];
        $data['refresh_token'] = !empty($token['refresh_token']) ? $token['refresh_token']:'';
        $result = $this->allowField(true)->isUpdate(false)->data($data)->save();
        return $result;
    }

    /**
     * 更新Token
     */
    public static function updateTokenByTokenAndPlatform($token, $platform){
        $map = [
            'openid' => $token['openid'],
            'platform' => $platform,
        ];
        $data['access_token'] = $token['access_token'];
        $data['refresh_token'] = !empty($token['refresh_token']) ? $token['refresh_token']:'';
        if (self::where($map)->count()) {
            self::where($map)->update($data);
            return true;
        }
        return false;
    }
}
