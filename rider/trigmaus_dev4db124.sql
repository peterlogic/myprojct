-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2016 at 09:11 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trigmaus_dev4db124`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_tokens`
--

CREATE TABLE IF NOT EXISTS `access_tokens` (
  `oauth_token` varchar(40) NOT NULL,
  `client_id` char(36) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`oauth_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_codes`
--

CREATE TABLE IF NOT EXISTS `auth_codes` (
  `code` varchar(40) NOT NULL,
  `client_id` char(36) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `redirect_uri` varchar(200) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=''Deactive'',1=''Active''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `link`, `created`, `updated`, `status`) VALUES
(5, 'Blog 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'story1.jpg1443214287', 'www.google.com', '2015-09-25 20:51:27', '2015-09-29 18:55:56', 1),
(3, 'Blog 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'story1.jpg1443208071', 'www.google.com', '2015-09-25 19:07:51', '2015-09-29 17:49:17', 1),
(4, 'Blog 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'story2.jpg1443208114', 'www.google.com', '2015-09-25 19:08:34', '2015-09-29 17:53:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(6, 'Hair Shampoo', 1),
(7, 'Air Fresheners', 1),
(8, 'Alcoholic Beverages', 1),
(9, 'All-Purpose Cleaners', 1),
(10, 'Allergy, Asthma, and Sinus Medicine', 1),
(11, 'Alternative Medicine', 1),
(12, 'Aromatherapy', 1),
(13, 'Baby Bath & Hair Care', 1),
(15, 'Baby Care', 1),
(16, 'Baby Diapers & Diaper Care', 1),
(17, 'Baby Feeding', 1),
(18, 'Baby Medicine & Vitamins', 1),
(19, 'Baby Food', 1),
(20, 'Baby Skin Care', 1),
(21, 'Baby Teeth Care', 1),
(22, 'Baking Ingredients', 1),
(23, 'Baking Products', 1),
(24, 'Bandages & Gauzes', 1),
(25, 'Bath Products', 1),
(26, 'Bathroom Cleaners', 1),
(27, 'Beans', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `email`, `phone`, `message`, `created`) VALUES
(92, 'dgdfg', 's@gmail.com', '1234567890', 'uikuikuik', '2016-04-06 23:54:19'),
(89, '', 't@trigma.in', '7412589635', 'hello', '2016-04-06 20:47:43'),
(90, 'ddasda', 's@gmail.com', '9888109789', 'sdfsdfsdf', '2016-04-06 21:38:58'),
(91, 'sfsdfs', 's@trigma.in', '9888109789', 'sdfgdsfsf', '2016-04-06 21:40:24'),
(88, '', 'sa@gmail.com', '9888109789', 'hello testing', '2016-04-06 20:43:43'),
(87, '', 's@gmail.com', '9041909789', 'hello', '2016-04-06 20:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=''Deactive'',1=''Active''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `content`, `image`, `created`, `updated`, `status`) VALUES
(3, 'Ride Rescue Service 1', 'we are always available to help you  ', 'service-img2.jpg1443205387', '2015-09-25 18:23:07', '2015-09-28 17:23:16', 1),
(4, 'Ride Rescue Service 2', 'we are always available to help you  ', 'service-img3.jpg1443205425', '2015-09-25 18:23:45', '2016-04-06 20:39:06', 1),
(5, 'Ride Rescue Service 3', 'we are always available to help you  ', 'service-img1.jpg1443205454', '2015-09-25 18:24:14', '2016-04-06 20:39:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE IF NOT EXISTS `sitesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `web_url` varchar(250) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `site_desc` varchar(500) NOT NULL,
  `facebook_url` varchar(150) NOT NULL,
  `instagram_url` varchar(255) NOT NULL,
  `twitter_url` varchar(150) NOT NULL,
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keyword` varchar(200) NOT NULL,
  `googleplus` varchar(150) NOT NULL,
  `site_email` varchar(100) NOT NULL,
  `contact` bigint(255) NOT NULL,
  `site_address` varchar(500) NOT NULL,
  `analytic_code` varchar(500) NOT NULL,
  `server` varchar(200) NOT NULL,
  `port` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `server_auth` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`id`, `title`, `web_url`, `keywords`, `site_desc`, `facebook_url`, `instagram_url`, `twitter_url`, `meta_title`, `meta_description`, `meta_keyword`, `googleplus`, `site_email`, `contact`, `site_address`, `analytic_code`, `server`, `port`, `username`, `password`, `server_auth`) VALUES
(2, 'Rider-Rescue', 'http://dev414.trigma.us/Rider-Rescue/', 'Rider-Rescue', 'Rider-Rescue', 'https://facebook.com/', 'https://instagram.com', 'https://twitter.com', 'riderescue', 'riderescue', 'riderescue', 'https://google.com', 'palwinder.singh@trigma.info', 172458967, 'Rider-Rescue', '', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=''Deactive'',1=''Active''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `content`, `image`, `link`, `created`, `updated`, `status`) VALUES
(5, 'Ride Rescue 2', 'Welcome to world of comfort driving', 'slide1.jpg1443204352', 'www.google.com', '2015-09-25 18:05:52', '2016-04-06 17:43:30', 1),
(4, 'Ride rescue', 'Welcome to ride rescue !!!!!!!', 'slide1.jpg1443203722', 'www.riderescue.com', '2015-09-25 17:55:22', '2015-09-25 17:55:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staticpages`
--

CREATE TABLE IF NOT EXISTS `staticpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staticpages`
--

INSERT INTO `staticpages` (`id`, `title`, `description`, `created`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 'What we do\n', '<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</div>', '2015-09-24 00:00:00', 'About Us', 'this is test', 'test1,test2'),
(2, 'The Executive Team', '<div class="about-info">\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">&nbsp;</div>\r\n<div class="about-info" style="color: #000000; font-family: ''Times New Roman''; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</div>\r\n</div>', '2015-09-24 00:00:00', 'demo', 'this is demo', 'test1,test2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `college` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `resume` varchar(255) NOT NULL,
  `certificate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `birthday` date NOT NULL,
  `token` text NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `user_notification` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `register_date` varchar(100) NOT NULL,
  `profile_image` varchar(250) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `home_town` varchar(200) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `employes` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A',
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `summary` text NOT NULL,
  `registertype` varchar(500) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `twiter_id` varchar(255) NOT NULL,
  `devicetype` varchar(500) NOT NULL,
  `fbpassword` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2325 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sort_order_id`, `username`, `college`, `resume`, `certificate`, `password`, `email`, `birthday`, `token`, `usertype_id`, `status`, `user_notification`, `register_date`, `profile_image`, `contact`, `home_town`, `first_name`, `last_name`, `company_name`, `category_id`, `employes`, `address`, `website`, `description`, `summary`, `registertype`, `fb_id`, `twiter_id`, `devicetype`, `fbpassword`) VALUES
(1, 1, 'admin', '', '', '', 'e3c41f11b6d12652694094554b48f8126ff24943', 'sahil.seth@trigma.in', '0000-00-00', 'e37a2178c21633f396315f93f63594dd80a9b737', 1, '1', '1', '2015-05-19', 'ride-rescue-sample.png', 235235235523, '', 'Trigma', 'Solution', 'dfhdfh', 4, 0, 'N/A', 'N/A', '', 'rydy', '', '', '', '', ''),
(2, 1, 'gurudustt1', '', '', '', '3db96102226efd4f17b30434b8cafb9c0a7cb262', 'gurudutt.shgarma@trigma.in', '0000-00-00', '', 2, '1', '1', '2015-09-17', '2324profileImage.png', 1234567890, '', '', '', '', 0, 0, 'N/A', 'N/A', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(250) NOT NULL,
  `Authorities` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `group_name`, `Authorities`, `status`) VALUES
(1, 'Administrators', 'All', 1),
(2, 'users', 'Few', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
