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

 Date: 22/01/2019 11:31:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for qnn_action
-- ----------------------------
DROP TABLE IF EXISTS `qnn_action`;
CREATE TABLE `qnn_action`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '行为唯一标识（组合控制器名+操作名）',
  `depend_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '来源类型。0系统,1module，2plugin，3theme',
  `depend_flag` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所属模块名',
  `title` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` varchar(140) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '行为规则',
  `log` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日志规则',
  `action_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '执行类型。1自定义操作，2记录操作',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '修改时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态。0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统行为表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_action
-- ----------------------------
INSERT INTO `qnn_action` VALUES (1, 'login_index', 1, 'admin', '登录后台', '用户登录后台', '', '[user|get_nickname]在[time|time_format]登录了后台', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (2, 'update_config', 1, 'admin', '更新配置', '新增或修改或删除配置', '', '', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (3, 'update_channel', 1, 'admin', '更新导航', '新增或修改或删除导航', '', '', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (4, 'update_category', 1, 'admin', '更新分类', '新增或修改或删除分类', '', '', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (5, 'database_export', 1, 'admin', '数据库备份', '后台进行数据库备份操作', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (6, 'database_optimize', 1, 'admin', '数据表优化', '数据库管理-》数据表优化', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (7, 'database_repair', 1, 'admin', '数据表修复', '数据库管理-》数据表修复', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (8, 'database_delbackup', 1, 'admin', '备份文件删除', '数据库管理-》备份文件删除', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (9, 'database_import', 1, 'admin', '数据库完成', '数据库管理-》数据还原', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (10, 'delete_actionlog', 1, 'admin', '删除行为日志', '后台删除用户行为日志', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (11, 'user_register', 1, 'admin', '注册', '', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (12, 'action_add', 1, 'admin', '添加行为', '', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (13, 'action_edit', 1, 'admin', '编辑用户行为', '', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (14, 'action_dellog', 1, 'admin', '清空日志', '清空所有行为日志', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (15, 'setstatus', 1, 'admin', '改变数据状态', '通过列表改变了数据的status状态值', '', '', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_action` VALUES (16, 'modules_delapp', 1, 'admin', '删除模块', '删除整个模块的时候记录', '', '', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);

-- ----------------------------
-- Table structure for qnn_action_log
-- ----------------------------
DROP TABLE IF EXISTS `qnn_action_log`;
CREATE TABLE `qnn_action_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) UNSIGNED NOT NULL COMMENT '行为ID',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否后台操作。0否，1是',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '执行用户id（管理员用户）',
  `nickname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `request_method` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请求类型',
  `url` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作页面',
  `data` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '相关数据,json格式',
  `ip` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'IP',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日志备注',
  `user_agent` varchar(360) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'User-Agent',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统行为日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_action_log
