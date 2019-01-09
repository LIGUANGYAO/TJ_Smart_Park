<?php
/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/12/3
 * Time: 14:16
 */

namespace app\carousel\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use think\Db;

/**
 * Class CarouselList
 * @package app\carousel\admin
 * 轮播图列表控制器
 */
class CarouselList extends Admin
{
    /**
     * @var
     * 列表模型
     */
    protected $listModel;
    /**
     * @var
     * 位置列表
     */
    protected $carouselPosition;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->listModel = new \app\carousel\model\CarouselList();
        $this->carouselPosition = Db::name('CarouselPosition')
            ->where('status', 1)
            ->column('id,name');
    }

    /**
     *入口方法
     */
    public function index()
    {
        return (new Iframe())
            ->setMetaTitle('轮播图列表')
            ->search([
                ['name' => 'position',
                    'type' => 'select',
                    'title' => '轮播位',
                    'options' => $this->carouselPosition],
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入关键字"']
            ])
            ->content($this->grid());
    }

    /**
     * @return \app\common\layout\Content
     * 内容列表
     */
    public function grid()
    {
        $search_setting = $this->buildModelSearchSetting();
        $map = [
            'status' => ['egt', 0]
        ];
        list($data_list, $total) = $this->listModel
            ->search($search_setting)
            ->getListByPage($map, true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopBtn('resume')
            ->addTopButton('forbid')
            ->addTopButton('delete')
            ->setSearch('请输入关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('position', '轮播位', 'callback', 'getCarouselPositionNameById')
            ->keyListItem('pic_path', '图片地址', 'picture')
            ->keyListItem('pic_url', '图片链接')
            ->keyListItem('pic_content', '文字介绍')
            ->keyListItem('create_time', '添加时间')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'CarouselList'])
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('轮播图列表')
            ->content($content);
    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 修改或者新增
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $data = \input('param.');
            //todo数据校验

            if ($this->listModel->editData($data)) {
                $this->success($title . '成功', \url('List'));
            } else {
                $this->error($this->listModel->getError());
            }
        } else {
            //默认值
            $info = [
                'order' => 50,
                'status' => 1,
            ];

            if ($id > 0) {
                $info = \app\carousel\model\CarouselList::get($id);
                if (empty($info)) {
                    $this->error($this->listModel->getError());
                }
            }

            $return = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('position', 'select', '轮播位', '请选择轮播位', $this->carouselPosition)
                ->addFormItem('pic_path', 'picture', '轮播图', '请选择轮播图')
                ->addFormItem('pic_url', 'text', '图片链接', '请输入图片链接地址')
                ->addFormItem('pic_content', 'text', '描述', '请输入文字描述')
                ->addFormItem('order', 'text', '排序', '')
                ->addFormItem('status', 'radio', '状态', '', [1 => '启用', 0 => '禁用'])
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '轮播图')
                ->content($return);
        }
    }

    /**
     * @return array
     * 查询条件
     */
    private function buildModelSearchSetting()
    {
        $search_setting = [
            'name' => 'position',
            'keyword_condition' => 'pic_content',
        ];

        return $search_setting;
    }
}