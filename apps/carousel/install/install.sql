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

 Date: 11/01/2019 12:03:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_carousel_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_carousel_list`;
CREATE TABLE `qnn_carousel_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position` tinyint(5) NOT NULL DEFAULT 1 COMMENT '所属位置',
  `module` tinyint(5) NULL DEFAULT NULL COMMENT '所属模块',
  `pic_path` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告图片URL',
  `pic_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告链接',
  `pic_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '广告文字内容',
  `create_time` datetime(0) NOT NULL COMMENT '添加时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `order` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(2) NOT NULL COMMENT '1=启用  0=禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '轮播图表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_carousel_position
-- ----------------------------
DROP TABLE IF EXISTS `qnn_carousel_position`;
CREATE TABLE `qnn_carousel_position`  (
  `id` tinyint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告位名称',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=启用;0=禁用',
  `create_time` datetime(0) NOT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '轮播图位置表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
