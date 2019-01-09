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

 Date: 22/12/2018 14:35:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_activity_apply_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_activity_apply_list`;
CREATE TABLE `qnn_activity_apply_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `activity_id` int(10) NOT NULL COMMENT '活动ID',
  `apply_number` int(11) NULL DEFAULT NULL COMMENT '报名人数',
  `paid_money` decimal(10, 2) NOT NULL COMMENT '预付金额',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `apply_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=待确认;2=已通过3;已拒绝',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_activity_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_activity_list`;
CREATE TABLE `qnn_activity_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '活动标题',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '类型,1=普通活动,2=讲座,3=公益',
  `hold_time` datetime(0) NOT NULL COMMENT '举办时间',
  `deadline` datetime(0) NOT NULL COMMENT '报名截止时间',
  `img` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '封面',
  `max_apply` int(5) NOT NULL COMMENT '每人最多报名数',
  `max_number` int(5) NOT NULL COMMENT '活动最大报名人数',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '预付定金',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '活动描述',
  `activity_status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=置顶,2=推荐,3=火爆',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态。0禁用，1正常',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '活动列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
