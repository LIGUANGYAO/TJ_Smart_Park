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

 Date: 19/01/2019 14:55:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_service_repair_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_repair_list`;
CREATE TABLE `qnn_service_repair_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '企业名称',
  `creator_id` int(11) NOT NULL COMMENT '报修人ID号',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '报修人手机号',
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '报修公司所在地址,自动生成',
  `type` tinyint(1) NOT NULL COMMENT '1=水电,2=电器,3=办公设备,4=电梯,5=门禁,6=公共设施,7=物业设备,8=其他报修',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片',
  `publish_time` datetime(0) NOT NULL COMMENT '报修时间',
  `status` tinyint(1) NOT NULL COMMENT '1=待处理,2=已派单,3=已完成|待评价,4=已关闭',
  `worker` int(11) NULL DEFAULT NULL COMMENT '维修工id',
  `cost` decimal(10, 2) NULL DEFAULT 0.00 COMMENT '费用',
  `evaluation` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户评价',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理回复',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '报修列表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
