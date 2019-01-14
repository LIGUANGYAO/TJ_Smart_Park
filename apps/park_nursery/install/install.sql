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

 Date: 14/01/2019 16:00:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_park_nursery_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_nursery_list`;
CREATE TABLE `qnn_park_nursery_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `build_id` int(11) NOT NULL COMMENT '楼宇ID',
  `floor` int(11) NULL DEFAULT NULL COMMENT '楼层',
  `station_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工位号',
  `station_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '工位费',
  `station_deposit` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '押金',
  `station_status` tinyint(1) NOT NULL COMMENT '工位状态:1=未租,2=已租,3=自用',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '苗圃工位列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_nursery_team_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_nursery_team_list`;
CREATE TABLE `qnn_park_nursery_team_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '团队/企业名称',
  `build_id` int(11) NOT NULL COMMENT '楼宇ID',
  `station_id` int(11) NOT NULL COMMENT '工位',
  `real_station_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际缴纳工位费',
  `property_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '物业费',
  `aircon_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '空调费',
  `entry_time` datetime(0) NULL DEFAULT NULL COMMENT '入住时间',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '到期时间',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '苗圃入驻团队列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
