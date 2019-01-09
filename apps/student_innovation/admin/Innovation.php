<?php
/**
 * Created by PhpStorm.
 * User: xpwsgg
 * Date: 2018/12/18
 * Time: 15:36
 */

namespace app\student_innovation\admin;

use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\student_innovation\model\StudentInnovation;
use think\Db;

/**
 * Class Innovation
 * @package app\student_innovation\admin
 * 大学生创业模型
 */
class Innovation extends Admin
{
    /**
     * @var
     * 模型
     */
    protected $innovationModel;
    /**
     * @var
     * 公司状态
     */
    protected $statusType;

    /**
     * @var
     */
    protected $building;

    /**
     *初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->innovationModel = new StudentInnovation();
        $this->statusType = [
            1 => '资助期内',
            2 => '全额退出',
            3 => '清算退出',
            4 => '注销',
            5 => '延迟退出'
        ];
        $this->building = Db::name('ParkBuilding')
            ->where('status', 1)
            ->column('id,title');
    }

    /**
     * @return mixed
     * 入口方法
     */
    public function index()
    {
        list($data_list, $total) = $this->innovationModel->search('title')
            ->getListByPage([], true, 'create_time desc');

        $content = (new BuilderList())
            ->addTopButton('addnew', ['model' => 'StudentInnovation'])
            ->setSearch('输入关键字')
            ->keyListItem('id', 'ID')
            ->keyListItem('title', '公司名称')
            ->keyListItem('principal', '负责人')
            ->keyListItem('telephone', '联系电话')
            ->keyListItem('education', '学历')
            ->keyListItem('education_number', '学号')
            ->keyListItem('director', '董事')
            ->keyListItem('supervisor', '监事')
            ->keyListItem('funding', '资助金额')
            ->keyListItem('exit_funding', '退出金额')
            ->keyListItem('start_day', '开始日期')
            ->keyListItem('end_day', '结束日期')
            ->keyListItem('innovation_status', '公司状态', 'array', $this->statusType)
            ->keyListItem('building_id', '楼号', 'callback', 'getBuildingNameById')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('files', '附件')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListPrimaryKey('id')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete',['model'=>'StudentInnovation'])
            ->fetch();

        return (new Iframe())
            ->setMetaTitle('大学生创业')
            ->content($content);
    }

    public function index2(){
        echo 2;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws \think\exception\DbException
     * 修改或者新增
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        if (IS_POST) {
            $param = \input('param.');

            //$this->validateData($param, 'student_innovation/Innovation');

            if ($this->innovationModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->buildingModel->getError());
            }
        } else {
            $info = [

            ];

            if ($id > 0) {
                $info = StudentInnovation::get($id);
                if (empty($info)) {
                    $this->error($this->buildingModel->getError());
                }
            }

            $builder = new BuilderForm();
            $return = $builder
                ->addFormItem('id', 'hidden', 'ID', 'ID')
                ->addFormItem('title', 'text', '公司名称', '请输入公司名称')
                ->addFormItem('principal', 'text', '负责人', '请输入负责人姓名')
                ->addFormItem('telephone', 'text', '联系电话', '请输入联系电话')
                ->addFormItem('education', 'text', '学历', '请输入学历')
                ->addFormItem('education_number', 'text', '学号', '请输入学号')
                ->addFormItem('director', 'text', '董事', '请输入董事')
                ->addFormItem('supervisor', 'text', '监事', '请输入监事')
                ->addFormItem('funding', 'text', '资助金额', '请输入资助金额')
                ->addFormItem('exit_funding', 'text', '退出金额', '请输入退出金额')
                ->addFormItem('start_day', 'datetime', '开始日期', '请选择入驻时间')
                ->addFormItem('end_day', 'datetime', '结束日期', '请选择退出时间')
                ->addFormItem('innovation_status', 'select', '公司状态', '', $this->statusType)
                ->addFormItem('building_id', 'select', '所在楼宇', '', $this->building)
                ->addFormItem('room_number', 'text', '房间号')
                ->addFormItem('files', 'file', '附件')
                ->setFormData($info)
                ->addButton('submit')
                ->addButton('back')
                ->fetch();

            return Iframe()
                ->setMetaTitle($title . '大学生创业')
                ->content($return);
        }
    }
}