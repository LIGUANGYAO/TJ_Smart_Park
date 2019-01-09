
CREATE TABLE IF NOT EXISTS `eacoo_demo_example` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '标题',
  `email` varchar(120) DEFAULT '' COMMENT '邮箱',
  `password` varchar(32) DEFAULT '' COMMENT '密码',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别。0保密，1男，2女',
  `picture` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '图片，通过attachment表id存储',
  `pictures` varchar(60) DEFAULT '' COMMENT '图片集，附件的ids串存储',
  `image` varchar(180) NOT NULL DEFAULT '' COMMENT '直接上传的形式，保存图片路径。',
  `repeater_content` text NOT NULL COMMENT '通过repeater组件存储数据',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `content` longtext COMMENT '内容。可以使用编辑器组件',
  `datetime` datetime NOT NULL COMMENT '时间',
  `daterange` varchar(300) DEFAULT '' COMMENT '时间范围',
  `file` varchar(120) NOT NULL DEFAULT '0' COMMENT '文件地址',
  `files` varchar(60) NOT NULL DEFAULT '' COMMENT '多个文件，id串存储形式',
  `region` varchar(255) NOT NULL DEFAULT '' COMMENT '地区组件数据存储',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '99' COMMENT '排序',
  `update_time` datetime NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '更新时间',
  `create_time` datetime NOT NULL DEFAULT '0001-01-01 00:00:00' COMMENT '创建时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态。0禁用，1正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='框架开发示例插件数据表';


INSERT INTO `eacoo_demo_example` (`id`, `title`, `email`, `password`, `sex`, `picture`, `pictures`, `image`, `repeater_content`, `description`, `content`, `datetime`,`daterange`, `file`, `files`, `region`, `sort`, `update_time`, `create_time`, `status`)
VALUES
	(1,'Builder表单示例数据','981248356@qq.com','123456',0,4,'94,95,96','/logo.png','[{\"img\":\"94\",\"url\":\"https:\\/\\/www.eacoophp.com\",\"text\":\"EacooPHP\\u5feb\\u901f\\u5f00\\u53d1\\u6846\\u67b6\"},{\"img\":\"95\",\"url\":\"https:\\/\\/forum.eacoophp.com\",\"text\":\"EacooPHP\\u8ba8\\u8bba\\u793e\\u533a\"},{\"img\":\"94\",\"url\":\"https:\\/\\/www.eacoophp.com\",\"text\":\"EacooPHP\\u5feb\\u901f\\u5f00\\u53d1\\u6846\\u67b6\"}]','默认描述内容','<p></p><p>默认内容<br></p>','2018-03-02 16:38:35','','/uploads/attachment/2016-07-27/579857b5aca95.mp3','10,12','{\"province\":\"1\",\"city\":\"2\",\"area\":\"83\"}',99,'2018-09-30 22:32:26','2018-09-30 22:32:26',1);

