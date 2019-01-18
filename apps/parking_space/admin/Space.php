<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/18
 * Time: 11:47
 */

namespace app\parking_space\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\parking_space\model\ParkingSpaceList;

/**
 * Class Space
 * @package app\parking_space\admin
 * 车位列表控制器
 */
class Space extends Admin
{
    /**
     * @var
     * 车位模型
     */
    protected $spaceModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->spaceModel = new ParkingSpaceList();
    }

    /**
     * @return \app\common\layout\Content
     * 车位列表
     */
    public function index()
    {
        list($data_list, $total) = $this->spaceModel
            ->search([
                'keyword_condition' => 'numbering',
            ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete')
            ->keyListItem('id', 'ID')
            ->keyListItem('numbering', '车位号')
            ->keyListItem('price', '价格')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'ParkingSpaceList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('车位列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="输入车位号"',
                ]
            ])
            ->content($content);

    }

    /**
     * @param int $id
     * @return \app\common\layout\Content
     * @throws \think\exception\DbException
     * 编辑/添加车位
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input();
            if ($this->spaceModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->spaceModel->getError());
            }
        } else {
            $info = [

            ];
            if ($id > 0) {
                $info = ParkingSpaceList::get($id);
            }
            $content = (new BuilderForm())
                ->addFormItem('id', 'hidden', 'ID')
                ->addFormItem('numbering', 'text', '车位号', '如A0001')
                ->addFormItem('price', 'text', '价格', '请输入数字')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();
            return (new Iframe())
                ->setMetaTitle($title . '车位')
                ->content($content);
        }
    }
}