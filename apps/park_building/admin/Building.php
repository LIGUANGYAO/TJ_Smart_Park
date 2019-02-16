<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/13
 * Time: 11:38
 */

namespace app\park_building\admin;

use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\park_building\model\ParkBuilding;

/**
 * Class Building
 * @package app\park_building\admin
 * 楼宇管理
 */
class Building extends Admin
{

    /**
     * @var楼宇模型
     */
    protected $buildingModel;
    /**
     * @var status键值
     */
    protected $statusType;
    protected $parkList;

    /**
     * 初始化
     * @return [type] [description]
     */
    function _initialize()
    {
        parent::_initialize();
        $this->buildingModel = model('ParkBuilding');
        $this->statusType = [
            1 => '启用',
            2 => '禁用',
        ];
        $this->parkList = \config('park_list');
    }

    /**
     * 入口操作
     * @return [type] [description]
     */
    public function index()
    {
        list($data_list, $total) = $this->buildingModel->search('title')
            ->getListByPage([], true, 'sort,create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew', ['model' => 'ParkBuilding'])
            ->addTopButton('resume', ['model' => 'ParkBuilding'])
            ->addTopButton('forbid', ['model' => 'ParkBuilding'])
            ->addTopButton('sort', ['model' => 'ParkBuilding'])
            ->setSearch('请输入关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('image', '图标', 'picture', ['width' => 60])
//            ->keyListItem('park', '所属园区', 'array', $this->parkList)
            ->keyListItem('title', '楼宇名称')
            ->keyListItem('status', '状态', 'status')
            ->keyListItem('sort', '排序')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('edit')// 添加编辑按钮
            ->addRightButton('delete', ['model' => 'ParkBuilding'])// 添加删除按钮
            ->fetch();

        return Iframe()
            ->setMetaTitle('楼宇管理')
            ->content($content);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws \think\exception\DbException
     * 编辑/添加楼宇
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $params = \input('param.');
            $this->validateData($params, 'park_building/Building');

            if ($this->buildingModel->editData($params)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->buildingModel->getError());
            }
        } else {
            $info = [
                'sort' => 50,
                'status' => 1,
                'park' => 1,
            ];
            if ($id > 0) {
                $info = ParkBuilding::get($id);
                if (empty($info)) {
                    $this->error($this->buildingModel->getError());
                }
            }

            $return = builder('Form')
                ->addFormItem('id', 'hidden', 'ID', 'ID')
//                ->addFormItem('park', 'select', '所在园区', '请选择所在园区', $this->parkList)
                ->addFormItem('title', 'text', '楼宇名称', '请输入楼宇名称')
                ->addFormItem('image', 'picture', '图标', '上传楼宇的图片')
                ->addFormItem('status', 'radio', '状态', '默认启用', $this->statusType)
                ->addFormItem('sort', 'number', '排序', '按照数值大小的倒叙进行排序，数值越小越靠前')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return Iframe()
                ->setMetaTitle($title . '楼宇')
                ->content($return);
        }
    }

    /**
     * @param null $ids
     * @return mixed
     * 排序操作
     */
    public function sort($ids = null)
    {
        $builder = builder('Sort');
        if (IS_POST) {
            return $builder->doSort('park_building', $ids);
        } else {
            $map['status'] = ['egt', 0];
            $list = $this->buildingModel->getList($map, 'id,title,sort', 'sort asc');
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['title'];
            }
            $content = $builder
                ->setListData($list)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return Iframe()
                ->setMetaTitle('配置排序')
                ->content($content);
        }
    }
}
