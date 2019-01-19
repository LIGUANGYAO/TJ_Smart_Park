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

 Date: 19/01/2019 10:08:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_cost_bill_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_cost_bill_list`;
CREATE TABLE `qnn_cost_bill_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bill_type` tinyint(1) NULL DEFAULT NULL COMMENT '费用类型',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业iD',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '企业名称',
  `bill_time` datetime(0) NULL DEFAULT NULL COMMENT '账单日期',
  `bill_status` tinyint(1) NULL DEFAULT NULL COMMENT '账单状态1=已缴费,2=未交费',
  `amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `real_amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际支付',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '水电等费用的账单列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_cost_category_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_cost_category_list`;
CREATE TABLE `qnn_cost_category_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `creator_id` int(5) NULL DEFAULT NULL COMMENT '创建人ID',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1=启用,2=禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '费用项目列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
