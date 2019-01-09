<?php
// 记录行为日志

namespace app\admin\behavior;

use app\admin\model\Action as ActionModel;
use think\Request;

class Log
{

    public function run(&$param)
    {
        $request = Request::instance();
        // 获取行为
        $module_name = $request->module();
        $info = ActionModel::get(function ($query) use ($module_name, $request) {
            $current_action_name = strtolower($request->controller() . '_' . $request->action());
            if (strtolower($request->action()) == 'setstatus') {
                $module_name = 'admin';
                $current_action_name = 'setstatus';
            }
            $query->where([
                'depend_type' => 1,
                'depend_flag' => $module_name,
                'name' => $current_action_name,
                'status' => 1
            ])->field('id,title,action_type');
        });
        if ($info) {
            $params = [
                'param' => $request->get(),//只记录get的参数。因为post的参数带有敏感数据
            ];
            if (is_array($params)) {
                $params = json_encode($params);
            }
            $uid = is_admin_login();
            $remark = $info['title'];
            // 保存日志
            return $res = logic('common/Action')->recordLog($info['id'], 1, $uid, $params, $remark);
        }

    }

}