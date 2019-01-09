/*
 Navicat Premium Data Transfer

 Source Server         : 企牛牛阿里测试服
 Source Server Type    : MySQL
 Source Server Version : 50642
 Source Host           : 139.196.30.162:3306
 Source Schema         : tongji_qiniuniu_

 Target Server Type    : MySQL
 Target Server Version : 50642
 File Encoding         : 65001

 Date: 09/01/2019 15:13:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_park_incubation_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_incubation_list`;
CREATE TABLE `qnn_park_incubation_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '企业名称',
  `entry_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '入孵时间',
  `out_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '退出时间',
  `out_status` tinyint(1) NULL DEFAULT NULL COMMENT '退出状态:1=毕业',
  `liaison` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联络员',
  `counselor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '辅导员',
  `entrepreneurship_tutor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创业导师',
  `visitor_id` int(5) NULL DEFAULT NULL COMMENT '走访者id,是谁的走访对象',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '孵化企业列表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for qnn_park_incubation_visit_log
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_incubation_visit_log`;
CREATE TABLE `qnn_park_incubation_visit_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `visitor_id` int(11) NULL DEFAULT NULL COMMENT '走访者ID',
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '走访记录',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '孵化企业走访记录' ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
