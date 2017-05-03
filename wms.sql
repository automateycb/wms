-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-28 08:07:33
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wms`
--

-- --------------------------------------------------------

--
-- 表的结构 `wms_admin`
--

CREATE TABLE IF NOT EXISTS `wms_admin` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `nickname` varchar(16) DEFAULT NULL COMMENT '昵称',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `nickname` (`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `wms_admin`
--

INSERT INTO `wms_admin` (`id`, `nickname`, `username`, `password`, `tel`, `email`, `create_time`) VALUES
(41, 'admin_test', 'admin_test', '5701e1fc38a45821bc7687a3d8530720', '13544060490', 'admin@tcl.com', 1493347924),
(42, 'yanchaobin', 'yanchaobin', '4492089a478d6217e52d1768054e571a', '13544060490', 'yanchaobin@tcl.com', 1493359635);

-- --------------------------------------------------------

--
-- 表的结构 `wms_admin_role`
--

CREATE TABLE IF NOT EXISTS `wms_admin_role` (
  `role_id` mediumint(12) unsigned NOT NULL COMMENT '角色id',
  `admin_id` mediumint(12) unsigned NOT NULL COMMENT '用户id',
  KEY `role_id` (`role_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wms_admin_role`
--

INSERT INTO `wms_admin_role` (`role_id`, `admin_id`) VALUES
(1, 41),
(1, 42);

-- --------------------------------------------------------

--
-- 表的结构 `wms_attribute`
--

CREATE TABLE IF NOT EXISTS `wms_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `type` enum('range','number','radio','file','checkbox','button','week','time','date','password','text','email','url','month','tel','search','select','color') DEFAULT 'text',
  `content` varchar(200) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `wms_attribute`
--

INSERT INTO `wms_attribute` (`id`, `name`, `type`, `content`, `note`, `time`, `status`) VALUES
(28, '号码', 'checkbox', '34,35,36,37,38,39,40,41,42,43,44,45,46', '鞋子号码', 1461557423, 0),
(29, '颜色', 'checkbox', '白色,黑色,蓝色,绿色,紫色,红色,天蓝色', '鞋子颜色', 1461557664, 0),
(31, '出厂日期', 'date', '', '出厂日期', 1461571851, 0),
(32, '号码', 'checkbox', 'XS,S,M,L,XL,XXL,XXXL', '衣服尺寸', 1461808173, 0),
(33, '颜色', 'checkbox', '白色,黑色,蓝色,绿色,紫色,红色,天蓝色', '衣服', 1461831605, 0),
(34, '季节', 'select', '春秋,夏季,冬季', '鞋子季节', 1461831862, 0),
(35, '材质', 'text', '', '鞋子的材质', 1461831994, 0),
(36, '款式', 'select', '商务,休闲,运动,韩版,英伦', '鞋子款式', 1461832335, 0),
(37, '适用对象', 'select', '儿童(6-18),青年(18-25周岁),中年(26-40),中老年(40-50),老年(50以上)', '鞋子适用对象', 1461832510, 1),
(38, '闭合方式', 'select', '系带,拉链', '鞋子闭合方式', 1461832716, 1),
(39, '鞋跟', 'select', '平底,中跟,高跟,内增高', '鞋子鞋跟样式', 1461832801, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wms_brand`
--

CREATE TABLE IF NOT EXISTS `wms_brand` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `wms_brand`
--

INSERT INTO `wms_brand` (`id`, `name`, `time`) VALUES
(10, 'HP', 1483323962),
(11, 'Mitsubishi', 1484103384),
(12, '三星', 1489133677),
(13, 'LG', 1489133703);

-- --------------------------------------------------------

--
-- 表的结构 `wms_category`
--

CREATE TABLE IF NOT EXISTS `wms_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品分类' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `wms_category`
--

INSERT INTO `wms_category` (`id`, `name`, `time`) VALUES
(1, 'PLC', 1461307800),
(10, '服务器', 1483324077),
(11, '显示器', 1484103617);

-- --------------------------------------------------------

--
-- 表的结构 `wms_category_attribute`
--

CREATE TABLE IF NOT EXISTS `wms_category_attribute` (
  `category_id` mediumint(12) unsigned NOT NULL COMMENT '鍟嗗搧id',
  `attribute_id` mediumint(12) unsigned NOT NULL COMMENT '灞炴€d'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wms_category_attribute`
--

INSERT INTO `wms_category_attribute` (`category_id`, `attribute_id`) VALUES
(1, 28),
(1, 29),
(4, 30),
(1, 31),
(2, 32),
(2, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39);

-- --------------------------------------------------------

--
-- 表的结构 `wms_contacts`
--

CREATE TABLE IF NOT EXISTS `wms_contacts` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(16) DEFAULT NULL COMMENT '昵称',
  `phone` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `wms_contacts`
--

INSERT INTO `wms_contacts` (`id`, `name`, `phone`) VALUES
(1, '张三', 110),
(2, '李四', 120),
(3, '张三', NULL),
(4, '李四', NULL),
(5, '张三', NULL),
(6, '李四', NULL),
(7, '李丹', NULL),
(8, '王麻子', NULL),
(9, 'SB', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wms_file`
--

CREATE TABLE IF NOT EXISTS `wms_file` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `depict` varchar(50) NOT NULL,
  `filepath` varchar(50) NOT NULL,
  `dateline` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `wms_file`
--

INSERT INTO `wms_file` (`id`, `filename`, `depict`, `filepath`, `dateline`) VALUES
(1, '58cb8a298efc7.jpg', '', '2017-03-17/', '2017-03-17 15:03:05'),
(2, '58cb8a637a86f.txt', '', '2017-03-17/', '2017-03-17 15:03:03'),
(3, '58cb8aa48819f.txt', '', '2017-03-17/', '2017-03-17 15:03:08'),
(5, '58cb8c3551a87.txt', '', '2017-03-17/', '2017-03-17 15:03:49'),
(6, '58cb9912f3655.pdf', '', '2017-03-17/', '2017-03-17 16:03:42'),
(7, '58cb9a445fd44.docx', '', '2017-03-17/', '2017-03-17 16:03:48'),
(8, '58cb9d3d3fbcb.txt', '', '2017-03-17/', '2017-03-17 16:03:29'),
(9, '58cb9e0e0e6bb.txt', '', '2017-03-17/', '2017-03-17 16:03:58'),
(10, '58cb9e2faedeb.docx', '', '2017-03-17/', '2017-03-17 16:03:31'),
(11, '58cb9fdb403ff.docx', '', '2017-03-17/', '2017-03-17 16:03:39'),
(12, '58cba120739df.txt', '', '2017-03-17/', '2017-03-17 16:03:04'),
(13, '58cba17861037.txt', '', '2017-03-17/', '2017-03-17 16:03:32'),
(14, '58cba1a4b0367.txt', '', '2017-03-17/', '2017-03-17 16:03:16'),
(15, '58cba1eeb8e77.docx', '', '2017-03-17/', '2017-03-17 16:03:30'),
(16, '58cbabe3b4dca.docx', '', '2017-03-17/', '2017-03-17 17:03:59');

-- --------------------------------------------------------

--
-- 表的结构 `wms_goods`
--

CREATE TABLE IF NOT EXISTS `wms_goods` (
  `id` mediumint(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sn` varchar(60) DEFAULT NULL COMMENT 'sn',
  `name` varchar(60) NOT NULL COMMENT '名称',
  `asset_number` varchar(60) NOT NULL COMMENT '资产编号',
  `position` varchar(60) NOT NULL COMMENT '仓库位置',
  `brand_id` mediumint(9) unsigned NOT NULL COMMENT '品牌id',
  `time` int(11) unsigned DEFAULT NULL COMMENT '时间',
  `price` decimal(10,2) DEFAULT NULL COMMENT '单价',
  `sum` mediumint(12) unsigned DEFAULT NULL COMMENT '数量',
  `total` decimal(12,2) unsigned DEFAULT NULL COMMENT '总价',
  `output_sum` mediumint(12) unsigned DEFAULT '0' COMMENT '出库总数',
  `stock` mediumint(12) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`) USING BTREE,
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `wms_goods`
--

INSERT INTO `wms_goods` (`id`, `sn`, `name`, `asset_number`, `position`, `brand_id`, `time`, `price`, `sum`, `total`, `output_sum`, `stock`) VALUES
(30, '1', 'Q06', '1234', '研发楼6楼', 11, 1488443232, '3000.00', 450, '60000.00', 30, 420),
(32, '3', '19寸显示器', '5423', '6楼', 12, 1489132652, '2332.00', 500, '53636.00', 209, 291),
(34, '2', 'DL320', '123445', '6F', 10, 1489549009, '12000.00', 415, '600000.00', 50, 365),
(35, '4', 'DL380 Gen8', '12356', '6F ', 10, 1489549042, '26000.00', 500, '2600000.00', 355, 145),
(36, '', 'DL380 gen9', 'qqqq', '6F', 10, 1489974892, '120.00', 234, '28080.00', 184, 50);

-- --------------------------------------------------------

--
-- 表的结构 `wms_goods_attrbute`
--

CREATE TABLE IF NOT EXISTS `wms_goods_attrbute` (
  `goods_id` mediumint(9) unsigned DEFAULT NULL,
  `attrbute_id` mediumint(9) unsigned DEFAULT NULL,
  `attrbute_value` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL,
  `count` mediumint(12) unsigned DEFAULT NULL,
  `val` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wms_goods_attrbute`
--

INSERT INTO `wms_goods_attrbute` (`goods_id`, `attrbute_id`, `attrbute_value`, `price`, `count`, `val`) VALUES
(17, 0, '39:白色 ', '30.00', 39, NULL),
(17, 0, '39:黑色 ', '30.00', 39, NULL),
(17, 0, '40:白色 ', '30.00', 14, NULL),
(17, 0, '40:黑色 ', '30.00', 40, NULL),
(17, 39, NULL, NULL, NULL, '平底'),
(17, 36, NULL, NULL, NULL, '商务'),
(17, 35, NULL, NULL, NULL, '皮革'),
(17, 34, NULL, NULL, NULL, '春秋'),
(17, 31, NULL, NULL, NULL, '2016-05-04'),
(18, 0, 'XS:白色 ', '30.00', 9, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wms_goods_category`
--

CREATE TABLE IF NOT EXISTS `wms_goods_category` (
  `goods_id` mediumint(9) unsigned NOT NULL,
  `category_id` mediumint(9) unsigned NOT NULL,
  KEY `category_id` (`category_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wms_goods_category`
--

INSERT INTO `wms_goods_category` (`goods_id`, `category_id`) VALUES
(21, 1),
(100, 1),
(101, 1),
(18, 10),
(19, 10),
(20, 11),
(21, 11),
(22, 1),
(17, 1),
(23, 10),
(24, 1),
(30, 1),
(34, 10),
(35, 10),
(32, 11),
(36, 10),
(0, 10),
(0, 10),
(39, 10),
(40, 10),
(41, 10),
(42, 10),
(43, 10),
(44, 10),
(45, 10),
(46, 10);

-- --------------------------------------------------------

--
-- 表的结构 `wms_issue`
--

CREATE TABLE IF NOT EXISTS `wms_issue` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(16) DEFAULT NULL COMMENT '问题名称',
  `username` varchar(16) NOT NULL COMMENT '提问人',
  `issuecategory_id` varchar(15) DEFAULT NULL COMMENT '问题类型',
  `time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `description` varchar(100) DEFAULT NULL COMMENT '问题类型',
  `status` varchar(15) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='问题表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `wms_issue`
--

INSERT INTO `wms_issue` (`id`, `name`, `username`, `issuecategory_id`, `time`, `description`, `status`) VALUES
(27, '无法登陆', '严超彬', '11', 1489913256, '账号正确，但无法登陆', '提交'),
(28, '无法注册', '严超彬', '20', 1489913584, '用户无法注册', '提交'),
(29, '库存模块卡死', '严超彬', '15', 1489913822, '库存模块存在卡死现象', '提交');

-- --------------------------------------------------------

--
-- 表的结构 `wms_issuecategory`
--

CREATE TABLE IF NOT EXISTS `wms_issuecategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='问题分类' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `wms_issuecategory`
--

INSERT INTO `wms_issuecategory` (`id`, `name`, `time`) VALUES
(15, '使用类型', 1489904880),
(20, '开发类型', 1489913495),
(21, '建议类型', 1489913527);

-- --------------------------------------------------------

--
-- 表的结构 `wms_node`
--

CREATE TABLE IF NOT EXISTS `wms_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(20) NOT NULL COMMENT '名字',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT NULL COMMENT '排序',
  `pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `level` tinyint(1) unsigned NOT NULL COMMENT '级别',
  PRIMARY KEY (`id`),
  KEY `idx_level` (`level`),
  KEY `idx_pid` (`pid`),
  KEY `idx_status` (`status`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限节点' AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `wms_node`
--

INSERT INTO `wms_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'Admin', '后台管理', 1, 'WMS后台管理系统', 0, 0, 1),
(2, 'News', '资讯管理', 1, '', 0, 1, 2),
(3, 'index', '资讯列表', 1, '', 0, 2, 3),
(4, 'add', '添加', 1, '', 0, 2, 3),
(5, 'edit', '编辑', 1, '', 0, 2, 3),
(6, 'status', '启用/禁用', 1, '', 0, 2, 3),
(7, 'del', '删除', 1, '', 0, 2, 3),
(8, 'category', '资讯分类', 1, '', 0, 2, 3),
(9, 'Link', '链接管理', 1, '', 0, 1, 2),
(10, 'index', '链接列表', 1, '', 0, 9, 3),
(11, 'add', '添加', 1, '', 0, 9, 3),
(12, 'edit', '编辑', 1, '', 0, 9, 3),
(13, 'status', '启用/禁用', 1, '', 0, 9, 3),
(14, 'del', '删除', 1, '', 0, 9, 3),
(15, 'details', '详情', 1, '', 0, 9, 3),
(16, 'Ad', '广告管理', 1, '', 0, 1, 2),
(17, 'index', '广告列表', 1, '', 0, 16, 3),
(18, 'add', '添加', 1, '', 0, 16, 3),
(19, 'edit', '编辑', 1, '', 0, 16, 3),
(20, 'status', '启用/禁用', 1, '', 0, 16, 3),
(21, 'del', '删除', 1, '', 0, 16, 3),
(22, 'details', '详情', 1, '', 0, 16, 3),
(23, 'User', '用户管理', 1, '', 0, 1, 2),
(24, 'index', '用户列表', 1, '', 0, 23, 3),
(26, 'del', '删除', 1, '', 0, 23, 3),
(27, 'details', '详情', 1, '', 0, 23, 3),
(28, 'Admin', '管理员管理', 1, '', 0, 1, 2),
(29, 'index', '管理员列表', 1, '', 0, 28, 3),
(30, 'add', '添加', 1, '', 0, 28, 3),
(31, 'edit', '编辑', 1, '', 0, 28, 3),
(32, 'status', '启用/禁用', 1, '', 0, 28, 3),
(33, 'del', '删除', 1, '', 0, 28, 3),
(34, 'details', '详情', 1, '', 0, 28, 3),
(35, 'Config', '配置管理', 1, '', 0, 1, 2),
(36, 'index', '列表+编辑', 1, '', 0, 35, 3),
(37, 'add', '添加', 1, '', 0, 35, 3),
(38, 'Access', '权限管理', 1, '', 0, 1, 2),
(39, 'index', '节点列表', 1, '', 0, 38, 3),
(40, 'addNode', '添加节点', 1, '', 0, 38, 3),
(41, 'editNode', '编辑节点', 1, '', 0, 38, 3),
(42, 'opSort', '节点排序', 1, '', 0, 38, 3),
(43, 'opNodeStatus', '启用/禁用(节点)', 1, '', 0, 38, 3),
(44, 'delNode', '删除节点', 1, '', 0, 38, 3),
(45, 'roleList', '角色列表', 1, '', 0, 38, 3),
(46, 'addRole', '添加角色', 1, '', 0, 38, 3),
(47, 'editRole', '编辑角色', 1, '', 0, 38, 3),
(48, 'opRoleStatus', '启用/禁用(角色)', 1, '', 0, 38, 3),
(49, 'changeRole', '分配权限', 1, '', 0, 38, 3),
(50, 'Db', '数据库管理', 1, '', 0, 1, 2),
(51, 'index', '数据表列表', 1, '', 0, 50, 3),
(52, 'restore', '导入列表', 1, '', 0, 50, 3),
(53, 'zipList', '压缩包列表', 1, '', 0, 50, 3),
(54, 'repair', '优化与修复', 1, '', 0, 50, 3),
(55, 'status', '禁用/启用', 1, '', 0, 23, 3),
(56, 'restoreData', '导入', 1, '', 0, 50, 3),
(57, 'delSqlFiles', '删除SQL文件', 1, '', 0, 50, 3),
(58, 'sendSql', '发送邮箱', 1, '', 0, 50, 3),
(59, 'zipSql', '压缩为ZIP', 1, '', 0, 50, 3),
(60, 'unzipSqlfile', '解压缩为SQL', 1, '', 0, 50, 3),
(61, 'delZipFiles', '删除ZIP文件', 1, '', 0, 50, 3),
(62, 'downFile', '下载文件', 1, '', 0, 50, 3),
(63, 'Template', '模板管理', 1, '', 0, 1, 2),
(64, 'index', '文件列表', 1, '', 0, 63, 3),
(65, 'downFile', '下载文件', 1, '', 0, 63, 3),
(66, 'edit', '编辑', 1, '', 0, 63, 3),
(67, 'mkdir', '创建文件夹', 1, '', 0, 63, 3),
(68, 'reName', '重命名', 1, '', 0, 63, 3),
(69, 'delFile', '删除文件', 1, '', 0, 63, 3),
(70, 'Oplog', '日志管理', 1, '', 0, 1, 2),
(71, 'index', '日志列表', 1, '', 0, 70, 3);

-- --------------------------------------------------------

--
-- 表的结构 `wms_oplog`
--

CREATE TABLE IF NOT EXISTS `wms_oplog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主id',
  `model` varchar(30) NOT NULL DEFAULT '' COMMENT '模块',
  `action` varchar(30) NOT NULL DEFAULT '' COMMENT '动作',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `admin_name` varchar(50) DEFAULT '' COMMENT '用户名',
  `role_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理角色id',
  `role_name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理角色',
  `bak` varchar(256) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='后台操作表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wms_oplog`
--

INSERT INTO `wms_oplog` (`id`, `model`, `action`, `admin_id`, `admin_name`, `role_id`, `role_name`, `bak`, `create_time`) VALUES
(1, 'Public', 'loginout', 1, 'admin', 1, '管理员', '退出', 1406110377),
(2, 'Public', 'index', 1, 'admin', 1, '超级管理员', '登录', 1406110389);

-- --------------------------------------------------------

--
-- 表的结构 `wms_position`
--

CREATE TABLE IF NOT EXISTS `wms_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT '职位名称',
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='职位表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wms_position`
--

INSERT INTO `wms_position` (`id`, `name`, `time`) VALUES
(1, '店长', 1461291852),
(2, '职员', 1461291852);

-- --------------------------------------------------------

--
-- 表的结构 `wms_privilege`
--

CREATE TABLE IF NOT EXISTS `wms_privilege` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(60) NOT NULL COMMENT '权限名称',
  `parent_id` mediumint(11) unsigned DEFAULT '0' COMMENT '父级id',
  `controller` varchar(20) DEFAULT NULL,
  `module` varchar(20) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `wms_privilege`
--

INSERT INTO `wms_privilege` (`id`, `name`, `parent_id`, `controller`, `module`, `action`) VALUES
(1, '超级管理员', 0, '---', '---', '---'),
(2, '角色管理', 0, 'Role', 'Role', 'index,add,edit,delete'),
(3, '用户管理', 0, 'Account', 'User', 'index,add,edit,delete'),
(4, '物品品牌', 0, 'Brand', 'Brand', 'index,add,edit,delete'),
(5, '物品分类', 0, 'Category', 'Category', 'index,add,edit,delete'),
(6, '库存管理', 0, 'Goods', 'Goods', 'index,add,edit,delete'),
(7, '职位管理', 0, 'Position', 'Position', 'index,add,edit,delete'),
(8, '权限管理', 0, 'Privilege', 'Privilege', 'index,add,edit,delete'),
(9, '区域管理', 0, 'Store', 'Store', 'index,add,edit,delete'),
(10, '管理员管理', 0, 'Admin', 'Admin', 'index,add,edit,delete'),
(11, '入库管理', 0, 'Input', 'Input', 'add,detail,edit,list'),
(12, '出库管理', 0, 'Output', 'Output', 'index,item,record'),
(13, '问题反馈', 0, 'Issue', 'Issue', 'add,list');

-- --------------------------------------------------------

--
-- 表的结构 `wms_record`
--

CREATE TABLE IF NOT EXISTS `wms_record` (
  `goods_id` mediumint(9) unsigned NOT NULL,
  `no` varchar(40) NOT NULL COMMENT '员工编号',
  `name` varchar(18) NOT NULL COMMENT '员工姓名',
  `create_time` int(11) NOT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `goods_name` varchar(80) NOT NULL,
  `count` mediumint(10) unsigned NOT NULL COMMENT '出库数量',
  `remark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出库记录';

-- --------------------------------------------------------

--
-- 表的结构 `wms_role`
--

CREATE TABLE IF NOT EXISTS `wms_role` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `wms_role`
--

INSERT INTO `wms_role` (`id`, `role_name`) VALUES
(1, '超级管理员'),
(11, '普通用户');

-- --------------------------------------------------------

--
-- 表的结构 `wms_role_privilege`
--

CREATE TABLE IF NOT EXISTS `wms_role_privilege` (
  `privliege_id` mediumint(12) unsigned NOT NULL COMMENT '权限id',
  `role_id` mediumint(12) unsigned NOT NULL COMMENT '角色id',
  KEY `role_id` (`role_id`),
  KEY `privliege_id` (`privliege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表，角色->权限';

--
-- 转存表中的数据 `wms_role_privilege`
--

INSERT INTO `wms_role_privilege` (`privliege_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(6, 11),
(11, 11),
(12, 11),
(13, 11),
(13, 11);

-- --------------------------------------------------------

--
-- 表的结构 `wms_role_user`
--

CREATE TABLE IF NOT EXISTS `wms_role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主id',
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '角色id',
  `user_id` char(32) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `idx_role_id` (`role_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户角色' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wms_role_user`
--

INSERT INTO `wms_role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, '1');

-- --------------------------------------------------------

--
-- 表的结构 `wms_store`
--

CREATE TABLE IF NOT EXISTS `wms_store` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `leader` varchar(30) DEFAULT NULL COMMENT '负责人，领导人',
  `name` varchar(60) NOT NULL COMMENT '门店名称',
  `tel` varchar(20) DEFAULT NULL,
  `address` varchar(100) NOT NULL COMMENT '地址',
  `desc` varchar(200) DEFAULT NULL,
  `create_time` varchar(20) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `leader` (`leader`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='门店表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wms_store`
--

INSERT INTO `wms_store` (`id`, `leader`, `name`, `tel`, `address`, `desc`, `create_time`, `status`) VALUES
(1, '李先生', '东创科技园金枫路分店', '0512-5689107', '江苏省苏州市', '描述', '2016-04-14', 0),
(2, '李先生', '观前街分店', '0512-5689108', '苏州市观前街', '描述内容', '2016-04-14', 0),
(3, '赵先生', '工业园区湖东分店', '0512-5689105', '江苏省苏州市工业园区湖东', '描述', '2016-04-14', 0),
(4, '李先生', '苏州市高新区木渎分店', '0512-5689102', '苏州市高新区木渎分店', '苏州市高新区木渎分店', '2016-04-22', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wms_user`
--

CREATE TABLE IF NOT EXISTS `wms_user` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `nickname` varchar(16) DEFAULT NULL COMMENT '昵称',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，0正常 1禁止 2删除',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `nickname` (`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `wms_user`
--

INSERT INTO `wms_user` (`id`, `nickname`, `username`, `password`, `status`, `create_time`) VALUES
(13, '布尔', 'bool', 'c506ff134babdd6e68ab3e6350e95305', 0, 1460968251),
(14, '毛毛', 'maomao', '4a8a08f09d37b73795649038408b5f33', 0, 1460969225),
(15, '布尔', 'a', '4a8a08f09d37b73795649038408b5f33', 0, 1460970912),
(16, '测试', 'b', '4a8a08f09d37b73795649038408b5f33', 0, 1460970931),
(17, 'ColorRabbit', 'ColorRabbit', '3e21a1642f4596362cf77c25c6d7a9d7', 0, 1461315134),
(18, '毛毛', 'maomao1', '202cb962ac59075b964b07152d234b70', 0, 1461721685);

-- --------------------------------------------------------

--
-- 表的结构 `wms_userinfo`
--

CREATE TABLE IF NOT EXISTS `wms_userinfo` (
  `id` mediumint(11) unsigned NOT NULL,
  `no` varchar(25) DEFAULT NULL,
  `qq` int(11) unsigned DEFAULT NULL COMMENT 'qq',
  `tel` varchar(15) DEFAULT NULL COMMENT '电话',
  `email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `sex` enum('女','男') DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `post` int(7) DEFAULT NULL,
  `store_id` int(11) unsigned NOT NULL,
  KEY `store_id` (`store_id`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wms_userinfo`
--

INSERT INTO `wms_userinfo` (`id`, `no`, `qq`, `tel`, `email`, `sex`, `position`, `address`, `post`, `store_id`) VALUES
(13, '2016', 30024167, '18101565682', '30024167@qq.com', '男', 2, '江苏省苏州市工业园区', 267000, 1),
(14, '44444444', 123456, '1414141414', '141414@qq.com', '男', 2, '河南省商丘市', 267000, 2),
(15, '123', 1222, '123', '1', '男', 1, '1', 233, 3),
(16, 'b', 1233, '123456', '123456@qq.com', '男', 2, '江苏省苏州市', 123, 1),
(17, 'CR20160422', 0, '', '', '男', 1, '', 0, 2),
(18, 'mao123', 0, '', '', '男', 2, '', 0, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
