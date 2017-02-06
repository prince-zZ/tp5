/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-01-20 18:11:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `think_administrator`
-- ----------------------------
DROP TABLE IF EXISTS `think_administrator`;
CREATE TABLE `think_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` char(3) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(100) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `rbac` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_administrator
-- ----------------------------
INSERT INTO `think_administrator` VALUES ('1', 'ADMIN', 'admin', '8bfa1a68eb8670d1a591ea70373c45b1', '112', '13888888888', '1', '587dd04f00608_thumb.jpg', '127.0.0.1', '1484902513', '1484931313', '1463362516', '1484791331', '1');
INSERT INTO `think_administrator` VALUES ('2', 'Editor', 'editor', 'df620c97d6c8a15b672191fe11b9a886', '519', '13888888888', '-1', null, '127.0.0.1', '1470748703', '1470777503', '1463363564', '1480649544', null);

-- ----------------------------
-- Table structure for `think_classification`
-- ----------------------------
DROP TABLE IF EXISTS `think_classification`;
CREATE TABLE `think_classification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '分类名称',
  `pid` int(11) NOT NULL COMMENT '分类id',
  `markname` varchar(11) DEFAULT NULL COMMENT '唯一标示',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `num` int(11) DEFAULT '0' COMMENT '数字最大在最前面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_classification
-- ----------------------------
INSERT INTO `think_classification` VALUES ('1', '首页', '0', 'sy', '1484807085', '10000');
INSERT INTO `think_classification` VALUES ('2', '关于我', '0', 'gyw', '1484807123', '1000');
INSERT INTO `think_classification` VALUES ('3', '慢生活', '0', 'msh', '1484807164', '999');
INSERT INTO `think_classification` VALUES ('4', '碎言碎语', '0', 'sysy', '1484807189', '998');
INSERT INTO `think_classification` VALUES ('5', '资源分享', '0', 'zyfx', '1484807208', '997');
INSERT INTO `think_classification` VALUES ('6', '学无止境', '0', 'xwzj', '1484807226', '996');
INSERT INTO `think_classification` VALUES ('7', '留言版', '0', 'lyb', '1484807241', '995');
INSERT INTO `think_classification` VALUES ('8', '日志', '3', 'rz', '1484807296', '10000');
INSERT INTO `think_classification` VALUES ('9', '心得笔记', '6', 'xdzj', '1484807353', '10000');
INSERT INTO `think_classification` VALUES ('10', 'CSS3|Html5', '6', 'csshtml', '1484807387', '1000');
INSERT INTO `think_classification` VALUES ('11', 'PHP笔记', '6', 'phpbj', '1484807421', '1000');

-- ----------------------------
-- Table structure for `think_config`
-- ----------------------------
DROP TABLE IF EXISTS `think_config`;
CREATE TABLE `think_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_config
-- ----------------------------
INSERT INTO `think_config` VALUES ('1', '网站标题', 'Small island blog', '1484635977');

-- ----------------------------
-- Table structure for `think_count`
-- ----------------------------
DROP TABLE IF EXISTS `think_count`;
CREATE TABLE `think_count` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(30) DEFAULT NULL COMMENT 'IP地址',
  `pid` int(11) DEFAULT NULL COMMENT '文章Id',
  `add_time` int(11) DEFAULT NULL COMMENT '下次浏览统计时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_count
-- ----------------------------
INSERT INTO `think_count` VALUES ('1', '127.0.0.1', '1', '1484883392');

-- ----------------------------
-- Table structure for `think_friendship`
-- ----------------------------
DROP TABLE IF EXISTS `think_friendship`;
CREATE TABLE `think_friendship` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '标题',
  `link` varchar(100) DEFAULT NULL COMMENT '网址',
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_friendship
-- ----------------------------


-- ----------------------------
-- Table structure for `think_journal`
-- ----------------------------
DROP TABLE IF EXISTS `think_journal`;
CREATE TABLE `think_journal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `ip` char(20) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_journal
-- ----------------------------


-- ----------------------------
-- Table structure for `think_linkip`
-- ----------------------------
DROP TABLE IF EXISTS `think_linkip`;
CREATE TABLE `think_linkip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(30) DEFAULT NULL COMMENT 'IP地址',
  `title` varchar(50) DEFAULT NULL COMMENT '备注',
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_linkip
-- ----------------------------

