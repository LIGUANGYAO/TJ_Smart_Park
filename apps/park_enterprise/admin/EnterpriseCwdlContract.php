<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/7
 * Time: 16:56
 */

namespace app\park_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise\model\ParkEnterpriseKuaijiContract;
use think\Db;

/**
 * Class EnterpriseCwdlContract
 * @package app\park_enterprise\admin
 * 财务代理合同控制器
 */
class EnterpriseCwdlContract extends Admin
{
    /**
     * @var
     * 财务代理模型
     */
    protected $cwdlModel;
    /**
     * @var
     * 公司列表
     */
    protected $enterpriseList;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->cwdlModel = new ParkEnterpriseKuaijiContract();
        $this->enterpriseList = Db::name('ParkEnterpriseQichachaBasicInfo')
            ->column('id,enterprise_name');
    }

    /**
     *入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('财务代理合同列表')
            ->content($this->grid());
    }

    /**
     * @return mixed
     * 表格内容
     */
    public function grid()
    {
        list($data_list, $total) = $this->cwdlModel
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('delete', ['model' => 'ParkEnterpriseKuaijiContract'])
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_id', '公司名', 'callback', 'getEnterpriseNameByEnterpriseId')
//            ->keyListItem('enterprise_id', '公司名', '', '')
            ->keyListItem('kjdlfy', '代理费用')
            ->keyListItem('numbering', '合同编号')
            ->keyListItem('kjdl_s_day', '开始日期')
            ->keyListItem('kjdl_e_day', '结束日期')
            ->keyListItem('create_time', '创建时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete',['model'=>'ParkEnterpriseKuaijiContract'])
            ->fetch();
        return $content;
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\Exception
     * @throws \think\exception\DbException
     * 编辑/添加财务代理合同
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '添加';
        if (IS_POST) {
            $data = \input();
            if ($this->cwdlModel->editData($data)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->roomModel->getError());
            }
        } else {
            $info = [];
            if ($id > 0) {
                $info = ParkEnterpriseKuaijiContract::get($id);
            }
        }

        $return = (new BuilderForm())
            ->addFormItem('id', 'hidden', 'ID')
            ->addFormItem('enterprise_id', 'select', '公司名称', '请选择公司', $this->enterpriseList)
            ->addFormItem('kjdlfy', 'text', '代理费用')
            ->addFormItem('numbering', 'text', '合同编号')
            ->addFormItem('kjdl_s_day', 'text', '开始日期')
            ->addFormItem('kjdl_e_day', 'text', '结束日期')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();

        return (new Iframe())
            ->setMetaTitle($title . '合同')
            ->content($return);
    }
}