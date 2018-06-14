<?php die();?>
SET NAMES utf8;
DROP TABLE IF EXISTS `cash_balance`;
CREATE TABLE `cash_balance` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `depositor` mediumint(8) unsigned NOT NULL,
  `date` date NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `currency` char(30) NOT NULL,
  `createdBy` char(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL DEFAULT '',
  `editedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `depositor` (`depositor`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `cash_depositor`;
CREATE TABLE `cash_depositor` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `abbr` char(60) NOT NULL,
  `provider` char(100) NOT NULL,
  `title` char(100) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `account` char(90) NOT NULL,
  `bankcode` varchar(30) NOT NULL,
  `public` enum('0','1') NOT NULL,
  `type` enum('cash','bank','online') NOT NULL,
  `currency` char(30) NOT NULL,
  `status` enum('normal','disable') NOT NULL DEFAULT 'normal',
  `createdBy` char(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL DEFAULT '',
  `editedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `cash_trade`;
CREATE TABLE `cash_trade` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `depositor` mediumint(8) unsigned NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product` mediumint(8) unsigned NOT NULL,
  `trader` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order` mediumint(8) unsigned NOT NULL,
  `contract` mediumint(8) unsigned NOT NULL,
  `project` mediumint(8) unsigned NOT NULL,
  `investID` mediumint(8) unsigned NOT NULL,
  `loanID` mediumint(8) unsigned NOT NULL,
  `dept` mediumint(8) unsigned NOT NULL,
  `type` enum('in','out','transferin','transferout','invest','redeem','loan','repay') NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `exchangeRate` decimal(12,4) NOT NULL DEFAULT '1.0000',
  `currency` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `deadline` date NOT NULL,
  `handlers` varchar(255) NOT NULL,
  `category` char(30) NOT NULL,
  `desc` text NOT NULL,
  `createdBy` char(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL DEFAULT '',
  `editedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `depositor` (`depositor`),
  KEY `parent` (`parent`),
  KEY `product` (`product`),
  KEY `trader` (`trader`),
  KEY `order` (`order`),
  KEY `contract` (`contract`),
  KEY `investID` (`investID`),
  KEY `loanID` (`loanID`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_address`;
CREATE TABLE `crm_address` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `objectType` char(30) NOT NULL,
  `objectID` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `area` mediumint(8) unsigned NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objectType` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_contact`;
CREATE TABLE `crm_contact` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `realname` char(30) NOT NULL DEFAULT '',
  `nickname` char(30) NOT NULL,
  `resume` mediumint(8) unsigned NOT NULL,
  `origin` varchar(150) NOT NULL,
  `originAccount` varchar(255) NOT NULL,
  `status` enum('normal','wait','ignore') NOT NULL DEFAULT 'normal',
  `avatar` varchar(255) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `email` char(50) NOT NULL DEFAULT '',
  `skype` char(50) NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(50) NOT NULL DEFAULT '',
  `gtalk` char(50) NOT NULL DEFAULT '',
  `wangwang` char(50) NOT NULL DEFAULT '',
  `site` varchar(100) NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL,
  `fax` char(20) NOT NULL DEFAULT '',
  `weibo` char(50) NOT NULL,
  `weixin` char(50) NOT NULL,
  `desc` text NOT NULL,
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `contactedBy` char(30) NOT NULL,
  `contactedDate` datetime NOT NULL,
  `nextDate` date NOT NULL,
  `assignedTo` char(30) NOT NULL,
  `ignoredBy` char(30) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `realname` (`realname`),
  KEY `nickname` (`nickname`),
  KEY `origin` (`origin`),
  KEY `birthday` (`birthday`),
  KEY `email` (`email`),
  KEY `qq` (`qq`),
  KEY `mobile` (`mobile`),
  KEY `phone` (`phone`),
  KEY `createdBy` (`createdBy`),
  KEY `contactedBy` (`contactedBy`),
  KEY `contactedDate` (`contactedDate`),
  KEY `nextDate` (`nextDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_contract`;
CREATE TABLE `crm_contract` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `customer` mediumint(8) unsigned NOT NULL,
  `name` char(100) NOT NULL,
  `code` char(30) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `items` text NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `delivery` char(30) NOT NULL,
  `return` char(30) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `status` enum('normal','closed','canceled') NOT NULL DEFAULT 'normal',
  `contact` mediumint(8) unsigned NOT NULL,
  `address` mediumint(8) unsigned NOT NULL,
  `handlers` varchar(255) NOT NULL,
  `signedBy` char(30) NOT NULL,
  `signedDate` date NOT NULL,
  `deliveredBy` char(30) NOT NULL,
  `deliveredDate` date NOT NULL,
  `returnedBy` char(30) NOT NULL,
  `returnedDate` date NOT NULL,
  `finishedBy` char(30) NOT NULL,
  `finishedDate` date NOT NULL,
  `canceledBy` char(30) NOT NULL,
  `canceledDate` date NOT NULL,
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `contactedBy` char(30) NOT NULL,
  `contactedDate` datetime NOT NULL,
  `nextDate` date NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `customer` (`customer`),
  KEY `amount` (`amount`),
  KEY `delivery` (`delivery`),
  KEY `return` (`return`),
  KEY `begin` (`begin`),
  KEY `end` (`end`),
  KEY `status` (`status`),
  KEY `handlers` (`handlers`),
  KEY `contactedDate` (`contactedDate`),
  KEY `nextDate` (`nextDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_contractorder`;
CREATE TABLE `crm_contractorder` (
  `contract` mediumint(8) unsigned NOT NULL,
  `order` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `contract` (`contract`,`order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_customer`;
CREATE TABLE `crm_customer` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  `type` char(30) NOT NULL,
  `relation` enum('client','provider','partner') NOT NULL DEFAULT 'client',
  `source` varchar(20) NOT NULL,
  `sourceNote` varchar(255) NOT NULL,
  `size` tinyint(3) unsigned NOT NULL,
  `industry` mediumint(8) unsigned NOT NULL,
  `area` mediumint(8) unsigned NOT NULL,
  `status` char(30) NOT NULL,
  `level` char(10) NOT NULL,
  `intension` text NOT NULL,
  `site` varchar(100) NOT NULL,
  `weibo` char(50) NOT NULL,
  `weixin` char(50) NOT NULL,
  `category` char(30) NOT NULL,
  `depositor` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `public` enum('0','1') NOT NULL DEFAULT '0',
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `assignedTo` char(30) NOT NULL,
  `assignedBy` char(30) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `contactedBy` char(30) NOT NULL,
  `contactedDate` datetime NOT NULL,
  `nextDate` date NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `industry` (`industry`),
  KEY `size` (`size`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `relation` (`relation`),
  KEY `area` (`area`),
  KEY `status` (`status`),
  KEY `level` (`level`),
  KEY `category` (`category`),
  KEY `public` (`public`),
  KEY `assignedTo` (`assignedTo`),
  KEY `contactedDate` (`contactedDate`),
  KEY `nextDate` (`nextDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_delivery`;
CREATE TABLE `crm_delivery` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `contract` mediumint(8) unsigned NOT NULL,
  `deliveredBy` char(30) NOT NULL,
  `deliveredDate` date NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contract` (`contract`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_order`;
CREATE TABLE `crm_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` char(255) NOT NULL,
  `customer` mediumint(8) unsigned NOT NULL,
  `plan` decimal(12,2) NOT NULL,
  `real` decimal(12,2) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `status` enum('normal','signed','closed') NOT NULL DEFAULT 'normal',
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `assignedTo` char(30) NOT NULL,
  `assignedBy` char(30) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `signedBy` char(30) NOT NULL,
  `signedDate` date NOT NULL,
  `closedBy` char(30) NOT NULL,
  `closedDate` datetime NOT NULL,
  `closedReason` enum('','payed','failed','postponed') NOT NULL DEFAULT '',
  `activatedBy` char(30) NOT NULL,
  `activatedDate` datetime NOT NULL,
  `contactedBy` char(30) NOT NULL,
  `contactedDate` datetime NOT NULL,
  `nextDate` date NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product` (`product`),
  KEY `customer` (`customer`),
  KEY `plan` (`plan`),
  KEY `real` (`real`),
  KEY `status` (`status`),
  KEY `createdBy` (`createdBy`),
  KEY `assignedTo` (`assignedTo`),
  KEY `closedBy` (`closedBy`),
  KEY `closedReason` (`closedReason`),
  KEY `contactedDate` (`contactedDate`),
  KEY `nextDate` (`nextDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_plan`;
CREATE TABLE `crm_plan` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(12,2) NOT NULL,
  `contract` mediumint(8) unsigned NOT NULL,
  `returnedBy` char(30) NOT NULL,
  `returnedDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contract` (`contract`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_resume`;
CREATE TABLE `crm_resume` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `contact` mediumint(8) unsigned NOT NULL,
  `customer` mediumint(8) unsigned NOT NULL,
  `maker` enum('0','1') NOT NULL DEFAULT '0',
  `dept` char(100) NOT NULL,
  `title` char(100) NOT NULL,
  `address` mediumint(8) unsigned NOT NULL,
  `join` char(10) NOT NULL,
  `left` char(10) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contact` (`contact`),
  KEY `customer` (`customer`),
  KEY `left` (`left`),
  KEY `maker` (`maker`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_salesgroup`;
CREATE TABLE `crm_salesgroup` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `users` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `crm_salespriv`;
CREATE TABLE `crm_salespriv` (
  `account` char(30) NOT NULL,
  `salesgroup` mediumint(8) unsigned NOT NULL,
  `priv` enum('view','edit') NOT NULL,
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `im_chat`;
CREATE TABLE `im_chat` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `gid` char(40) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT 'group',
  `admins` varchar(255) NOT NULL DEFAULT '',
  `committers` varchar(255) NOT NULL DEFAULT '',
  `subject` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `public` enum('0','1') NOT NULL DEFAULT '0',
  `createdBy` varchar(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editedBy` varchar(30) NOT NULL DEFAULT '',
  `editedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastActiveTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dismissDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `public` (`public`),
  KEY `createdBy` (`createdBy`),
  KEY `editedBy` (`editedBy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `im_chatuser`;
CREATE TABLE `im_chatuser` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cgid` char(40) NOT NULL DEFAULT '',
  `user` mediumint(8) NOT NULL DEFAULT '0',
  `order` smallint(5) NOT NULL DEFAULT '0',
  `star` enum('0','1') NOT NULL DEFAULT '0',
  `hide` enum('0','1') NOT NULL DEFAULT '0',
  `mute` enum('0','1') NOT NULL DEFAULT '0',
  `join` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `chatuser` (`cgid`,`user`),
  KEY `cgid` (`cgid`),
  KEY `user` (`user`),
  KEY `order` (`order`),
  KEY `star` (`star`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `im_message`;
CREATE TABLE `im_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `gid` char(40) NOT NULL DEFAULT '',
  `cgid` char(40) NOT NULL DEFAULT '',
  `user` varchar(30) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order` mediumint(8) unsigned NOT NULL,
  `type` enum('normal','broadcast') NOT NULL DEFAULT 'normal',
  `content` text NOT NULL,
  `contentType` enum('text','emotion','image','file','object') NOT NULL DEFAULT 'text',
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mgid` (`gid`),
  KEY `mcgid` (`cgid`),
  KEY `muser` (`user`),
  KEY `mtype` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `im_usermessage`;
CREATE TABLE `im_usermessage` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `level` smallint(5) NOT NULL DEFAULT '3',
  `user` mediumint(8) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `muser` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_attend`;
CREATE TABLE `oa_attend` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `date` date NOT NULL,
  `signIn` time NOT NULL,
  `signOut` time NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL,
  `device` varchar(30) NOT NULL,
  `client` varchar(20) NOT NULL,
  `manualIn` time NOT NULL,
  `manualOut` time NOT NULL,
  `reason` varchar(30) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `reviewStatus` varchar(30) NOT NULL DEFAULT '',
  `reviewedBy` char(30) NOT NULL,
  `reviewedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attend` (`date`,`account`),
  KEY `account` (`account`),
  KEY `date` (`date`),
  KEY `status` (`status`),
  KEY `reason` (`reason`),
  KEY `reviewStatus` (`reviewStatus`),
  KEY `reviewedBy` (`reviewedBy`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `oa_attend`(`id`,`account`,`date`,`signIn`,`signOut`,`status`,`ip`,`device`,`client`,`manualIn`,`manualOut`,`reason`,`desc`,`reviewStatus`,`reviewedBy`,`reviewedDate`) VALUES ('1','root','2018-03-10','16:51:09','00:00:00','rest','127.0.0.1','desktop','desktop','00:00:00','00:00:00','','','','','0000-00-00 00:00:00');
DROP TABLE IF EXISTS `oa_attendstat`;
CREATE TABLE `oa_attendstat` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `month` char(10) NOT NULL DEFAULT '',
  `normal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `late` decimal(12,2) NOT NULL DEFAULT '0.00',
  `early` decimal(12,2) NOT NULL DEFAULT '0.00',
  `absent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `trip` decimal(12,2) NOT NULL DEFAULT '0.00',
  `egress` decimal(12,2) NOT NULL DEFAULT '0.00',
  `lieu` decimal(12,2) NOT NULL DEFAULT '0.00',
  `paidLeave` decimal(12,2) NOT NULL DEFAULT '0.00',
  `unpaidLeave` decimal(12,2) NOT NULL DEFAULT '0.00',
  `timeOvertime` decimal(12,2) NOT NULL DEFAULT '0.00',
  `restOvertime` decimal(12,2) NOT NULL DEFAULT '0.00',
  `holidayOvertime` decimal(12,2) NOT NULL DEFAULT '0.00',
  `deserve` decimal(12,2) NOT NULL DEFAULT '0.00',
  `actual` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `attend` (`month`,`account`),
  KEY `account` (`account`),
  KEY `month` (`month`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_doc`;
CREATE TABLE `oa_doc` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL,
  `project` mediumint(8) unsigned NOT NULL,
  `lib` mediumint(8) unsigned NOT NULL,
  `module` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `views` mediumint(8) unsigned NOT NULL,
  `createdBy` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` varchar(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `version` smallint(5) unsigned NOT NULL DEFAULT '1',
  `private` enum('0','1') NOT NULL DEFAULT '0',
  `users` text NOT NULL,
  `groups` varchar(255) NOT NULL DEFAULT '',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_doccontent`;
CREATE TABLE `oa_doccontent` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `doc` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `digest` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `files` text NOT NULL,
  `type` varchar(10) NOT NULL,
  `version` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `docVersion` (`doc`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_doclib`;
CREATE TABLE `oa_doclib` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `private` enum('0','1') NOT NULL DEFAULT '0',
  `users` text NOT NULL,
  `groups` varchar(255) NOT NULL DEFAULT '',
  `main` enum('0','1') NOT NULL DEFAULT '0',
  `order` tinyint(5) unsigned NOT NULL,
  `createdBy` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` varchar(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_holiday`;
CREATE TABLE `oa_holiday` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `type` enum('holiday','working') NOT NULL DEFAULT 'holiday',
  `desc` text NOT NULL,
  `year` char(4) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_leave`;
CREATE TABLE `oa_leave` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `year` char(4) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `hours` float(4,1) unsigned NOT NULL DEFAULT '0.0',
  `backDate` datetime NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `reviewedBy` char(30) NOT NULL,
  `reviewedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `createdBy` (`createdBy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_lieu`;
CREATE TABLE `oa_lieu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `year` char(4) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `hours` float(4,1) unsigned NOT NULL DEFAULT '0.0',
  `overtime` char(255) NOT NULL,
  `desc` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `reviewedBy` char(30) NOT NULL,
  `reviewedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `status` (`status`),
  KEY `createdBy` (`createdBy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_overtime`;
CREATE TABLE `oa_overtime` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `year` char(4) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `hours` float(4,1) unsigned NOT NULL DEFAULT '0.0',
  `leave` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `rejectReason` varchar(100) NOT NULL,
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `reviewedBy` char(30) NOT NULL,
  `reviewedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `createdBy` (`createdBy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_project`;
CREATE TABLE `oa_project` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `desc` text NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` enum('doing','finished','suspend') NOT NULL DEFAULT 'doing',
  `whitelist` varchar(255) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_refund`;
CREATE TABLE `oa_refund` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `customer` mediumint(8) unsigned NOT NULL,
  `order` mediumint(8) unsigned NOT NULL,
  `contract` mediumint(8) unsigned NOT NULL,
  `project` mediumint(8) unsigned NOT NULL,
  `name` char(150) NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dept` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `category` char(30) NOT NULL,
  `date` date NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `currency` varchar(30) NOT NULL,
  `desc` text NOT NULL,
  `related` char(200) NOT NULL DEFAULT '',
  `status` char(30) NOT NULL DEFAULT 'wait',
  `createdBy` char(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL DEFAULT '',
  `editedDate` datetime NOT NULL,
  `firstReviewer` char(30) NOT NULL DEFAULT '',
  `firstReviewDate` datetime NOT NULL,
  `secondReviewer` char(30) NOT NULL DEFAULT '',
  `secondReviewDate` datetime NOT NULL,
  `refundBy` char(30) NOT NULL DEFAULT '',
  `refundDate` datetime NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdBy` (`createdBy`),
  KEY `firstReviewer` (`firstReviewer`),
  KEY `secondReviewer` (`secondReviewer`),
  KEY `refundBy` (`refundBy`),
  KEY `category` (`category`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_todo`;
CREATE TABLE `oa_todo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `date` date NOT NULL,
  `begin` smallint(4) unsigned zerofill NOT NULL,
  `end` smallint(4) unsigned zerofill NOT NULL,
  `type` char(20) NOT NULL,
  `idvalue` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pri` tinyint(3) unsigned NOT NULL,
  `name` char(150) NOT NULL,
  `desc` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `private` tinyint(1) NOT NULL,
  `assignedTo` varchar(30) NOT NULL DEFAULT '',
  `assignedBy` varchar(30) NOT NULL DEFAULT '',
  `assignedDate` datetime NOT NULL,
  `finishedBy` varchar(30) NOT NULL DEFAULT '',
  `finishedDate` datetime NOT NULL,
  `closedBy` varchar(30) NOT NULL DEFAULT '',
  `closedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `oa_trip`;
CREATE TABLE `oa_trip` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('trip','egress') NOT NULL DEFAULT 'trip',
  `customers` varchar(20) NOT NULL,
  `name` char(30) NOT NULL,
  `desc` text NOT NULL,
  `year` char(4) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `from` char(50) NOT NULL,
  `to` char(50) NOT NULL,
  `createdBy` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `createdBy` (`createdBy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_action`;
CREATE TABLE `sys_action` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `customer` mediumint(8) unsigned DEFAULT NULL,
  `contact` mediumint(8) unsigned DEFAULT NULL,
  `objectType` varchar(30) NOT NULL DEFAULT '',
  `objectID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `actor` varchar(30) NOT NULL DEFAULT '',
  `action` varchar(30) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  `extra` varchar(255) NOT NULL,
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `reader` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`),
  KEY `contact` (`contact`),
  KEY `objectType` (`objectType`),
  KEY `objectID` (`objectID`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `sys_action`(`id`,`customer`,`contact`,`objectType`,`objectID`,`actor`,`action`,`date`,`comment`,`extra`,`read`,`reader`) VALUES ('1','0','0','user','1','root','login','2018-03-10 16:51:09','','','0','');
DROP TABLE IF EXISTS `sys_article`;
CREATE TABLE `sys_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `original` enum('1','0') NOT NULL,
  `copySite` varchar(60) NOT NULL,
  `copyURL` varchar(255) NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  `type` varchar(30) NOT NULL,
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL,
  `private` enum('0','1') NOT NULL DEFAULT '0',
  `users` text NOT NULL,
  `groups` varchar(255) NOT NULL DEFAULT '',
  `readers` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `views` (`views`),
  KEY `sticky` (`sticky`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_block`;
CREATE TABLE `sys_block` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `app` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `source` varchar(20) NOT NULL,
  `block` varchar(20) NOT NULL,
  `params` text NOT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `grid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountAppOrder` (`account`,`app`,`order`),
  KEY `account` (`account`,`app`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('1','root','sys','日历','oa','attend','','1','6','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('2','root','sys','最新动态','','dynamic','','2','6','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('3','root','sys','系统公告','oa','announce','{\"num\":15}','3','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('4','root','sys','我的合同','crm','contract','{\"num\":15,\"orderBy\":\"id_desc\",\"type\":\"returnedBy\",\"status\":[]}','4','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('5','root','sys','我的订单','crm','order','{\"num\":15,\"orderBy\":\"id_desc\",\"type\":\"createdBy\",\"status\":[]}','5','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('6','root','sys','付款账户','cash','depositor','[]','6','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('7','root','sys','最新博客','team','blog','{\"num\":15}','7','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('8','root','sys','最新帖子','team','thread','{\"num\":15,\"type\":\"new\"}','8','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('9','root','crm','我的订单','crm','order','{\"num\":15,\"orderBy\":\"id_desc\",\"type\":\"createdBy\",\"status\":[]}','1','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('10','root','crm','我的合同','crm','contract','{\"num\":15,\"orderBy\":\"id_desc\",\"type\":\"returnedBy\",\"status\":[]}','2','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('11','root','crm','本周联系','crm','customer','{\"num\":15,\"orderBy\":\"id_desc\",\"type\":\"thisweek\"}','3','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('12','root','oa','日历','oa','attend','','1','6','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('13','root','oa','系统公告','oa','announce','{\"num\":15}','2','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('14','root','proj','指派给我的任务','proj','task','{\"num\":15,\"orderBy\":\"id_desc\",\"status\":[],\"type\":\"assignedTo\"}','3','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('15','root','proj','项目列表','proj','project','{\"num\":15,\"orderBy\":\"id_desc\",\"status\":\"doing\"}','4','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('16','root','cash','付款账户','cash','depositor','[]','1','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('17','root','cash','账目','cash','trade','{\"num\":15,\"orderBy\":\"id_desc\"}','2','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('18','root','cash','供应商','cash','provider','{\"num\":15,\"orderBy\":\"id_desc\"}','3','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('19','root','team','最新博客','team','blog','{\"num\":15}','1','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('20','root','team','最新帖子','team','thread','{\"num\":15,\"type\":\"new\"}','2','4','0','0');
INSERT INTO `sys_block`(`id`,`account`,`app`,`title`,`source`,`block`,`params`,`order`,`grid`,`height`,`hidden`) VALUES ('21','root','team','置顶帖子','team','thread','{\"num\":15,\"type\":\"stick\"}','3','4','0','0');
DROP TABLE IF EXISTS `sys_category`;
CREATE TABLE `sys_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `root` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL,
  `readonly` enum('0','1') NOT NULL DEFAULT '0',
  `moderators` varchar(255) NOT NULL,
  `threads` smallint(5) NOT NULL,
  `posts` smallint(5) NOT NULL,
  `postedBy` varchar(30) NOT NULL,
  `postedDate` datetime NOT NULL,
  `postID` mediumint(8) unsigned NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `users` text NOT NULL,
  `rights` varchar(255) NOT NULL,
  `refund` enum('0','1') NOT NULL DEFAULT '0',
  `major` enum('0','1','2','3','4','5','6','7','8') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM AUTO_INCREMENT=820032 DEFAULT CHARSET=utf8;
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('1','主营业务收入','','','','0','0',',1,','1','1','in','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','1');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('2','非主营业务收入','','','','0','0',',2,','1','2','in','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','2');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('3','主营业务成本','','','','0','0',',3,','1','3','out','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','3');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('4','非主营业务成本','','','','0','0',',4,','1','4','out','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','4');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('5','理财盈利','','','','0','2',',2,5,','2','5','in','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','5');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('6','理财亏损','','','','0','4',',4,6,','2','6','out','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','6');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('7','手续费','','','','0','4',',4,7,','2','7','out','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','7');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('8','借贷利息','','','','0','4',',4,8,','2','8','out','0','','0','0','','0000-00-00 00:00:00','0','0','','','0','8');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('110000','北京市','','','','0','0',',110000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('120000','天津市','','','','0','0',',120000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130000','河北省','','','','0','0',',130000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140000','山西省','','','','0','0',',140000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150000','内蒙古自治区','','','','0','0',',150000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210000','辽宁省','','','','0','0',',210000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220000','吉林省','','','','0','0',',220000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230000','黑龙江省','','','','0','0',',230000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('310000','上海市','','','','0','0',',310000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320000','江苏省','','','','0','0',',320000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330000','浙江省','','','','0','0',',330000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340000','安徽省','','','','0','0',',340000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350000','福建省','','','','0','0',',350000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360000','江西省','','','','0','0',',360000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370000','山东省','','','','0','0',',370000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410000','河南省','','','','0','0',',410000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420000','湖北省','','','','0','0',',420000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430000','湖南省','','','','0','0',',430000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440000','广东省','','','','0','0',',440000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450000','广西壮族自治区','','','','0','0',',450000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('460000','海南省','','','','0','0',',460000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('500000','重庆市','','','','0','0',',500000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510000','四川省','','','','0','0',',510000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520000','贵州省','','','','0','0',',520000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530000','云南省','','','','0','0',',530000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('540000','西藏自治区','','','','0','0',',540000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610000','陕西省','','','','0','0',',610000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620000','甘肃省','','','','0','0',',620000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('630000','青海省','','','','0','0',',630000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640000','宁夏回族自治区','','','','0','0',',640000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('650000','新疆维吾尔自治区','','','','0','0',',650000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('710000','台湾省','','','','0','0',',710000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('810000','香港特别行政区','','','','0','0',',810000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820000','澳门特别行政区','','','','0','0',',820000,','1','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130100','石家庄市','','','','0','130000',',130000,130100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130200','唐山市','','','','0','130000',',130000,130200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130300','秦皇岛市','','','','0','130000',',130000,130300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130400','邯郸市','','','','0','130000',',130000,130400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130500','邢台市','','','','0','130000',',130000,130500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130600','保定市','','','','0','130000',',130000,130600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130700','张家口市','','','','0','130000',',130000,130700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130800','承德市','','','','0','130000',',130000,130800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('130900','沧州市','','','','0','130000',',130000,130900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('131000','廊坊市','','','','0','130000',',130000,131000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('131100','衡水市','','','','0','130000',',130000,131100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140100','太原市','','','','0','140000',',140000,140100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140200','大同市','','','','0','140000',',140000,140200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140300','阳泉市','','','','0','140000',',140000,140300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140400','长治市','','','','0','140000',',140000,140400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140500','晋城市','','','','0','140000',',140000,140500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140600','朔州市','','','','0','140000',',140000,140600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140700','晋中市','','','','0','140000',',140000,140700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140800','运城市','','','','0','140000',',140000,140800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('140900','忻州市','','','','0','140000',',140000,140900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('141000','临汾市','','','','0','140000',',140000,141000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('141100','吕梁市','','','','0','140000',',140000,141100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150100','呼和浩特市','','','','0','150000',',150000,150100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150200','包头市','','','','0','150000',',150000,150200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150300','乌海市','','','','0','150000',',150000,150300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150400','赤峰市','','','','0','150000',',150000,150400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150500','通辽市','','','','0','150000',',150000,150500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150600','鄂尔多斯市','','','','0','150000',',150000,150600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150700','呼伦贝尔市','','','','0','150000',',150000,150700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150800','巴彦淖尔市','','','','0','150000',',150000,150800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('150900','乌兰察布市','','','','0','150000',',150000,150900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('152200','兴安盟','','','','0','150000',',150000,152200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('152500','锡林郭勒盟','','','','0','150000',',150000,152500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('152900','阿拉善盟','','','','0','150000',',150000,152900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210100','沈阳市','','','','0','210000',',210000,210100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210200','大连市','','','','0','210000',',210000,210200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210300','鞍山市','','','','0','210000',',210000,210300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210400','抚顺市','','','','0','210000',',210000,210400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210500','本溪市','','','','0','210000',',210000,210500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210600','丹东市','','','','0','210000',',210000,210600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210700','锦州市','','','','0','210000',',210000,210700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210800','营口市','','','','0','210000',',210000,210800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('210900','阜新市','','','','0','210000',',210000,210900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('211000','辽阳市','','','','0','210000',',210000,211000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('211100','盘锦市','','','','0','210000',',210000,211100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('211200','铁岭市','','','','0','210000',',210000,211200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('211300','朝阳市','','','','0','210000',',210000,211300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('211400','葫芦岛市','','','','0','210000',',210000,211400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220100','长春市','','','','0','220000',',220000,220100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220200','吉林市','','','','0','220000',',220000,220200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220300','四平市','','','','0','220000',',220000,220300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220400','辽源市','','','','0','220000',',220000,220400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220500','通化市','','','','0','220000',',220000,220500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220600','白山市','','','','0','220000',',220000,220600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220700','松原市','','','','0','220000',',220000,220700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('220800','白城市','','','','0','220000',',220000,220800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('222400','延边朝鲜族自治州','','','','0','220000',',220000,222400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230100','哈尔滨市','','','','0','230000',',230000,230100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230200','齐齐哈尔市','','','','0','230000',',230000,230200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230300','鸡西市','','','','0','230000',',230000,230300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230400','鹤岗市','','','','0','230000',',230000,230400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230500','双鸭山市','','','','0','230000',',230000,230500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230600','大庆市','','','','0','230000',',230000,230600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230700','伊春市','','','','0','230000',',230000,230700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230800','佳木斯市','','','','0','230000',',230000,230800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('230900','七台河市','','','','0','230000',',230000,230900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('231000','牡丹江市','','','','0','230000',',230000,231000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('231100','黑河市','','','','0','230000',',230000,231100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('231200','绥化市','','','','0','230000',',230000,231200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('232700','大兴安岭地区','','','','0','230000',',230000,232700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320100','南京市','','','','0','320000',',320000,320100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320200','无锡市','','','','0','320000',',320000,320200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320300','徐州市','','','','0','320000',',320000,320300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320400','常州市','','','','0','320000',',320000,320400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320500','苏州市','','','','0','320000',',320000,320500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320600','南通市','','','','0','320000',',320000,320600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320700','连云港市','','','','0','320000',',320000,320700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320800','淮安市','','','','0','320000',',320000,320800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('320900','盐城市','','','','0','320000',',320000,320900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('321000','扬州市','','','','0','320000',',320000,321000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('321100','镇江市','','','','0','320000',',320000,321100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('321200','泰州市','','','','0','320000',',320000,321200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('321300','宿迁市','','','','0','320000',',320000,321300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330100','杭州市','','','','0','330000',',330000,330100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330200','宁波市','','','','0','330000',',330000,330200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330300','温州市','','','','0','330000',',330000,330300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330400','嘉兴市','','','','0','330000',',330000,330400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330500','湖州市','','','','0','330000',',330000,330500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330600','绍兴市','','','','0','330000',',330000,330600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330700','金华市','','','','0','330000',',330000,330700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330800','衢州市','','','','0','330000',',330000,330800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('330900','舟山市','','','','0','330000',',330000,330900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('331000','台州市','','','','0','330000',',330000,331000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('331100','丽水市','','','','0','330000',',330000,331100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340100','合肥市','','','','0','340000',',340000,340100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340200','芜湖市','','','','0','340000',',340000,340200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340300','蚌埠市','','','','0','340000',',340000,340300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340400','淮南市','','','','0','340000',',340000,340400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340500','马鞍山市','','','','0','340000',',340000,340500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340600','淮北市','','','','0','340000',',340000,340600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340700','铜陵市','','','','0','340000',',340000,340700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('340800','安庆市','','','','0','340000',',340000,340800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341000','黄山市','','','','0','340000',',340000,341000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341100','滁州市','','','','0','340000',',340000,341100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341200','阜阳市','','','','0','340000',',340000,341200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341300','宿州市','','','','0','340000',',340000,341300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341500','六安市','','','','0','340000',',340000,341500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341600','亳州市','','','','0','340000',',340000,341600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341700','池州市','','','','0','340000',',340000,341700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('341800','宣城市','','','','0','340000',',340000,341800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350100','福州市','','','','0','350000',',350000,350100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350200','厦门市','','','','0','350000',',350000,350200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350300','莆田市','','','','0','350000',',350000,350300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350400','三明市','','','','0','350000',',350000,350400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350500','泉州市','','','','0','350000',',350000,350500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350600','漳州市','','','','0','350000',',350000,350600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350700','南平市','','','','0','350000',',350000,350700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350800','龙岩市','','','','0','350000',',350000,350800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('350900','宁德市','','','','0','350000',',350000,350900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360100','南昌市','','','','0','360000',',360000,360100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360200','景德镇市','','','','0','360000',',360000,360200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360300','萍乡市','','','','0','360000',',360000,360300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360400','九江市','','','','0','360000',',360000,360400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360500','新余市','','','','0','360000',',360000,360500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360600','鹰潭市','','','','0','360000',',360000,360600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360700','赣州市','','','','0','360000',',360000,360700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360800','吉安市','','','','0','360000',',360000,360800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('360900','宜春市','','','','0','360000',',360000,360900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('361000','抚州市','','','','0','360000',',360000,361000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('361100','上饶市','','','','0','360000',',360000,361100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370100','济南市','','','','0','370000',',370000,370100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370200','青岛市','','','','0','370000',',370000,370200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370300','淄博市','','','','0','370000',',370000,370300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370400','枣庄市','','','','0','370000',',370000,370400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370500','东营市','','','','0','370000',',370000,370500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370600','烟台市','','','','0','370000',',370000,370600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370700','潍坊市','','','','0','370000',',370000,370700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370800','济宁市','','','','0','370000',',370000,370800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('370900','泰安市','','','','0','370000',',370000,370900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371000','威海市','','','','0','370000',',370000,371000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371100','日照市','','','','0','370000',',370000,371100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371200','莱芜市','','','','0','370000',',370000,371200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371300','临沂市','','','','0','370000',',370000,371300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371400','德州市','','','','0','370000',',370000,371400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371500','聊城市','','','','0','370000',',370000,371500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371600','滨州市','','','','0','370000',',370000,371600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('371700','菏泽市','','','','0','370000',',370000,371700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410100','郑州市','','','','0','410000',',410000,410100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410200','开封市','','','','0','410000',',410000,410200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410300','洛阳市','','','','0','410000',',410000,410300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410400','平顶山市','','','','0','410000',',410000,410400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410500','安阳市','','','','0','410000',',410000,410500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410600','鹤壁市','','','','0','410000',',410000,410600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410700','新乡市','','','','0','410000',',410000,410700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410800','焦作市','','','','0','410000',',410000,410800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('410900','濮阳市','','','','0','410000',',410000,410900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411000','许昌市','','','','0','410000',',410000,411000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411100','漯河市','','','','0','410000',',410000,411100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411200','三门峡市','','','','0','410000',',410000,411200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411300','南阳市','','','','0','410000',',410000,411300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411400','商丘市','','','','0','410000',',410000,411400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411500','信阳市','','','','0','410000',',410000,411500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411600','周口市','','','','0','410000',',410000,411600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('411700','驻马店市','','','','0','410000',',410000,411700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('419000','省直辖县级行政区划','','','','0','410000',',410000,419000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420100','武汉市','','','','0','420000',',420000,420100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420200','黄石市','','','','0','420000',',420000,420200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420300','十堰市','','','','0','420000',',420000,420300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420500','宜昌市','','','','0','420000',',420000,420500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420600','襄阳市','','','','0','420000',',420000,420600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420700','鄂州市','','','','0','420000',',420000,420700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420800','荆门市','','','','0','420000',',420000,420800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('420900','孝感市','','','','0','420000',',420000,420900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('421000','荆州市','','','','0','420000',',420000,421000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('421100','黄冈市','','','','0','420000',',420000,421100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('421200','咸宁市','','','','0','420000',',420000,421200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('421300','随州市','','','','0','420000',',420000,421300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('422800','恩施土家族苗族自治州','','','','0','420000',',420000,422800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('429000','省直辖县级行政区划','','','','0','420000',',420000,429000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430100','长沙市','','','','0','430000',',430000,430100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430200','株洲市','','','','0','430000',',430000,430200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430300','湘潭市','','','','0','430000',',430000,430300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430400','衡阳市','','','','0','430000',',430000,430400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430500','邵阳市','','','','0','430000',',430000,430500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430600','岳阳市','','','','0','430000',',430000,430600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430700','常德市','','','','0','430000',',430000,430700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430800','张家界市','','','','0','430000',',430000,430800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('430900','益阳市','','','','0','430000',',430000,430900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('431000','郴州市','','','','0','430000',',430000,431000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('431100','永州市','','','','0','430000',',430000,431100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('431200','怀化市','','','','0','430000',',430000,431200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('431300','娄底市','','','','0','430000',',430000,431300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('433100','湘西土家族苗族自治州','','','','0','430000',',430000,433100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440100','广州市','','','','0','440000',',440000,440100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440200','韶关市','','','','0','440000',',440000,440200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440300','深圳市','','','','0','440000',',440000,440300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440400','珠海市','','','','0','440000',',440000,440400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440500','汕头市','','','','0','440000',',440000,440500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440600','佛山市','','','','0','440000',',440000,440600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440700','江门市','','','','0','440000',',440000,440700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440800','湛江市','','','','0','440000',',440000,440800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('440900','茂名市','','','','0','440000',',440000,440900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441200','肇庆市','','','','0','440000',',440000,441200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441300','惠州市','','','','0','440000',',440000,441300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441400','梅州市','','','','0','440000',',440000,441400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441500','汕尾市','','','','0','440000',',440000,441500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441600','河源市','','','','0','440000',',440000,441600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441700','阳江市','','','','0','440000',',440000,441700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441800','清远市','','','','0','440000',',440000,441800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('441900','东莞市','','','','0','440000',',440000,441900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('442000','中山市','','','','0','440000',',440000,442000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('445100','潮州市','','','','0','440000',',440000,445100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('445200','揭阳市','','','','0','440000',',440000,445200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('445300','云浮市','','','','0','440000',',440000,445300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450100','南宁市','','','','0','450000',',450000,450100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450200','柳州市','','','','0','450000',',450000,450200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450300','桂林市','','','','0','450000',',450000,450300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450400','梧州市','','','','0','450000',',450000,450400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450500','北海市','','','','0','450000',',450000,450500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450600','防城港市','','','','0','450000',',450000,450600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450700','钦州市','','','','0','450000',',450000,450700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450800','贵港市','','','','0','450000',',450000,450800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('450900','玉林市','','','','0','450000',',450000,450900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('451000','百色市','','','','0','450000',',450000,451000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('451100','贺州市','','','','0','450000',',450000,451100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('451200','河池市','','','','0','450000',',450000,451200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('451300','来宾市','','','','0','450000',',450000,451300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('451400','崇左市','','','','0','450000',',450000,451400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('460100','海口市','','','','0','460000',',460000,460100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('460200','三亚市','','','','0','460000',',460000,460200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('460300','三沙市','','','','0','460000',',460000,460300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('469000','省直辖县级行政区划','','','','0','460000',',460000,469000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510100','成都市','','','','0','510000',',510000,510100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510300','自贡市','','','','0','510000',',510000,510300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510400','攀枝花市','','','','0','510000',',510000,510400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510500','泸州市','','','','0','510000',',510000,510500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510600','德阳市','','','','0','510000',',510000,510600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510700','绵阳市','','','','0','510000',',510000,510700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510800','广元市','','','','0','510000',',510000,510800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('510900','遂宁市','','','','0','510000',',510000,510900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511000','内江市','','','','0','510000',',510000,511000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511100','乐山市','','','','0','510000',',510000,511100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511300','南充市','','','','0','510000',',510000,511300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511400','眉山市','','','','0','510000',',510000,511400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511500','宜宾市','','','','0','510000',',510000,511500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511600','广安市','','','','0','510000',',510000,511600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511700','达州市','','','','0','510000',',510000,511700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511800','雅安市','','','','0','510000',',510000,511800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('511900','巴中市','','','','0','510000',',510000,511900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('512000','资阳市','','','','0','510000',',510000,512000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('513200','阿坝藏族羌族自治州','','','','0','510000',',510000,513200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('513300','甘孜藏族自治州','','','','0','510000',',510000,513300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('513400','凉山彝族自治州','','','','0','510000',',510000,513400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520100','贵阳市','','','','0','520000',',520000,520100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520200','六盘水市','','','','0','520000',',520000,520200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520300','遵义市','','','','0','520000',',520000,520300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520400','安顺市','','','','0','520000',',520000,520400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520500','毕节市','','','','0','520000',',520000,520500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('520600','铜仁市','','','','0','520000',',520000,520600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('522300','黔西南布依族苗族自治州','','','','0','520000',',520000,522300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('522600','黔东南苗族侗族自治州','','','','0','520000',',520000,522600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('522700','黔南布依族苗族自治州','','','','0','520000',',520000,522700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530100','昆明市','','','','0','530000',',530000,530100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530300','曲靖市','','','','0','530000',',530000,530300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530400','玉溪市','','','','0','530000',',530000,530400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530500','保山市','','','','0','530000',',530000,530500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530600','昭通市','','','','0','530000',',530000,530600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530700','丽江市','','','','0','530000',',530000,530700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530800','普洱市','','','','0','530000',',530000,530800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('530900','临沧市','','','','0','530000',',530000,530900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('532300','楚雄彝族自治州','','','','0','530000',',530000,532300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('532500','红河哈尼族彝族自治州','','','','0','530000',',530000,532500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('532600','文山壮族苗族自治州','','','','0','530000',',530000,532600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('532800','西双版纳傣族自治州','','','','0','530000',',530000,532800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('532900','大理白族自治州','','','','0','530000',',530000,532900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('533100','德宏傣族景颇族自治州','','','','0','530000',',530000,533100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('533300','怒江傈僳族自治州','','','','0','530000',',530000,533300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('533400','迪庆藏族自治州','','','','0','530000',',530000,533400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('540100','拉萨市','','','','0','540000',',540000,540100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542100','昌都地区','','','','0','540000',',540000,542100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542200','山南地区','','','','0','540000',',540000,542200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542300','日喀则地区','','','','0','540000',',540000,542300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542400','那曲地区','','','','0','540000',',540000,542400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542500','阿里地区','','','','0','540000',',540000,542500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('542600','林芝地区','','','','0','540000',',540000,542600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610100','西安市','','','','0','610000',',610000,610100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610200','铜川市','','','','0','610000',',610000,610200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610300','宝鸡市','','','','0','610000',',610000,610300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610400','咸阳市','','','','0','610000',',610000,610400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610500','渭南市','','','','0','610000',',610000,610500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610600','延安市','','','','0','610000',',610000,610600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610700','汉中市','','','','0','610000',',610000,610700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610800','榆林市','','','','0','610000',',610000,610800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('610900','安康市','','','','0','610000',',610000,610900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('611000','商洛市','','','','0','610000',',610000,611000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620100','兰州市','','','','0','620000',',620000,620100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620200','嘉峪关市','','','','0','620000',',620000,620200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620300','金昌市','','','','0','620000',',620000,620300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620400','白银市','','','','0','620000',',620000,620400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620500','天水市','','','','0','620000',',620000,620500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620600','武威市','','','','0','620000',',620000,620600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620700','张掖市','','','','0','620000',',620000,620700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620800','平凉市','','','','0','620000',',620000,620800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('620900','酒泉市','','','','0','620000',',620000,620900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('621000','庆阳市','','','','0','620000',',620000,621000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('621100','定西市','','','','0','620000',',620000,621100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('621200','陇南市','','','','0','620000',',620000,621200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('622900','临夏回族自治州','','','','0','620000',',620000,622900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('623000','甘南藏族自治州','','','','0','620000',',620000,623000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('630100','西宁市','','','','0','630000',',630000,630100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('630200','海东市','','','','0','630000',',630000,630200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632200','海北藏族自治州','','','','0','630000',',630000,632200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632300','黄南藏族自治州','','','','0','630000',',630000,632300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632500','海南藏族自治州','','','','0','630000',',630000,632500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632600','果洛藏族自治州','','','','0','630000',',630000,632600,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632700','玉树藏族自治州','','','','0','630000',',630000,632700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('632800','海西蒙古族藏族自治州','','','','0','630000',',630000,632800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640100','银川市','','','','0','640000',',640000,640100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640200','石嘴山市','','','','0','640000',',640000,640200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640300','吴忠市','','','','0','640000',',640000,640300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640400','固原市','','','','0','640000',',640000,640400,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('640500','中卫市','','','','0','640000',',640000,640500,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('650100','乌鲁木齐市','','','','0','650000',',650000,650100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('650200','克拉玛依市','','','','0','650000',',650000,650200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652100','吐鲁番地区','','','','0','650000',',650000,652100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652200','哈密地区','','','','0','650000',',650000,652200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652300','昌吉回族自治州','','','','0','650000',',650000,652300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652700','博尔塔拉蒙古自治州','','','','0','650000',',650000,652700,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652800','巴音郭楞蒙古自治州','','','','0','650000',',650000,652800,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('652900','阿克苏地区','','','','0','650000',',650000,652900,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('653000','克孜勒苏柯尔克孜自治州','','','','0','650000',',650000,653000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('653100','喀什地区','','','','0','650000',',650000,653100,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('653200','和田地区','','','','0','650000',',650000,653200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('654000','伊犁哈萨克自治州','','','','0','650000',',650000,654000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('654200','塔城地区','','','','0','650000',',650000,654200,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('654300','阿勒泰地区','','','','0','650000',',650000,654300,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('659000','自治区直辖县级行政区划','','','','0','650000',',650000,659000,','2','0','area','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820001','化工','','','','0','0',',820001,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820002','环保、绿化、公共事业','','','','0','0',',820002,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820003','电子电工及通讯','','','','0','0',',820003,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820004','办公文教及光仪','','','','0','0',',820004,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820005','影视、新闻、出版','','','','0','0',',820005,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820006','电脑、网络、软件','','','','0','0',',820006,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820007','农林牧渔','','','','0','0',',820007,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820008','生活消费','','','','0','0',',820008,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820009','家电及家居用品','','','','0','0',',820009,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820010','交通运输、物流','','','','0','0',',820010,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820011','文化教育、培训','','','','0','0',',820011,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820012','玩具及儿童用品','','','','0','0',',820012,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820013','科研、设计、监测','','','','0','0',',820013,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820014','礼品、美术、工艺品','','','','0','0',',820014,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820015','医疗、医药、保健','','','','0','0',',820015,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820016','金融、保险、投资','','','','0','0',',820016,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820017','机械、机电、设备','','','','0','0',',820017,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820018','旅游、运动、休闲','','','','0','0',',820018,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820019','政府及社会团体','','','','0','0',',820019,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820020','工业制品及工业用品','','','','0','0',',820020,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820021','包装、印刷、纸品','','','','0','0',',820021,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820022','商业机构','','','','0','0',',820022,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820023','纺织、皮革、印染','','','','0','0',',820023,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820024','安全、保安','','','','0','0',',820024,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820025','专业服务','','','','0','0',',820025,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820026','能源、矿产、冶金','','','','0','0',',820026,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820027','服装、服饰','','','','0','0',',820027,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820028','生活服务','','','','0','0',',820028,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820029','宠物及用品','','','','0','0',',820029,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820030','建筑、装饰、房地产','','','','0','0',',820030,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
INSERT INTO `sys_category`(`id`,`name`,`alias`,`desc`,`keywords`,`root`,`parent`,`path`,`grade`,`order`,`type`,`readonly`,`moderators`,`threads`,`posts`,`postedBy`,`postedDate`,`postID`,`replyID`,`users`,`rights`,`refund`,`major`) VALUES ('820031','食品、饮料、烟酒','','','','0','0',',820031,','1','0','industry','0','','0','0','','0000-00-00 00:00:00','0','0','','','','0');
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` char(30) NOT NULL DEFAULT '',
  `app` varchar(30) NOT NULL DEFAULT 'sys',
  `module` varchar(30) NOT NULL,
  `section` char(30) NOT NULL DEFAULT '',
  `key` char(30) DEFAULT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`owner`,`app`,`module`,`section`,`key`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('1','system','sys','xuanxuan','global','version','1.3.0');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('2','system','sys','common','global','version','4.6.1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('3','root','sys','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('4','system','sys','cron','run','status','running');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('5','root','crm','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('6','root','oa','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('7','root','proj','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('8','root','cash','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('9','root','team','common','','blockInited','1');
INSERT INTO `sys_config`(`id`,`owner`,`app`,`module`,`section`,`key`,`value`) VALUES ('10','system','oa','attend','readers','2018-03-10','root');
DROP TABLE IF EXISTS `sys_cron`;
CREATE TABLE `sys_cron` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `m` varchar(20) NOT NULL,
  `h` varchar(20) NOT NULL,
  `dom` varchar(20) NOT NULL,
  `mon` varchar(20) NOT NULL,
  `dow` varchar(20) NOT NULL,
  `command` text NOT NULL,
  `remark` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `buildin` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL,
  `lastTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
INSERT INTO `sys_cron`(`id`,`m`,`h`,`dom`,`mon`,`dow`,`command`,`remark`,`type`,`buildin`,`status`,`lastTime`) VALUES ('1','*','*','*','*','*','','监控定时任务','ranzhi','1','normal','2018-03-11 11:44:15');
INSERT INTO `sys_cron`(`id`,`m`,`h`,`dom`,`mon`,`dow`,`command`,`remark`,`type`,`buildin`,`status`,`lastTime`) VALUES ('2','1','1','*','*','*','appName=sys&moduleName=backup&methodName=backup&reload=0','定时备份任务','ranzhi','1','running','2018-03-11 11:44:15');
INSERT INTO `sys_cron`(`id`,`m`,`h`,`dom`,`mon`,`dow`,`command`,`remark`,`type`,`buildin`,`status`,`lastTime`) VALUES ('3','1','1','*','*','*','appName=sys&moduleName=backup&methodName=batchdelete&saveDays=30','删除30天前的备份','ranzhi','1','normal','2018-03-10 16:51:10');
INSERT INTO `sys_cron`(`id`,`m`,`h`,`dom`,`mon`,`dow`,`command`,`remark`,`type`,`buildin`,`status`,`lastTime`) VALUES ('4','1','7','*','*','*','appName=sys&moduleName=report&methodName=remind','每日提醒','ranzhi','1','normal','2018-03-10 16:51:10');
DROP TABLE IF EXISTS `sys_entry`;
CREATE TABLE `sys_entry` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `abbr` char(6) NOT NULL,
  `code` varchar(20) NOT NULL,
  `buildin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `integration` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `open` varchar(20) NOT NULL,
  `key` char(32) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `logout` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `control` varchar(10) NOT NULL DEFAULT 'simple',
  `size` varchar(50) NOT NULL DEFAULT 'max',
  `position` varchar(10) NOT NULL DEFAULT 'default',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `order` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `zentao` enum('0','1') NOT NULL DEFAULT '0',
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('1','客户管理','客户','crm','1','1','iframe','epet8b8ae1g89rxzquf4ubv37ul5tite','*','theme/default/images/ips/app-crm.png','../crm','','','simple','max','default','1','10','0','0');
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('2','日常办公','办公','oa','1','1','iframe','1a673c4c3c85fadcf0333e0a4596d220','*','theme/default/images/ips/app-oa.png','../oa','','','simple','max','default','1','20','0','0');
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('3','项目','项目','proj','1','1','iframe','a910d9d1dd03c9dd99cecb3ca31ea600','*','theme/default/images/ips/app-proj.png','../proj','','','simple','max','default','1','30','0','0');
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('4','文档','文档','doc','1','1','iframe','76ff605479df34f1d239730efa68d562','*','theme/default/images/ips/app-doc.png','../doc','','','simple','max','default','1','40','0','0');
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('5','现金记账','记账','cash','1','1','iframe','438d85f2c2b04372662c63ebfb1c4c2f','*','theme/default/images/ips/app-cash.png','../cash','','','simple','max','default','1','50','0','0');
INSERT INTO `sys_entry`(`id`,`name`,`abbr`,`code`,`buildin`,`integration`,`open`,`key`,`ip`,`logo`,`login`,`logout`,`block`,`control`,`size`,`position`,`visible`,`order`,`zentao`,`category`) VALUES ('6','团队','团队','team','1','1','iframe','6c46d9fe76a1afa1cd61f946f1072d1e','*','theme/default/images/ips/app-team.png','../team','','','simple','max','default','1','60','0','0');
DROP TABLE IF EXISTS `sys_file`;
CREATE TABLE `sys_file` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pathname` char(100) NOT NULL,
  `title` char(90) NOT NULL,
  `extension` char(30) NOT NULL,
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `objectType` char(30) NOT NULL,
  `objectID` mediumint(8) unsigned NOT NULL,
  `createdBy` char(30) NOT NULL DEFAULT '',
  `createdDate` datetime NOT NULL,
  `editor` enum('1','0') NOT NULL DEFAULT '0',
  `primary` enum('1','0') DEFAULT '0',
  `public` enum('1','0') NOT NULL DEFAULT '1',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `desc` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
INSERT INTO `sys_group`(`id`,`name`,`desc`) VALUES ('1','管理员','管理员拥有前台所有权限');
INSERT INTO `sys_group`(`id`,`name`,`desc`) VALUES ('2','财务专员','财务专员拥有现金流所有权限');
INSERT INTO `sys_group`(`id`,`name`,`desc`) VALUES ('3','销售经理','销售经理拥有客户管理所有权限');
INSERT INTO `sys_group`(`id`,`name`,`desc`) VALUES ('4','销售人员','默认的销售人员权限');
INSERT INTO `sys_group`(`id`,`name`,`desc`) VALUES ('5','普通用户','默认的普通账号权限');
DROP TABLE IF EXISTS `sys_grouppriv`;
CREATE TABLE `sys_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` char(30) NOT NULL DEFAULT '',
  `method` char(30) NOT NULL DEFAULT '',
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','address','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','address','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','address','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','address','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','announce','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','announce','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','announce','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','announce','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','announce','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','cash');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','crm');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','doc');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','oa');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','proj');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','superadmin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','apppriv','team');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','detail');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','exportDetail');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','exportStat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','personalSettings');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','saveStat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','setManager');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','settings');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','attend','stat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','balance','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','balance','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','balance','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','balance','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','blog','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','blog','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','blog','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','blog','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','blog','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','company','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','exportTemplate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','import');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','showImport');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','vcard');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contact','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','cancel');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','deleteDelivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','deleteReturn');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','delivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','editDelivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','editReturn');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','finish');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','receive');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','contract','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','crm','manageAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','batchAssign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','contract');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','linkContact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','merge');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','order');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','customer','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','activate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','check');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','forbid');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','depositor','savebalance');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','allLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','createLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','deleteLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','editLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','projectLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','showFiles');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','sort');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','doc','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','egress','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','egress','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','file','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','file','download');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','file','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','file','upload');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','forum','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','forum','board');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','forum','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','forum','update');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','holiday','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','holiday','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','holiday','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','apply');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','ignore');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','setting');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','transform');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leads','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','leave','setReviewer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','lieu','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','lieu','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','lieu','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','lieu','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','lieu','setReviewer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','makeup','setReviewer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','my','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','activate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','close');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','order','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','overtime','setReviewer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','product','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','product','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','product','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','product','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','product','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','linkContact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','provider','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','reimburse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','setCategory');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','setDepositor');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','setRefundBy');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','setReviewer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','refund','todo');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','report','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','resume','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','resume','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','resume','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','resume','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','resume','leave');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','sales','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','sales','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','sales','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','sales','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','sales','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','schema','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','schema','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','schema','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','schema','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','schema','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','setting','customerPool');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','setting','lang');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','setting','modules');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','setting','reset');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','task','deleteAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','task','editAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','task','viewAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','deleteFile');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','post');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','stick');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','switchStatus');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','thread','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','batchCreate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','batchEdit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','compare');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','detail');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','export2Excel');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','import');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','invest');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','loan');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','report');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','setReportUnit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','showImport');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','tradeSetting');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trade','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','tree','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','tree','children');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','tree','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','tree','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','tree','merge');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trip','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','trip','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','active');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','colleague');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('1','user','forbid');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','address','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','announce','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','announce','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','announce','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','announce','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','cash');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','crm');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','doc');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','oa');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','proj');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','apppriv','team');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','attend','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','attend','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','attend','exportStat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','attend','saveStat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','attend','stat');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','balance','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','balance','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','balance','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','balance','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','blog','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','blog','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','blog','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','blog','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','company','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','contact','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','contact','vcard');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','contact','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','contract','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','contract','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','crm','manageAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','customer','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','customer','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','customer','contract');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','customer','order');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','customer','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','activate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','check');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','forbid');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','depositor','savebalance');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','allLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','createLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','editLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','projectLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','showFiles');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','sort');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','doc','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','file','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','file','download');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','file','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','file','upload');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','forum','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','forum','board');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','forum','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','holiday','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','holiday','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','holiday','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','leads','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','leads','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','leave','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','order','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','order','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','order','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','product','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','product','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','linkContact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','provider','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','reimburse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','setCategory');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','setDepositor');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','refund','todo');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','resume','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','sales','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','schema','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','schema','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','schema','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','schema','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','schema','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','setting','lang');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','setting','reset');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','post');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','stick');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','switchStatus');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','thread','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','batchCreate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','batchEdit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','compare');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','detail');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','export2Excel');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','import');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','invest');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','loan');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','report');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','setReportUnit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','showImport');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','tradeSetting');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trade','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','tree','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','tree','children');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','tree','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','tree','merge');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','trip','company');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('2','user','colleague');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','address','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','address','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','address','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','address','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','announce','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','announce','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','announce','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','announce','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','cash');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','crm');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','doc');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','oa');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','proj');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','apppriv','team');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','blog','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','blog','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','blog','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','blog','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','company','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','exportTemplate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','import');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','showImport');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','vcard');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contact','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','cancel');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','deleteDelivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','deleteReturn');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','delivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','editDelivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','editReturn');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','finish');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','receive');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','contract','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','crm','manageAll');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','contract');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','linkContact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','merge');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','order');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','customer','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','depositor','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','allLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','createLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','editLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','projectLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','showFiles');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','sort');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','doc','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','egress','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','file','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','file','download');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','file','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','file','upload');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','forum','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','forum','board');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','forum','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','apply');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','ignore');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','setting');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','transform');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leads','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leave','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leave','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','leave','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','lieu','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','lieu','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','lieu','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','makeup','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','makeup','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','makeup','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','activate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','close');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','order','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','overtime','batchReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','overtime','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','overtime','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','product','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','product','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','product','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','product','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','product','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','refund','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','refund','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','resume','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','resume','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','resume','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','resume','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','resume','leave');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','sales','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','sales','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','sales','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','sales','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','setting','customerPool');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','setting','lang');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','setting','reset');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','post');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','stick');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','switchStatus');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','thread','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','tree','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','tree','children');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','tree','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','trip','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('3','user','colleague');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','address','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','address','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','address','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','announce','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','announce','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','announce','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','announce','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','cash');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','crm');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','doc');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','oa');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','proj');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','apppriv','team');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','attend','browseReview');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','attend','department');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','attend','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','attend','review');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','blog','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','blog','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','blog','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','blog','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','company','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','exportTemplate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','import');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','showImport');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','vcard');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contact','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','cancel');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','delivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','editDelivery');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','editReturn');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','finish');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','receive');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','contract','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','batchAssign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','contract');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','linkContact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','merge');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','order');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','customer','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','depositor','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','allLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','createLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','editLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','projectLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','showFiles');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','sort');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','doc','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','file','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','file','download');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','file','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','file','upload');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','forum','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','forum','board');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','forum','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','apply');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','ignore');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','transform');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','leads','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','activate');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','assign');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','close');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','contact');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','export');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','order','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','product','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','product','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','product','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','product','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','resume','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','resume','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','resume','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','sales','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','setting','lang');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','setting','reset');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','post');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','stick');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','switchStatus');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','thread','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','tree','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','tree','children');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','tree','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('4','user','colleague');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','announce','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','announce','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','announce','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','announce','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','apppriv','doc');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','apppriv','oa');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','apppriv','proj');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','apppriv','team');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','blog','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','blog','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','blog','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','blog','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','company','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','allLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','browse');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','create');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','createLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','editLib');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','projectLibs');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','showFiles');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','sort');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','doc','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','file','delete');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','file','download');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','file','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','file','upload');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','forum','admin');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','forum','board');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','forum','index');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','edit');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','post');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','stick');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','switchStatus');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','transfer');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','thread','view');
INSERT INTO `sys_grouppriv`(`group`,`module`,`method`) VALUES ('5','user','colleague');
DROP TABLE IF EXISTS `sys_history`;
CREATE TABLE `sys_history` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `action` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field` varchar(30) NOT NULL DEFAULT '',
  `old` text NOT NULL,
  `new` text NOT NULL,
  `diff` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action` (`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_lang`;
CREATE TABLE `sys_lang` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(30) NOT NULL,
  `app` varchar(30) NOT NULL DEFAULT 'sys',
  `module` varchar(30) NOT NULL,
  `section` varchar(30) NOT NULL,
  `key` varchar(60) NOT NULL,
  `value` text NOT NULL,
  `system` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang` (`app`,`lang`,`module`,`section`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_message`;
CREATE TABLE `sys_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL,
  `objectType` varchar(30) NOT NULL DEFAULT '',
  `objectID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) DEFAULT NULL,
  `from` char(30) NOT NULL,
  `to` char(30) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `status` char(20) NOT NULL,
  `readed` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_package`;
CREATE TABLE `sys_package` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` varchar(30) NOT NULL,
  `version` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `license` text NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'extension',
  `site` varchar(150) NOT NULL,
  `ranzhiCompatible` varchar(100) NOT NULL,
  `installedTime` datetime NOT NULL,
  `depends` varchar(100) NOT NULL,
  `dirs` text NOT NULL,
  `files` text NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `addedTime` (`installedTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_product`;
CREATE TABLE `sys_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `order` smallint(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `desc` text NOT NULL,
  `createdBy` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedBy` varchar(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_relation`;
CREATE TABLE `sys_relation` (
  `type` char(20) NOT NULL,
  `id` mediumint(8) NOT NULL,
  `category` mediumint(8) NOT NULL,
  UNIQUE KEY `relation` (`type`,`id`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_schema`;
CREATE TABLE `sys_schema` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` char(10) NOT NULL,
  `trader` char(10) NOT NULL,
  `type` char(10) NOT NULL,
  `money` char(10) NOT NULL,
  `desc` char(10) NOT NULL,
  `date` char(10) NOT NULL,
  `fee` char(10) NOT NULL,
  `dept` char(10) NOT NULL,
  `product` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
INSERT INTO `sys_schema`(`id`,`name`,`category`,`trader`,`type`,`money`,`desc`,`date`,`fee`,`dept`,`product`) VALUES ('1','支付宝','','H','K','J','I,O','D','M','','');
INSERT INTO `sys_schema`(`id`,`name`,`category`,`trader`,`type`,`money`,`desc`,`date`,`fee`,`dept`,`product`) VALUES ('2','中信银行简版','','C','','E,D','G,H','A','','','');
DROP TABLE IF EXISTS `sys_sso`;
CREATE TABLE `sys_sso` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `sid` char(32) NOT NULL,
  `entry` mediumint(8) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('1','l9sgklk6k8mfr4ouucjgeuv433','1','0b5749765f279f4d0aca74ee1b70fd66','2018-03-10 16:51:40');
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('2','l9sgklk6k8mfr4ouucjgeuv433','2','11adcc1fca525be9fe67a270c94621c9','2018-03-10 16:51:42');
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('3','l9sgklk6k8mfr4ouucjgeuv433','4','6f31ccf24acf30ff52a9e1d8e080ccb2','2018-03-10 16:51:45');
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('4','l9sgklk6k8mfr4ouucjgeuv433','3','80fb343c53a2944682c11ad6072e6629','2018-03-10 16:51:46');
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('5','l9sgklk6k8mfr4ouucjgeuv433','5','85bf5620d8873671950a7e1625debe4e','2018-03-10 16:51:50');
INSERT INTO `sys_sso`(`id`,`sid`,`entry`,`token`,`time`) VALUES ('6','l9sgklk6k8mfr4ouucjgeuv433','6','5cf16ed1ff4344ca43889fb15253d575','2018-03-10 16:51:52');
DROP TABLE IF EXISTS `sys_tag`;
CREATE TABLE `sys_tag` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_task`;
CREATE TABLE `sys_task` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `customer` mediumint(8) unsigned NOT NULL,
  `order` mediumint(8) unsigned NOT NULL,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pri` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `estimate` decimal(12,1) unsigned NOT NULL,
  `consumed` decimal(12,1) unsigned NOT NULL,
  `left` decimal(12,1) unsigned NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('wait','doing','done','cancel','closed') NOT NULL DEFAULT 'wait',
  `statusCustom` tinyint(3) unsigned NOT NULL,
  `mailto` varchar(255) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `createdBy` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `assignedTo` varchar(30) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `estStarted` date NOT NULL,
  `realStarted` date NOT NULL,
  `finishedBy` varchar(30) NOT NULL,
  `finishedDate` datetime NOT NULL,
  `canceledBy` varchar(30) NOT NULL,
  `canceledDate` datetime NOT NULL,
  `closedBy` varchar(30) NOT NULL,
  `closedDate` datetime NOT NULL,
  `closedReason` varchar(30) NOT NULL,
  `editedBy` varchar(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `key` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `statusOrder` (`statusCustom`),
  KEY `assignedTo` (`assignedTo`),
  KEY `createdBy` (`createdBy`),
  KEY `finishedBy` (`finishedBy`),
  KEY `closedBy` (`closedBy`),
  KEY `closedReason` (`closedReason`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_team`;
CREATE TABLE `sys_team` (
  `type` char(30) NOT NULL,
  `id` mediumint(8) NOT NULL DEFAULT '0',
  `account` char(30) NOT NULL DEFAULT '',
  `role` char(30) NOT NULL DEFAULT '',
  `join` date NOT NULL DEFAULT '0000-00-00',
  `days` smallint(5) unsigned NOT NULL,
  `hours` float(2,1) unsigned NOT NULL DEFAULT '0.0',
  `estimate` decimal(12,1) unsigned NOT NULL,
  `consumed` decimal(12,1) unsigned NOT NULL,
  `left` decimal(12,1) unsigned NOT NULL,
  `order` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`type`,`id`,`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `dept` mediumint(8) unsigned NOT NULL,
  `account` char(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `realname` char(30) NOT NULL DEFAULT '',
  `role` char(30) NOT NULL,
  `nickname` char(60) NOT NULL DEFAULT '',
  `admin` enum('no','common','super') NOT NULL DEFAULT 'no',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `email` char(90) NOT NULL DEFAULT '',
  `skype` char(90) NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(90) NOT NULL DEFAULT '',
  `gtalk` char(90) NOT NULL DEFAULT '',
  `wangwang` char(90) NOT NULL DEFAULT '',
  `site` varchar(100) NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `address` char(120) NOT NULL DEFAULT '',
  `zipcode` char(10) NOT NULL DEFAULT '',
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(50) NOT NULL DEFAULT '',
  `last` datetime NOT NULL,
  `ping` datetime NOT NULL,
  `fails` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `join` datetime NOT NULL,
  `locked` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  `status` enum('online','away','busy','offline') NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`),
  KEY `admin` (`admin`),
  KEY `accountPassword` (`account`,`password`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `sys_user`(`id`,`dept`,`account`,`password`,`realname`,`role`,`nickname`,`admin`,`avatar`,`birthday`,`gender`,`email`,`skype`,`qq`,`yahoo`,`gtalk`,`wangwang`,`site`,`mobile`,`phone`,`address`,`zipcode`,`visits`,`ip`,`last`,`ping`,`fails`,`join`,`locked`,`deleted`,`status`) VALUES ('1','0','root','8d8418ef2560ea30f98cee60c7d32556','root','','','super','','0000-00-00','u','','','','','','','','','','','','1','127.0.0.1','2018-03-10 16:51:09','2018-03-11 00:51:11','0','2018-03-10 16:50:57','0000-00-00 00:00:00','0','offline');
DROP TABLE IF EXISTS `sys_usergroup`;
CREATE TABLE `sys_usergroup` (
  `account` char(30) NOT NULL DEFAULT '',
  `group` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sys_userquery`;
CREATE TABLE `sys_userquery` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `title` varchar(90) NOT NULL,
  `form` text NOT NULL,
  `sql` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `team_reply`;
CREATE TABLE `team_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `thread` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `author` char(30) NOT NULL,
  `editor` char(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `thread` (`thread`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `team_thread`;
CREATE TABLE `team_thread` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `board` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `createdDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `stick` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL,
  `repliedBy` varchar(30) NOT NULL,
  `repliedDate` datetime NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`board`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