-- ----------------------------
-- Table structure for `think_posts`
-- ----------------------------
DROP TABLE IF EXISTS `think_posts`;
CREATE TABLE `think_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_content` longtext,
  `post_title` text NOT NULL,
  `post_excerpt` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) DEFAULT '',
  `comment_count` bigint(20) DEFAULT '0',
  `feature_image` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '分类',
  `type` tinyint(3) DEFAULT '0' COMMENT '是否设置为推荐',
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`status`,`create_time`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_posts
-- ----------------------------
INSERT INTO `think_posts` VALUES ('1', '1', '<p>Android XML代码</p>\r\n\r\n<p><img alt=\"\" src=\"/userfiles/images/20170119112115.png\" style=\"height:471px; width:787px\" /></p>\r\n\r\n<p>红色框里面代表这个APP项目的路径 如何用HTML唤醒如下</p>\r\n\r\n<p><img alt=\"\" src=\"/userfiles/images/20170119112648.png\" style=\"height:481px; width:787px\" /></p>\r\n\r\n<p>IPhone 代码如下</p>\r\n\r\n<p><img alt=\"\" src=\"/userfiles/images/20170119113010.png\" style=\"width:700px\" /></p>\r\n\r\n<p>如果还是不懂请在留言版留言</p>\r\n', '【HTML唤起APP】看我是如何唤起的APP', '', '1', 'opened', '', '1', '5880337d5973a_thumb.jpg', '1484795839', '1484806223', '10', '1');

-- ----------------------------
-- Table structure for `think_rbac`
-- ----------------------------
DROP TABLE IF EXISTS `think_rbac`;
CREATE TABLE `think_rbac` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '控制器方法',
  `title` text COMMENT '控制器名字',
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_rbac
-- ----------------------------
INSERT INTO `think_rbac` VALUES ('1', '超级管理员', 'a:52:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"5\";i:3;s:1:\"6\";i:4;s:1:\"4\";i:5;s:1:\"7\";i:6;s:1:\"8\";i:7;s:1:\"9\";i:8;s:2:\"10\";i:9;s:2:\"11\";i:10;s:2:\"12\";i:11;s:2:\"13\";i:12;s:2:\"14\";i:13;s:2:\"15\";i:14;s:2:\"16\";i:15;s:2:\"17\";i:16;s:2:\"18\";i:17;s:2:\"19\";i:18;s:2:\"20\";i:19;s:2:\"22\";i:20;s:2:\"23\";i:21;s:2:\"24\";i:22;s:2:\"25\";i:23;s:2:\"21\";i:24;s:2:\"26\";i:25;s:1:\"1\";i:26;s:2:\"27\";i:27;s:2:\"28\";i:28;s:2:\"29\";i:29;s:2:\"30\";i:30;s:2:\"31\";i:31;s:2:\"32\";i:32;s:2:\"33\";i:33;s:2:\"34\";i:34;s:2:\"35\";i:35;s:2:\"36\";i:36;s:2:\"37\";i:37;s:2:\"38\";i:38;s:2:\"39\";i:39;s:2:\"40\";i:40;s:2:\"41\";i:41;s:2:\"42\";i:42;s:2:\"43\";i:43;s:2:\"44\";i:44;s:2:\"45\";i:45;s:2:\"46\";i:46;s:2:\"47\";i:47;s:2:\"48\";i:48;s:2:\"49\";i:49;s:2:\"50\";i:50;s:2:\"51\";i:51;s:2:\"52\";}', '1484816559');

-- ----------------------------
-- Table structure for `think_rbac_name`
-- ----------------------------
DROP TABLE IF EXISTS `think_rbac_name`;
CREATE TABLE `think_rbac_name` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '控制器方法',
  `title` varchar(30) DEFAULT NULL COMMENT '控制器名字',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of think_rbac_name
