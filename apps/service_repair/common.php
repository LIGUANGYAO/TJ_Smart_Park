<?php
//模块自定义函数文件
use think\Db;

//框架内已有"get_nickname"方法,所以这个弃用了
if (!function_exists('getFrontUserNameById')) {
    /**
     * @param $uid
     * @return mixed
     * 根据用户ID返回前台用户的用户名
     */
    function getFrontUserNameById($uid)
    {
        $name = Db::name('Users')
            ->where('uid', 'eq', $uid)
            ->value('username');
        return $name;
    }
}
if (!function_exists('getAdminsByGroup')) {
    /**
     * @param $gid
     * @return array
     * 根据角色组返回该组内成员的['uid'=>'nickname']
     */
    function getAdminsByGroup($gid)
    {
        $users = Db::name('Admin a')
            ->join('AuthGroupAccess b', 'a.uid=b.uid')
            ->join('AuthGroup c', 'b.group_id=c.id')
            ->where('c.id', 'eq', $gid)
            ->column('a.uid,a.nickname');
        return $users;
    }
}