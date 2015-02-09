-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 10 日 05:34
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `fanruo`
--

--
-- 表的结构 `fr_cats`
--

CREATE TABLE IF NOT EXISTS `fr_cats` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) DEFAULT NULL,
  `cat_author` int(4) DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 表的结构 `fr_contacts`
--

CREATE TABLE IF NOT EXISTS `fr_contacts` (
  `contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(20) NOT NULL,
  `contact_type` varchar(20) DEFAULT NULL,
  `contact_num` varchar(48) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 表的结构 `fr_downloads`
--

CREATE TABLE IF NOT EXISTS `fr_downloads` (
  `dl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dl_name` varchar(50) DEFAULT NULL,
  `dl_cat` varchar(20) NOT NULL,
  `dl_discrib` mediumtext,
  PRIMARY KEY (`dl_id`),
  KEY `dl_cat` (`dl_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 表的结构 `fr_images`
--

CREATE TABLE IF NOT EXISTS `fr_images` (
  `image_id` int(10) unsigned NOT NULL,
  `image_name` varchar(20) NOT NULL,
  `image_path` varchar(80) NOT NULL,
  `image_save_name` varchar(80) NOT NULL,
  `is_display` int(1) DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 表的结构 `fr_jobs`
--

CREATE TABLE IF NOT EXISTS `fr_jobs` (
  `job_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL DEFAULT '0',
  `job_name` varchar(100) NOT NULL,
  `job_cat` varchar(20) NOT NULL,
  `num` varchar(10) DEFAULT NULL,
  `work_where` varchar(100) DEFAULT NULL,
  `wage` varchar(30) DEFAULT NULL,
  `ask_sex` int(1) NOT NULL DEFAULT '0',
  `ask_edu` varchar(20) DEFAULT NULL,
  `exp_require` mediumtext,
  `add_time` date DEFAULT '1970-01-01',
  `job_status` tinyint(1) NOT NULL DEFAULT '0',
  `more_discrib` mediumtext NOT NULL,
  `contact_email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  KEY `job_cat` (`job_cat`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 表的结构 `fr_links`
--

CREATE TABLE IF NOT EXISTS `fr_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(50) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `images_dir` varchar(255) DEFAULT NULL,
  `add_time` date DEFAULT '1970-01-01',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 `fr_navs`
--

CREATE TABLE IF NOT EXISTS `fr_navs` (
  `nav_id` int(10) unsigned NOT NULL,
  `nav_name` varchar(20) NOT NULL,
  `nav_url` varchar(150) DEFAULT NULL,
  `nav_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 表的结构 `fr_news`
--

CREATE TABLE IF NOT EXISTS `fr_news` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) DEFAULT NULL,
  `post_id` varchar(50) NOT NULL DEFAULT '0',
  `news_cat` varchar(20) NOT NULL,
  `post_date` date NOT NULL DEFAULT '1970-01-01',
  `from_name` varchar(100) DEFAULT NULL,
  `from_url` varchar(150) DEFAULT NULL,
  `content` mediumtext,
  PRIMARY KEY (`news_id`),
  KEY `news_cat` (`news_cat`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 表的结构 `fr_notices`
--

CREATE TABLE IF NOT EXISTS `fr_notices` (
  `notice_id` int(10) NOT NULL AUTO_INCREMENT,
  `notice_title` varchar(255) DEFAULT NULL,
  `notice_cat` varchar(20) NOT NULL,
  `post_id` varchar(50) NOT NULL DEFAULT '0',
  `post_date` date NOT NULL DEFAULT '1970-01-01',
  `content` mediumtext,
  PRIMARY KEY (`notice_id`),
  KEY `notice_cat` (`notice_cat`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 表的结构 `fr_orders`
--

CREATE TABLE IF NOT EXISTS `fr_orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `telphone` varchar(20) DEFAULT NULL,
  `cellphone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `content` text,
  `add_time` date DEFAULT '1970-01-01',
  `see` tinyint(1) NOT NULL DEFAULT '0',
  `deal` tinyint(1) NOT NULL DEFAULT '0',
  `order_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 `fr_pages`
--

CREATE TABLE IF NOT EXISTS `fr_pages` (
  `page_id` int(10) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 表的结构 `fr_products`
--

CREATE TABLE IF NOT EXISTS `fr_products` (
  `pro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(50) DEFAULT NULL,
  `pro_price` int(10) DEFAULT NULL,
  `pro_cat` varchar(20) NOT NULL,
  `pro_discrib` mediumtext,
  PRIMARY KEY (`pro_id`),
  KEY `pro_cat` (`pro_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 表的结构 `fr_users`
--

CREATE TABLE IF NOT EXISTS `fr_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_passwd` varchar(50) NOT NULL,
  `user_role` int(4) DEFAULT '1',
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


