<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/10
 * Time: 16:52
 */

namespace app\park_incubation\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_incubation\model\ParkIncubationList;
use think\Db;

/**
 * Class Incubation
 * @package app\park_incubation\admin
 * 孵化企业控制器
 */
class Incubation extends Admin
{
    /**
     * @var
     * 孵化企业模型
     */
    protected $incubationModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->incubationModel = new ParkIncubationList();
    }

    /**
     * @return \app\common\layout\Content
     * 入口方法
     */
    public function index()
    {
        //获取页面需要的数据
        list($data_list, $total) = $this->incubationModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('entry_time', '入孵时间')
            ->keyListItem('enterprise_status', '状态', 'array', [1 => '毕业', 2 => '在孵'])
            ->keyListItem('out_time', '退出时间')
            ->keyListItem('liaison', '联络员', 'callback', 'getAdminNameByAdminId')
            ->keyListItem('counselor', '辅导员')
            ->keyListItem('entrepreneurship_tutor', '创业导师')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkIncubationList'])
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('孵化企业列表')
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
     * 编辑/新增孵化企业
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        //联络员=负责该企业的走访者
        $liaison = Db::name('Admin a')
            ->join('AuthGroupAccess b', 'a.uid=b.uid')
            ->where('b.group_id', 'eq', 5)//管理组id=5是孵化企业联络员
            ->column('a.uid,a.username');
        if (IS_POST) {
            $param = \input();
            if ($this->incubationModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->incubationModel->getError());
            }
        } else {

            $info = [

            ];
            if ($id > 0) {
                $info = ParkIncubationList::get($id);
            }

            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('enterprise_id', 'hidden', '企业ID')
                ->addFormItem('enterprise_name', 'text', '企业名称')
                ->addFormItem('entry_time', 'text', '入孵时间')
                ->addFormItem('enterprise_status', 'select', '状态', '', [1 => '毕业', 2 => '在孵'])
                ->addFormItem('out_time', 'text', '退出时间')
                ->addFormItem('liaison', 'select', '联络员', '', $liaison)
                ->addFormItem('counselor', 'text', '辅导员')
                ->addFormItem('entrepreneurship_tutor', 'text', '创业导师')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return (new Iframe())
                ->setMetaTitle($title . '孵化企业')
                ->content($content);

        }
    }
}