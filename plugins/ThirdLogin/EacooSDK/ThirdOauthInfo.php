<?php
namespace plugins\ThirdLogin\EacooSDK;
use app\admin\model\Plugins;

class ThirdOauthInfo{
    //登录成功，获取腾讯QQ用户信息
    public static function qq($token){
        //import("ORG.ThinkSDK.ThinkOauth");
        $qq   = ThirdOauth::getInstance('qq', $token);
        $data = $qq->call('user/get_user_info');

        if($data['ret'] == 0){
            $userInfo['platform'] = 'qq';
            $userInfo['username'] = $data['nickname'];
            $userInfo['nickname'] = $data['nickname'];
            $userInfo['avatar'] = $data['figureurl_qq_2'];
            $userInfo['sex'] = $data['gender']=='男'? 0:1;
            return $userInfo;
        } else {
            throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取新浪微博用户信息
    public static function sina($token){
        $sina = ThirdOauth::getInstance('sina', $token);
        $data = $sina->call('users/show', "uid={$sina->openid()}");

        if($data['error_code'] == 0){
            $userInfo['platform'] = 'sina';
            $userInfo['username'] = $data['name'];
            $userInfo['nickname'] = $data['screen_name'];
            $userInfo['avatar'] = $data['avatar_large'];
            $userInfo['sex'] = $data['gender']=='m'? 0:1;
            return $userInfo;
        } else {
            throw_exception("获取新浪微博用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取网易微博用户信息
    public static function t163($token){
        $t163 = ThirdOauth::getInstance('t163', $token);
        $data = $t163->call('users/show');

        if($data['error_code'] == 0){
            $userInfo['platform'] = 't163';
            $userInfo['username'] = $data['name'];
            $userInfo['nickname'] = $data['screen_name'];
            $userInfo['avatar'] = str_replace('w=48&h=48', 'w=180&h=180', $data['profile_image_url']);
            return $userInfo;
        } else {
            throw_exception("获取网易微博用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取360用户信息
    public static function x360($token){
        $x360 = ThirdOauth::getInstance('x360', $token);
        $data = $x360->call('user/me');

        if($data['error_code'] == 0){
            $userInfo['type'] = 'x360';
            $userInfo['username'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['avatar'] = $data['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取360用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取豆瓣用户信息
    public static function douban($token){
        $douban = ThirdOauth::getInstance('douban', $token);
        $data   = $douban->call('user/~me');

        if(empty($data['code'])){
            $userInfo['platform'] = 'douban';
            $userInfo['username'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['avatar'] = $data['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取豆瓣用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取Github用户信息
    public static function github($token){
        $obj = ThirdOauth::getInstance('github', $token);
        $data   = $obj->call('user');

        if(empty($data['code'])){
            $userInfo = [
                'platform'        =>'github',
                'username'        =>$data['login'],
                'nickname'        =>$data['name'],
                'email'          => $data['email'],
                'avatar'          =>$data['avatar_url'],
                'url'             =>$data['blog'],
                'github_homepage' =>$data['html_url'],
            ];
            return $userInfo;
        } else {
            throw_exception("获取Github用户信息失败：{$data}");
        }
    }

    //登录成功，获取Gitee码云用户信息
    public static function gitee($token){
        $obj = ThirdOauth::getInstance('gitee', $token);
        $data   = $obj->call('user');

        if(empty($data['code'])){
            $userInfo = [
                'platform'       => 'gitee',
                'username'       => $data['login'],
                'nickname'       => $data['name'],
                'email'          => $data['email'],
                'avatar'         => $data['avatar_url'],
                'url'            => $data['blog'],
                'gitee_homepage' => $data['html_url'],
                'intro'          => $data['bio'],  
            ];
            return $userInfo;
        } else {
            throw_exception("获取Github用户信息失败：{$data}");
        }
    }

    //登录成功，获取淘宝网用户信息
    public static function taobao($token){
        $taobao = ThirdOauth::getInstance('taobao', $token);
        $fields = 'user_id,nick,sex,buyer_credit,avatar,has_shop,vip_info';
        $data   = $taobao->call('taobao.user.buyer.get', "fields={$fields}");

        if(!empty($data['user_buyer_get_response']['user'])){
            $user = $data['user_buyer_get_response']['user'];
            $userInfo['platform'] = 'taobao';
            $userInfo['username'] = $user['user_id'];
            $userInfo['nickname'] = $user['nick'];
            $userInfo['avatar'] = $user['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取淘宝网用户信息失败：{$data['error_response']['msg']}");
        }
    }

    //登录成功，获取百度用户信息
    public static function baidu($token){
        $baidu = ThirdOauth::getInstance('baidu', $token);
        $data  = $baidu->call('passport/users/getLoggedInUser');

        if(!empty($data['uid'])){
            $userInfo['platform'] = 'baidu';
            $userInfo['username'] = $data['uid'];
            $userInfo['nickname'] = $data['uname'];
            $userInfo['avatar'] = "http://tb.himg.baidu.com/sys/portrait/item/{$data['portrait']}";
            return $userInfo;
        } else {
            throw_exception("获取百度用户信息失败：{$data['error_msg']}");
        }
    }

    //登录成功，微信用户信息
    public static function wechat($token){
        $weixin = ThirdOauth::getInstance('weixin', $token);
        $data = $weixin->call('sns/userinfo');

        if($data['ret'] == 0){
            $userInfo=$data;
            $userInfo['platform'] = 'wechat';
            $userInfo['username'] = $data['nickname'];
            $userInfo['nickname'] = $data['nickname'];
            $userInfo['avatar'] = $data['headimgurl'];
            return $userInfo;
        } else {
            throw_exception("获取微信用户信息失败：{$data['errmsg']}");
        }
    }
}
