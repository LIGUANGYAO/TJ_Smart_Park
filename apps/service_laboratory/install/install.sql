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

 Date: 21/01/2019 14:19:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_service_laboratory_booking_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_laboratory_booking_list`;
CREATE TABLE `qnn_service_laboratory_booking_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `laboratory_id` int(11) NULL DEFAULT NULL COMMENT '实验室ID',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '预约人姓名',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '预约人电话',
  `s_time` datetime(0) NOT NULL COMMENT '开始时间',
  `e_time` datetime(0) NOT NULL COMMENT '结束时间',
  `create_time` datetime(0) NOT NULL COMMENT '申请时间',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '0=待处理,1=已通过,2=已拒绝',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `handler_id` int(11) NULL DEFAULT NULL COMMENT '操作人id',
  `hand_time` datetime(0) NULL DEFAULT NULL COMMENT '操作时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_service_laboratory_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_laboratory_list`;
CREATE TABLE `qnn_service_laboratory_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `building_id` int(11) NULL DEFAULT NULL COMMENT '楼宇ID',
  `room_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '房间号',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '实验室类型,见对应config文件',
  `equipment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '实验室配备',
  `capacity` int(11) NULL DEFAULT NULL COMMENT '可容纳人数',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1=启用,2=禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
