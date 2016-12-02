# Host: 127.0.0.1  (Version: 5.5.47)
# Date: 2016-11-29 14:57:19
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "t_add_friends"
#

DROP TABLE IF EXISTS `t_add_friends`;
CREATE TABLE `t_add_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `friends_id` int(11) unsigned DEFAULT NULL COMMENT '添加用户id',
  `state` tinyint(3) unsigned DEFAULT NULL COMMENT '状态0未同意1同意2拒绝3删除',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `remarks` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `group_id` int(11) unsigned DEFAULT NULL COMMENT '分组id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='添加朋友';

#
# Data for table "t_add_friends"
#

INSERT INTO `t_add_friends` VALUES (1,1,2,0,1480327548,'备注',1),(2,3,1,1,1480386370,'备注',1),(3,4,1,2,1480386723,'备注',1);

#
# Structure for table "t_admin"
#

DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(36) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  `last_login` int(11) unsigned DEFAULT '0',
  `last_ip` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC COMMENT='后台管理员';

#
# Data for table "t_admin"
#


#
# Structure for table "t_authen"
#

DROP TABLE IF EXISTS `t_authen`;
CREATE TABLE `t_authen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师认证表';

#
# Data for table "t_authen"
#


#
# Structure for table "t_feed_back"
#

DROP TABLE IF EXISTS `t_feed_back`;
CREATE TABLE `t_feed_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `msg` text COLLATE utf8_bin COMMENT '反馈内容',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '反馈时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='意见反馈';

#
# Data for table "t_feed_back"
#

INSERT INTO `t_feed_back` VALUES (1,1,'我是用回  我要饭局i“”！！！！‘’‘’\'\'\'\'\'',1479369929);

#
# Structure for table "t_friendship"
#

DROP TABLE IF EXISTS `t_friendship`;
CREATE TABLE `t_friendship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `friends_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `remarks` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `group_id` int(11) unsigned DEFAULT NULL COMMENT '分组id',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除0不删除1删除',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '删除时间',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='好友关系表';

#
# Data for table "t_friendship"
#

INSERT INTO `t_friendship` VALUES (1,1,3,'王晓明',1,0,NULL,1480389463),(2,3,1,'备注',1,0,NULL,1480389463);

#
# Structure for table "t_group"
#

DROP TABLE IF EXISTS `t_group`;
CREATE TABLE `t_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '分组名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型0为系统默认1为用户',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除0不删除1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='分组信息';

#
# Data for table "t_group"
#

INSERT INTO `t_group` VALUES (1,'教师',0,NULL,NULL,0),(2,'家长',0,NULL,NULL,0),(3,'学生',0,NULL,NULL,0),(4,'嘻嘻',1,1,1480319803,0);

#
# Structure for table "t_invita_img"
#

DROP TABLE IF EXISTS `t_invita_img`;
CREATE TABLE `t_invita_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invita_id` int(11) unsigned DEFAULT NULL COMMENT '帖子id',
  `img_url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '帖子地址',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='帖子图片';

#
# Data for table "t_invita_img"
#

INSERT INTO `t_invita_img` VALUES (1,1,'/image/201611/25/1480057601260.jpg',1480059099),(2,2,'/image/201611/25/1480057601260.jpg',1480063083),(3,3,'/image/201611/25/1480057601260.jpg',1480063086),(4,4,'/image/201611/25/1480057601260.jpg',1480063090),(5,5,'/image/201611/25/1480057601260.jpg',1480063093),(6,6,'/image/201611/25/1480057601260.jpg',1480063096),(7,8,'/image/201611/25/1480057601260.jpg',1480313627),(8,9,'/image/201611/25/1480057601260.jpg',1480313987);

#
# Structure for table "t_invitation"
#

DROP TABLE IF EXISTS `t_invitation`;
CREATE TABLE `t_invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户类型1老师2学生3家长4普通用户',
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '标题',
  `content` text CHARACTER SET utf8 COMMENT '内容',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `reply_time` int(11) unsigned DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='帖子';

#
# Data for table "t_invitation"
#

INSERT INTO `t_invitation` VALUES (1,1,1,'标题','内容',1480059099,1480313803),(2,1,1,'标题1','内容1',1480063083,1480313814),(3,1,1,'标题2','内容2',1480063086,0),(4,1,1,'标题3','内容3',1480063090,0),(5,1,1,'标题4','内容4',1480063093,0),(6,1,1,'标题5','内容5',1480063096,0),(7,1,1,'标题6','内容6',1480063099,0),(8,1,1,'标题6','内容6',1480313627,NULL),(9,1,1,'标题6','内容6',1480313987,NULL);