-- ----------------------------
INSERT INTO `think_rbac_name` VALUES ('2', '/administrator/index', '管理员列表');
INSERT INTO `think_rbac_name` VALUES ('3', '/administrator/read', '管理员列表->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('5', '/administrator/create', '管理员列表->添加表单');
INSERT INTO `think_rbac_name` VALUES ('6', '/administrator/add', '管理员列表->添加');
INSERT INTO `think_rbac_name` VALUES ('4', '/administrator/update', '管理员列表->编辑');
INSERT INTO `think_rbac_name` VALUES ('7', '/administrator/upload', '管理员列表->图片上传');
INSERT INTO `think_rbac_name` VALUES ('8', '/administrator/delete', '管理员列表->删除');
INSERT INTO `think_rbac_name` VALUES ('9', '/administrator/delete_image', '管理员列表->图片删除');
INSERT INTO `think_rbac_name` VALUES ('10', '/administrator/update_expire_time', '管理员列表->修改使过期');
INSERT INTO `think_rbac_name` VALUES ('11', '/posts/index', '文章列表');
INSERT INTO `think_rbac_name` VALUES ('12', '/posts/create', '文章列表->添加表单');
INSERT INTO `think_rbac_name` VALUES ('13', '/posts/add', '文章列表>添加');
INSERT INTO `think_rbac_name` VALUES ('14', '/posts/read', '文章列表->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('15', '/posts/update', '文章列表->编辑');
INSERT INTO `think_rbac_name` VALUES ('16', '/posts/upload', '文章列表->图片上传');
INSERT INTO `think_rbac_name` VALUES ('17', '/posts/delete', '文章列表->删除');
INSERT INTO `think_rbac_name` VALUES ('18', '/posts/delete_image', '文章列表->图片删除');
INSERT INTO `think_rbac_name` VALUES ('19', '/rbac/index', '权限列表');
INSERT INTO `think_rbac_name` VALUES ('20', '/rbac/create', '权限列表->添加权限规则');
INSERT INTO `think_rbac_name` VALUES ('22', '/rbac/rbac', '权限列表->查看权限');
INSERT INTO `think_rbac_name` VALUES ('23', '/rbac/rbacadd', '权限列表->添加权限');
INSERT INTO `think_rbac_name` VALUES ('24', '/rbac/rbacedit', '权限列表->修改权限');
INSERT INTO `think_rbac_name` VALUES ('25', '/rbac/delete', '权限列表->权限规则删除');
INSERT INTO `think_rbac_name` VALUES ('21', '/rbac/createedit', '权限列表->编辑权限规则');
INSERT INTO `think_rbac_name` VALUES ('26', '/rbac/del', '权限列表->权限删除');
INSERT INTO `think_rbac_name` VALUES ('1', '/index/index', '首页');
INSERT INTO `think_rbac_name` VALUES ('27', '/classification/index', '分类列表');
INSERT INTO `think_rbac_name` VALUES ('28', '/classification/create', '分类列表->添加表单');
INSERT INTO `think_rbac_name` VALUES ('29', '/classification/add', '分类列表->添加');
INSERT INTO `think_rbac_name` VALUES ('30', '/classification/read', '分类列表->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('31', '/classification/update', '分类列表->编辑');
INSERT INTO `think_rbac_name` VALUES ('32', '/classification/delete', '分类列表->删除');
INSERT INTO `think_rbac_name` VALUES ('33', '/friendship/index', '友情链接列表');
INSERT INTO `think_rbac_name` VALUES ('34', '/friendship/create', '友情链接列表->添加表单');
INSERT INTO `think_rbac_name` VALUES ('35', '/friendship/add', '友情链接列表->添加');
INSERT INTO `think_rbac_name` VALUES ('36', '/friendship/read', '友情链接列表->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('37', '/friendship/update', '友情链接列表->编辑');
INSERT INTO `think_rbac_name` VALUES ('38', '/friendship/delete', '友情链接列表->删除');
INSERT INTO `think_rbac_name` VALUES ('39', '/configure/index', '基本配置->网站配置');
INSERT INTO `think_rbac_name` VALUES ('40', '/configure/create', '基本配置->网站配置->添加表单');
INSERT INTO `think_rbac_name` VALUES ('41', '/configure/add', '基本配置->网站配置->添加');
INSERT INTO `think_rbac_name` VALUES ('42', '/configure/read', '基本配置->网站配置->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('43', '/configure/update', '基本配置->网站配置->编辑');
INSERT INTO `think_rbac_name` VALUES ('44', '/configure/delete', '基本配置->网站配置->删除');
INSERT INTO `think_rbac_name` VALUES ('45', '/configure/cache', '基本配置->清空缓存');
INSERT INTO `think_rbac_name` VALUES ('46', '/configure/journal', '基本配置->查看日志');
INSERT INTO `think_rbac_name` VALUES ('47', '/configure/linkip', '基本配置->指定IP列表');
INSERT INTO `think_rbac_name` VALUES ('48', '/configure/createip', '基本配置->指定IP列表->添加表单');
INSERT INTO `think_rbac_name` VALUES ('49', '/configure/addip', '基本配置->指定IP列表->添加');
INSERT INTO `think_rbac_name` VALUES ('50', '/configure/readip', '基本配置->指定IP列表->编辑表单');
INSERT INTO `think_rbac_name` VALUES ('51', '/configure/updateip', '基本配置->指定IP列表->编辑');
INSERT INTO `think_rbac_name` VALUES ('52', '/configure/deleteip', '基本配置->指定IP列表->删除');
