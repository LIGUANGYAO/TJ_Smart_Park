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

 Date: 18/01/2019 14:37:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_parking_space_lease_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_parking_space_lease_list`;
CREATE TABLE `qnn_parking_space_lease_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `space` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '车位号',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业id',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `s_date` datetime(0) NULL DEFAULT NULL COMMENT '租赁起始日',
  `e_date` datetime(0) NULL DEFAULT NULL COMMENT '租赁到期日',
  `period` tinyint(1) NULL DEFAULT NULL COMMENT '周期:1=月,2=半年,3=一年4=两年,5=三年,6=四年,7=五年,8=一次性',
  `pay_time` datetime(0) NULL DEFAULT NULL COMMENT '缴费时间',
  `is_paid` tinyint(1) NULL DEFAULT 1 COMMENT '1=已缴费,2=未交费',
  `amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `lease_status` tinyint(1) NULL DEFAULT 2 COMMENT '1=到期,2=未到期',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '车位租赁列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_parking_space_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_parking_space_list`;
CREATE TABLE `qnn_parking_space_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `numbering` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '车位号',
  `price` decimal(10, 2) UNSIGNED NULL DEFAULT NULL COMMENT '费用',
  `space_status` tinyint(1) NULL DEFAULT 2 COMMENT '1=已租,2=未租',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '车位列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
