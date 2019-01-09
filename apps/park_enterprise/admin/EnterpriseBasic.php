<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/27
 * Time: 11:03
 */

namespace app\park_enterprise\admin;


use app\admin\controller\Admin;
use app\common\builder\BuilderList;
use app\common\layout\Iframe;
use app\park_enterprise\model\ParkEnterpriseBankInfo;
use app\park_enterprise\model\ParkEnterpriseContactInfo;
use app\park_enterprise\model\ParkEnterpriseContract;
use app\park_enterprise\model\ParkEnterpriseEntryInfo;
use app\park_enterprise\model\ParkEnterpriseKuaijiContract;
use app\park_enterprise\model\ParkEnterpriseOtherInfo;
use app\park_enterprise\model\ParkEnterpriseQichachaBasicInfo;
use app\park_enterprise\model\ParkEnterpriseQichachaEmployeesInfo;
use app\park_enterprise\model\ParkEnterpriseQichachaStockInfo;
use app\park_incubation\model\ParkIncubationList;
use app\park_incubation\model\ParkIncubationVisitLog;
use app\student_innovation\model\StudentInnovation;
use think\Db;

/**
 * Class EnterpriseBasic
 * @package app\park_enterprise\admin
 * 录入企业信息
 */
class EnterpriseBasic extends Admin
{
    /**
     * @var
     * 楼宇列表
     */
    protected $build_list;
    /**
     * @var
     * 基本信息模型
     */
    protected $basicInfoModel;

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->build_list = Db::name('ParkBuilding')
            ->where('status', 1)
            ->select();
        $this->basicInfoModel = new ParkEnterpriseQichachaBasicInfo();
    }

    /**
     * @return mixed
     * 入口方法
     */

    public function index()
    {
        list($data_list, $total) = $this->basicInfoModel
            ->search([
                'keyword_condition' => 'enterprise_name',
            ])
            ->getListByPage([], true, 'create_time desc');
        $del = [
            'icon' => 'fa fa-remove',
            'title' => '删除',
            'class' => 'btn btn-danger ajax-table-btn confirm btn-sm',
            'confirm-info' => '该操作会清空该企业所有相关数据,请谨慎操作',
            'href' => url('del')
        ];
        $content = (new BuilderList())
            ->addTopButton('addnew')
            ->addTopButton('self',$del)
            ->setSearch('请输入企业名')
            ->keyListItem('id', 'ID')
            ->keyListItem('enterprise_name', '企业名称')
            ->keyListItem('build_id', '所在楼宇', 'callback', 'getBuildingNameById')
            ->keyListItem('room_number', '房间号')
            ->keyListItem('create_time', '创建时间')
            ->keyListItem('right_button', '操作', 'btn')
            ->setListData($data_list)// 数据列表
            ->setListPage($total)// 数据列表分页
            ->addRightButton('self', ['title' => '查看', 'class' => 'btn btn-info btn-xs', 'href' => url('edit', ['id' => '__data_id__'])])
            ->addRightButton('self', ['title' => '退租', 'class' => 'btn btn-warning confirm btn-xs', 'href' => url('out', ['id' => '__data_id__'])])

            ->fetch();

        return (new Iframe())
            ->setMetaTitle('企业列表')
            ->search([
                ['name' => 'keyword',
                    'type' => 'text',
                    'extra_attr' => 'placeholder="请输入企业名"',
                ]
            ])
            ->content($content);
    }


    /**
     * @return mixed
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 添加/修改/查看企业信息
     */
    public function edit()
    {
        $enterprise_id = \input('id', 0);
        //企查查配置
        $qcc_config = get_plugin_config('qichacha');
        $modelA = new ParkEnterpriseQichachaBasicInfo();
        $modelB = new ParkEnterpriseQichachaStockInfo();
        $modelC = new ParkEnterpriseQichachaEmployeesInfo();
        $modelD = new ParkEnterpriseContactInfo();
        $modelE = new ParkEnterpriseBankInfo();
        $modelF = new ParkEnterpriseOtherInfo();
        $modelG = new ParkEnterpriseEntryInfo();
        $modelContract = new ParkEnterpriseContract();
        $modelKuaiji = new ParkEnterpriseKuaijiContract();
        if ($enterprise_id == 0) {
//=================================================执行新增企业操作======================================================
            if (IS_POST) {
                $data = \input();

                $enterprise_name_count = $modelA->count('enterprise_name');
                if ($enterprise_name_count > 0) {
                    $this->error('企业名已存在');
                }

                //1,插入企业基本信息表并返回企业id
                $modelA->startTrans();
                $modelA->allowField(true)->save($data);
                //获取到企业ID
                $data['enterprise_id'] = $modelA->id;
                if (empty($data['enterprise_id'])) {
                    $modelA->rollback();
                    $this->error('添加失败,企业ID不存在');
                }

                //2,插入企业股东信息
                $modelB->startTrans();
                $stock_length = \count($data['stock_name']);
                $stockInfo = [];
                for ($i = 0; $i < $stock_length; $i++) {
                    //企业ID
                    $stockInfo[$i]['enterprise_id'] = $data['enterprise_id'];
                    //股东名
                    $stockInfo[$i]['stock_name'] = $data['stock_name'][$i];
                    //股东类型
                    $stockInfo[$i]['stock_type'] = $data['stock_type'][$i];
                    //所占比例
                    $stockInfo[$i]['stock_percent'] = $data['stock_percent'][$i];
                }
                $stockRes = $modelB->allowField(true)->saveAll($stockInfo);

                if ($stockRes == 0) {
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入股东信息失败');
                }

                //3,插入企业主要人员信息
                $modelC->startTrans();
                $employees_length = \count($data['employees']);
                $employeesInfo = [];
                for ($i = 0; $i < $employees_length; $i++) {
                    //企业ID
                    $employeesInfo[$i]['enterprise_id'] = $data['enterprise_id'];
                    //人员姓名
                    $employeesInfo[$i]['employee_name'] = $data['employees'][$i];
                    //人员职务
                    $employeesInfo[$i]['employees_job'] = $data['employees_job'][$i];
                }

                $employeesRes = $modelC->allowField(true)->saveAll($employeesInfo);

                if ($employeesRes == 0) {
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入员工信息失败');
                }
                //4,插入企业联系信息
                $modelD->startTrans();
                $modelD->allowField(true)->save($data);
                if (empty($modelD->id)) {
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入企业联系信息失败');
                }
                //5,插入银行信息
                $modelE->startTrans();
                $modelE->allowField(true)->save($data);
                if (empty($modelE->id)) {
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入银行信息失败');
                }
                //6,插入其他信息
                $modelF->startTrans();
                $modelF->allowField(true)->save($data);
                if (empty($modelF->id)) {
                    $modelF->rollback();
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入其他信息失败');
                }
                //7,插入入驻信息
                $modelG->startTrans();
                $modelG->allowField(true)->save($data);
                if (empty($modelG->id)) {
                    $modelG->rollback();
                    $modelF->rollback();
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('写入入驻信息失败');
                } else {
                    $modelG->commit();
                    $modelF->commit();
                    $modelE->commit();
                    $modelD->commit();
                    $modelC->commit();
                    $modelB->commit();
                    $modelA->commit();
                }

                //企业添加完毕后:1,修改房源状态;2,生成大学生创业企业数据;3,生成合同

                //1,修改房源状态
                $room_ids = \explode('|', $data['room_number']);
                Db::name('ParkRoom')
                    ->where('building_id', 'eq', $data['build_id'])
                    ->where('room_number', 'in', $room_ids)
                    ->setField(['room_status' => 2, 'enterprise_id' => $data['enterprise_id']]);

                //2,录入大学生创业表
                //检测该模块是否安装并启用
                $isStudentInnovationModuleInstall = \check_install_module_my('student_innovation');
                if ($isStudentInnovationModuleInstall && ($data['student_innovation'] == 1)) {
                    $si_data['enterprise_id'] = $data['enterprise_id'];
                    $si_data['title'] = $data['enterprise_name'];
                    $si_data['building_id'] = $data['build_id'];
                    $si_data['room_number'] = $data['room_number'];
                    $si_model = new StudentInnovation();
                    $si_model->save($si_data);
                }

                //3,生成租房合同

                $contractData['enterprise_id'] = $data['enterprise_id'];
                $contractData['enterprise_name'] = $data['enterprise_name'];
                $contractData['numbering'] = \getFangZuContractNumbering($data['build_id']);
                $contractData['build_id'] = $data['build_id'];
                $contractData['room_number'] = $data['room_number'];
                $contractData['contract_type'] = 1;
                $contractData['margin'] = $data['margin'];
                $contractData['start_day'] = $data['start_day'];
                $contractData['end_day'] = $data['end_day'];
                $contractData['expiration'] = '0';
                $contractData['jiaofei_period'] = $data['rent_period'];

                $modelContract->save($contractData);

                //4,生成财务代理合同
                if ($data['kuaiji_daili'] == 1) {
                    $daliContractInfo = [
                        'enterprise_id' => $data['enterprise_id'],
                        'kjdlfy' => $data['kjdlfy'],
                        'numbering' => \getKuaijiContractNumbering(),
                        'kjdl_s_day' => $data['kjdl_s_day'],
                        'kjdl_e_day' => $data['kjdl_e_day']
                    ];
                    $modelKuaiji->save($daliContractInfo);
                }

                //5,孵化企业生成走访列表
                $isParkIncubationInstall = \check_install_module_my('park_incubation');
                if ($isParkIncubationInstall && ($data['fuhua'] == 1)) {
                    $incubationData = [
                        'enterprise_id' => $data['enterprise_id'],
                        'enterprise_name' => $data['enterprise_name'],
                    ];
                    ParkIncubationList::create($incubationData);
                }
                
                $this->success('添加企业成功');
            } else {
//====================================================显示添加企业的空页面=================================================
                //企业logo属性
                $logo = [
                    'name' => 'logo',
                    'value' => '',
                ];
                $yyzz = [
                    'name' => 'yyzz',
                    'value' => '',
                ];
                $frsfzzp = [
                    'name' => 'frsfzzp',
                    'value' => '',
                ];
                $qtzs = [
                    'name' => 'qtzs',
                    'value' => '',
                ];
                $fzrsfz = [
                    'name' => 'fzrsfz',
                    'value' => '',
                ];

                $meta_title = '新增企业';
                $this->assign([
                    'logo' => $logo,
                    'yyzz' => $yyzz,
                    'frsfzzp' => $frsfzzp,
                    'qtzs' => $qtzs,
                    'fzrsfz' => $fzrsfz,
                    'meta_title' => $meta_title,
                    'qcc_config' => $qcc_config,
                    'build_list' => $this->build_list
                ]);
                return $this->fetch();
            }

        } else {
            //=========================================================修改企业操作==================================================

            if (IS_POST) {
                //更新后的新数据
                $new_data = \input();
                $new_data['enterprise_id'] = $new_data['id'];
                //当前企业ID=$new_data['id'];

                //1,更新企业基本信息表
                $modelA->startTrans();
                $modelA->allowField(true)->save($new_data, ['id' => $new_data['id']]);

                //2,更新企业股东信息,因为数量不确定,所以删除原来的记录新增更新后的数据
                $modelB::destroy(['enterprise_id' => $new_data['id']]);

                $modelB->startTrans();
                $stock_length = \count($new_data['stock_name']);
                $stockInfo = [];
                for ($i = 0; $i < $stock_length; $i++) {
                    //企业ID
                    $stockInfo[$i]['enterprise_id'] = $new_data['id'];
                    //股东名
                    $stockInfo[$i]['stock_name'] = $new_data['stock_name'][$i];
                    //股东类型
                    $stockInfo[$i]['stock_type'] = $new_data['stock_type'][$i];
                    //所占比例
                    $stockInfo[$i]['stock_percent'] = $new_data['stock_percent'][$i];
                }
                $stockRes = $modelB->allowField(true)->saveAll($stockInfo);

                if ($stockRes == 0) {
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新股东信息失败');
                }

                //4,插入企业主要人员信息,逻辑同上
                $modelC::destroy(['enterprise_id' => $new_data['id']]);
                $modelC->startTrans();
                $employees_length = \count($new_data['employees']);
                $employeesInfo = [];
                for ($i = 0; $i < $employees_length; $i++) {
                    //企业ID
                    $employeesInfo[$i]['enterprise_id'] = $new_data['id'];
                    //人员姓名
                    $employeesInfo[$i]['employee_name'] = $new_data['employees'][$i];
                    //人员职务
                    $employeesInfo[$i]['employees_job'] = $new_data['employees_job'][$i];
                }

                $employeesRes = $modelC->allowField(true)->saveAll($employeesInfo);

                if ($employeesRes == 0) {
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新员工信息失败');
                }

                //4,更新企业联系信息
                $modelD->startTrans();
                //不知道为什么更新没有反应,所以直接删除旧的,添加新的
                $modelD::destroy(['enterprise_id' => $new_data['id']]);
                $resD = $modelD->allowField(true)->save($new_data);
                if ($resD === false) {
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新企业联系信息失败');
                }
                //5,更新银行信息
                $modelE->startTrans();
                $modelE::destroy(['enterprise_id' => $new_data['id']]);
                $resE = $modelE->allowField(true)->save($new_data);
                if ($resE === false) {
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新银行信息失败');
                }
                //6,更新其他信息
                $modelF->startTrans();
                $modelF::destroy(['enterprise_id' => $new_data['id']]);
                $resF = $modelF->allowField(true)->save($new_data);
                if ($resF === false) {
                    $modelF->rollback();
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新其他信息失败');
                }
                //7,更新入驻信息
                $modelG->startTrans();
                $modelG::destroy(['enterprise_id' => $new_data['id']]);
                $resG = $modelG->allowField(true)->save($new_data);
                if ($resG === false) {
                    $modelG->rollback();
                    $modelF->rollback();
                    $modelE->rollback();
                    $modelD->rollback();
                    $modelC->rollback();
                    $modelB->rollback();
                    $modelA->rollback();
                    $this->error('更新入驻信息失败');
                } else {
                    $modelG->commit();
                    $modelF->commit();
                    $modelE->commit();
                    $modelD->commit();
                    $modelC->commit();
                    $modelB->commit();
                    $modelA->commit();
                }
                //更新完毕后:1修改房源状态:旧房源改为未租,新房源改为已租;2,修改合同
                //1,修改房源状态
                $old_build_id = $modelG::where('enterprise_id', 'eq', $new_data['id'])->value('build_id');
                $old_room_info = $modelG::where('enterprise_id', 'eq', $new_data['id'])
                    ->value('room_number');
                $old_room_ids = \explode('|', $old_room_info);
                Db::name('ParkRoom')
                    ->where('building_id', 'eq', $old_build_id)
                    ->where('room_number', 'in', $old_room_ids)
                    ->setField('room_status', 1);

                $new_room_ids = \explode('|', $new_data['room_number']);
                Db::name('ParkRoom')
                    ->where('room_number', 'in', $new_room_ids)
                    ->setField(['room_status' => 2, 'enterprise_id' => $new_data['id']]);


                //2,更新大学生创业表:删除旧数据,添加新数据
                StudentInnovation::destroy(['enterprise_id' => $new_data['id']]);
                if ($new_data['student_innovation'] == 1) {
                    $si_data['enterprise_id'] = $new_data['enterprise_id'];
                    $si_data['title'] = $new_data['enterprise_name'];
                    $si_data['building_id'] = $new_data['build_id'];
                    $si_data['room_number'] = $new_data['room_number'];
                    $si_model = new StudentInnovation();
                    $si_model->save($si_data);
                }

                //3,重新生成租房合同

                ParkEnterpriseContract::destroy(['enterprise_id' => $new_data['id']]);
                $contractData['enterprise_id'] = $new_data['id'];
                $contractData['enterprise_name'] = $new_data['enterprise_name'];
                $contractData['numbering'] = \getFangzuContractNumbering($new_data['build_id']);
                $contractData['build_id'] = $new_data['build_id'];
                $contractData['room_number'] = $new_data['room_number'];
                $contractData['contract_type'] = 1;
                $contractData['margin'] = $new_data['margin'];
                $contractData['start_day'] = $new_data['start_day'];
                $contractData['end_day'] = $new_data['end_day'];
                $contractData['expiration'] = '0';
                $contractData['jiaofei_period'] = $new_data['rent_period'];

                $modelContract->save($contractData);

                //4,财务代理合同更新操作
                ParkEnterpriseKuaijiContract::destroy(['enterprise_id' => $new_data['id']]);
                if ($new_data['kuaiji_daili'] == 1) {
                    $daliContractInfo = [
                        'enterprise_id' => $new_data['id'],
                        'kjdlfy' => $new_data['kjdlfy'],
                        'numbering' => \getKuaijiContractNumbering(),
                        'kjdl_s_day' => $new_data['kjdl_s_day'],
                        'kjdl_e_day' => $new_data['kjdl_e_day']
                    ];
                    ParkEnterpriseKuaijiContract::create($daliContractInfo);
                }

                $this->success('更新信息成功');

            } else {
//======================================查看/修改企业详情页面==========================================================
                $enterprise_id = \input('id');
                //企查查基础信息
                $basic_info = $modelA::get($enterprise_id);
                //股东信息
                $stock_info = $modelB::all(['enterprise_id' => $enterprise_id]);
                //员工信息
                $employee_info = $modelC::all(['enterprise_id' => $enterprise_id]);
                //联系信息
                $contact_info = $modelD::get(['enterprise_id' => $enterprise_id]);
                //银行信息
                $bank_info = $modelE::get(['enterprise_id' => $enterprise_id]);
                //其他信息
                $other_info = $modelF::get(['enterprise_id' => $enterprise_id]);
                //入驻信息
                $entry_info = $modelG::get(['enterprise_id' => $enterprise_id]);

                //企业logo属性
                $logo = [
                    'name' => 'logo',
                    'value' => $basic_info['logo'],
                ];
                //营业执照照片属性
                $yyzz = [
                    'name' => 'yyzz',
                    'value' => $basic_info['yyzz'],
                ];
                //法人身份证照片属性
                $frsfzzp = [
                    'name' => 'frsfzzp',
                    'value' => $basic_info['frsfzzp'],
                ];
                //其他证书图片属性
                $qtzs = [
                    'name' => 'qtzs',
                    'value' => $basic_info['qtzs'],
                ];
                //财务负责人身份证属性
                $fzrsfz = [
                    'name' => 'fzrsfz',
                    'value' => $contact_info['fzrsfz'],
                ];
                $meta_title = '修改企业';
                $this->assign([
                    'logo' => $logo,
                    'yyzz' => $yyzz,
                    'frsfzzp' => $frsfzzp,
                    'qtzs' => $qtzs,
                    'fzrsfz' => $fzrsfz,
                    'meta_title' => $meta_title,
                    'qcc_config' => $qcc_config,
                    'build_list' => $this->build_list,
                    'basic_info' => $basic_info,
                    'stock_info' => $stock_info,
                    'employee_info' => $employee_info,
                    'contact_info' => $contact_info,
                    'bank_info' => $bank_info,
                    'other_info' => $other_info,
                    'entry_info' => $entry_info,
                ]);
                return $this->fetch();
            }
        }
    }


    /**
     * @throws \think\exception\DbException
     * 删除企业操作
     */
    public function del()
    {
        $enterprise_id = \input('id');
        $enterprise_info = ParkEnterpriseQichachaBasicInfo::get($enterprise_id);
        if (empty($enterprise_info)) {
            $this->error('该企业不存在');
        } else {
            //1,删除企业之后修改房源为"未租"状态
            $build_id = ParkEnterpriseEntryInfo::get($enterprise_id)->value('build_id');
            $room_info = ParkEnterpriseEntryInfo::where('enterprise_id', $enterprise_id)->value('room_number');
            $room_ids = \explode('|', $room_info);
            Db::name('ParkRoom')
                ->where('building_id', 'eq', $build_id)
                ->where('room_number', 'in', $room_ids)
                ->setField('room_status', '1');

            //2,删除基本信息
            ParkEnterpriseQichachaBasicInfo::destroy(['id' => $enterprise_id]);
            //3,删除股东信息
            ParkEnterpriseQichachaStockInfo::destroy(['enterprise_id' => $enterprise_id]);
            //4,删除成员信息
            ParkEnterpriseQichachaEmployeesInfo::destroy(['enterprise_id' => $enterprise_id]);
            //5,删除联系信息
            ParkEnterpriseContactInfo::destroy(['enterprise_id' => $enterprise_id]);
            //6,删除银行信息
            ParkEnterpriseBankInfo::destroy(['enterprise_id' => $enterprise_id]);
            //7,删除其他信息
            ParkEnterpriseOtherInfo::destroy(['enterprise_id' => $enterprise_id]);
            //8,删除入驻信息
            ParkEnterpriseEntryInfo::destroy(['enterprise_id' => $enterprise_id]);

            //9,如果是大学生创业,还需删除大学生创业列表中的数据
            StudentInnovation::destroy(['enterprise_id' => $enterprise_id]);
            
            //10.如果是孵化企业,删除孵化企业列表和走访记录中的数据
            ParkIncubationList::destroy(['enterprise_id' => $enterprise_id]);
            ParkIncubationVisitLog::destroy(['enterprise_id' => $enterprise_id]);

            //11,租房合同手动删除

            $this->success('删除成功');
        }
    }
}