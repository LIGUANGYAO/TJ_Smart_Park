<?php
// service_repair模块后台控制器

namespace app\service_repair\admin;

use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\service_repair\model\ServiceRepairList;
use think\Db;

/**
 * Class Index
 * @package app\service_repair\admin
 * 报修列表控制器
 */
class Index extends Admin
{
    /**
     * @var报修模型
     */
    protected $repairModel;
    /**
     * @var
     * 公司列表
     */
    protected $enterpriseList;
    /**
     * @var
     * 报修类型
     */
    protected $repairType;
    /**
     * @var
     * 维修状态
     */
    protected $repairStatus;

    /**
     * @var
     * 维修工列表
     */
    protected $workerList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->repairModel = new ServiceRepairList();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->where('enterprise_status', 'eq', 1)
            ->column('id,enterprise_name');
        $this->repairType = \config('repair_type');
        $this->repairStatus = [
            1 => '待处理',
            2 => '已派单',
            3 => '已完成',
            4 => '已关闭',
        ];
        $this->workerList = \getAdminsByGroup(6);
    }

    /**
     * @return \app\common\layout\Content
     * 报修列表
     */
    public function index()
    {
        list($data_list, $total) = $this->repairModel
            ->search(['keyword_condition' => 'enterprise_name'])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '公司名称')
            ->keyListItem('location', '公司地址')
            ->keyListItem('creator_id', '发布人', 'callback', 'get_nickname')
            ->keyListItem('phone', '联系电话')
            ->keyListItem('type', '报修类型', 'array', $this->repairType)
            ->keyListItem('title', '标题')
            ->keyListItem('content', '内容')
            ->keyListItem('pic', '图片')
            ->keyListItem('publish_time', '发布时间')
            ->keyListItem('status', '状态', 'array', $this->repairStatus)
            ->keyListItem('worker', '维修人', 'array', $this->workerList)
            ->keyListItem('cost', '维修费')
            ->keyListItem('evaluation', '用户反馈')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ServiceRepairList'])
            ->setListData($data_list)
            ->setListPage($total)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('报修列表')
            ->search([
                ['name' => 'type', 'type' => 'select', 'title' => '报修类型', 'options' => $this->repairType],
                ['name' => 'status', 'type' => 'select', 'title' => '报修状态', 'options' => $this->repairStatus],
                ['name' => 'keyword', 'type' => 'text', 'extra_attr' => 'placeholder="输入企业名称"']
            ])
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑报修
     */
    public function edit($id = 0)
    {
        $info = ServiceRepairList::get($id);
        if (IS_POST) {
            $param = \input();
            if ($this->repairModel->editData($param)) {
                $this->success('编辑成功', \url('index'));
            } else {
                $this->error($this->repairModel->getError());
            }
        } else {
            $info = [];
            if ($id > 0) {
                $info = ServiceRepairList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('title', 'text', '主题')
                ->addFormItem('content', 'textarea', '报修描述')
                ->addFormItem('location', 'text', '公司所在地')
                ->addFormItem('pic', 'text', '图片')
                ->addFormItem('worker', 'select', '维修人员', '需在权限管理->管理员中添加维修人员', $this->workerList)
                ->addFormItem('status', 'radio', '报修状态', '', $this->repairStatus)
                ->addFormItem('cost', 'text', '维修费')
                ->addFormItem('evaluation', 'textarea', '用户反馈', '', '', 'readonly')
                ->addFormItem('comment', 'text', '回复')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle('修改维修信息')
                ->content($content);
        }

    }
}