-- ----------------------------
INSERT INTO `qnn_action_log` VALUES (1, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-17 14:00:57');
INSERT INTO `qnn_action_log` VALUES (2, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-17 15:08:43');
INSERT INTO `qnn_action_log` VALUES (3, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-17 15:38:30');
INSERT INTO `qnn_action_log` VALUES (4, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-18 14:43:41');
INSERT INTO `qnn_action_log` VALUES (5, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-18 16:08:00');
INSERT INTO `qnn_action_log` VALUES (6, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-18 16:09:34');
INSERT INTO `qnn_action_log` VALUES (7, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-19 10:29:50');
INSERT INTO `qnn_action_log` VALUES (8, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-20 09:02:35');
INSERT INTO `qnn_action_log` VALUES (9, 13, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/action/edit.html', '{\"param\":[]}', '127.0.0.1', '编辑用户行为', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-21 11:02:01');
INSERT INTO `qnn_action_log` VALUES (10, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-22 09:07:50');
INSERT INTO `qnn_action_log` VALUES (11, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-22 11:45:46');
INSERT INTO `qnn_action_log` VALUES (12, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-24 08:31:08');
INSERT INTO `qnn_action_log` VALUES (13, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-25 09:16:35');
INSERT INTO `qnn_action_log` VALUES (14, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-25 13:44:57');
INSERT INTO `qnn_action_log` VALUES (15, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-26 08:34:03');
INSERT INTO `qnn_action_log` VALUES (16, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-27 08:51:50');
INSERT INTO `qnn_action_log` VALUES (17, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-29 13:57:12');
INSERT INTO `qnn_action_log` VALUES (18, 1, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-02 09:02:36');
INSERT INTO `qnn_action_log` VALUES (19, 15, 1, 1, 'admin', 'POST', '/admin.php?s=/admin/attachment/setstatus/status/delete/model/attachment.html', '{\"param\":[]}', '127.0.0.1', '改变数据状态', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-02 16:38:44');
INSERT INTO `qnn_action_log` VALUES (20, 1, 1, 1, 'admin', 'GET', '/admin.php?', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-02 17:05:00');
INSERT INTO `qnn_action_log` VALUES (21, 1, 1, 1, 'admin', 'GET', '/admin.php', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-04 16:33:06');
INSERT INTO `qnn_action_log` VALUES (22, 1, 1, 1, 'admin', 'POST', '/admin.php/admin/login/index.html', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-07 08:46:58');
INSERT INTO `qnn_action_log` VALUES (23, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-08 14:36:57');
INSERT INTO `qnn_action_log` VALUES (24, 16, 1, 1, 'admin', 'GET', '/admin.php/admin/modules/delapp/name/gift_manager.html', '{\"param\":[]}', '127.0.0.1', '删除模块', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-09 10:48:37');
INSERT INTO `qnn_action_log` VALUES (25, 1, 1, 1, 'admin', 'GET', '/admin.php', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-11 08:45:09');
INSERT INTO `qnn_action_log` VALUES (26, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-14 08:43:50');
INSERT INTO `qnn_action_log` VALUES (27, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-15 08:49:57');
INSERT INTO `qnn_action_log` VALUES (28, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-16 08:39:32');
INSERT INTO `qnn_action_log` VALUES (29, 15, 1, 1, 'admin', 'GET', '/admin.php/admin/plugins/setstatus/status/forbid/ids/10.html', '{\"param\":[]}', '127.0.0.1', '改变数据状态', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-16 16:59:19');
INSERT INTO `qnn_action_log` VALUES (30, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-17 09:04:11');
INSERT INTO `qnn_action_log` VALUES (31, 16, 1, 1, 'admin', 'GET', '/admin.php/admin/modules/delapp/name/park_enterprise_intellectual_property.html', '{\"param\":[]}', '127.0.0.1', '删除模块', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-17 17:20:29');
INSERT INTO `qnn_action_log` VALUES (32, 1, 1, 1, 'admin', 'GET', '/admin.php?s=/admin/login/index', '{\"param\":[]}', '127.0.0.1', '登录后台', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-21 08:31:52');

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

-- ----------------------------
-- Table structure for qnn_admin
-- ----------------------------
DROP TABLE IF EXISTS `qnn_admin`;
CREATE TABLE `qnn_admin`  (
  `uid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员UID',
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `nickname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `avatar` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像，相对于uploads/avatar目录',
  `sex` smallint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别；0：保密，1：男；2：女',
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '个人介绍',
  `login_num` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `last_login_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '最后登录时间',
  `activation_auth_sign` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `bind_uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '绑定前台用户ID（可选）',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '注册时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户状态 0：禁用； 1：正常 ',
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE INDEX `uniq_username`(`username`) USING BTREE,
  INDEX `idx_email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_admin
-- ----------------------------
INSERT INTO `qnn_admin` VALUES (1, 'admin', '31b836d289cdfb8b6e20c2bab2b78756', '创始人', 'xpwsgg@163.com', '', 'http://cdn.eacoo.xin/attachment/static/assets/img/default-avatar.png', 2, '我很帅', 0, '127.0.0.1', '2019-01-21 08:31:51', '3d3b4ab61b9c70ded38a759b5f95793544ec7cf3', 1, '2018-11-26 17:15:57', '2018-11-28 16:21:29', 1);
INSERT INTO `qnn_admin` VALUES (2, 'dtt123', '31b836d289cdfb8b6e20c2bab2b78756', '段婷婷', 'dtt@163.com', '17889898989', '', 0, '', 0, '127.0.0.1', '0001-01-01 00:00:00', '', 0, '2019-01-11 10:05:24', '2019-01-11 10:05:33', 1);
INSERT INTO `qnn_admin` VALUES (3, 'lichao', '31b836d289cdfb8b6e20c2bab2b78756', '李超', 'lc@126.com', '17888888888', '', 1, '', 0, '127.0.0.1', '0001-01-01 00:00:00', '', 0, '2019-01-19 15:57:46', '2019-01-19 15:57:46', 1);

-- ----------------------------
-- Table structure for qnn_attachment
-- ----------------------------
DROP TABLE IF EXISTS `qnn_attachment`;
CREATE TABLE `qnn_attachment`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否后台用户上传',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件路径',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件链接（暂时无用）',
  `location` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件存储位置(或驱动)',
  `path_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'picture' COMMENT '路径类型，存储在uploads的哪个目录中',
  `ext` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件类型',
  `mime_type` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文件大小',
  `alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '替代文本图像alt',
  `md5` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件sha1编码',
  `download` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '下载次数',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '上传时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '修改时间',
  `sort` mediumint(8) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_paty_type`(`path_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '附件表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_attachment
-- ----------------------------
INSERT INTO `qnn_attachment` VALUES (1, 1, 0, 'preg_match_imgs.jpeg', '/uploads/Editor/Picture/2016-06-12/575d4bd8d0351.jpeg', '', 'local', 'editor', 'jpeg', '', 19513, '', '4cf157e42b44c95d579ee39b0a1a48a4', 'dee76e7b39f1afaad14c1e03cfac5f6031c3c511', 0, '2018-09-30 12:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_attachment` VALUES (2, 1, 0, 'gerxiangimg200x200.jpg', '/uploads/Editor/Picture/2016-06-12/575d4bfb09961.jpg', '', 'local', 'editor', 'jpg', '', 5291, 'gerxiangimg200x200', '4db879c357c4ab80c77fce8055a0785f', '480eb2e097397856b99b373214fb28c2f717dacf', 0, '2018-09-30 13:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_attachment` VALUES (3, 1, 0, 'oraclmysqlzjfblhere.jpg', '/uploads/Editor/Picture/2016-06-12/575d4c691e976.jpg', '', 'local', 'editor', 'jpg', '', 23866, 'mysql', '5a3a5a781a6d9b5f0089f6058572f850', 'a17bfe395b29ba06ae5784486bcf288b3b0adfdb', 0, '2018-09-30 14:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_attachment` VALUES (13, 1, 0, '7751775467283337', '/uploads/picture/2016-09-26/57e8dc9d29b01.jpg', '', 'local', 'picture', 'jpg', '', 70875, NULL, '3e3bfc950aa0b6ebb56654c15fe8e392', 'c75e70753eaf36aaee10efb3682fdbd8f766d32d', 0, '2018-09-30 15:17:26', '2018-09-30 22:32:26', 99, -1);
INSERT INTO `qnn_attachment` VALUES (14, 1, 1, '595a09d177244', '/uploads/picture/2018-12-04/5c064d7f080af.jpg', '/uploads/picture/2018-12-04/5c064d7f080af.jpg', 'local', 'picture', 'jpg', 'image', 381604, '595a09d177244', '4b63e27cf651c226dfccf889766aea6b', 'e1da9da2cd6bf9c1f7b5a5dcb50ac5abad99f506', 0, '2018-12-04 17:48:47', '2018-12-18 14:50:54', 99, 1);
INSERT INTO `qnn_attachment` VALUES (16, 1, 1, '5c1cb2ef855d2', '/uploads/file/2019-01-02/5c2c760e3fa19.jpg', '/uploads/file/2019-01-02/5c2c760e3fa19.jpg', 'local', 'file', 'jpg', 'image', 1075780, '5c1cb2ef855d2', '9d0f57c9bfe35c10006f78b369bd2d32', '1417f7651b4e4bd2e1426927a2e556deb1707f4c', 0, '2019-01-02 16:27:58', '2019-01-02 16:40:21', 99, 1);
INSERT INTO `qnn_attachment` VALUES (18, 1, 1, '西北坡小程序交接文档', '/uploads/file/2019-01-02/5c2c7f49dd16c.docx', '/uploads/file/2019-01-02/5c2c7f49dd16c.docx', 'local', 'file', 'docx', 'application', 25563, '西北坡小程序交接文档', 'fdab546b2224fbfec935763570e82d82', '06106f914579b7c78a46e84e3fc881280ebfc627', 0, '2019-01-02 17:07:21', '2019-01-02 17:07:21', 99, 1);

-- ----------------------------
-- Table structure for qnn_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `qnn_auth_group`;
CREATE TABLE `qnn_auth_group`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '描述信息',
  `rules` varchar(160) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态。1启用，0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_auth_group
-- ----------------------------
INSERT INTO `qnn_auth_group` VALUES (1, '超级管理员', '拥有网站的最高权限', '1,2,6,18,9,12,19,25,17,26,3,7,21,43,44,4,37,38,39,40,41,42,5,22,23,30,24,10,11,13,14,20,32,15,8,16,45,27,28,29', 1);
INSERT INTO `qnn_auth_group` VALUES (2, '管理员', '授权管理员', '1,6,18,12,19,26,3,7,21,44,4,37,38,39,40,41,42,5,22,23,30,24,10,11,13,14,20,15,8,16,27,28,29', 1);
INSERT INTO `qnn_auth_group` VALUES (3, '普通用户', '这是普通用户的权限', '1,3,8,10,11,94,95,96,97,98,99,41,42,43,44,38,39,40', 1);
INSERT INTO `qnn_auth_group` VALUES (4, '客服', '客服处理订单发货', '1,27,28,29,7,4,52,53,54,55', 1);
INSERT INTO `qnn_auth_group` VALUES (5, '孵化企业联络员', '孵化企业联络员', '198,199,200,201,202,203,204', 1);
INSERT INTO `qnn_auth_group` VALUES (6, '维修部门', '负责处理入驻企业的报修', '', 1);

-- ----------------------------
-- Table structure for qnn_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `qnn_auth_group_access`;
CREATE TABLE `qnn_auth_group_access`  (
  `uid` int(11) UNSIGNED NOT NULL COMMENT '管理员用户ID',
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否审核  2：未审核，1:启用，0：禁用，-1：删除',
  INDEX `uid`(`uid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户组明细表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_auth_group_access
-- ----------------------------
INSERT INTO `qnn_auth_group_access` VALUES (1, 1, 1);
INSERT INTO `qnn_auth_group_access` VALUES (2, 5, 1);
INSERT INTO `qnn_auth_group_access` VALUES (3, 6, 1);

-- ----------------------------
-- Table structure for qnn_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `qnn_auth_rule`;
CREATE TABLE `qnn_auth_rule`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '导航链接',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '导航名字',
  `depend_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '来源类型。1module，2plugin，3theme',
  `depend_flag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '来源标记。如：模块或插件标识',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '是否支持规则表达式',
  `pid` smallint(6) UNSIGNED NULL DEFAULT 0 COMMENT '上级id',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '图标',
  `condition` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `is_menu` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否菜单',
  `position` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'left' COMMENT '菜单显示位置。left:左边，top:头部',
  `developer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '开发者',
  `sort` smallint(6) UNSIGNED NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否有效(0:无效,1:有效)',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 500 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '规则表（后台菜单）' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_auth_rule
-- ----------------------------
INSERT INTO `qnn_auth_rule` VALUES (1, 'admin/dashboard/index', '仪表盘', 1, 'admin', 1, 0, 'fa fa-tachometer', NULL, 1, 'left', 0, 3, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (2, 'admin', '系统设置', 1, 'admin', 1, 0, 'fa fa-cog', NULL, 1, 'left', 0, 18, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (3, 'user/user/', '会员管理', 1, 'user', 1, 0, 'fa fa-users', NULL, 1, 'left', 0, 28, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (4, 'admin/attachment/index', '附件空间', 1, 'admin', 1, 0, 'fa fa-picture-o', NULL, 1, 'left', 0, 34, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (5, 'admin/extend/index', '应用中心', 1, 'admin', 1, 0, 'fa fa-cloud', NULL, 1, 'left', 0, 35, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (6, 'admin/navigation/index', '前台导航菜单', 1, 'admin', 1, 2, 'fa fa-leaf', NULL, 1, 'left', 0, 30, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (7, 'user/user/index', '用户列表', 1, 'user', 1, 3, 'fa fa-user', NULL, 1, 'left', 0, 4, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (8, 'admin/AuthGroup/index', '角色组', 1, 'user', 1, 15, '', NULL, 1, 'left', 0, 6, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (9, 'admin/menu/index', '后台菜单管理', 1, 'admin', 1, 2, 'fa fa-inbox', NULL, 1, 'left', 1, 36, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (10, 'tools', '插件工具', 1, 'admin', 1, 0, 'fa fa-gavel', NULL, 1, 'left', 1, 33, '2018-11-29 14:51:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (11, 'admin/database', '安全', 1, 'admin', 1, 10, 'fa fa-database', NULL, 0, 'left', 0, 37, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (12, 'admin/attachment/setting', '设置', 1, 'admin', 1, 2, '', NULL, 0, 'left', 0, 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (13, 'admin/link/index', '友情链接', 1, 'admin', 1, 10, '', NULL, 1, 'left', 0, 31, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (14, 'admin/link/edit', '链接编辑', 1, 'admin', 1, 13, '', NULL, 0, 'left', 0, 7, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (15, 'user/auth', '权限管理', 1, 'user', 1, 0, 'fa fa-sun-o', NULL, 1, 'left', 0, 25, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (16, 'admin/auth/index', '规则管理', 1, 'admin', 1, 15, 'fa fa-500px', NULL, 1, 'left', 0, 19, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (17, 'admin/config/edit', '配置编辑或添加', 1, 'admin', 1, 25, '', NULL, 0, 'left', 0, 32, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (18, 'admin/navigation/edit', '导航编辑或添加', 1, 'admin', 1, 6, '', NULL, 0, 'left', 0, 8, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (19, 'admin/config/website', '网站设置', 1, 'admin', 1, 2, '', NULL, 1, 'left', 0, 26, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (20, 'admin/database/index', '数据库管理', 1, 'admin', 1, 10, 'fa fa-database', NULL, 1, 'left', 0, 38, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (21, 'user/user/resetPassword', '修改密码', 1, 'user', 1, 3, '', '', 1, 'top', 0, 40, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (22, 'admin/theme/index', '主题', 1, 'admin', 1, 5, 'fa fa-cloud', NULL, 1, 'left', 0, 23, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (23, 'admin/plugins/index', '插件', 1, 'admin', 1, 5, 'fa fa-cloud', NULL, 1, 'left', 0, 20, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (24, 'admin/modules/index', '模块', 1, 'admin', 1, 5, 'fa fa-cloud', NULL, 1, 'left', 0, 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (25, 'admin/config/index', '配置管理', 1, 'admin', 1, 2, '', NULL, 1, 'left', 1, 39, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (26, 'admin/config/group', '系统设置', 1, 'admin', 1, 2, '', NULL, 1, 'left', 0, 9, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (27, 'admin/action', '系统安全', 1, 'admin', 1, 0, 'fa fa-list-alt', NULL, 1, 'left', 0, 24, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (28, 'admin/action/index', '用户行为', 1, 'user', 1, 27, NULL, NULL, 1, 'left', 0, 10, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (29, 'admin/action/log', '行为日志', 1, 'user', 1, 27, 'fa fa-address-book-o', NULL, 1, 'left', 0, 21, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (30, 'admin/plugins/hooks', '钩子管理', 1, 'admin', 1, 23, '', NULL, 0, 'left', 1, 11, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (32, 'admin/mailer/template', '邮件模板', 1, 'admin', 1, 10, NULL, NULL, 1, 'left', 0, 29, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (37, 'admin/attachment/attachmentCategory', '附件分类', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 12, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (38, 'admin/attachment/upload', '文件上传', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 13, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (39, 'admin/attachment/uploadPicture', '上传图片', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 14, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (40, 'admin/attachment/upload_onlinefile', '添加外链附件', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 15, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (41, 'admin/attachment/attachmentInfo', '附件详情', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 16, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (42, 'admin/attachment/uploadAvatar', '上传头像', 1, 'admin', 1, 4, NULL, NULL, 0, 'left', 0, 17, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (43, 'user/tags/index', '标签管理', 1, 'user', 1, 3, '', NULL, 1, 'left', 0, 22, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0);
INSERT INTO `qnn_auth_rule` VALUES (44, 'user/tongji/analyze', '会员统计', 1, 'user', 1, 3, '', NULL, 1, 'left', 0, 27, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (45, 'admin/AdminUser/index', '管理员', 1, 'admin', 1, 15, '', '', 1, 'left', 0, 5, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_auth_rule` VALUES (55, 'wechat', '微信管理', 1, 'wechat', 1, 0, 'fa fa-wechat', '', 1, 'left', 0, 41, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (56, 'wechat/wechat/index', '公众号管理', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 42, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (57, 'wechat/Reply/keyword', '自动回复', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 43, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (58, 'wechat/Material/text', '素材管理', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 44, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (59, 'wechat/Menu/index', '自定义菜单', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 45, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (60, 'wechat/WechatUser/index', '微信用户列表', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 46, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (61, 'wechat/Message/index', '消息列表', 1, 'wechat', 1, 55, '', '', 1, 'left', 0, 47, '2018-11-27 13:36:45', '2018-11-27 13:36:45', 1);
INSERT INTO `qnn_auth_rule` VALUES (78, 'cms/posts', '内容管理CMS', 1, 'cms', 1, 0, 'fa fa-file-text', '', 1, 'left', 0, 51, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (79, 'admin/modules/config?name=cms', '模块设置', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 52, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (80, 'cms/Document/index', '文档管理', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 53, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (81, 'cms/posts/index', '文章列表', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 54, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (82, 'cms/posts/edit', '文章编辑', 1, 'cms', 1, 78, '', '', 0, 'left', 0, 55, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (83, 'cms/category/index', '文章分类', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 56, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (84, 'cms/category/index?taxonomy=post_tag', '文章标签', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 57, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_auth_rule` VALUES (85, 'cms/page/index', '页面列表', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 58, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (86, 'cms/Document/trash', '回收站', 1, 'cms', 1, 78, '', '', 1, 'left', 0, 59, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (90, 'admin/plugins/config?name=ImageGallery', '图片轮播', 2, 'ImageGallery', 1, 10, 'fa fa-file-text', '', 1, 'left', 0, 63, '2018-11-28 17:41:10', '2018-11-28 17:41:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (92, 'admin/plugins/config?name=Alisms', '阿里云短信', 2, 'Alisms', 1, 10, 'fa fa-paper-plane-o', '', 1, 'left', 0, 64, '2018-11-28 17:55:55', '2018-11-28 17:55:55', 1);
INSERT INTO `qnn_auth_rule` VALUES (94, 'admin/plugins/config?name=qiniuoss', '七牛云储存', 2, 'qiniuoss', 1, 10, 'fa fa-file-text', '', 1, 'left', 0, 65, '2018-11-29 15:05:31', '2018-11-29 15:05:31', 1);
INSERT INTO `qnn_auth_rule` VALUES (132, 'park/building', '房源管理', 1, 'park_building', 1, 0, 'fa fa-institution', '', 1, 'left', 0, 99, '2018-12-17 09:43:31', '2018-12-17 09:43:31', 1);
INSERT INTO `qnn_auth_rule` VALUES (133, 'park_building/building/index', '楼宇列表', 1, 'park_building', 1, 132, 'fa fa-institution', '', 1, 'left', 0, 99, '2018-12-17 09:43:31', '2018-12-17 09:43:31', 1);
INSERT INTO `qnn_auth_rule` VALUES (134, 'park_building/room/index', '房源列表', 1, 'park_building', 1, 132, '', '', 1, 'left', 0, 99, '2018-12-17 09:43:31', '2018-12-17 09:43:31', 1);
INSERT INTO `qnn_auth_rule` VALUES (152, 'park/activity', '活动管理', 1, 'park_activity', 1, 0, 'fa fa-soccer-ball-o', '', 1, 'left', 0, 99, '2018-12-22 14:36:29', '2018-12-22 14:36:29', 1);
INSERT INTO `qnn_auth_rule` VALUES (153, 'park_activity/activity/index', '活动列表', 1, 'park_activity', 1, 152, '', '', 1, 'left', 0, 99, '2018-12-22 14:36:29', '2018-12-22 14:36:29', 1);
INSERT INTO `qnn_auth_rule` VALUES (154, 'park_activity/apply/index', '报名列表', 1, 'park_activity', 1, 152, '', '', 1, 'left', 0, 99, '2018-12-22 14:36:29', '2018-12-22 14:36:29', 1);
INSERT INTO `qnn_auth_rule` VALUES (189, 'park/enterprise', '企业管理', 1, 'park_enterprise', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (190, 'park_enterprise/EnterpriseBasic/index', '企业列表', 1, 'park_enterprise', 1, 189, '', '', 1, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (191, 'park_enterprise/EnterpriseBasic/edit', '添加企业', 1, 'park_enterprise', 1, 189, '', '', 0, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (192, 'park_enterprise/EnterpriseBasic/del', '删除企业', 1, 'park_enterprise', 1, 189, '', '', 0, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (193, 'park_enterprise/EnterpriseContract/index', '租房合同', 1, 'park_enterprise', 1, 189, '', '', 1, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (194, 'park_enterprise/EnterpriseContract/edit', '添加租房合同', 1, 'park_enterprise', 1, 189, '', '', 0, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (195, 'park_enterprise/EnterpriseContract/del', '删除租房合同', 1, 'park_enterprise', 1, 189, '', '', 0, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (196, 'park_enterprise/EnterpriseCwdlContract/index', '财务代理合同', 1, 'park_enterprise', 1, 189, '', '', 1, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (197, 'park_enterprise/EnterpriseCwdlContract/edit', '添加财务代理合同', 1, 'park_enterprise', 1, 189, '', '', 0, 'left', 0, 99, '2019-01-08 14:54:34', '2019-01-08 14:54:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (198, 'park/incubation', '孵化企业管理', 1, 'park_incubation', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-18 10:30:59', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (199, 'park_incubation/Incubation/index', '孵化企业列表', 1, 'park_incubation', 1, 198, '', '', 1, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (200, 'park_incubation/Incubation/edit', '添加孵化企业', 1, 'park_incubation', 1, 198, '', '', 0, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (201, 'park_incubation/Incubation/del', '删除孵化企业', 1, 'park_incubation', 1, 198, '', '', 0, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (202, 'park_incubation/IncubationVisit/index', '走访记录', 1, 'park_incubation', 1, 198, '', '', 1, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (203, 'park_incubation/IncubationVisit/edit', '添加走访记录', 1, 'park_incubation', 1, 198, '', '', 0, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (204, 'park_incubation/IncubationVisit/del', '删除走访记录', 1, 'park_incubation', 1, 198, '', '', 0, 'left', 0, 99, '2019-01-09 15:32:13', '2019-01-09 15:32:13', 1);
INSERT INTO `qnn_auth_rule` VALUES (205, 'carousel/index', '轮播图管理', 1, 'carousel', 1, 0, 'fa fa-picture-o', '', 1, 'left', 0, 99, '2019-01-18 09:47:40', '2019-01-11 13:32:07', 1);
INSERT INTO `qnn_auth_rule` VALUES (206, 'admin/modules/config?name=carousel', '轮播图配置', 1, 'carousel', 1, 205, 'fa fa-cog ', '', 1, 'left', 0, 99, '2019-01-11 13:32:07', '2019-01-11 13:32:07', 1);
INSERT INTO `qnn_auth_rule` VALUES (207, 'carousel/carousel_position/index', '轮播位设置', 1, 'carousel', 1, 205, 'fa fa-th-large', '', 1, 'left', 0, 99, '2019-01-11 13:32:07', '2019-01-11 13:32:07', 1);
INSERT INTO `qnn_auth_rule` VALUES (208, 'carousel/carousel_list/index', '轮播图列表', 1, 'carousel', 1, 205, 'fa fa-file-image-o', '', 1, 'left', 0, 99, '2019-01-11 13:32:07', '2019-01-11 13:32:07', 1);
INSERT INTO `qnn_auth_rule` VALUES (223, 'park/software_enterprise', '软件企业', 1, 'software_enterprise', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-11 14:31:15', '2019-01-11 14:31:15', 1);
INSERT INTO `qnn_auth_rule` VALUES (224, 'software_enterprise/EnterpriseList/index', '企业列表', 1, 'software_enterprise', 1, 223, '', '', 1, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (225, 'software_enterprise/EnterpriseList/edit', '新增企业', 1, 'software_enterprise', 1, 223, '', '', 0, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (226, 'software_enterprise/EnterpriseList/delete', '删除企业', 1, 'software_enterprise', 1, 223, '', '', 0, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (227, 'software_enterprise/SoftList/index', '项目列表', 1, 'software_enterprise', 1, 223, '', '', 1, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (228, 'software_enterprise/SoftList/edit', '新增项目', 1, 'software_enterprise', 1, 223, '', '', 0, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (229, 'software_enterprise/SoftList/delete', '删除项目', 1, 'software_enterprise', 1, 223, '', '', 0, 'left', 0, 99, '2019-01-11 14:31:16', '2019-01-11 14:31:16', 1);
INSERT INTO `qnn_auth_rule` VALUES (231, 'high-tech/index', '高新企业管理', 1, 'high_tech_enterprise', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-14 10:14:34', '2019-01-14 10:14:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (232, 'high_tech_enterprise/Index/index', '企业列表', 1, 'high_tech_enterprise', 1, 231, '', '', 1, 'left', 0, 99, '2019-01-14 10:14:34', '2019-01-14 10:14:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (233, 'high_tech_enterprise/Index/edit', '添加企业', 1, 'high_tech_enterprise', 1, 231, '', '', 0, 'left', 0, 99, '2019-01-14 10:14:34', '2019-01-14 10:14:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (234, 'high_tech_enterprise/Index/delete', '删除企业', 1, 'high_tech_enterprise', 1, 231, '', '', 0, 'left', 0, 99, '2019-01-14 10:14:34', '2019-01-14 10:14:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (235, 'park/nursery', '苗圃管理', 1, 'park_nursery', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (236, 'park_nursery/Nursery/index', '苗圃工位列表', 1, 'park_nursery', 1, 235, '', '', 1, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (237, 'park_nursery/Nursery/edit', '添加苗圃工位', 1, 'park_nursery', 1, 235, '', '', 0, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (238, 'park_nursery/Nursery/delete', '删除苗圃工位', 1, 'park_nursery', 1, 235, '', '', 0, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (239, 'park_nursery/Team/index', '苗圃团队管理', 1, 'park_nursery', 1, 235, '', '', 1, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (240, 'park_nursery/Team/edit', '添加苗圃团队', 1, 'park_nursery', 1, 235, '', '', 0, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (241, 'park_nursery/Team/delete', '删除苗圃团队', 1, 'park_nursery', 1, 235, '', '', 0, 'left', 0, 99, '2019-01-14 16:11:39', '2019-01-14 16:11:39', 1);
INSERT INTO `qnn_auth_rule` VALUES (242, 'park/investment', '投资管理', 1, 'park_investment', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-15 11:53:05', '2019-01-15 11:53:05', 1);
INSERT INTO `qnn_auth_rule` VALUES (243, 'park_investment/Investment/index', '投资列表', 1, 'park_investment', 1, 242, '', '', 1, 'left', 0, 99, '2019-01-15 11:53:05', '2019-01-15 11:53:05', 1);
INSERT INTO `qnn_auth_rule` VALUES (244, 'park_investment/Investment/edit', '添加投资', 1, 'park_investment', 1, 242, '', '', 0, 'left', 0, 99, '2019-01-15 11:53:05', '2019-01-15 11:53:05', 1);
INSERT INTO `qnn_auth_rule` VALUES (245, 'park_investment/Investment/del', '删除投资', 1, 'park_investment', 1, 242, '', '', 0, 'left', 0, 99, '2019-01-15 11:53:05', '2019-01-15 11:53:05', 1);
INSERT INTO `qnn_auth_rule` VALUES (254, 'park/project_budget', '项目预算管理', 1, 'park_project_budget', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-16 09:46:34', '2019-01-16 09:46:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (255, 'park_project_budget/Budget/index', '项目预算列表', 1, 'park_project_budget', 1, 254, '', '', 1, 'left', 0, 99, '2019-01-16 09:46:34', '2019-01-16 09:46:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (256, 'park_project_budget/Budget/edit', '添加项目预算', 1, 'park_project_budget', 1, 254, '', '', 0, 'left', 0, 99, '2019-01-16 09:46:34', '2019-01-16 09:46:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (257, 'park_project_budget/Budget/delete', '删除项目预算', 1, 'park_project_budget', 1, 254, '', '', 0, 'left', 0, 99, '2019-01-16 09:46:34', '2019-01-16 09:46:34', 1);
INSERT INTO `qnn_auth_rule` VALUES (258, 'park/enterprise_finance', '公司财务信息', 1, 'park_enterprise_finance_info', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-16 11:11:49', '2019-01-16 11:11:49', 1);
INSERT INTO `qnn_auth_rule` VALUES (259, 'park_enterprise_finance_info/Finance/index', '科技项目资金列表', 1, 'park_enterprise_finance_info', 1, 258, '', '', 1, 'left', 0, 99, '2019-01-16 11:11:49', '2019-01-16 11:11:49', 1);
INSERT INTO `qnn_auth_rule` VALUES (260, 'park_enterprise_finance_info/Finance/edit', '添加科技项目', 1, 'park_enterprise_finance_info', 1, 258, '', '', 0, 'left', 0, 99, '2019-01-16 11:11:49', '2019-01-16 11:11:49', 1);
INSERT INTO `qnn_auth_rule` VALUES (261, 'park_enterprise_finance_info/Finance/delete', '删除科技项目', 1, 'park_enterprise_finance_info', 1, 258, '', '', 0, 'left', 0, 99, '2019-01-16 11:11:49', '2019-01-16 11:11:49', 1);
INSERT INTO `qnn_auth_rule` VALUES (282, 'admin/plugins/config?name=Qichacha', '企查查', 2, 'Qichacha', 1, 10, 'fa fa-quora', '', 1, 'left', 0, 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_auth_rule` VALUES (283, 'park/park_financial_support', '财政扶持管理', 1, 'park_financial_support', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-17 17:14:50', '2019-01-17 17:14:50', 1);
INSERT INTO `qnn_auth_rule` VALUES (284, 'park_financial_support/Index/index', '扶持列表', 1, 'park_financial_support', 1, 283, '', '', 1, 'left', 0, 99, '2019-01-17 17:14:50', '2019-01-17 17:14:50', 1);
INSERT INTO `qnn_auth_rule` VALUES (285, 'park_financial_support/Index/edit', '添加扶持', 1, 'park_financial_support', 1, 283, '', '', 0, 'left', 0, 99, '2019-01-17 17:14:50', '2019-01-17 17:14:50', 1);
INSERT INTO `qnn_auth_rule` VALUES (286, 'park_financial_support/Index/delete', '删除扶持', 1, 'park_financial_support', 1, 283, '', '', 0, 'left', 0, 99, '2019-01-17 17:14:50', '2019-01-17 17:14:50', 1);
INSERT INTO `qnn_auth_rule` VALUES (350, 'park/intellectual', '知识产权管理', 1, 'park_enterprise_intellectual', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (351, 'park_enterprise_intellectual/Trademark/index', '商标信息列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (352, 'park_enterprise_intellectual/Trademark/edit', '添加商标', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (353, 'park_enterprise_intellectual/Trademark/delete', '删除商标', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (354, 'park_enterprise_intellectual/Patent/index', '专利信息列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (355, 'park_enterprise_intellectual/Patent/edit', '添加专利', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (356, 'park_enterprise_intellectual/Patent/delete', '删除专利', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (357, 'park_enterprise_intellectual/Certificate/index', '企业证书列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (358, 'park_enterprise_intellectual/Certificate/edit', '添加证书', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (359, 'park_enterprise_intellectual/Certificate/delete', '删除证书', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (360, 'park_enterprise_intellectual/Wcopyright/index', '作品著作权列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (361, 'park_enterprise_intellectual/Wcopyright/edit', '添加作品著作权', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (362, 'park_enterprise_intellectual/Wcopyright/delete', '删除作品著作权', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (363, 'park_enterprise_intellectual/Scopyright/index', '软件著作权列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:17', '2019-01-17 17:33:17', 1);
INSERT INTO `qnn_auth_rule` VALUES (364, 'park_enterprise_intellectual/Scopyright/edit', '添加软件著作权', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:18', '2019-01-17 17:33:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (365, 'park_enterprise_intellectual/Scopyright/delete', '删除软件著作权', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:18', '2019-01-17 17:33:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (366, 'park_enterprise_intellectual/Website/index', '网站信息列表', 1, 'park_enterprise_intellectual', 1, 350, '', '', 1, 'left', 0, 99, '2019-01-17 17:33:18', '2019-01-17 17:33:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (367, 'park_enterprise_intellectual/Website/edit', '添加网站信息', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:18', '2019-01-17 17:33:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (368, 'park_enterprise_intellectual/Website/delete', '删除网站信息', 1, 'park_enterprise_intellectual', 1, 350, '', '', 0, 'left', 0, 99, '2019-01-17 17:33:18', '2019-01-17 17:33:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (369, 'student_innovation/innovation', '大学生创业', 1, 'student_innovation', 1, 0, 'fa fa-mortar-board', '', 1, 'left', 0, 99, '2019-01-18 08:34:32', '2019-01-18 08:34:32', 1);
INSERT INTO `qnn_auth_rule` VALUES (370, 'student_innovation/innovation/index', '项目列表', 1, 'student_innovation', 1, 369, '', '', 1, 'left', 0, 99, '2019-01-18 08:34:32', '2019-01-18 08:34:32', 1);
INSERT INTO `qnn_auth_rule` VALUES (371, 'student_innovation/innovation/edit', '添加/编辑项目', 1, 'student_innovation', 1, 369, '', '', 0, 'left', 0, 99, '2019-01-18 08:34:32', '2019-01-18 08:34:32', 1);
INSERT INTO `qnn_auth_rule` VALUES (372, 'student_innovation/innovation/delete', '删除项目', 1, 'student_innovation', 1, 369, '', '', 0, 'left', 0, 99, '2019-01-18 08:34:32', '2019-01-18 08:34:32', 1);
INSERT INTO `qnn_auth_rule` VALUES (377, 'park/tech_project', '科技项目资金管理', 1, 'tech_project', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-18 10:54:02', '2019-01-18 10:54:02', 1);
INSERT INTO `qnn_auth_rule` VALUES (378, 'tech_project/Project/index', '科技项目资金列表', 1, 'tech_project', 1, 377, '', '', 1, 'left', 0, 99, '2019-01-18 10:54:02', '2019-01-18 10:54:02', 1);
INSERT INTO `qnn_auth_rule` VALUES (379, 'tech_project/Project/edit', '添加科技项目', 1, 'tech_project', 1, 377, '', '', 0, 'left', 0, 99, '2019-01-18 10:54:02', '2019-01-18 10:54:02', 1);
INSERT INTO `qnn_auth_rule` VALUES (380, 'tech_project/Project/delete', '删除科技项目', 1, 'tech_project', 1, 377, '', '', 0, 'left', 0, 99, '2019-01-18 10:54:02', '2019-01-18 10:54:02', 1);
INSERT INTO `qnn_auth_rule` VALUES (385, 'high_tech_project/Index', '高新技术成果管理', 1, 'high_tech_project', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-18 10:57:18', '2019-01-18 10:57:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (386, 'high_tech_project/Index/index', '成果列表', 1, 'high_tech_project', 1, 385, '', '', 1, 'left', 0, 99, '2019-01-18 10:57:18', '2019-01-18 10:57:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (387, 'high_tech_project/Index/edit', '添加成果', 1, 'high_tech_project', 1, 385, '', '', 0, 'left', 0, 99, '2019-01-18 10:57:18', '2019-01-18 10:57:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (388, 'high_tech_project/Index/delete', '删除成果', 1, 'high_tech_project', 1, 385, '', '', 0, 'left', 0, 99, '2019-01-18 10:57:18', '2019-01-18 10:57:18', 1);
INSERT INTO `qnn_auth_rule` VALUES (410, 'parking_space/Space', '停车位管理', 1, 'parking_space', 1, 0, 'fa fa-car', '', 1, 'left', 0, 99, '2019-01-18 14:29:51', '2019-01-18 14:29:51', 1);
INSERT INTO `qnn_auth_rule` VALUES (411, 'parking_space/Space/index', '车位列表', 1, 'parking_space', 1, 410, '', '', 1, 'left', 0, 99, '2019-01-18 14:29:51', '2019-01-18 14:29:51', 1);
INSERT INTO `qnn_auth_rule` VALUES (412, 'parking_space/Space/edit', '添加车位', 1, 'parking_space', 1, 410, '', '', 0, 'left', 0, 99, '2019-01-18 14:29:51', '2019-01-18 14:29:51', 1);
INSERT INTO `qnn_auth_rule` VALUES (413, 'parking_space/Space/delete', '删除车位', 1, 'parking_space', 1, 410, '', '', 0, 'left', 0, 99, '2019-01-18 14:29:51', '2019-01-18 14:29:51', 1);
INSERT INTO `qnn_auth_rule` VALUES (414, 'parking_space/Lease/index', '租赁管理', 1, 'parking_space', 1, 410, '', '', 1, 'left', 0, 99, '2019-01-18 14:29:51', '2019-01-18 14:29:51', 1);
INSERT INTO `qnn_auth_rule` VALUES (415, 'parking_space/Lease/edit', '添加租赁', 1, 'parking_space', 1, 410, '', '', 0, 'left', 0, 99, '2019-01-18 14:29:52', '2019-01-18 14:29:52', 1);
INSERT INTO `qnn_auth_rule` VALUES (416, 'parking_space/Lease/delete', '删除租赁', 1, 'parking_space', 1, 410, '', '', 0, 'left', 0, 99, '2019-01-18 14:29:52', '2019-01-18 14:29:52', 1);
INSERT INTO `qnn_auth_rule` VALUES (423, 'home/plugin/execute?_plugin=DataDictionary&_controller=Index&_action=index', '数据库字典', 2, 'DataDictionary', 1, 10, 'fa fa-database', '', 1, 'left', 0, 99, '2019-01-18 16:16:08', '2019-01-18 16:16:08', 1);
INSERT INTO `qnn_auth_rule` VALUES (459, 'cost_management/index', '费用账单管理', 1, 'cost_management', 1, 0, 'fa fa-money', '', 1, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (460, 'cost_management/Category/index', '收费项目', 1, 'cost_management', 1, 459, '', '', 1, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (461, 'cost_management/Category/edit', '添加项目', 1, 'cost_management', 1, 459, '', '', 0, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (462, 'cost_management/Category/delete', '删除项目', 1, 'cost_management', 1, 459, '', '', 0, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (463, 'cost_management/Bill/index', '账单列表', 1, 'cost_management', 1, 459, '', '', 1, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (464, 'cost_management/Bill/edit', '添加账单', 1, 'cost_management', 1, 459, '', '', 0, 'left', 0, 99, '2019-01-19 11:36:00', '2019-01-19 11:36:00', 1);
INSERT INTO `qnn_auth_rule` VALUES (465, 'cost_management/Bill/delete', '删除账单', 1, 'cost_management', 1, 459, '', '', 0, 'left', 0, 99, '2019-01-19 11:36:01', '2019-01-19 11:36:01', 1);
INSERT INTO `qnn_auth_rule` VALUES (474, 'service_repair/Index', '报修管理', 1, 'service_repair', 1, 0, 'fa fa-cog', '', 1, 'left', 0, 99, '2019-01-19 17:29:15', '2019-01-19 17:29:15', 1);
INSERT INTO `qnn_auth_rule` VALUES (475, 'service_repair/Index/index', '报修列表', 1, 'service_repair', 1, 474, '', '', 1, 'left', 0, 99, '2019-01-19 17:29:15', '2019-01-19 17:29:15', 1);
INSERT INTO `qnn_auth_rule` VALUES (476, 'service_repair/Index/edit', '处理报修', 1, 'service_repair', 1, 474, '', '', 0, 'left', 0, 99, '2019-01-19 17:29:15', '2019-01-19 17:29:15', 1);
INSERT INTO `qnn_auth_rule` VALUES (477, 'service_repair/Index/delete', '删除报修', 1, 'service_repair', 1, 474, '', '', 0, 'left', 0, 99, '2019-01-19 17:29:15', '2019-01-19 17:29:15', 1);
INSERT INTO `qnn_auth_rule` VALUES (485, 'service_meeting_room/Room', '会议室管理', 1, 'service_meeting_room', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (486, 'service_meeting_room/Room/index', '会议室列表', 1, 'service_meeting_room', 1, 485, '', '', 1, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (487, 'service_meeting_room/Room/edit', '添加会议室', 1, 'service_meeting_room', 1, 485, '', '', 0, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (488, 'service_meeting_room/Room/delete', '删除会议室', 1, 'service_meeting_room', 1, 485, '', '', 0, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (489, 'service_meeting_room/Booking/index', '预约管理', 1, 'service_meeting_room', 1, 485, '', '', 1, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (490, 'service_meeting_room/Booking/edit', '添加预约', 1, 'service_meeting_room', 1, 485, '', '', 0, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (491, 'service_meeting_room/Booking/delete', '删除预约', 1, 'service_meeting_room', 1, 485, '', '', 0, 'left', 0, 99, '2019-01-21 09:47:10', '2019-01-21 09:47:10', 1);
INSERT INTO `qnn_auth_rule` VALUES (492, 'service_laboratory/Room', '实验室管理', 1, 'service_laboratory', 1, 0, '', '', 1, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (493, 'service_laboratory/Room/index', '实验室列表', 1, 'service_laboratory', 1, 492, '', '', 1, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (494, 'service_laboratory/Room/edit', '添加实验室', 1, 'service_laboratory', 1, 492, '', '', 0, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (495, 'service_laboratory/Room/delete', '删除实验室', 1, 'service_laboratory', 1, 492, '', '', 0, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (496, 'service_laboratory/Booking/index', '预约管理', 1, 'service_laboratory', 1, 492, '', '', 1, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (497, 'service_laboratory/Booking/edit', '添加预约', 1, 'service_laboratory', 1, 492, '', '', 0, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);
INSERT INTO `qnn_auth_rule` VALUES (498, 'service_laboratory/Booking/delete', '删除预约', 1, 'service_laboratory', 1, 492, '', '', 0, 'left', 0, 99, '2019-01-21 14:20:57', '2019-01-21 14:20:57', 1);

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

-- ----------------------------
-- Table structure for qnn_config
-- ----------------------------
DROP TABLE IF EXISTS `qnn_config`;
CREATE TABLE `qnn_config`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置说明',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置值',
  `options` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置额外值',
  `group` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '配置分组',
  `sub_group` tinyint(3) NULL DEFAULT 0 COMMENT '子分组，子分组需要自己定义',
  `type` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置类型',
  `remark` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置说明',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_config
-- ----------------------------
INSERT INTO `qnn_config` VALUES (1, 'toggle_web_site', '站点开关', '1', '0:关闭\r\n1:开启', 1, 0, 'select', '站点关闭后将提示网站已关闭，不能正常访问', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1, 1);
INSERT INTO `qnn_config` VALUES (2, 'web_site_title', '网站标题', '同济科技园', '', 6, 0, 'text', '网站标题前台显示标题', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 2, 1);
INSERT INTO `qnn_config` VALUES (4, 'web_site_logo', '网站LOGO', '4', '', 6, 0, 'picture', '网站LOGO', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 4, 1);
INSERT INTO `qnn_config` VALUES (5, 'web_site_description', 'SEO描述', '开源框架 QnnPHP ThinkPHP', '', 6, 1, 'textarea', '网站搜索引擎描述', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 6, 1);
INSERT INTO `qnn_config` VALUES (6, 'web_site_keyword', 'SEO关键字', 'QnnPHP是基于ThinkPHP5开发的一套轻量级WEB产品开发框架，追求高效，简单，灵活。', '', 6, 1, 'textarea', '网站搜索引擎关键字', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 4, 1);
INSERT INTO `qnn_config` VALUES (7, 'web_site_copyright', '版权信息', 'Copyright © ******有限公司 All rights reserved.', '', 1, 0, 'text', '设置在网站底部显示的版权信息', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 7, 1);
INSERT INTO `qnn_config` VALUES (8, 'web_site_icp', '网站备案号', '豫ICP备14003306号', '', 6, 0, 'text', '设置在网站底部显示的备案号，如“苏ICP备1502009-2号\"', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 8, 1);
INSERT INTO `qnn_config` VALUES (9, 'web_site_statistics', '站点统计', '', '', 1, 0, 'textarea', '支持百度、Google、cnzz等所有Javascript的统计代码', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 9, 1);
INSERT INTO `qnn_config` VALUES (10, 'index_url', '首页地址', 'http://www.demo.gov', '', 2, 0, 'text', '可以通过配置此项自定义系统首页的地址，比如：http://www.xxx.com', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (13, 'admin_tags', '后台多标签', '0', '0:关闭\r\n1:开启', 2, 0, 'radio', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 3, 1);
INSERT INTO `qnn_config` VALUES (14, 'admin_page_size', '后台分页数量', '12', '', 2, 0, 'number', '后台列表分页时每页的记录数', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 4, 1);
INSERT INTO `qnn_config` VALUES (15, 'admin_theme', '后台主题', 'default', 'default:默认主题\r\nblue:蓝色理想\r\ngreen:绿色生活', 2, 0, 'select', '后台界面主题', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 5, 1);
INSERT INTO `qnn_config` VALUES (16, 'develop_mode', '开发模式', '1', '1:开启\r\n0:关闭', 3, 0, 'select', '开发模式下会显示菜单管理、配置管理、数据字典等开发者工具', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1, 1);
INSERT INTO `qnn_config` VALUES (17, 'app_trace', '是否显示页面Trace', '0', '1:开启\r\n0:关闭', 3, 0, 'select', '是否显示页面Trace信息', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 2, 1);
INSERT INTO `qnn_config` VALUES (18, 'auth_key', '系统加密KEY', 'vzxI=vf[=xV)?a^XihbLKx?pYPw$;Mi^R*<mV;yJh$wy(~~E?<.JA&ANdIZ#QhPq', '', 3, 0, 'textarea', '轻易不要修改此项，否则容易造成用户无法登录；如要修改，务必备份原key', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 3, 1);
INSERT INTO `qnn_config` VALUES (19, 'only_auth_rule', '权限仅验证规则表', '1', '1:开启\n0:关闭', 4, 0, 'radio', '开启此项，则后台验证授权只验证规则表存在的规则', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (20, 'static_domain', '静态文件独立域名', '', '', 3, 0, 'text', '静态文件独立域名一般用于在用户无感知的情况下平和的将网站图片自动存储到腾讯万象优图、又拍云等第三方服务。', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 3, 1);
INSERT INTO `qnn_config` VALUES (21, 'config_group_list', '配置分组', '1:基本\r\n2:系统\r\n3:开发\r\n4:安全\r\n5:数据库\r\n6:网站设置\r\n7:用户\r\n8:邮箱\r\n9:高级', '', 3, 0, 'array', '配置分组的键值对不要轻易改变', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 5, 1);
INSERT INTO `qnn_config` VALUES (25, 'form_item_type', '表单项目类型', 'hidden:隐藏\r\nreadonly:仅读文本\r\nnumber:数字\r\ntext:单行文本\r\ntextarea:多行文本\r\narray:数组\r\npassword:密码\r\nradio:单选框\r\ncheckbox:复选框\r\nselect:下拉框\r\nicon:字体图标\r\ndate:日期\r\ndatetime:时间\r\npicture:单张图片\r\npictures:多张图片\r\nfile:单个文件\r\nfiles:多个文件\r\nwangeditor:wangEditor编辑器\r\nueditor:百度富文本编辑器\r\neditormd:Markdown编辑器\r\ntags:标签\nselect2:高级下拉框\r\njson:JSON\r\nboard:拖', '', 3, 0, 'array', '专为配置管理设定\r\n', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (26, 'term_taxonomy', '分类法', 'post_category:分类目录\r\npost_tag:标签\r\nmedia_cat:多媒体分类', '', 3, 0, 'array', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (27, 'data_backup_path', '数据库备份根路径', '../data/backup', '', 5, 0, 'text', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (28, 'data_backup_part_size', '数据库备份卷大小', '20971520', '', 5, 0, 'number', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (29, 'data_backup_compress_level', '数据库备份文件压缩级别', '4', '1:普通\r\n4:一般\r\n9:最高', 5, 0, 'radio', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (30, 'data_backup_compress', '数据库备份文件压缩', '1', '0:不压缩\r\n1:启用压缩', 5, 0, 'radio', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (31, 'hooks_type', '钩子的类型', '1:视图\r\n2:控制器', '', 3, 0, 'array', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (33, 'action_type', '行为类型', '1:系统\r\n2:用户', '1:系统\r\n2:用户', 7, 0, 'array', '配置说明', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (34, 'website_group', '网站信息子分组', '0:基本信息\r\n1:SEO设置\r\n3:其它', '', 6, 0, 'array', '作为网站信息配置的子分组配置，每个大分组可设置子分组作为tab切换', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 20, 1);
INSERT INTO `qnn_config` VALUES (36, 'mail_reg_active_template', '注册激活邮件模板', '{\"active\":\"0\",\"subject\":\"\\u6ce8\\u518c\\u6fc0\\u6d3b\\u901a\\u77e5\"}', '', 8, 0, 'json', 'JSON格式保存除了模板内容的属性', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (37, 'mail_captcha_template', '验证码邮件模板', '{\"active\":\"0\",\"subject\":\"\\u90ae\\u7bb1\\u9a8c\\u8bc1\\u7801\\u901a\\u77e5\"}', '', 8, 0, 'json', 'JSON格式保存除了模板内容的属性', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (38, 'mail_reg_active_template_content', '注册激活邮件模板内容', '<p><span style=\"font-family: 微软雅黑; font-size: 14px;\"></span><span style=\"font-family: 微软雅黑; font-size: 14px;\">您在{$title}的激活链接为</span><a href=\"{$url}\" target=\"_blank\" style=\"font-family: 微软雅黑; font-size: 14px; white-space: normal;\">激活</a><span style=\"font-family: 微软雅黑; font-size: 14px;\">，或者请复制链接：{$url}到浏览器打开。</span></p>', '', 8, 0, 'textarea', '注册激活模板邮件内容部分，模板内容单独存放', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (39, 'mail_captcha_template_content', '验证码邮件模板内容', '<p><span style=\"font-family: 微软雅黑; font-size: 14px;\">您的验证码为{$verify}验证码，账号为{$account}。</span></p>', '', 8, 0, 'textarea', '验证码邮件模板内容部分', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (40, 'attachment_options', '附件配置选项', '{\"driver\":\"local\",\"file_max_size\":\"2097152\",\"file_exts\":\"doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z\",\"file_save_name\":\"uniqid\",\"image_max_size\":\"2097152\",\"image_exts\":\"gif,jpg,jpeg,bmp,png\",\"image_save_name\":\"uniqid\",\"page_number\":\"24\",\"widget_show_type\":\"0\",\"cut\":\"1\",\"small_size\":{\"width\":\"150\",\"height\":\"150\"},\"medium_size\":{\"width\":\"320\",\"height\":\"280\"},\"large_size\":{\"width\":\"560\",\"height\":\"430\"},\"watermark_scene\":\"2\",\"watermark_type\":\"1\",\"water_position\":\"9\",\"water_img\":\"\\/logo.png\",\"water_opacity\":\"80\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (42, 'user_deny_username', '保留用户名和昵称', '管理员,测试,admin,垃圾', '', 7, 0, 'textarea', '禁止注册用户名和昵称，包含这些即无法注册,用&quot; , &quot;号隔开，用户只能是英文，下划线_，数字等', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (43, 'captcha_open', '验证码配置', 'reg,login,reset', 'reg:注册显示\r\nlogin:登陆显示\r\nreset:密码重置', 4, 0, 'checkbox', '验证码开启配置', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (44, 'captcha_type', '验证码类型', '4', '1:中文\r\n2:英文\r\n3:数字\r\n4:英文+数字', 4, 0, 'select', '验证码类型', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (45, 'web_site_subtitle', '网站副标题', '基于ThinkPHP5的开发框架', '', 6, 0, 'textarea', '用简洁的文字描述本站点（网站口号、宣传标语、一句话介绍）', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 2, 1);
INSERT INTO `qnn_config` VALUES (46, 'cache', '缓存配置', '{\"type\":\"File\",\"path\":\"\\/Library\\/WebServer\\/Documents\\/EacooPHP\\/runtime\\/cache\\/\",\"prefix\":\"\",\"expire\":\"0\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (47, 'session', 'Session配置', '{\"type\":\"\",\"prefix\":\"eacoophp_\",\"auto_start\":\"1\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (48, 'cookie', 'Cookie配置', '{\"path\":\"\\/\",\"prefix\":\"eacoophp_\",\"expire\":\"0\",\"domain\":\"\",\"secure\":\"0\",\"httponly\":\"\",\"setcookie\":\"1\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (49, 'reg_default_roleid', '注册默认角色', '4', '', 7, 0, 'select', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (50, 'open_register', '开放注册', '0', '1:是\r\n0:否', 7, 0, 'radio', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (56, 'meanwhile_user_online', '允许同时登录', '1', '1:是\r\n0:否', 7, 0, 'radio', '是否允许同一帐号在不同地方同时登录', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 0, 1);
INSERT INTO `qnn_config` VALUES (57, 'admin_collect_menus', '后台收藏菜单', '', '', 2, 0, 'json', '在后台顶部菜单栏展示，可以方便快速菜单入口', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (58, 'minify_status', '开启minify', '1', '1:开启\r\n0:关闭', 2, 0, 'radio', '开启minify会压缩合并js、css文件，可以减少资源请求次数，如果不支持minify，可关闭', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (59, 'admin_allow_login_many', '同账号多人登录后台', '0', '0:不允许\r\n1:允许', 4, 0, 'radio', '允许多个人使用同一个账号登录后台。默认：不允许', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (60, 'admin_allow_ip', '仅限登录后台IP', '', '', 4, 0, 'textarea', '填写IP地址，多个IP用英文逗号隔开。默认为空，允许所有IP', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (61, 'redis', 'Redis配置', '{\"host\":\"127.0.0.1\",\"port\":\"6979\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_config` VALUES (62, 'memcache', 'Memcache配置', '{\"host\":\"127.0.0.1\",\"port\":\"11211\"}', '', 9, 0, 'json', '以JSON格式保存', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);

-- ----------------------------
-- Table structure for qnn_cost_bill_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_cost_bill_list`;
CREATE TABLE `qnn_cost_bill_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bill_type` tinyint(1) NULL DEFAULT NULL COMMENT '费用类型',
  `enterprise_id` int(11) NULL DEFAULT 0 COMMENT '企业iD',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '其他' COMMENT '企业名称',
  `bill_time` datetime(0) NULL DEFAULT NULL COMMENT '账单日期',
  `bill_status` tinyint(1) NULL DEFAULT NULL COMMENT '账单状态1=已缴费,2=未交费',
  `amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `real_amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际支付',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '水电等费用的账单列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_cost_bill_list
-- ----------------------------
INSERT INTO `qnn_cost_bill_list` VALUES (1, 1, 1, '上海小炬华科技', '2019-01-19 00:00:00', 2, 2000.00, 1890.00, '啦啦啦', '2019-01-19 11:38:12', '2019-01-19 11:38:12');
INSERT INTO `qnn_cost_bill_list` VALUES (2, 2, 0, '其他企业', '2019-01-18 00:00:00', 1, 1000.00, 1000.00, '会议室租借', '2019-01-19 11:41:15', '2019-01-19 11:41:48');

-- ----------------------------
-- Table structure for qnn_cost_category_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_cost_category_list`;
CREATE TABLE `qnn_cost_category_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `creator_id` int(5) NULL DEFAULT NULL COMMENT '创建人ID',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1=启用,2=禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '费用项目列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_cost_category_list
-- ----------------------------
INSERT INTO `qnn_cost_category_list` VALUES (1, '水费', 1, 1, '2019-01-19 10:48:41', '2019-01-19 10:48:41');
INSERT INTO `qnn_cost_category_list` VALUES (2, '电费', 1, 1, '2019-01-19 10:49:58', '2019-01-19 10:49:58');

-- ----------------------------
-- Table structure for qnn_high_tech_enterprise_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_high_tech_enterprise_list`;
CREATE TABLE `qnn_high_tech_enterprise_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `get_time` datetime(0) NULL DEFAULT NULL COMMENT '获得时间',
  `expire_time` datetime(0) NULL DEFAULT NULL COMMENT '到期时间',
  `is_expire` tinyint(1) NULL DEFAULT 2 COMMENT '是否到期:1=是,2=否',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_high_tech_enterprise_list
-- ----------------------------
INSERT INTO `qnn_high_tech_enterprise_list` VALUES (1, 5, '上海小菊花', '2019-01-14 11:05:30', '2019-02-03 11:05:32', 1, '啊啊啊啊呀', '2019-01-14 11:05:44', '2019-01-14 11:17:28');

-- ----------------------------
-- Table structure for qnn_high_tech_project_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_high_tech_project_list`;
CREATE TABLE `qnn_high_tech_project_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `project_time` datetime(0) NULL DEFAULT NULL COMMENT '立项时间',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '高新技术成果转化列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_hooks
-- ----------------------------
DROP TABLE IF EXISTS `qnn_hooks`;
CREATE TABLE `qnn_hooks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '钩子ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `type` tinyint(4) UNSIGNED NOT NULL DEFAULT 1 COMMENT '类型。1视图，2控制器',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态。1启用，0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '钩子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_hooks
-- ----------------------------
INSERT INTO `qnn_hooks` VALUES (1, 'AdminIndex', '后台首页小工具', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (2, 'FormBuilderExtend', 'FormBuilder类型扩展Builder', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (3, 'UploadFile', '上传文件钩子', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (4, 'PageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (5, 'PageFooter', '页面footer钩子，一般用于加载插件CSS文件和代码', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (6, 'ThirdLogin', '第三方账号登陆', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (7, 'SendMessage', '发送消息钩子，用于消息发送途径的扩展', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (8, 'sms', '短信插件钩子', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (9, 'RegisterUser', '用户注册钩子', 2, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (10, 'ImageGallery', '图片轮播钩子', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (11, 'JChinaCity', '每个系统都需要的一个中国省市区三级联动插件。', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (13, 'editor', '内容编辑器钩子', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (14, 'adminEditor', '后台内容编辑页编辑器', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (15, 'ThirdLogin', '集成第三方授权登录，包括微博、QQ、微信、码云', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (16, 'comment', '实现本地评论功能，支持评论点赞', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (17, 'uploadPicture', '实现阿里云OSS对象存储，管理附件', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (18, 'participle', '关键字提取，百度自然语言', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (19, 'MicroTopicsUserPost', '微话题，专注实时热点、个人兴趣、网友讨论等。', 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_hooks` VALUES (20, 'qichacha', '通过企查查接口获取企业Master信息,官网http://www.yjapi.cn', 1, '2018-12-25 10:41:29', '2018-12-25 10:41:29', 1);
INSERT INTO `qnn_hooks` VALUES (22, 'qichachaTm', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:51', '2019-01-16 17:16:51', 1);
INSERT INTO `qnn_hooks` VALUES (23, 'qichachaPatent', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:51', '2019-01-16 17:16:51', 1);
INSERT INTO `qnn_hooks` VALUES (24, 'qichachaCertificate', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:51', '2019-01-16 17:16:51', 1);
INSERT INTO `qnn_hooks` VALUES (25, 'qichachaWcopyright', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks` VALUES (26, 'qichachaScopyright', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks` VALUES (27, 'qichachaWebsite', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', 1, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);

-- ----------------------------
-- Table structure for qnn_hooks_extra
-- ----------------------------
DROP TABLE IF EXISTS `qnn_hooks_extra`;
CREATE TABLE `qnn_hooks_extra`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '钩子ID',
  `depend_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '应用类型。1module，2plugin，3theme',
  `depend_flag` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '应用标记。如：模块或插件标识',
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态。0禁用，1正常',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_hookid_depend`(`hook_id`, `depend_flag`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '钩子应用依赖表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_hooks_extra
-- ----------------------------
INSERT INTO `qnn_hooks_extra` VALUES (3, 1, 1, 'cms', 99, '2018-11-28 10:00:56', '2018-11-28 10:00:56', 1);
INSERT INTO `qnn_hooks_extra` VALUES (4, 10, 2, 'ImageGallery', 99, '2018-11-28 17:41:10', '2018-11-28 17:41:10', 1);
INSERT INTO `qnn_hooks_extra` VALUES (6, 8, 2, 'Alisms', 99, '2018-11-28 17:55:55', '2018-11-28 17:55:55', 1);
INSERT INTO `qnn_hooks_extra` VALUES (7, 3, 2, 'qiniuoss', 99, '2018-11-29 15:05:31', '2018-11-29 15:05:31', 1);
INSERT INTO `qnn_hooks_extra` VALUES (13, 20, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (14, 22, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (15, 23, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (16, 24, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (17, 25, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (18, 26, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);
INSERT INTO `qnn_hooks_extra` VALUES (19, 27, 2, 'Qichacha', 99, '2019-01-16 17:16:52', '2019-01-16 17:16:52', 1);

-- ----------------------------
-- Table structure for qnn_links
-- ----------------------------
DROP TABLE IF EXISTS `qnn_links`;
CREATE TABLE `qnn_links`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `image` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图标',
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '链接',
  `target` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '_blank' COMMENT '打开方式',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '类型',
  `rating` int(11) UNSIGNED NOT NULL COMMENT '评级',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '修改时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态，1启用，0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '友情链接表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_links
-- ----------------------------
INSERT INTO `qnn_links` VALUES (1, 'EacooPHP官网', 14, 'https://www.eacoophp.com', '_blank', 2, 8, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 2, 1);

-- ----------------------------
-- Table structure for qnn_modules
-- ----------------------------
DROP TABLE IF EXISTS `qnn_modules`;
CREATE TABLE `qnn_modules`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(31) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(63) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `description` varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `author` varchar(31) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '开发者',
  `version` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '版本',
  `config` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置',
  `is_system` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否允许卸载',
  `url` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '站点',
  `admin_manage_into` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '后台管理入口',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态。0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '模块功能表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_modules
-- ----------------------------
INSERT INTO `qnn_modules` VALUES (1, 'user', '用户中心', '用户模块，系统核心模块，不可卸载', '心云间、凝听', '1.0.2', '', 1, 'https://www.eacoophp.com', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_modules` VALUES (2, 'home', '前台Home', '一款基础前台Home模块', '心云间、凝听', '1.0.0', '', 1, '', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_modules` VALUES (8, 'wechat', '微信管理系统', '微信公众号平台官方模块', '心云间、凝听', '1.0.6', '', 0, '', '', '2018-11-27 13:36:45', '2018-11-27 13:36:45', 99, 1);
INSERT INTO `qnn_modules` VALUES (14, 'cms', '内容管理系统CMS', '内容管理、CMS、文章管理、页面管理', '心云间、凝听', '1.2.3', '{\"need_check\":\"0\",\"toggle_comment\":\"1\",\"taglib\":[\"cms\"],\"post_type\":[{\"name\":\"post\",\"title\":\"\\u6587\\u7ae0\"},{\"name\":\"page\",\"title\":\"\\u9875\\u9762\"},{\"name\":\"product\",\"title\":\"\\u4ea7\\u54c1\"}]}', 0, '', '', '2018-11-28 10:00:56', '2018-11-28 10:00:56', 99, 1);
INSERT INTO `qnn_modules` VALUES (29, 'park_building', '智慧园区--房源模块', '智慧园区的房源管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2018-12-17 09:43:31', '2018-12-17 09:43:31', 99, 1);
INSERT INTO `qnn_modules` VALUES (37, 'park_activity', '智慧园区--活动模块', '智慧园区的活动管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2018-12-22 14:36:29', '2018-12-22 14:36:29', 99, 1);
INSERT INTO `qnn_modules` VALUES (45, 'park_enterprise', '智慧园区--企业模块', '智慧园区的企业管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-08 14:54:34', '2019-01-08 14:54:34', 99, 1);
INSERT INTO `qnn_modules` VALUES (46, 'park_incubation', '智慧园区--孵化企业模块', '智慧园区的孵化企业管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-09 15:32:12', '2019-01-09 15:32:12', 99, 1);
INSERT INTO `qnn_modules` VALUES (47, 'carousel', '多位置轮播图', '支持多位置,多模块轮播图设置', 'xpwsgg', '1.0.1', '{\"\\u914d\\u7f6e\\u9879\\u540d\":\"1\"}', 0, '', '', '2019-01-11 13:32:07', '2019-01-11 13:32:07', 99, 1);
INSERT INTO `qnn_modules` VALUES (50, 'software_enterprise', '智慧园区--软件企业管理模块', '智慧园区的软件企业管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-11 14:31:15', '2019-01-11 14:31:15', 99, 1);
INSERT INTO `qnn_modules` VALUES (52, 'high_tech_enterprise', '智慧园区--高新企业模块', '智慧园区的高新企业管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-14 10:14:34', '2019-01-14 10:14:34', 99, 1);
INSERT INTO `qnn_modules` VALUES (53, 'park_nursery', '智慧园区--苗圃模块', '智慧园区的苗圃管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-14 16:11:39', '2019-01-14 16:11:39', 99, 1);
INSERT INTO `qnn_modules` VALUES (54, 'park_investment', '智慧园区--投资管理', '智慧园区的投资管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-15 11:53:05', '2019-01-15 11:53:05', 99, 1);
INSERT INTO `qnn_modules` VALUES (57, 'park_project_budget', '智慧园区--项目预算管理', '智慧园区的项目预算管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-16 09:46:34', '2019-01-16 09:46:34', 99, 1);
INSERT INTO `qnn_modules` VALUES (58, 'park_enterprise_finance_info', '智慧园区--公司财务信息', '智慧园区的公司财务信息管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-16 11:11:49', '2019-01-16 11:11:49', 99, 1);
INSERT INTO `qnn_modules` VALUES (60, 'park_financial_support', '智慧园区--财政扶持', '智慧园区的财政扶持管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-17 17:14:50', '2019-01-17 17:14:50', 99, 1);
INSERT INTO `qnn_modules` VALUES (66, 'park_enterprise_intellectual', '智慧园区--企业知识产品', '智慧园区的企业知识产品管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-17 17:33:17', '2019-01-17 17:33:17', 99, 1);
INSERT INTO `qnn_modules` VALUES (67, 'student_innovation', '智慧园区--大学生创业', '智慧园区大学生创业模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-18 08:34:32', '2019-01-18 08:34:32', 99, 1);
INSERT INTO `qnn_modules` VALUES (69, 'tech_project', '智慧园区--科技项目投资模块', '智慧园区的科技项目投资管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-18 10:54:02', '2019-01-18 10:54:02', 99, 1);
INSERT INTO `qnn_modules` VALUES (71, 'high_tech_project', '智慧园区--高新技术成果', '智慧园区的高新技术成果转化管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-18 10:57:18', '2019-01-18 10:57:18', 99, 1);
INSERT INTO `qnn_modules` VALUES (75, 'parking_space', '智慧园区--停车位模块', '智慧园区的停车位管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-18 14:29:51', '2019-01-18 14:29:51', 99, 1);
INSERT INTO `qnn_modules` VALUES (81, 'cost_management', '智慧园区--费用账单管理', '智慧园区的费用账单管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-19 11:36:00', '2019-01-19 11:36:00', 99, 1);
INSERT INTO `qnn_modules` VALUES (84, 'service_repair', '智慧园区--报修管理', '智慧园区的报修管理模块', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-19 17:29:15', '2019-01-19 17:29:15', 99, 1);
INSERT INTO `qnn_modules` VALUES (86, 'service_meeting_room', '智慧园区--会议室管理', '智慧园区的会议室管理,添加会议室,会议预约管理', 'xpwsgg', '1.0.0', '', 0, '', '', '2019-01-21 09:47:10', '2019-01-21 09:47:10', 99, 1);
INSERT INTO `qnn_modules` VALUES (87, 'service_laboratory', '智慧园区--实验室管理', '智慧园区的实验室添加,租赁管理模块', 'xpwsg', '1.0.0', '', 0, '', '', '2019-01-21 14:20:57', '2019-01-21 14:20:57', 99, 1);

-- ----------------------------
-- Table structure for qnn_nav
-- ----------------------------
DROP TABLE IF EXISTS `qnn_nav`;
CREATE TABLE `qnn_nav`  (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `value` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'url地址',
  `pid` smallint(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级',
  `position` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '位置。头部：header，我的：my',
  `target` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '_self' COMMENT '打开方式。',
  `depend_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '来源类型。0普通外链http，1模块扩展，2插件扩展，3主题扩展',
  `depend_flag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '来源标记。如：模块或插件标识',
  `icon` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态。0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '前台导航' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_nav
-- ----------------------------
INSERT INTO `qnn_nav` VALUES (1, '主页', '/', 0, 'header', '_self', 1, 'home', 'fa fa-home', 10, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_nav` VALUES (2, '会员', 'user/index/index', 0, 'header', '_self', 1, 'user', '', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_nav` VALUES (3, '下载', 'https://gitee.com/ZhaoJunfeng/EacooPHP/attach_files', 0, 'header', '_blank', 0, '', '', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_nav` VALUES (4, '社区', 'https://forum.eacoophp.com', 0, 'header', '_blank', 0, '', '', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_nav` VALUES (5, '文档', 'https://www.kancloud.cn/youpzt/eacoo', 0, 'header', '_blank', 0, '', '', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_nav` VALUES (10, '内容管理CMS', '', 0, 'header', '_self', 1, 'cms', '', 99, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);
INSERT INTO `qnn_nav` VALUES (11, '文章列表', 'cms/Index/index', 10, 'header', '_self', 1, 'cms', 'fa fa-list', 99, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);
INSERT INTO `qnn_nav` VALUES (12, '页面列表', 'cms/page/index', 10, 'header', '_self', 1, 'cms', 'fa fa-list', 99, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);
INSERT INTO `qnn_nav` VALUES (13, '我的文章', 'cms/My/posts', 0, 'my', '_self', 1, 'cms', 'fa fa-list', 99, '2018-11-28 10:00:57', '2018-11-28 10:00:57', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_building
-- ----------------------------
INSERT INTO `qnn_park_building` VALUES (3, '一号楼', 14, '2018-12-17 11:51:09', '2019-01-04 15:27:01', 50, 1);

-- ----------------------------
-- Table structure for qnn_park_enterprise_bank_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_bank_info`;
CREATE TABLE `qnn_park_enterprise_bank_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '银行名称',
  `bank_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '开户行',
  `bank_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '账户',
  `caiwufzr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '财务负责人',
  `caiwufzr_tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '财务负责人电话',
  `caiwufzr_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '财务负责人邮箱',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_bank_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_bank_info` VALUES (1, 1, '中国银行', '中国银行北京分行', '56799797866', 'chegnwe', '568969868', '1@1.com', '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_contact_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_contact_info`;
CREATE TABLE `qnn_park_enterprise_contact_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系人',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系电话',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `qq` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'QQ',
  `wechat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '微信',
  `contact_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系地址',
  `fzrsfz` int(10) NOT NULL COMMENT '负责人身份证',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业联系信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_contact_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_contact_info` VALUES (1, 1, '程伟', '18977777777', '123@134.com', '6789789676', '586778686787', '北京市海淀区东北旺西路8号院35号楼5层501室', 14, '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_contract
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_contract`;
CREATE TABLE `qnn_park_enterprise_contract`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `numbering` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同编号',
  `build_id` int(11) NULL DEFAULT NULL COMMENT '楼宇ID',
  `room_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '门牌号',
  `miaopu_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '苗圃工位号',
  `contract_type` tinyint(1) NULL DEFAULT 1 COMMENT '合同项目:1=办公室合同',
  `margin` decimal(10, 2) NULL DEFAULT NULL COMMENT '保证金',
  `start_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开始日期',
  `end_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '结束日期',
  `paid_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '支付时间',
  `contract_period` tinyint(1) NULL DEFAULT NULL COMMENT '合同期限',
  `expiration` tinyint(1) NULL DEFAULT 0 COMMENT '合同是否到期:0=未到期,1=已到期',
  `jiaofei_period` tinyint(1) NULL DEFAULT NULL COMMENT '交费周期:1=季度缴,2=半年缴,3=一年缴,4=二年缴,5=三年,6=五年',
  `continuous` tinyint(1) NULL DEFAULT 0 COMMENT '是否续签合同:0=否;1=是',
  `withdraw` tinyint(1) NULL DEFAULT 0 COMMENT '是否退租:0=否;1=是',
  `withdraw_money` decimal(10, 2) NULL DEFAULT 0.00 COMMENT '退租金额',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '合同状态',
  `total_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `real_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际费用',
  `fangzu_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '房租合同',
  `caiwudaili_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '财务代理合同,不应该出现在这里',
  `contractor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同签订人',
  `contractor_tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同签订人电话',
  `handler` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人',
  `issuer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开票人',
  `confirmor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '确认人',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '租房合同' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_contract
-- ----------------------------
INSERT INTO `qnn_park_enterprise_contract` VALUES (1, 1, '上海小炬华科技', '03HT2019001', 3, '101|102', NULL, 1, 5999.00, '2019-01-27', '2019-02-03', NULL, 1, 0, 3, 0, 0, 0.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-09 16:46:31', '2019-01-09 16:46:31');
INSERT INTO `qnn_park_enterprise_contract` VALUES (2, 1, '上海小炬华科技', '03HT2019002', 3, '101|102', NULL, 1, NULL, '2019-12-18 16:57:25', '2019-12-18 16:57:25', '2019/1/10', 1, 0, 1, 0, 0, 0.00, 1, 20000.00, 18000.00, '14,', NULL, '香飘飘', '17888888888', '香飘飘', '香飘飘', '香飘飘', '续租合同', '2019-01-10 13:56:01', '2019-01-10 13:56:01');

-- ----------------------------
-- Table structure for qnn_park_enterprise_ecicertification_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_ecicertification_list`;
CREATE TABLE `qnn_park_enterprise_ecicertification_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '证书类型',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '证书名称',
  `numbering` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '证书编号',
  `start_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发证日期',
  `end_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '截止日期',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业证书列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_entry_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_entry_info`;
CREATE TABLE `qnn_park_enterprise_entry_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `build_id` int(11) NOT NULL COMMENT '楼宇ID',
  `room_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间号',
  `margin` decimal(10, 2) NOT NULL COMMENT '保证金',
  `rent_period` tinyint(1) NOT NULL COMMENT '房租交费周期:',
  `rent` decimal(10, 2) NOT NULL COMMENT '房租单价',
  `paid_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付时间',
  `contract_period` tinyint(1) NOT NULL COMMENT '合同期限',
  `zuilin_period` tinyint(1) NOT NULL COMMENT '租赁期限',
  `start_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同生效日期',
  `end_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '合同结束日期',
  `fuwufei_period` int(6) NOT NULL COMMENT '服务费支付周期',
  `aircon_period` int(6) NOT NULL COMMENT '空调费支付周期',
  `key_deposit` decimal(10, 2) NOT NULL COMMENT '钥匙押金',
  `mailbox_deposit` decimal(10, 2) NOT NULL COMMENT '信箱押金',
  `owner_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方公司名称',
  `owner_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方联系地址',
  `owner_tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出租方联系电话',
  `kuaiji_daili` tinyint(1) NOT NULL COMMENT '会计代理:1=是;0=否',
  `kjdlfy` decimal(10, 2) NULL DEFAULT NULL COMMENT '会计代理费用',
  `kjdl_s_day` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '会计代理开始日期',
  `kjdl_e_day` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '会计代理结束时间',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_entry_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_entry_info` VALUES (1, 1, 3, '101|102', 5999.00, 3, 2000.00, '2019-01-09', 1, 3, '2019-01-27', '2019-02-03', 1, 1, 100.00, 100.00, '同济科技园', '上海市普陀区同济科技园办公室', '', 1, 2000.00, '2019-01-09', '2019-01-27', '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_finance_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_finance_info`;
CREATE TABLE `qnn_park_enterprise_finance_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `year` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '年度',
  `income` decimal(10, 2) NULL DEFAULT 0.00 COMMENT '收入',
  `profit` decimal(10, 2) NULL DEFAULT NULL COMMENT '利润',
  `tax` decimal(10, 2) NULL DEFAULT NULL COMMENT '税收',
  `liabilities` decimal(10, 2) NULL DEFAULT NULL COMMENT '负债',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_finance_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_finance_info` VALUES (1, 1, '上海小炬华科技', '2019', 100.00, 80.00, 15.00, 0.00, '啊啊', '2019-01-16 13:38:47', '2019-01-16 13:38:47');

-- ----------------------------
-- Table structure for qnn_park_enterprise_finance_support
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_finance_support`;
CREATE TABLE `qnn_park_enterprise_finance_support`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `vat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '增值税',
  `income_tax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '所得税',
  `support` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '计算公式:(增值税*0.325+所得税*0.2)*0.7*0.7*0.5',
  `is_support` tinyint(1) NULL DEFAULT NULL COMMENT '是否扶持:1=是,2=否',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '财政扶持列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_finance_support
-- ----------------------------
INSERT INTO `qnn_park_enterprise_finance_support` VALUES (1, 1, '上海小炬华科技', '1000', '2000', '177.625', 1, '一个扶持', '2019-01-18 09:32:48', '2019-01-18 09:32:48');

-- ----------------------------
-- Table structure for qnn_park_enterprise_kuaiji_contract
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_kuaiji_contract`;
CREATE TABLE `qnn_park_enterprise_kuaiji_contract`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `kjdlfy` decimal(10, 2) NULL DEFAULT NULL COMMENT '会计代理费用',
  `numbering` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同编号',
  `kjdl_s_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '代理开始日期',
  `kjdl_e_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '代理结束日期',
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '合同照片',
  `marks` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_kuaiji_contract
-- ----------------------------
INSERT INTO `qnn_park_enterprise_kuaiji_contract` VALUES (1, 1, 2000.00, 'CWDL2019001', '2019-01-09', '2019-01-27', NULL, NULL, '2019-01-09 16:46:31', '2019-01-09 16:46:31');
INSERT INTO `qnn_park_enterprise_kuaiji_contract` VALUES (2, 1, 2000.00, 'CWDL2019002', '2019-1-10', '2020-1-10', '14,', '财务代理', '2019-01-10 14:16:20', '2019-01-10 14:16:20');

-- ----------------------------
-- Table structure for qnn_park_enterprise_other_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_other_info`;
CREATE TABLE `qnn_park_enterprise_other_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_type` tinyint(1) NOT NULL COMMENT '企业类别',
  `enterprise_category` tinyint(1) NOT NULL COMMENT '行业分类',
  `enterprise_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '经营状态:1=经营;2=歇业;3=注销;4=吊销;5=迁出',
  `enterprise_rate` tinyint(1) NOT NULL DEFAULT 0 COMMENT '企业评级:1=A级;2=B级;3=C级;4=D级;5=E级;',
  `student_innovation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '大学生创业:1=是;0=否',
  `schoolmate_innovation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '校友创业:1=是;0=否',
  `high_tech` tinyint(1) NOT NULL DEFAULT 0 COMMENT '高新技术企业:1=是;0=否',
  `soft_tech` tinyint(1) NOT NULL DEFAULT 0 COMMENT '软件企业:1=是;0=否',
  `new_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT '上海市专精特新企业:1=是;0=否',
  `putuo_juren` tinyint(1) NOT NULL DEFAULT 0 COMMENT '普陀小巨人:1=是;0=否',
  `shanghai_juren` tinyint(1) NOT NULL DEFAULT 0 COMMENT '上海小巨人:1=是;0=否',
  `fuhua` tinyint(1) NOT NULL DEFAULT 0 COMMENT '孵化企业:1=是;0=否',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_other_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_other_info` VALUES (1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_out_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_out_list`;
CREATE TABLE `qnn_park_enterprise_out_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `build_id` int(5) NULL DEFAULT NULL COMMENT '楼宇ID',
  `room_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '房间号',
  `start_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最新合同的生效日期',
  `end_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最新合同的结束日期',
  `out_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '退租日期',
  `out_money` decimal(10, 2) NULL DEFAULT NULL COMMENT '退租金额',
  `margin` decimal(10, 2) NULL DEFAULT NULL COMMENT '保证金',
  `key_deposit` decimal(10, 2) NULL DEFAULT NULL COMMENT '钥匙押金',
  `mailbox_deposit` decimal(10, 2) NULL DEFAULT NULL COMMENT '信箱押金',
  `return_contract` tinyint(1) NULL DEFAULT NULL COMMENT '是否返还合同;1=是,2=否',
  `out_hander` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人',
  `out_confirmor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '确认人',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业退租记录列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_out_list
-- ----------------------------
INSERT INTO `qnn_park_enterprise_out_list` VALUES (1, 1, '上海小炬华科技', 3, '101|102', '2019-12-18 16:57:25', '2019-12-18 16:57:25', '2019-1-10', 789.00, NULL, 100.00, 100.00, 1, '香飘飘', '香飘飘', '香飘飘啊', '2019-01-10 15:56:43', '2019-01-10 15:56:43');

-- ----------------------------
-- Table structure for qnn_park_enterprise_patent_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_patent_list`;
CREATE TABLE `qnn_park_enterprise_patent_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '专利类型',
  `publication_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公开号',
  `publication_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公开日期',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业专利列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_basic_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_basic_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_basic_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '企业名称',
  `credit_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '社会统一信用代码',
  `regist_capi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '注册资本',
  `term_start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '营业开始日期',
  `team_end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '营业结束日期',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '注册地址',
  `oper_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '法人名',
  `scope` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '经营范围',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '业务介绍',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'logo图片',
  `yyzz` int(10) NULL DEFAULT NULL COMMENT '营业执照图片',
  `frsfzzp` int(10) NULL DEFAULT NULL COMMENT '法人身份证照片',
  `qtzs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他证书图片',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `build_id` int(11) NULL DEFAULT NULL COMMENT '因为某些原因,这里也记录一下',
  `room_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '同上',
  `enterprise_status` tinyint(1) NULL DEFAULT 1 COMMENT '企业状态1=正常,2=退租',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业企查查基本信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_qichacha_basic_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_qichacha_basic_info` VALUES (1, '上海小炬华科技', '500902300083458', '103.68万元', '2012-07-10T00:00:00', 'null ', '北京市海淀区东北旺西路8号院35号楼5层501室', '程维', '帮助\r\n内容详细\r\n\r\n接口测试：API测试工具\r\n\r\n技术支持：service@yjapi.com\r\n\r\n在线客服：客服咨询\r\n\r\n接口列表\r\n企业关键字模糊查询企业关键字多维度查询企业关键字精确获取详细信息(Master)获取新增的公司信息企业关键字精确获取详细信息(Basic)企业关键字精确获取详细信息(Full)\r\n接口信息资费说明SDK与文档错误代码更新记录\r\n接口地址：http://api.qichacha.com/ECIV4/GetDetailsByName\r\n\r\n支持格式：JSON/XML\r\n\r\n请求方式：GET\r\n\r\n请求示例：http://api.qichacha.com/ECIV4/GetDetailsByName?key=AppKey&keyword=北京小桔科技有限公司\r\n\r\n权限验证：\r\n参数名	类型	传递方式	说明\r\nToken	String	http header 头	验证加密值（key+Timespan+SecretKey组成的32位md5加密的大写字符串）\r\nTimespan	String	http header 头	精确到秒的Unix时间戳\r\nSecretKey	String	不传递	密钥，请妥善保管好\r\n\r\n请求参数：\r\n名称\r\n类型\r\n是否必填\r\n描述\r\nkey	String	是	应用APPKEY(应用详细页查询)\r\nkeyword	String	是	搜索关键字（公司名、注册号、社会统一信用代码或KeyNo）\r\ndtype	String	否	返回数据格式：仅支持json\r\n\r\n返回字段：\r\n名称	类型	说明\r\nKeyNo	String	内部KeyNo\r\nName	String	公司名称\r\nNo	String	注册号\r\nBelongOrg	String	登记机关\r\nOperName	String	法人名\r\nStartDate	String	成立日期\r\nEndDate	String	吊销日期\r\nStatus	String	企业状态\r\nProvince	String	省份\r\nUpdatedDate	String	更新日期\r\nCreditCode	String	社会统一信用代码\r\nRegistCapi	String	注册资本\r\nEconKind	String	企业类型\r\nAddress	String	地址\r\nScope	String	经营范围\r\nTermStart	String	营业开始日期\r\nTeamEnd	String	营业结束日期\r\nCheckDate	String	发照日期\r\nOrgNo	String	组织机构代码\r\nIsOnStock	String	是否上市(0为未上市，1为上市)\r\nStockNumber	String	上市公司代码\r\nStockType	String	上市类型\r\nImageUrl	String	企业Logo\r\nOriginalName\r\n曾用名	Name	String	曾用名\r\nChangeDate	String	变更日期\r\nPartners\r\n股东信息	StockName	String	股东\r\nStockType	String	股东类型\r\nStockPercent	String	出资比例\r\nShouldCapi	String	认缴出资额\r\nShoudDate	String	认缴出资时间\r\nInvestType	String	认缴出资方式\r\nInvestName	String	实际出资方式\r\nRealCapi	String	实缴出资额\r\nCapiDate	String	实缴时间\r\nEmployees\r\n主要人员	Name	String	姓名\r\nJob	String	职位\r\nBranches\r\n分支机构	CompanyId	String	CompanyId\r\nRegNo	String	注册号或社会统一信用代码（存在社会统一信用代码显示社会统一信用代码，否则显示注册号）\r\nName	String	名称\r\nBelongOrg	String	登记机关\r\nCreditCode	String	社会统一信用代码（保留字段，目前为空）\r\nOperName	String	法人姓名或负责人姓名（保留字段，目前为空）\r\nChangeRecords\r\n变更信息	ProjectName	String	变更事项\r\nBeforeContent	String	变更前内容\r\nAfterContent	String	变更后内容\r\nChangeDate	String	变更日期\r\nContactInfo\r\n联系信息	WebSite.Name	String	网站名称\r\nWebSite.Url	String	网站地址\r\nPhoneNumber	String	联系电话\r\nEmail	String	联系邮箱\r\nIndustry\r\n行业信息	IndustryCode	String	行业门类code\r\nIndustry	String	行业门类描述\r\nSubIndustryCode	String	行业大类code\r\nSubIndustry	String	行业大类描述\r\nMiddleCategoryCode	String	行业中类code\r\nMiddleCategory	String	行业中类描述\r\nSmallCategoryCode	String	行业小类code\r\nSmallCategory	String	行业小类描述\r\n\r\nJSON返回示例：\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25\r\n26\r\n27\r\n28\r\n29\r\n30\r\n31\r\n32\r\n33\r\n34\r\n35\r\n36\r\n37\r\n38\r\n39\r\n40\r\n41\r\n42\r\n43\r\n44\r\n45\r\n46\r\n47\r\n48\r\n49\r\n50\r\n51\r\n52\r\n53\r\n54\r\n55\r\n56\r\n57\r\n58\r\n59\r\n60\r\n61\r\n62\r\n63\r\n64\r\n65\r\n66\r\n67\r\n68\r\n69\r\n70\r\n71\r\n72\r\n73\r\n74\r\n75\r\n76\r\n77\r\n78\r\n79\r\n80\r\n81\r\n82\r\n83\r\n84\r\n85\r\n86\r\n87\r\n88\r\n89\r\n90\r\n91\r\n92\r\n93\r\n94\r\n95\r\n96\r\n97\r\n98\r\n99\r\n100\r\n101\r\n102\r\n103\r\n104\r\n105\r\n106\r\n107\r\n108\r\n109\r\n110\r\n111\r\n112\r\n113\r\n114\r\n115\r\n116\r\n117\r\n118\r\n119\r\n120\r\n121\r\n122\r\n123\r\n124\r\n125\r\n126\r\n127\r\n128\r\n129\r\n130\r\n131\r\n132\r\n133\r\n134\r\n135\r\n136\r\n137\r\n138\r\n139\r\n140\r\n141\r\n142\r\n143\r\n144\r\n145\r\n146\r\n147\r\n148\r\n149\r\n150\r\n151\r\n152\r\n153\r\n154\r\n155\r\n156\r\n157\r\n158\r\n159\r\n160\r\n161\r\n162\r\n163\r\n164\r\n165\r\n166\r\n167\r\n168\r\n169\r\n170\r\n171\r\n172\r\n173\r\n174\r\n175\r\n176\r\n177\r\n178\r\n179\r\n180\r\n181\r\n182\r\n183\r\n184\r\n185\r\n186\r\n187\r\n188\r\n189\r\n190\r\n191\r\n192\r\n193\r\n194\r\n195\r\n196\r\n197\r\n198\r\n199\r\n200\r\n{\r\n  \"Status\": \"200\",\r\n  \"Message\": \"查询成功\",\r\n  \"OrderNumber\": ECI201806191100235,\r\n  \"Result\": {\r\n    \"Partners\": [\r\n      {\r\n        \"StockName\": \"程维\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"49.19%\",\r\n        \"ShouldCapi\": \"491.9\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"王刚\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"48.22%\",\r\n        \"ShouldCapi\": \"482.25\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"张博\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"1.55%\",\r\n        \"ShouldCapi\": \"15.53\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"吴睿\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"0.72%\",\r\n        \"ShouldCapi\": \"7.23\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"陈汀\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"0.31%\",\r\n        \"ShouldCapi\": \"3.09\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      }\r\n    ],\r\n    \"Employees\": [\r\n      {\r\n        \"Name\": \"程维\",\r\n        \"Job\": \"执行董事\"\r\n      },\r\n      {\r\n        \"Name\": \"程维\",\r\n        \"Job\": \"经理\"\r\n      },\r\n      {\r\n        \"Name\": \"吴睿\",\r\n        \"Job\": \"监事\"\r\n      }\r\n    ],\r\n    \"Branches\": [\r\n      {\r\n        \"CompanyId\": \"8dc057af59e908b6a1c05d74de114134\",\r\n        \"RegNo\": \"500902300083458\",\r\n        \"Name\": \"北京小桔科技有限公司重庆分公司\",\r\n        \"BelongOrg\": \"重庆市工商行政管理局南岸区分局经开区局\",\r\n        \"CreditCode\": null,\r\n        \"OperName\": null\r\n      }\r\n    ],\r\n    \"ChangeRecords\": [\r\n      {\r\n        \"ProjectName\": \"住所\",\r\n        \"BeforeContent\": \"北京市海淀区上地东路9号1幢5层北区2号\",\r\n        \"AfterContent\": \"北京市海淀区东北旺西路8号院35号楼5层501室\",\r\n        \"ChangeDate\": \"2016-09-27T00:00:00+08:00\"\r\n      },\r\n      {\r\n        \"ProjectName\": \"经营范围\",\r\n        \"BeforeContent\": \"从事互联网文化活动；第二类增值电信业务中的信息服务业务(仅限互联网信息服务)(互联网信息服务不含新闻、出版、教育、医疗保健、药品和医疗器械、电子公告服务)(电信与信息服务业务许可证有效期至2020年04月29日)；第二类增值电信业务中的信息服务业务(不含固定网电话信息服务和互联网信息服务)(增值电信业务经营许可证有效期至2020年04月29日)。技术开发、技术咨询、技术服务、技术推广；基础软件服务；应用软件服务；设计、制作、代理、发布广告；软件开发；销售自行开发后的产品；企业管理咨询；计算机系统服务；组织文化艺术交流活动(不含营业性演出)；公共关系服务；企业策划、设计；会议服务；市场调查；货物进出口、技术进出口、代理进出口从事互联网文化活动以及依法须经批准的项目,经相关部门批准后依批准的内容开展经营活动。\"', '帮助\r\n内容详细\r\n\r\n接口测试：API测试工具\r\n\r\n技术支持：service@yjapi.com\r\n\r\n在线客服：客服咨询\r\n\r\n接口列表\r\n企业关键字模糊查询企业关键字多维度查询企业关键字精确获取详细信息(Master)获取新增的公司信息企业关键字精确获取详细信息(Basic)企业关键字精确获取详细信息(Full)\r\n接口信息资费说明SDK与文档错误代码更新记录\r\n接口地址：http://api.qichacha.com/ECIV4/GetDetailsByName\r\n\r\n支持格式：JSON/XML\r\n\r\n请求方式：GET\r\n\r\n请求示例：http://api.qichacha.com/ECIV4/GetDetailsByName?key=AppKey&keyword=北京小桔科技有限公司\r\n\r\n权限验证：\r\n参数名	类型	传递方式	说明\r\nToken	String	http header 头	验证加密值（key+Timespan+SecretKey组成的32位md5加密的大写字符串）\r\nTimespan	String	http header 头	精确到秒的Unix时间戳\r\nSecretKey	String	不传递	密钥，请妥善保管好\r\n\r\n请求参数：\r\n名称\r\n类型\r\n是否必填\r\n描述\r\nkey	String	是	应用APPKEY(应用详细页查询)\r\nkeyword	String	是	搜索关键字（公司名、注册号、社会统一信用代码或KeyNo）\r\ndtype	String	否	返回数据格式：仅支持json\r\n\r\n返回字段：\r\n名称	类型	说明\r\nKeyNo	String	内部KeyNo\r\nName	String	公司名称\r\nNo	String	注册号\r\nBelongOrg	String	登记机关\r\nOperName	String	法人名\r\nStartDate	String	成立日期\r\nEndDate	String	吊销日期\r\nStatus	String	企业状态\r\nProvince	String	省份\r\nUpdatedDate	String	更新日期\r\nCreditCode	String	社会统一信用代码\r\nRegistCapi	String	注册资本\r\nEconKind	String	企业类型\r\nAddress	String	地址\r\nScope	String	经营范围\r\nTermStart	String	营业开始日期\r\nTeamEnd	String	营业结束日期\r\nCheckDate	String	发照日期\r\nOrgNo	String	组织机构代码\r\nIsOnStock	String	是否上市(0为未上市，1为上市)\r\nStockNumber	String	上市公司代码\r\nStockType	String	上市类型\r\nImageUrl	String	企业Logo\r\nOriginalName\r\n曾用名	Name	String	曾用名\r\nChangeDate	String	变更日期\r\nPartners\r\n股东信息	StockName	String	股东\r\nStockType	String	股东类型\r\nStockPercent	String	出资比例\r\nShouldCapi	String	认缴出资额\r\nShoudDate	String	认缴出资时间\r\nInvestType	String	认缴出资方式\r\nInvestName	String	实际出资方式\r\nRealCapi	String	实缴出资额\r\nCapiDate	String	实缴时间\r\nEmployees\r\n主要人员	Name	String	姓名\r\nJob	String	职位\r\nBranches\r\n分支机构	CompanyId	String	CompanyId\r\nRegNo	String	注册号或社会统一信用代码（存在社会统一信用代码显示社会统一信用代码，否则显示注册号）\r\nName	String	名称\r\nBelongOrg	String	登记机关\r\nCreditCode	String	社会统一信用代码（保留字段，目前为空）\r\nOperName	String	法人姓名或负责人姓名（保留字段，目前为空）\r\nChangeRecords\r\n变更信息	ProjectName	String	变更事项\r\nBeforeContent	String	变更前内容\r\nAfterContent	String	变更后内容\r\nChangeDate	String	变更日期\r\nContactInfo\r\n联系信息	WebSite.Name	String	网站名称\r\nWebSite.Url	String	网站地址\r\nPhoneNumber	String	联系电话\r\nEmail	String	联系邮箱\r\nIndustry\r\n行业信息	IndustryCode	String	行业门类code\r\nIndustry	String	行业门类描述\r\nSubIndustryCode	String	行业大类code\r\nSubIndustry	String	行业大类描述\r\nMiddleCategoryCode	String	行业中类code\r\nMiddleCategory	String	行业中类描述\r\nSmallCategoryCode	String	行业小类code\r\nSmallCategory	String	行业小类描述\r\n\r\nJSON返回示例：\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25\r\n26\r\n27\r\n28\r\n29\r\n30\r\n31\r\n32\r\n33\r\n34\r\n35\r\n36\r\n37\r\n38\r\n39\r\n40\r\n41\r\n42\r\n43\r\n44\r\n45\r\n46\r\n47\r\n48\r\n49\r\n50\r\n51\r\n52\r\n53\r\n54\r\n55\r\n56\r\n57\r\n58\r\n59\r\n60\r\n61\r\n62\r\n63\r\n64\r\n65\r\n66\r\n67\r\n68\r\n69\r\n70\r\n71\r\n72\r\n73\r\n74\r\n75\r\n76\r\n77\r\n78\r\n79\r\n80\r\n81\r\n82\r\n83\r\n84\r\n85\r\n86\r\n87\r\n88\r\n89\r\n90\r\n91\r\n92\r\n93\r\n94\r\n95\r\n96\r\n97\r\n98\r\n99\r\n100\r\n101\r\n102\r\n103\r\n104\r\n105\r\n106\r\n107\r\n108\r\n109\r\n110\r\n111\r\n112\r\n113\r\n114\r\n115\r\n116\r\n117\r\n118\r\n119\r\n120\r\n121\r\n122\r\n123\r\n124\r\n125\r\n126\r\n127\r\n128\r\n129\r\n130\r\n131\r\n132\r\n133\r\n134\r\n135\r\n136\r\n137\r\n138\r\n139\r\n140\r\n141\r\n142\r\n143\r\n144\r\n145\r\n146\r\n147\r\n148\r\n149\r\n150\r\n151\r\n152\r\n153\r\n154\r\n155\r\n156\r\n157\r\n158\r\n159\r\n160\r\n161\r\n162\r\n163\r\n164\r\n165\r\n166\r\n167\r\n168\r\n169\r\n170\r\n171\r\n172\r\n173\r\n174\r\n175\r\n176\r\n177\r\n178\r\n179\r\n180\r\n181\r\n182\r\n183\r\n184\r\n185\r\n186\r\n187\r\n188\r\n189\r\n190\r\n191\r\n192\r\n193\r\n194\r\n195\r\n196\r\n197\r\n198\r\n199\r\n200\r\n{\r\n  \"Status\": \"200\",\r\n  \"Message\": \"查询成功\",\r\n  \"OrderNumber\": ECI201806191100235,\r\n  \"Result\": {\r\n    \"Partners\": [\r\n      {\r\n        \"StockName\": \"程维\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"49.19%\",\r\n        \"ShouldCapi\": \"491.9\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"王刚\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"48.22%\",\r\n        \"ShouldCapi\": \"482.25\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"张博\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"1.55%\",\r\n        \"ShouldCapi\": \"15.53\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"吴睿\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"0.72%\",\r\n        \"ShouldCapi\": \"7.23\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      },\r\n      {\r\n        \"StockName\": \"陈汀\",\r\n        \"StockType\": \"自然人股东\",\r\n        \"StockPercent\": \"0.31%\",\r\n        \"ShouldCapi\": \"3.09\",\r\n        \"ShoudDate\": null,\r\n        \"InvestType\": \"货币\",\r\n        \"InvestName\": null,\r\n        \"RealCapi\": null,\r\n        \"CapiDate\": null\r\n      }\r\n    ],\r\n    \"Employees\": [\r\n      {\r\n        \"Name\": \"程维\",\r\n        \"Job\": \"执行董事\"\r\n      },\r\n      {\r\n        \"Name\": \"程维\",\r\n        \"Job\": \"经理\"\r\n      },\r\n      {\r\n        \"Name\": \"吴睿\",\r\n        \"Job\": \"监事\"\r\n      }\r\n    ],\r\n    \"Branches\": [\r\n      {\r\n        \"CompanyId\": \"8dc057af59e908b6a1c05d74de114134\",\r\n        \"RegNo\": \"500902300083458\",\r\n        \"Name\": \"北京小桔科技有限公司重庆分公司\",\r\n        \"BelongOrg\": \"重庆市工商行政管理局南岸区分局经开区局\",\r\n        \"CreditCode\": null,\r\n        \"OperName\": null\r\n      }\r\n    ],\r\n    \"ChangeRecords\": [\r\n      {\r\n        \"ProjectName\": \"住所\",\r\n        \"BeforeContent\": \"北京市海淀区上地东路9号1幢5层北区2号\",\r\n        \"AfterContent\": \"北京市海淀区东北旺西路8号院35号楼5层501室\",\r\n        \"ChangeDate\": \"2016-09-27T00:00:00+08:00\"\r\n      },\r\n      {\r\n        \"ProjectName\": \"经营范围\",\r\n        \"BeforeContent\": \"从事互联网文化活动；第二类增值电信业务中的信息服务业务(仅限互联网信息服务)(互联网信息服务不含新闻、出版、教育、医疗保健、药品和医疗器械、电子公告服务)(电信与信息服务业务许可证有效期至2020年04月29日)；第二类增值电信业务中的信息服务业务(不含固定网电话信息服务和互联网信息服务)(增值电信业务经营许可证有效期至2020年04月29日)。技术开发、技术咨询、技术服务、技术推广；基础软件服务；应用软件服务；设计、制作、代理、发布广告；软件开发；销售自行开发后的产品；企业管理咨询；计算机系统服务；组织文化艺术交流活动(不含营业性演出)；公共关系服务；企业策划、设计；会议服务；市场调查；货物进出口、技术进出口、代理进出口从事互联网文化活动以及依法须经批准的项目,经相关部门批准后依批准的内容开展经营活动.', '14', 14, 14, '14', '2019-01-09 16:46:30', '2019-01-09 16:46:30', 3, '101|102', 1);

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_employees_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_employees_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_employees_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `employee_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '人员姓名',
  `employees_job` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '人员职务',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_qichacha_employees_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_qichacha_employees_info` VALUES (1, 1, '程维', '执行董事', '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_qichacha_stock_info
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_qichacha_stock_info`;
CREATE TABLE `qnn_park_enterprise_qichacha_stock_info`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `stock_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '股东姓名',
  `stock_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '股东类型',
  `stock_percent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '出资比例',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_enterprise_qichacha_stock_info
-- ----------------------------
INSERT INTO `qnn_park_enterprise_qichacha_stock_info` VALUES (1, 1, '程维', '自然人股东', '49.19%', '2019-01-09 16:46:30', '2019-01-09 16:46:30');

-- ----------------------------
-- Table structure for qnn_park_enterprise_scopyright_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_scopyright_list`;
CREATE TABLE `qnn_park_enterprise_scopyright_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '软件名称',
  `version_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '版本号',
  `publish_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '首次发表日期',
  `shortname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '软件简称',
  `register_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登记号',
  `register_aper_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登记批准日期',
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类号',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业软件著作权列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_trademark_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_trademark_list`;
CREATE TABLE `qnn_park_enterprise_trademark_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `image_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商标logo',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商标名',
  `tm_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '申请状态',
  `app_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '申请日期',
  `reg_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '注册号',
  `intcis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '国际分类',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业商标信息列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_wcopyright_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_wcopyright_list`;
CREATE TABLE `qnn_park_enterprise_wcopyright_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '作品名称',
  `publish_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '首次发表日期',
  `finish_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创作完成日期',
  `register_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登记号',
  `register_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登记日期',
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '等级类别',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业作品著作权列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_enterprise_website_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_enterprise_website_list`;
CREATE TABLE `qnn_park_enterprise_website_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `home_site` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '网址',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `yuming` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '域名',
  `beian` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备案号',
  `s_day` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '审核日期',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '企业网站列表' ROW_FORMAT = Dynamic;

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
  `enterprise_status` tinyint(1) NULL DEFAULT NULL COMMENT '状态:1=毕业',
  `liaison` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联络员',
  `counselor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '辅导员',
  `entrepreneurship_tutor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创业导师',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '孵化企业列表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qnn_park_incubation_list
-- ----------------------------
INSERT INTO `qnn_park_incubation_list` VALUES (1, 1, '上海小炬华科技', '2017-10-10', '', 2, '1', '马画藤', '马小云', '2019-01-09 16:46:31', '2019-01-11 10:26:39');

-- ----------------------------
-- Table structure for qnn_park_incubation_visit_log
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_incubation_visit_log`;
CREATE TABLE `qnn_park_incubation_visit_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `visitor_id` int(11) NULL DEFAULT NULL COMMENT '走访者ID',
  `visit_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '走访时间',
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '走访记录',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '孵化企业走访记录' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qnn_park_incubation_visit_log
-- ----------------------------
INSERT INTO `qnn_park_incubation_visit_log` VALUES (1, 1, '上海小炬华科技', 1, '2019-01-11 11:25:53', '小菊花的记录', '2019-01-11 11:26:32', '2019-01-11 11:39:25');

-- ----------------------------
-- Table structure for qnn_park_investment_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_investment_list`;
CREATE TABLE `qnn_park_investment_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `type` tinyint(1) NOT NULL COMMENT '投资类型:1=贷款,2=企业投资人投资,3=个人投资人投资',
  `amount` decimal(10, 2) NULL DEFAULT 0.00 COMMENT '投资金额',
  `is_mortgage` tinyint(1) NULL DEFAULT NULL COMMENT '是否抵押:1=是,2=否',
  `percent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '所占比例',
  `start_time` datetime(0) NULL DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '结束时间',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '投资列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_investment_list
-- ----------------------------
INSERT INTO `qnn_park_investment_list` VALUES (1, 1, '上海小炬华科技', 1, 1000000.00, 2, '50%', '2018-12-31 00:00:54', '2019-01-15 14:31:16', 'O(∩_∩)O哈哈~', '2019-01-15 14:31:23', '2019-01-15 14:31:23');

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
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '入驻团队名称',
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
  `floor` int(11) NULL DEFAULT NULL COMMENT '楼层',
  `station_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '工位',
  `real_station_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际缴纳工位费',
  `property_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '物业费',
  `aircon_fee` decimal(10, 2) NULL DEFAULT NULL COMMENT '空调费',
  `entry_time` datetime(0) NULL DEFAULT NULL COMMENT '入住时间',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '到期时间',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '苗圃入驻团队列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_park_project_budget_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_park_project_budget_list`;
CREATE TABLE `qnn_park_project_budget_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) NOT NULL COMMENT '预算类型:1=投资,2=捐助,,,,确定后再改',
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '总预算',
  `real_amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '实际执行预算',
  `confirmor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '确认人',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_project_budget_list
-- ----------------------------
INSERT INTO `qnn_park_project_budget_list` VALUES (1, 1, '小石头拖拉机', 1000000.00, 80000.00, '香飘飘', '2019年1月16日', '2019-01-16 10:31:07', '2019-01-16 10:31:07');

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
  `type` tinyint(1) NOT NULL COMMENT '房间类型;1=办公,2=商铺,3=自用,4=会议室,5=苗圃,6=展览室',
  `aircon_price` decimal(10, 2) NOT NULL COMMENT '空调单价',
  `decoration` tinyint(1) NULL DEFAULT 2 COMMENT '1:毛坯;2:简装',
  `room_img` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '房屋封面',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '房源介绍',
  `room_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:未租;2:已租',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '入驻企业ID',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_room
-- ----------------------------
INSERT INTO `qnn_park_room` VALUES (1, 3, 1, 101, 100.00, 30.00, 10.00, 1, 5.00, 1, '14', '<p></p><p></p><p></p><p></p><p></p><p></p><p>房间介绍</p><p></p><p><br></p><p></p><p><br></p><p></p><p><br></p><p></p><p><br></p><p></p><p><br></p><p></p><p><br></p>', 2, 1, '2019-01-04 15:28:12', '2019-01-04 16:03:57');
INSERT INTO `qnn_park_room` VALUES (2, 3, 1, 102, 200.00, 50.00, 20.00, 1, 10.00, 1, '14', '<p></p><p>呱呱呱</p>', 2, 1, '2019-01-04 16:03:44', '2019-01-04 16:33:37');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '软件企业列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_soft_enterprise_list
-- ----------------------------
INSERT INTO `qnn_park_soft_enterprise_list` VALUES (1, 1, '上海小菊花网络科技', '2019-01-11 14:31:51', '2019-01-11 14:31:53');

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
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '软件项目列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_park_soft_project_list
-- ----------------------------
INSERT INTO `qnn_park_soft_project_list` VALUES (1, 1, '上海小菊花网络科技', '同济智慧园区二期', '2020-01-01 10:30:01', '哈哈哈', '2019-01-11 15:04:31', '2019-01-11 15:21:25');
INSERT INTO `qnn_park_soft_project_list` VALUES (2, 1, '上海小菊花网络科技', '同济智慧园区', '2019-01-11 15:21:45', '急急急', '2019-01-11 15:21:49', '2019-01-11 15:21:49');

-- ----------------------------
-- Table structure for qnn_parking_space_lease_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_parking_space_lease_list`;
CREATE TABLE `qnn_parking_space_lease_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `space` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '车位号',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业id',
  `enterprise_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `s_date` datetime(0) NULL DEFAULT NULL COMMENT '租赁起始日',
  `e_date` datetime(0) NULL DEFAULT NULL COMMENT '租赁到期日',
  `period` tinyint(1) NULL DEFAULT NULL COMMENT '周期:1=月,2=半年,3=一年4=两年,5=三年,6=四年,7=五年,8=一次性',
  `pay_time` datetime(0) NULL DEFAULT NULL COMMENT '缴费时间',
  `is_paid` tinyint(1) NULL DEFAULT 1 COMMENT '1=已缴费,2=未交费',
  `amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '总费用',
  `lease_status` tinyint(1) NULL DEFAULT 2 COMMENT '1=到期,2=未到期',
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '车位租赁列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_parking_space_lease_list
-- ----------------------------
INSERT INTO `qnn_parking_space_lease_list` VALUES (1, 'A0001', 1, '上海小炬华科技', '2019-01-18 14:22:48', '2019-02-28 14:20:40', 2, '2019-01-18 14:23:00', 1, 500.00, 2, 'hhh', '2019-01-18 14:23:19', '2019-01-18 14:36:08');

-- ----------------------------
-- Table structure for qnn_parking_space_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_parking_space_list`;
CREATE TABLE `qnn_parking_space_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `numbering` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '车位号',
  `price` decimal(10, 2) UNSIGNED NULL DEFAULT NULL COMMENT '费用',
  `space_status` tinyint(1) NULL DEFAULT 2 COMMENT '1=已租,2=未租',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '车位列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_parking_space_list
-- ----------------------------
INSERT INTO `qnn_parking_space_list` VALUES (1, 'A0001', 144.00, 1, '2019-01-18 13:36:24', '2019-01-18 14:34:48');

-- ----------------------------
-- Table structure for qnn_plugins
-- ----------------------------
DROP TABLE IF EXISTS `qnn_plugins`;
CREATE TABLE `qnn_plugins`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '插件描述',
  `config` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '配置',
  `author` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '版本号',
  `admin_manage_into` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '后台管理入口',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '插件类型',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '安装时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '修改时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '插件表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_plugins
-- ----------------------------
INSERT INTO `qnn_plugins` VALUES (3, 'ImageGallery', '幻灯片', '图片轮播滑块器，可用于图片展示', '{\"status\":\"1\",\"type\":\"flexslider\",\"sliders\":[{\"img\":\"14\",\"url\":\"https:\\/\\/www.eacoophp.com\",\"text\":\"\\u6a31\\u82b1\\u5c11\\u5973\"}],\"second\":\"3000\",\"direction\":\"horizontal\",\"imgWidth\":\"\",\"imgHeight\":\"880\"}', '心云间、凝听', '1.0.3', '0', 1, '2018-11-28 17:41:10', '2018-12-04 17:49:26', 99, 1);
INSERT INTO `qnn_plugins` VALUES (5, 'Alisms', '阿里云短信', '通过阿里短信接口发送短信，官网：https://www.aliyun.com/product/sms', '{\"status\":\"1\",\"accessKeyId\":\"\",\"accessKeySecret\":\"\",\"signName\":\"\"}', 'xpwsgg', '1.0.1', '', 1, '2018-11-28 17:55:55', '2018-11-28 17:55:55', 99, 1);
INSERT INTO `qnn_plugins` VALUES (7, 'qiniuoss', '七牛云储存', '实现七牛云存储，管理附件', '{\"enable\":1,\"bucket\":\"eacoomall-qiniu\",\"access_key_id\":\"\",\"access_key_secret\":\"\",\"root_path\":\"images\",\"domain\":\"http:\\/\\/img.eacoomall.com\",\"endpoint\":\"http:\\/\\/pamlntz0m.bkt.clouddn.com\",\"style\":[{\"name\":\"wap-thumb\"},{\"name\":\"small\"},{\"name\":\"medium\"},{\"name\":\"large\"}]}', 'yyyvy', '1.0.0', '', 1, '2018-11-29 15:05:31', '2018-11-29 15:05:31', 99, 1);
INSERT INTO `qnn_plugins` VALUES (12, 'Qichacha', '企查查', '通过企查查获取企业Master数据,商标,专利,著作权,网站,企业证书数据官网http://www.yjapi.cn', '{\"status\":\"1\",\"appKey\":\"1768454120694ddba498dfd1c95d16a1\",\"secretKey\":\"002E95B913D601221F01AC7F2DDF99C6\"}', 'xpwsgg', '1.1.0', '', 1, '2019-01-16 17:16:51', '2019-01-16 17:18:15', 99, 1);
INSERT INTO `qnn_plugins` VALUES (20, 'DataDictionary', '数据库字典', '数据库字典,丑是丑了点,又不是不能用!', '', 'xpwsgg', '1.0.0', '', 1, '2019-01-18 16:16:08', '2019-01-18 16:16:08', 99, 1);

-- ----------------------------
-- Table structure for qnn_postmeta
-- ----------------------------
DROP TABLE IF EXISTS `qnn_postmeta`;
CREATE TABLE `qnn_postmeta`  (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`meta_id`) USING BTREE,
  INDEX `idx_postid_metakey`(`post_id`, `meta_key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_posts
-- ----------------------------
DROP TABLE IF EXISTS `qnn_posts`;
CREATE TABLE `qnn_posts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '标题',
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章类型,post,page,product',
  `source` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '来源标记',
  `excerpt` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '摘要',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `author_id` int(11) UNSIGNED NOT NULL COMMENT '作者',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否后台管理员用户创建。0否，1是',
  `seo_keywords` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'seo_keywords',
  `img` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '封面图片',
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览数',
  `collection` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏量',
  `comment_count` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '冗余评论数',
  `parent` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'post的父级post id,表示post层级关系',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `fields` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'post的扩展字段，保存相关扩展属性，如缩略图；格式为json',
  `istop` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '置顶 1置顶； 0不置顶',
  `recommended` tinyint(1) NULL DEFAULT 0 COMMENT '推荐 1推荐 0不推荐，大于1的数字可设定为不同推荐区',
  `publish_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '发布时间',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `sort` int(10) UNSIGNED NULL DEFAULT 99 COMMENT '排序号',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 -1 删除 0审核 1为已发布',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_type`(`type`) USING BTREE,
  INDEX `idx_author_id`(`author_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文章表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_posts
-- ----------------------------
INSERT INTO `qnn_posts` VALUES (1, '揭秘eBay四大系统 从行为数据中寻找价值', '', 'post', NULL, '', '<p></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(102, 102, 102); font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; white-space: normal;\">喜欢海淘的朋友应该对eBay并不陌生，如果你还不了解，可以把eBay+PayPal理解为淘宝+支付宝的组合，当然eBay不仅有C2C还有B2C的模式，甚至还有二手卖家。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(102, 102, 102); font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; white-space: normal;\">铺垫了一些背景，我们再来说说电子商务，现在还有没网购过的同学请举手，1、2、3……可能没有几个。虽然大家都在各种电子商务网站上购过物，但是你是否知道你在网上的一切行为都已经被记录并进行分析。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(102, 102, 102); font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; white-space: normal;\">不论国外还是国内的电子商务企业，他们的相同点都是以业务为导向。eBay的做法是用数据驱动商业，其上所有的数据产品都是针对业务而生，数据部门需要对不断变化的用户需求找到解决之法，也就是从客户的行为数据中来寻找价值。</p><h3 style=\"box-sizing: border-box; font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: normal; line-height: 1.1; color: rgb(68, 68, 68); margin-top: 20px; margin-bottom: 16px; font-size: 16px; border-bottom-color: rgb(238, 238, 238); border-bottom-width: 1px; border-bottom-style: solid; padding-bottom: 0px; white-space: normal;\"><strong style=\"box-sizing: border-box;\">行为数据用混合的手段来处理</strong></h3><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(102, 102, 102); font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; white-space: normal;\">数据是eBay发展的基础和价值所在，所以eBay数据服务和解决方案团队从eBay成立的第一天就已经存在，从数据仓库到数据分析再到数据服务，部门的名字一直随着发展在不断变化。但万变不离其宗，数据服务和解决方案团队就是一个针对数据展开想象的部门。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(102, 102, 102); font-family: \'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; white-space: normal;\">eBay数据服务和解决方案团队分布在美国西雅图、圣何塞以及中国上海，而中国团队全职和外包人员总共将近有100人，其中有不同的职位和分工，包括数据科学家、数据工程师、商业需求分析师、产品经理四大类。两个区域的团队互相协作，共同开发核心数据的同时也支持不同的业务部门。</p><p><br></p><p></p><p><br></p>', 1, 1, '', 14, 100, 10, 0, 0, '', '', 0, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-12-12 13:42:31', 99, 1);
INSERT INTO `qnn_posts` VALUES (2, '谷歌数据中心安全及设计的最佳实践', '', 'post', NULL, '', '<p>在首次云端平台使用者大会(Google Cloud Platform Global User Conference)上，谷歌的两位领导者——数据中心的运营副总裁Joe Kava和安全隐私方面的优秀工程师Niels Provos向与会者分享了谷歌在全球范围内设计、构建、运行和保护数据中心的实践方式，其中包含一些令谷歌的数据中心独一无二的秘诀，及其对于谷歌云端平台用户的意义。\r\n\r\n安全性和数据保护sdf\r\n\r\n谷歌一直以来将重心放在数据的安全和保护上，这也是我们的关键设计准则之一。在物理安全方面，我们以分层安全模型为特色，使用了如定制的电子访问卡、警报器、车辆进出限制、围栏架设、金属探测器及生物识别技术等保障措施。数据中心的地板配备了激光束入侵探测器，并安装了高清晰度的内外监视器，全天候检测追踪入侵行为。此外为以防万一，可随时调用访问日志、活动记录以及监控录像。\r\n\r\n同时数据中心还安排了经验丰富的保安人员每日例行巡逻，他们已接受过背景调查与严格的培训(可以点击查看数据中心的360度视频)。越靠近数据中心，安全措施系数就越高，只有一条安全通道能进入数据中心，通过安全徽章和生物识别技术来实现多重访问控制，只有特定职位的员工才有权进入。在整个谷歌公司，只有不到1%的员工曾踏足此区域。\r\n\r\n我们还采用了非常严格的点对点监管链，用于储存、追踪全过程——从第一次HD输入机器直至证实其已被销毁或清除。同时，我们采用了信息安全和物理安全双管齐下的方式，由于数据通过网络传输的特性，若未经授权可随意访问的话就会非常危险。有鉴于此，谷歌将数据传输过程中的信息保护摆在优先位置上，用户设备与谷歌间的数据传输通常都是利用HTTPS/TLS(安全传输层协议)来进行加密输送。谷歌是第一个默认启用HTTPS/TLS的主要云服务提供商。</p>', 1, 1, '', 93, 100, 0, 0, 0, '', '', 0, 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 0);
INSERT INTO `qnn_posts` VALUES (3, '机器学习专家带你实践LSTM语言模型', '', 'post', NULL, '', '<p>测试</p><p><br></p>', 1, 0, '', 94, 100, 13, 0, 0, '', '', 0, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_posts` VALUES (4, '大撒发送大撒发送', '', 'page', NULL, '', '<p style=\"text-align:center\"><br/></p><p>这是编辑的内容就gsadfasdfasfd</p><p></p>', 1, 1, '', 1164, 100, 0, 0, 0, '', '', 0, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, -1);
INSERT INTO `qnn_posts` VALUES (5, '贝恩：企业大数据战略指南', '', 'post', NULL, '这是摘要dgs', '<p>企业大数据战略指南</p><p><br></p><p><img class=\"\" src=\"http://localhost/ZhaoCMF/Uploads/Picture/2016-09-26/57e8ddc3e1455.jpeg\" data-id=\"363\"></p><p>fsafsaf</p><p><br></p>', 1, 1, '关键字1', 88, 100, 0, 0, 0, '', '', 1, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_posts` VALUES (6, '发撒范德萨', '', 'post', NULL, '', '<p>撒发达范德萨发送</p>', 1, 0, '', 27, 100, 0, 0, 0, '', '', 0, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_posts` VALUES (7, '关于我们', '', 'page', NULL, NULL, '<p>EacooPHP是基于ThinkPHP5开发的一套轻量级WEB产品开发框架，追求高效，简单，灵活。具有完善并灵活的模块化和插件机制，模块式开发，大大降低开发成本。</p>', 1, 1, 'EacooPHP是基于ThinkPHP5开发的一套轻量级WEB产品开发框架', NULL, 100, 0, 0, 0, '', '', 0, 0, '2018-09-30 22:32:26', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);

-- ----------------------------
-- Table structure for qnn_rewrite
-- ----------------------------
DROP TABLE IF EXISTS `qnn_rewrite`;
CREATE TABLE `qnn_rewrite`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `rule` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'url',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态：0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '伪静态表' ROW_FORMAT = Dynamic;

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
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '0=待处理,1=已通过,2=已拒绝',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `handler_id` int(11) NULL DEFAULT NULL COMMENT '操作人id',
  `hand_time` datetime(0) NULL DEFAULT NULL COMMENT '操作时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_service_laboratory_booking_list
-- ----------------------------
INSERT INTO `qnn_service_laboratory_booking_list` VALUES (1, 2, '柯南', '18899999999', '2019-01-21 15:26:32', '2019-01-21 17:26:34', '2019-01-21 15:26:43', 2, '没时间', 1, '2019-01-21 15:41:28', '2019-01-21 15:41:28');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_service_laboratory_list
-- ----------------------------
INSERT INTO `qnn_service_laboratory_list` VALUES (1, 3, '3001', 1, '话筒,大屏幕', 50, 1, '2019-01-21 14:46:02', '2019-01-21 14:49:38');
INSERT INTO `qnn_service_laboratory_list` VALUES (2, 3, '3002', 2, '话筒,大屏幕', 50, 2, '2019-01-21 14:47:25', '2019-01-21 14:49:31');

-- ----------------------------
-- Table structure for qnn_service_meeting_room_booking_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_service_meeting_room_booking_list`;
CREATE TABLE `qnn_service_meeting_room_booking_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `meetingroom_id` int(11) NOT NULL COMMENT '会议室id',
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '申请人姓名',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '申请人手机号',
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of qnn_service_meeting_room_list
-- ----------------------------
INSERT INTO `qnn_service_meeting_room_list` VALUES (7, 3, '2001', 100.00, 50, '大屏幕,投影仪', '14,', '<p></p><p>哈哈哈</p><p></p><p><br></p>', 50, 1, '2019-01-21 11:00:55', '2019-01-21 11:01:22');

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

-- ----------------------------
-- Table structure for qnn_student_innovation
-- ----------------------------
DROP TABLE IF EXISTS `qnn_student_innovation`;
CREATE TABLE `qnn_student_innovation`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '公司名称',
  `principal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '负责人',
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系电话',
  `education` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '学历',
  `education_number` int(10) NOT NULL COMMENT '学号',
  `director` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '董事',
  `supervisor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '监事',
  `funding` decimal(10, 2) NOT NULL COMMENT '资助金额',
  `exit_funding` decimal(10, 2) NOT NULL COMMENT '退出金额',
  `start_day` datetime(0) NOT NULL COMMENT '开始日期',
  `end_day` datetime(0) NOT NULL COMMENT '结束日期',
  `innovation_status` tinyint(1) NOT NULL COMMENT '1=资助期内;2=全额退出;3=清算退出;4=注销;5=延迟退出',
  `building_id` tinyint(2) NOT NULL COMMENT '所在楼宇',
  `room_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '房间号',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  `files` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '附件',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_tech_project_list
-- ----------------------------
DROP TABLE IF EXISTS `qnn_tech_project_list`;
CREATE TABLE `qnn_tech_project_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `enterprise_id` int(11) NOT NULL COMMENT '企业ID',
  `enterprise_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '投资类型',
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '项目名称',
  `start_time` datetime(0) NULL DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '结束时间',
  `department` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '立项委办局',
  `amount` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '获得资助资金额度',
  `total` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '总投入',
  `pics` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片',
  `marks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '科技项目资金信息列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_term_relationships
-- ----------------------------
DROP TABLE IF EXISTS `qnn_term_relationships`;
CREATE TABLE `qnn_term_relationships`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'posts表里文章id',
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  `table` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '数据表',
  `uid` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '分类与用户关系',
  `create_time` datetime(0) NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态，1发布，0不发布',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_term_id`(`term_id`) USING BTREE,
  INDEX `idx_object_id`(`object_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '对象分类对应表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_term_relationships
-- ----------------------------
INSERT INTO `qnn_term_relationships` VALUES (3, 116, 12, 'attachment', 1, '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_term_relationships` VALUES (10, 3, 5, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (11, 5, 6, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (12, 2, 6, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (13, 1, 1, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (14, 4, 1, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (15, 6, 1, 'posts', 0, '0001-01-01 00:00:00', 0, 1);
INSERT INTO `qnn_term_relationships` VALUES (16, 14, 9, 'attachment', 0, '0001-01-01 00:00:00', 99, 1);
INSERT INTO `qnn_term_relationships` VALUES (17, 16, 9, 'attachment', 0, '0001-01-01 00:00:00', 99, 1);

-- ----------------------------
-- Table structure for qnn_terms
-- ----------------------------
DROP TABLE IF EXISTS `qnn_terms`;
CREATE TABLE `qnn_terms`  (
  `term_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '分类别名',
  `taxonomy` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '分类类型',
  `pid` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '上级ID',
  `seo_title` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'seo标题',
  `seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'seo 关键词',
  `seo_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'seo描述',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `sort` int(10) UNSIGNED NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '状态，1发布，0不发布',
  PRIMARY KEY (`term_id`) USING BTREE,
  INDEX `idx_taxonomy`(`taxonomy`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_terms
-- ----------------------------
INSERT INTO `qnn_terms` VALUES (1, '未分类', 'nocat', 'post_category', 0, '未分类', '', '自定义分类描述', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (4, '大数据', 'tag_dashuju', 'post_tag', 0, '大数据', '', '这是标签描述', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, -1);
INSERT INTO `qnn_terms` VALUES (5, '技术类', 'technology', 'post_category', 0, '技术类', '关键词', '自定义分类描述', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, -1);
INSERT INTO `qnn_terms` VALUES (7, '运营', 'yunying', 'post_tag', 0, '运营', '关键字', '自定义标签描述', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (9, '人物', 'renwu', 'media_cat', 0, '人物', '', '聚集多为人物显示的分类', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (10, '美食', 'meishi', 'media_cat', 0, '美食', '', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (11, '图标素材', 'icons', 'media_cat', 0, '图标素材', '', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (12, '风景', 'fengjin', 'media_cat', 0, '风景', '风景', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);
INSERT INTO `qnn_terms` VALUES (13, '其它', 'others', 'media_cat', 0, '其它', '', '', '2018-09-30 22:32:26', '2018-09-30 22:32:26', 99, 1);

-- ----------------------------
-- Table structure for qnn_themes
-- ----------------------------
DROP TABLE IF EXISTS `qnn_themes`;
CREATE TABLE `qnn_themes`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `description` varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `author` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '开发者',
  `version` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '版本',
  `config` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '主题配置',
  `current` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当前主题类型，1PC端，2手机端。默认0',
  `website` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '站点',
  `sort` tinyint(4) UNSIGNED NOT NULL DEFAULT 99 COMMENT '排序，值越小越靠前',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '前台主题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_themes
-- ----------------------------
INSERT INTO `qnn_themes` VALUES (1, 'default', '默认主题', '内置于系统中，是其它主题的基础主题', '心云间、凝听', '1.0.2', '', 0, 'https://www.eacoophp.com', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_themes` VALUES (2, 'default-mobile', '默认主题-手机端', '内置于系统中，是系统的默认主题。手机端', '心云间、凝听', '1.0.1', '', 2, '', 99, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);
INSERT INTO `qnn_themes` VALUES (3, 'Simple-white', '简约白01-企业主题PC端', '简约白企业主题,针对CMS做单独优化处理', 'yyyvy', '1.0.0', '', 1, '', 99, '2018-11-28 10:52:56', '2018-11-28 10:52:56', 1);

-- ----------------------------
-- Table structure for qnn_user_level
-- ----------------------------
DROP TABLE IF EXISTS `qnn_user_level`;
CREATE TABLE `qnn_user_level`  (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '等级名称',
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态。0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户等级表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_users
-- ----------------------------
DROP TABLE IF EXISTS `qnn_users`;
CREATE TABLE `qnn_users`  (
  `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '前台用户ID',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `number` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '会员编号',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `nickname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `avatar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户头像，相对于uploads/avatar目录',
  `sex` smallint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别；0：保密，1：男；2：女',
  `birthday` date NOT NULL COMMENT '生日',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '个人描述',
  `register_ip` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '注册IP',
  `login_num` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `last_login_ip` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '最后登录时间',
  `activation_auth_sign` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户个人网站',
  `score` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户积分',
  `money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '金额',
  `freeze_money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '冻结金额，和金币相同换算',
  `pay_pwd` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '支付密码',
  `reg_from` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册来源。1PC端，2WAP端，3微信端，4APP端，5后台添加',
  `reg_method` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '注册方式。wechat,sina,等',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '等级，关联表user_level主键',
  `p_uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '推荐人会员ID',
  `is_lock` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否锁定。0否，1是',
  `actived` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否激活，0否，1是',
  `reg_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '注册时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户状态 0：禁用； 1：正常 ；',
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE INDEX `uniq_number`(`number`) USING BTREE,
  INDEX `idx_username`(`username`) USING BTREE,
  INDEX `idx_email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户会员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_users
-- ----------------------------
INSERT INTO `qnn_users` VALUES (1, 'founder', '5257975351', '31b836d289cdfb8b6e20c2bab2b78756', '站长', '', '', 'http://cdn.eacoo.xin/attachment/static/assets/img/default-avatar.png', 1, '0000-00-00', '网站创始人、站长。', '', 0, '127.0.0.1', '2018-11-27 10:37:21', '381af7a195b90d109a056732fe5f748db7b6d9f6', 'https://www.eacoophp.com', 100, 100.00, 0.00, 'eba6095468eb32492d20d5db6a85aa5d', 0, '', 0, 0, 0, 1, '2018-09-30 22:32:26', '2018-09-30 22:32:26', 1);

-- ----------------------------
-- Table structure for qnn_wechat
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat`;
CREATE TABLE `qnn_wechat`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公众号名称',
  `type` int(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公众号类型（1：普通订阅号；2：认证订阅号；3：普通服务号；4：认证服务号',
  `origin_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '公众号原始ID',
  `weixin_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信号',
  `valid_token` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '接口验证Token',
  `token` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '公众号标识',
  `mch_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商户号',
  `mch_key` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `encodingaeskey` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '消息加解密秘钥',
  `appid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'AppId',
  `appsecret` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'AppSecret',
  `headimg` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `qrcode` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '二维码',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态（0：禁用，1：正常，2：审核中）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '公众号表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qnn_wechat
-- ----------------------------
INSERT INTO `qnn_wechat` VALUES (2, '公众平台测试账号', 1, 'gh_866ee7026f43  ', 'gh_866ee7026f43  ', 'Mf8Pv8Oc', 'fbbe31c758cd06451f1aaf5b55122251', '', '', 'vlEORHu2zpaEV67oiN0FNalKdRwTrIXKcEp4d7eYbx0', 'wx5627ca95a3d62b24', '5785ffa71d964ad8744a51e9e19d7d76', '/uploads/picture/2018-10-06/5bb86eb1929cf.png', '', '测试开发功能使用，可删除', '2018-10-06 16:13:53', '2018-11-30 16:47:46', 2);

-- ----------------------------
-- Table structure for qnn_wechat_material
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat_material`;
CREATE TABLE `qnn_wechat_material`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `wxid` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公众号标识',
  `wx_media_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '微信端素材的media_id',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '素材类型',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '素材描述',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '文本素材内容',
  `attachment_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片素材路径',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '素材标题',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '素材链接',
  `news_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '图文素材描述',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '多图文组的ID',
  `fields` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '扩展字段',
  `create_time` datetime(0) NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '素材创建时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态。1正常，0禁用',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '公众号素材表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_wechat_menus
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat_menus`;
CREATE TABLE `qnn_wechat_menus`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wxid` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公众号标识',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单类型,click,view, miniprogram',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `key` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '若为小程序菜单，作为备用url',
  `appid` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '对应小程序的appid',
  `pagepath` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT ' 小程序路径',
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_wechat_message
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat_message`;
CREATE TABLE `qnn_wechat_message`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `wxid` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公众号标识ID',
  `ToUserName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'Token',
  `FromUserName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'OpenID',
  `CreateTime` int(10) NOT NULL COMMENT '创建时间',
  `MsgType` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '消息类型',
  `MsgId` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '消息ID',
  `Content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文本消息内容',
  `PicUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片链接',
  `MediaId` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '多媒体文件ID',
  `Format` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '语音格式',
  `ThumbMediaId` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '缩略图的媒体id',
  `Title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '消息标题',
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '消息描述',
  `Url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'Url',
  `collect` tinyint(1) NOT NULL DEFAULT 0 COMMENT '收藏状态',
  `deal` tinyint(1) NOT NULL DEFAULT 0 COMMENT '处理状态',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已读',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '消息分类',
  `is_material` tinyint(1) NOT NULL DEFAULT 0 COMMENT '设置为文本素材',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_wxid_openid`(`wxid`, `ToUserName`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '微信消息记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_wechat_reply
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat_reply`;
CREATE TABLE `qnn_wechat_reply`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `wxid` tinyint(3) UNSIGNED NOT NULL COMMENT '公众号标识',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '回复场景',
  `reply_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '回复类型',
  `material_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '回复素材ID',
  `keyword` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '绑定的关键词',
  `plugin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '处理消息的插件',
  `status` tinyint(3) NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_keyword`(`keyword`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '公众号自动回复' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qnn_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `qnn_wechat_user`;
CREATE TABLE `qnn_wechat_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户标识',
  `wxid` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公众号标识',
  `openid` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'OPENID',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(1) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `headimgurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `subscribe` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否订阅',
  `subscribe_time` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '订阅时间',
  `unionid` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `last_update` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信用户表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
