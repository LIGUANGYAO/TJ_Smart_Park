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

 Date: 21/01/2019 11:13:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_service_meeting_room_booking_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_meeting_room_booking_list`;
CREATE TABLE `qnn_service_meeting_room_booking_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `meetingroom_id` int(11) NOT NULL COMMENT '会议室id',
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '申请人姓名',
  `s_time` datetime(0) NOT NULL COMMENT '开始时间',
  `e_time` datetime(0) NOT NULL COMMENT '结束时间',
  `create_time` datetime(0) NOT NULL COMMENT '申请时间',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=待审核,1=已通过,2已拒绝',
  `handler_id` int(11) NULL DEFAULT NULL COMMENT '处理人id',
  `handle_time` datetime(0) NULL DEFAULT NULL COMMENT '处理时间',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '会议室申请表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_service_meeting_room_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_meeting_room_list`;
CREATE TABLE `qnn_service_meeting_room_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `phase` tinyint(1) NULL DEFAULT NULL COMMENT '期数',
  `room_number` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间号',
  `area` double(10, 2) NOT NULL COMMENT '面积',
  `capacity` int(10) NOT NULL DEFAULT 0 COMMENT '可容纳人数',
  `equipment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '设备',
  `room_img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '封面图片',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '介绍',
  `listorder` int(11) NULL DEFAULT 50 COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=启用,0禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
