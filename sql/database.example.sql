-- 六合彩彩票系统数据库结构

-- 房间表
CREATE TABLE `fn_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `roomadmin` varchar(255) NOT NULL,
  `roompass` varchar(255) NOT NULL,
  `roomtime` datetime NOT NULL,
  `version` varchar(50) NOT NULL DEFAULT '标准版',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 六合彩设置表
CREATE TABLE `fn_lottery9` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `game` varchar(255) NOT NULL DEFAULT '六合彩',
  `fanshui` varchar(255) NOT NULL DEFAULT '0',
  `fengtime` int(11) NOT NULL DEFAULT 60,
  `kaijiang_time` int(11) NOT NULL DEFAULT 0,
  `next_term` varchar(50) NOT NULL,
  `next_time` datetime NOT NULL,
  `open_term` varchar(50) NOT NULL,
  `current_term` varchar(50) NOT NULL,
  `daojishi_wait` int(11) NOT NULL DEFAULT 80,
  `daojishi_feng` int(11) NOT NULL DEFAULT 30,
  `daojishi_kaijiang` int(11) NOT NULL DEFAULT 10,
  `daojishi_ad1` varchar(255) DEFAULT '',
  `daojishi_ad2` varchar(255) DEFAULT '',
  `daojishi_after_kaijiang` int(11) NOT NULL DEFAULT 300,
  `next_kaijiang` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 开奖记录表
CREATE TABLE `fn_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `term` varchar(50) NOT NULL,
  `code` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `next_term` varchar(50) NOT NULL,
  `next_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `term` (`term`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 在此添加更多表结构...
