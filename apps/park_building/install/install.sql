/*
 Navicat Premium Data Transfer

 Source Server         : 本地Linux
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1:3306
 Source Schema         : eacoo

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 17/12/2018 09:42:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_park_building
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_building`;
CREATE TABLE `qnn_park_building`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID ',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '楼宇名称',
  `image` int(11) NULL DEFAULT NULL COMMENT '图标',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '修改时间',
  `sort` tinyint(3) NOT NULL DEFAULT 50 COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '1=启用;2=禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_room
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_room`;
CREATE TABLE `qnn_park_room`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `building_id` int(11) NOT NULL COMMENT '楼宇ID',
  `floor` int(11) NOT NULL COMMENT '楼层',
  `room_number` int(11) NOT NULL COMMENT '房间号',
  `area` decimal(10, 2) NOT NULL COMMENT '面积',
  `unit_price` decimal(10, 2) NOT NULL COMMENT '单价',
  `property_price` decimal(10, 2) NOT NULL COMMENT '物业单价',
  `aircon_price` decimal(10, 2) NOT NULL COMMENT '空调单价',
  `decoration` tinyint(1) NULL DEFAULT 2 COMMENT '1:毛坯;2:简装',
  `room_img` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '房屋封面',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '房源介绍',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:未租;2:已租',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '入驻企业ID',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;