<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/11
 * Time: 10:37
 */

namespace app\park_incubation\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_incubation\model\ParkIncubationVisitLog;
use think\Db;

/**
 * Class IncubationVisit
 * @package app\park_incubation\admin
 * 孵化企业走访记录
 */
class IncubationVisit extends Admin
{
    /**
     * @var
     * 走访记录模型
     */
    protected $visitModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->visitModel = new ParkIncubationVisitLog();
    }

    /**
     * @return \app\common\layout\Content
     * 走访列表
     */
    public function index()
    {
        list($data_list, $total) = $this->visitModel->search([
            'keyword_condition' => 'enterprise_name',
        ])
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete', ['model' => 'ParkIncubationVisitLog'])
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('visitor_id', '联络员', 'callback', 'getAdminNameByAdminId')
            ->keyListItem('visit_time', '走访时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkIncubationVisitLog'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('走访记录列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名"',
                ]
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/新增走访记录
     */
    public function edit($id = 0)
    {
        //已登录管理员的id
        $loginUserId = \session('admin_login_auth.uid');
        $incubationList = Db::name('ParkIncubationList')
            ->where('liaison', 'eq', $loginUserId)
            ->column('enterprise_id,enterprise_name');
        $title = $id > 0 ? '编辑' : '新增';

        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = \getEnterpriseNameByEnterpriseId($param['enterprise_id']);
            if ($this->visitModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {
            $info = [
                'visitor_id' => $loginUserId,
            ];
            if ($id > 0) {
                $info = ParkIncubationVisitLog::get($id);
                $info['visitor_id'] = $loginUserId;
            }
        }

        $content = (new BuilderForm())
            ->addFormItem('id', 'hidden', 'ID')
            ->addFormItem('visitor_id', 'hidden', '走访者ID')
            ->addFormItem('enterprise_id', 'select', '选择企业', '', $incubationList)
            ->addFormItem('visit_time', 'datetime', '走访时间')
            ->addFormItem('comment1', 'textarea', '财务状况')
            ->addFormItem('comment2', 'textarea', '企业需求')
            ->addFormItem('comment3', 'textarea', '企业发展分析')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();
        return (new Iframe())
            ->setMetaTitle($title . '走访记录')
            ->content($content);
    }
}
