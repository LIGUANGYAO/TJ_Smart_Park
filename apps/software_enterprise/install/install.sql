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

 Date: 11/01/2019 13:51:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_park_soft_enterprise_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_soft_enterprise_list`;
CREATE TABLE `qnn_park_soft_enterprise_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '软件企业列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_soft_project_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_soft_project_list`;
CREATE TABLE `qnn_park_soft_project_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `start_time` datetime(0) NULL DEFAULT NULL COMMENT '立项时间',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '软件项目列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
