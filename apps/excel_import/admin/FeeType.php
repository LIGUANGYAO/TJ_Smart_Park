<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/2/25
 * Time: 15:53
 */

namespace app\excel_import\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\excel_import\model\CostFeeType;

/**
 * Class FeeType
 * @package app\excel_import\admin
 * 费用分类
 */
class FeeType extends Admin
{
    /**
     * @var
     * 费用分类模型
     */
    protected $feeModel;

    /**
     *
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->feeModel = new CostFeeType();
    }

    /**
     * @return \app\common\layout\Content
     * 分类列表
     */
    public function index()
    {
        list($data_list, $total) = $this->feeModel->search()->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('name', '费用名称')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('create_time', '创建时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'CostFeeType'])
            ->setListData($data_list)
            ->setListPage($total, 10)
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('其他费用类型')
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 新增/修改类别
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->feeModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->feeModel->getError());
            }
        } else {
            $info = ['status' => 1];
        }
        if ($id > 0) {
            $info = CostFeeType::get($id);
        }
        $content = (new BuilderForm())
            ->addFormItem('id', 'hidden', 'ID')
            ->addFormItem('name', 'text', '费用名称')
            ->addFormItem('status', 'radio', '选择费用状态', '', [1 => '启用', 0 => '禁用'])
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();
        return (new Iframe())
            ->setMetaTitle($title . '类型')
            ->content($content);
    }
}
