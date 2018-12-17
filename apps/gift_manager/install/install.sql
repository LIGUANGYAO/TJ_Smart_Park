/*
 Navicat Premium Data Transfer

 Source Server         : 本地Linux
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : www_demo_gov

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 28/11/2018 10:20:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_gift_manager_category
-- ----------------------------
DROP TABLE IF EXISTS `qnn_gift_manager_category`;
CREATE TABLE `qnn_gift_manager_category`  (
                                            `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
                                            PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '礼金类型' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_gift_manager_category
-- ----------------------------
INSERT INTO `qnn_gift_manager_category` VALUES (1, '结婚');
INSERT INTO `qnn_gift_manager_category` VALUES (2, '生娃');

-- ----------------------------
-- Table structure for qnn_gift_manager_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_gift_manager_list`;
CREATE TABLE `qnn_gift_manager_list`  (
                                        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                        `cate_id` int(11) NOT NULL COMMENT '类别id',
                                        `why` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '事由',
                                        `when` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '发生时间',
                                        `who` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '称呼,姓名',
                                        `money` decimal(10, 0) NULL DEFAULT 0 COMMENT '金额',
                                        `pay_status` tinyint(1) NULL DEFAULT 2 COMMENT '1=需要还礼,2=不需要还礼',
                                        PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '礼金列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_gift_manager_list
-- ----------------------------
INSERT INTO `qnn_gift_manager_list` VALUES (1, 1, '结婚礼金', '2018-03-25 00:00:00', '大姨妈', 200, 2);

SET FOREIGN_KEY_CHECKS = 1;
