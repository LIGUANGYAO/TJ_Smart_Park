<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2019/1/14
 * Time: 10:10
 */

namespace app\high_tech_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderForm;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\high_tech_enterprise\model\HighTechEnterpriseList;
use think\Db;

/**
 * Class Index
 * @package app\high_tech_enterprise\admin
 * 高新企业控制器
 */
class Index extends Admin
{
    /**
     * @var
     * 高新企业模型
     */
    protected $techModel;

    /**
     *初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->techModel = new HighTechEnterpriseList();
    }

    /**
     * @return \app\common\layout\Content
     * 企业列表
     */
    public function index()
    {
        list($data_list, $total) = $this->techModel->search([
            'keyword_condition' => 'enterprise_name',
        ])
            ->getListByPage([], true, 'create_time desc');
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('delete', ['model' => 'HighTechEnterpriseList'])
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('get_time', '获得时间')
            ->keyListItem('expire_time', '到期时间')
            ->keyListItem('is_expire', '是否到期', 'array', [1 => '是', 2 => '否'])
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)
            ->setListPage($total)
            ->addRightButton('edit')
            ->addRightButton('delete', ['model' => 'HighTechEnterpriseList'])
            ->fetch();
        return (new Iframe())
            ->setMetaTitle('高新企业列表')
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
     */
    public function edit($id = 0)
    {
        $title = $id > 0 ? '编辑' : '新增';
        //高新企业列表
        $techList = Db::name('HighTechEnterpriseList')
            ->column('enterprise_id,enterprise_name');

        if (IS_POST) {
            $param = \input();
            $param['enterprise_name'] = Db::name('HighTechEnterpriseList')
                ->where('enterprise_id', 'eq', $param['enterprise_id'])
                ->value('enterprise_name');
            if ($this->techModel->editData($param)) {
                $this->success($title . '成功', \url('index'));
            } else {
                $this->error($this->techModel->getError());
            }
        } else {
            $info = [
                'is_expire' => 2,
            ];
            if ($id > 0) {
                $info = HighTechEnterpriseList::get($id);
            }
        }
        $content = (new BuilderForm())
            ->addFormItem('id', 'hidden', 'ID')
            ->addFormItem('enterprise_id', 'select', '选择企业', '', $techList)
            ->addFormItem('get_time', 'datetime', '获得时间')
            ->addFormItem('is_expire', 'radio', '是否过期', '', [1 => '是', 2 => '否'])
            ->addFormItem('marks', 'textarea', '备注')
            ->setFormData($info)
            ->addButton('submit')
            ->addButton('back')
            ->fetch();

        return (new Iframe())
            ->setMetaTitle($title . '高新企业')
            ->content($content);
    }
}