#
# Structure for table "t_like"
#

DROP TABLE IF EXISTS `t_like`;
CREATE TABLE `t_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `invita_id` int(11) unsigned DEFAULT NULL COMMENT '帖子id',
  `is_like` tinyint(3) unsigned DEFAULT NULL COMMENT '是否点赞0不点赞1点赞',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='帖子点赞';

#
# Data for table "t_like"
#

INSERT INTO `t_like` VALUES (1,1,1,1,1480061701);

#
# Structure for table "t_phone_code"
#

DROP TABLE IF EXISTS `t_phone_code`;
CREATE TABLE `t_phone_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) COLLATE utf8_bin DEFAULT NULL COMMENT '手机号码',
  `code` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '手机验证码',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `num` int(11) DEFAULT NULL COMMENT '验证次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='手机短信验证';

#
# Data for table "t_phone_code"
#

INSERT INTO `t_phone_code` VALUES (1,'13071985489','456969',1479371938,0),(2,'18751950352','129782',1479371962,0);

#
# Structure for table "t_reply"
#

DROP TABLE IF EXISTS `t_reply`;
CREATE TABLE `t_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回帖用户id',
  `invita_id` int(11) unsigned DEFAULT NULL COMMENT '帖子id',
  `content` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '评论内容',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '回帖时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='回帖';

#
# Data for table "t_reply"
#

INSERT INTO `t_reply` VALUES (1,1,1,'我回复的内容',1480060366),(2,1,1,'我又回帖了',1480060555),(3,1,1,'我又回帖了',1480313796),(4,1,1,'我又回帖了22',1480313803),(5,1,2,'我又回帖了22',1480313814);

#
# Structure for table "t_token"
#

DROP TABLE IF EXISTS `t_token`;
CREATE TABLE `t_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '第三方token值',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型1 环信token',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='第三方token';

#
# Data for table "t_token"
#


#
# Structure for table "t_tribe"
#

DROP TABLE IF EXISTS `t_tribe`;
CREATE TABLE `t_tribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '部落名称',
  `number` int(11) DEFAULT NULL COMMENT '部落编号',
  `face` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '部落头像',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `im` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '环信帐号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='部落信息';

#
# Data for table "t_tribe"
#


#
# Structure for table "t_user"
#

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '姓名',
  `real_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '真实姓名',
  `face` varchar(500) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '头像',
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '手机',
  `email` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '邮箱',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别 1男2女 0未知',
  `password` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT '密码 md5',
  `token` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '唯一凭证',
  `personality` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '个性签名',
  `type` tinyint(3) DEFAULT NULL COMMENT '用户类型1老师2学生3家长4普通用户',
  `im` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '环信帐号',
  `create_time` int(10) DEFAULT NULL COMMENT '注册时间',
  `is_authen` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否认证 0未认证 1认证',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='用户表';

#
# Data for table "t_user"
#

INSERT INTO `t_user` VALUES (1,'我那逛街',NULL,'1','13071985489',NULL,1,'d553d148479a268914cecb77b2b88e6a','1|62ec5473202fd97fc75cf1ef58b7e917','我是最谁啊啊',1,'',1479364014,1),(2,'王杰',NULL,'','13071985481',NULL,0,'e10adc3949ba59abbe56e057f20f883e','2|06383373a84c73874faa1d958fa70e5c','',1,'',1480313894,0),(3,'王杰2',NULL,'','13071985482',NULL,0,'e10adc3949ba59abbe56e057f20f883e','3|32fb7938cf84e4abb0e5cfbbace3e895','',2,'',1480313908,0),(4,'王杰3',NULL,'','13071985483',NULL,0,'e10adc3949ba59abbe56e057f20f883e','4|9913dd90b23b26e263ade5bfb9f6ccf3','',3,'',1480313914,0),(5,'王杰4',NULL,'','13071985484',NULL,0,'e10adc3949ba59abbe56e057f20f883e','5|6e86a2067c3eccbc9d696a9d86de8445','',4,'',1480313920,0),(6,'王杰5',NULL,'','13071985485',NULL,0,'e10adc3949ba59abbe56e057f20f883e','6|18ce5974cd0419c64632ebb58e7ccbbd','',3,'',1480313930,0);
