<?php

namespace app\carousel\admin;

use app\admin\controller\Admin;
use app\carousel\model\CarouselPosition as GpModel;

/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/11/30
 * Time: 15:24
 */
class CarouselPosition extends Admin
{
    /**
     * @var
     * 模型对象
     */
    protected $carouselPositionModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->carouselPositionModel = new GpModel();
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return Iframe()
            ->setMetaTitle('轮播位管理')
            ->content($this->grip());
    }

    /**
     * @return mixed
     * 构建列表
     */
    public function grip()
    {
        $map['status'] = ['egt', '0']; // 禁用和正常状态
        list($data_list, $total) = $this->carouselPositionModel
            ->search('name')//添加搜索查询
            ->getListByPage($map, true, 'create_time desc');
        return builder('list')
            ->addTopBtn('addnew')
            ->addTopBtn('resume')
            ->addTopBtn('forbid')
            ->addTopBtn('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('name', '轮播位')
            ->keyListItem('create_time', '添加时间')
            ->keyListItem('status', '状态','status')
            ->setListData($data_list)
            ->setListPage($total)
            ->keyListItem('right_button', '操作', 'btn')
            ->addRightButton('edit')
            ->addRightButton('delete')
            ->fetch();
    }


    /**
     * @param int $id
     * @return mixed
     * @throws \think\exception\DbException
     * 添加和修改
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? "编辑" : "添加";
        //修改
        if (IS_POST) {
            $param = $this->request->param();

            if ($this->carouselPositionModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->carouselPositionModel->getError());
            }
        } else {
            //添加
            return Iframe()
                ->setMetaTitle($title . '轮播位')
                ->content($this->form($id));
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \think\exception\DbException
     * 添加页面
     */
    public function form($id = 0)
    {
        $info = ['status' => 1];
        if ($id > 0)
            $info = GpModel::get($id);
        return builder('Form')
            ->addFormItem('id', 'hidden', 'ID', 'ID')
            ->addFormItem('name', 'text', '轮播位名称', '', '', 'required', 'placeholder="请输入轮播位名称"')
            ->addFormItem('status', 'radio', '状态', '', [1 => '启用', 0 => '禁用'], 'required')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();
    }
}