/*
 Navicat Premium Data Transfer

 Source Server         : WSL服务器
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1:3306
 Source Schema         : www_tongji_gov

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 08/01/2019 14:52:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_park_enterprise_bank_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_bank_info`;
CREATE TABLE `qnn_park_enterprise_bank_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '银行名称',
  `bank_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '开户行',
  `bank_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '账户',
  `caiwufzr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '财务负责人',
  `caiwufzr_tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '财务负责人电话',
  `caiwufzr_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '财务负责人邮箱',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_contact_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_contact_info`;
CREATE TABLE `qnn_park_enterprise_contact_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系人',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系电话',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `qq` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'QQ',
  `wechat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '微信',
  `contact_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系地址',
  `fzrsfz` int(10) NOT NULL COMMENT '负责人身份证',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业联系信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_contract
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_contract`;
CREATE TABLE `qnn_park_enterprise_contract`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `numbering` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同编号',
  `room_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '门牌号',
  `miaopu_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '苗圃工位号',
  `contract_type` tinyint(1) NULL DEFAULT 1 COMMENT '合同项目:1=办公室合同',
  `margin` decimal(10, 2) NULL DEFAULT NULL COMMENT '保证金',
  `start_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开始日期',
  `end_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '结束日期',
  `paid_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '支付时间',
  `contract_period` tinyint(1) NULL DEFAULT NULL COMMENT '合同期限',
  `expiration` tinyint(1) NULL DEFAULT 0 COMMENT '合同是否到期:0=未到期,1=已到期',
  `jiaofei_period` tinyint(1) NULL DEFAULT NULL COMMENT '交费周期:1=季度缴,2=半年缴,3=一年缴,4=二年缴,5=三年,6=五年',
  `continuous` tinyint(1) NULL DEFAULT 0 COMMENT '是否续签合同:0=否;1=是',
  `withdraw` tinyint(1) NULL DEFAULT 0 COMMENT '是否退租:0=否;1=是',
  `withdraw_money` decimal(10, 2) NULL DEFAULT 0.00 COMMENT '退租金额',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '合同状态',
  `total_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `real_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际费用',
  `fangzu_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '房租合同',
  `caiwudaili_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '财务代理合同',
  `contractor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同签订人',
  `contractor_tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同签订人电话',
  `handler` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人',
  `issuer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开票人',
  `confirmor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '确认人',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_entry_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_entry_info`;
CREATE TABLE `qnn_park_enterprise_entry_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `build_id` int(11) NOT NULL COMMENT '楼宇ID',
  `room_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间号',
  `margin` decimal(10, 2) NOT NULL COMMENT '保证金',
  `rent_period` tinyint(1) NOT NULL COMMENT '房租交费周期:',
  `rent` decimal(10, 2) NOT NULL COMMENT '房租单价',
  `paid_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付时间',
  `contract_period` tinyint(1) NOT NULL COMMENT '合同期限',
  `zuilin_period` tinyint(1) NOT NULL COMMENT '租赁期限',
  `start_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同生效日期',
  `end_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同结束日期',
  `fuwufei_period` int(6) NOT NULL COMMENT '服务费支付周期',
  `aircon_period` int(6) NOT NULL COMMENT '空调费支付周期',
  `key_deposit` decimal(10, 2) NOT NULL COMMENT '钥匙押金',
  `mailbox_deposit` decimal(10, 2) NOT NULL COMMENT '信箱押金',
  `owner_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方公司名称',
  `owner_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方联系地址',
  `owner_tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方联系电话',
  `kuaiji_daili` tinyint(1) NOT NULL COMMENT '会计代理:1=是;0=否',
  `kjdlfy` decimal(10, 2) NULL DEFAULT NULL COMMENT '会计代理费用',
  `kjdl_s_day` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '会计代理开始日期',
  `kjdl_e_day` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '会计代理结束时间',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_kuaiji_contract
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_kuaiji_contract`;
CREATE TABLE `qnn_park_enterprise_kuaiji_contract`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `kjdlfy` decimal(10, 2) NULL DEFAULT NULL COMMENT '会计代理费用',
  `numbering` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同编号',
  `kjdl_s_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '代理开始日期',
  `kjdl_e_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '代理结束日期',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_other_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_other_info`;
CREATE TABLE `qnn_park_enterprise_other_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_type` tinyint(1) NOT NULL COMMENT '企业类别',
  `enterprise_category` tinyint(1) NOT NULL COMMENT '行业分类',
  `enterprise_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '经营状态:1=经营;2=歇业;3=注销;4=吊销;5=迁出',
  `enterprise_rate` tinyint(1) NOT NULL DEFAULT 0 COMMENT '企业评级:1=A级;2=B级;3=C级;4=D级;5=E级;',
  `student_innovation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '大学生创业:1=是;0=否',
  `schoolmate_innovation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '校友创业:1=是;0=否',
  `high_tech` tinyint(1) NOT NULL DEFAULT 0 COMMENT '高新技术企业:1=是;0=否',
  `soft_tech` tinyint(1) NOT NULL DEFAULT 0 COMMENT '软件企业:1=是;0=否',
  `new_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT '上海市专精特新企业:1=是;0=否',
  `putuo_juren` tinyint(1) NOT NULL DEFAULT 0 COMMENT '普陀小巨人:1=是;0=否',
  `shanghai_juren` tinyint(1) NOT NULL DEFAULT 0 COMMENT '上海小巨人:1=是;0=否',
  `fuhua` tinyint(1) NOT NULL DEFAULT 0 COMMENT '孵化企业:1=是;0=否',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_basic_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_basic_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_basic_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '企业名称',
  `credit_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '社会统一信用代码',
  `regist_capi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '注册资本',
  `term_start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '营业开始日期',
  `team_end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '营业结束日期',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '注册地址',
  `oper_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '法人名',
  `scope` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '经营范围',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '业务介绍',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'logo图片',
  `yyzz` int(10) NULL DEFAULT NULL COMMENT '营业执照图片',
  `frsfzzp` int(10) NULL DEFAULT NULL COMMENT '法人身份证照片',
  `qtzs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他证书图片',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `build_id` int(11) NULL DEFAULT NULL COMMENT '因为某些原因,这里也记录一下',
  `room_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '同上',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业企查查基本信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_employees_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_employees_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_employees_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `employee_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '人员姓名',
  `employees_job` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '人员职务',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_stock_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_stock_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_stock_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `stock_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '股东姓名',
  `stock_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '股东类型',
  `stock_percent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '出资比例',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
