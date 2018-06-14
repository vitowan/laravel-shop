-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 03 月 12 日 01:06
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jin`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `intro` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `pic` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(66) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `intro`, `content`, `pic`, `date`, `author`, `pid`) VALUES
(3, '新闻中心9', '新闻中心9新闻中心9', '新闻中心9新闻中心9', '/jin_tp/public/static/uploads/up_midd_03.jpg', '2018-02-01 08:05:02', '新闻中心8', 9),
(5, '新闻中心6', '新闻中心6', '新闻中心6新闻中心6', '../uploads/', '2018-02-01 09:07:42', '新闻中心6', 9),
(6, '新闻中心5', '新闻中心5', '新闻中心5新闻中心5', '../uploads/', '2018-02-01 09:08:38', '新闻中心5', 9),
(7, '新闻中心4', '新闻中心4', '新闻中心4新闻中心4', '../uploads/', '2018-02-01 13:17:39', '新闻中心4', 9),
(10, '关于金岭', '关于金岭关于金岭', '关于金岭关于金岭关于金岭', '', '2018-03-11 12:08:51', '', 0),
(11, '联系我们', '联系我们', '联系我们联系我们', '../uploads/', '2018-02-01 13:26:56', '我', 18),
(12, '主要产品', '主要产品', '主要产品主要产品', '../uploads/', '2018-02-01 13:27:15', '我', 16),
(13, '社会责任', '社会责任', '社会责任社会责任', '../uploads/', '2018-02-01 13:27:33', '我', 15),
(14, '企业文化', '企业文化', '企业文化企业文化', '../uploads/', '2018-02-01 13:28:09', '我', 14),
(15, '社会责任', '社会责任社会责任', '社会责任社会责任社会责任', '../uploads/', '2018-02-02 05:50:39', '我', 12),
(16, '人力资源', '人力资源人力资源', '人力资源人力资源人力资源', '../uploads/', '2018-02-02 05:52:36', '我', 10),
(17, '新闻中心', '新闻中心', '新闻中心新闻中心', '../uploads/', '2018-02-02 05:53:18', '我', 9),
(18, '联系我们', '联系我们联系我们', '联系我们联系我们', '../uploads/', '2018-02-02 06:41:44', '通知公告', 19),
(19, '通知公告1', '通知公告1', '通知公告1通知公告1', '../uploads/', '2018-02-02 06:42:13', '通知公告1', 19),
(20, '通知公告2', '通知公告2通知公告2', '通知公告2通知公告2', '../uploads/', '2018-02-02 06:42:34', '通知公告2', 19),
(21, '产品销售信息1', '产品销售信息1', '产品销售信息1', '../uploads/', '2018-02-02 06:43:15', '产品销售信息', 20);

-- --------------------------------------------------------

--
-- 表的结构 `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `intro` varchar(200) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `times` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `nav`
--

INSERT INTO `nav` (`id`, `title`, `url`, `intro`, `banner`, `times`) VALUES
(11, '首页', 'index.php', '首页首页', '../uploads/banner-index.jpg', '2018-03-11 07:32:43'),
(10, '关于金岭', 'about.php', '关于金岭', '../uploads/banner_a.jpg', '2018-02-02 07:28:05'),
(9, '新闻中心', 'news.php', '新闻中心', '../uploads/news.jpg', '2018-02-02 07:24:59'),
(12, '主要产品', 'product.php', '主要产品', '../uploads/banner_jlhg.jpg', '2018-02-02 07:26:06'),
(14, '企业文化', 'culture.php', '企业文化', '../uploads/aboutBanner.jpg', '2018-02-02 07:27:38'),
(15, '社会责任', 'responsibility.php', '社会责任', '../uploads/banner_shzr.jpg', '2018-02-02 07:28:34'),
(16, '人力资源', 'hr.php', '人力资源', '../uploads/rlzy.jpg', '2018-02-02 07:29:07'),
(18, '联系我们', 'contact.php', '联系我们', '../uploads/banner_lx.jpg', '2018-02-02 07:29:51');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(66) NOT NULL,
  `con` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `con`) VALUES
(7, '东营市侨联主席赵军到公司调研', '东营市侨联主席赵军到公司调研东营市侨联主席赵军到公司调研东营市侨联主席赵军到公司调研'),
(8, '东营市侨联主席赵军到公司调研', '东营市侨联主席赵军到公司调研东营市侨联主席赵军到公司调研东营市侨联主席赵军到公司调研'),
(9, '金岭集团再次上榜中国石油和化工民营企业百强', '金岭集团再次上榜中国石油和化工民营企业百强金岭集团再次上榜中国石油和化工民营企业百强'),
(10, '国家环保部环境保护对外合作中心陈亮主任到公司调研', '国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研'),
(11, '金岭集团再次上榜中国石油和化工民营企业百强', '金岭集团再次上榜中国石油和化工民营企业百强金岭集团再次上榜中国石油和化工民营企业百强'),
(12, '国家环保部环境保护对外合作中心陈亮主任到公司调研', '国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研'),
(13, '国家环保部环境保护对外合作中心陈亮主任到公司调研', '国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研'),
(14, '国家环保部环境保护对外合作中心陈亮主任到公司调研', '国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研国家环保部环境保护对外合作中心陈亮主任到公司调研'),
(15, '济南市工商联考察团到公司考察', '济南市工商联考察团到公司考察济南市工商联考察团到公司考察济南市工商联考察团到公司考察济南市工商联考察团到公司考察'),
(16, 'Helloworld', 'HelloworldHelloworldHelloworldHelloworldHelloworldHelloworld'),
(17, '您好世界您好世界您好世界您好世界', '您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界您好世界');

-- --------------------------------------------------------

--
-- 表的结构 `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(66) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `staff`
--

INSERT INTO `staff` (`id`, `user`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
