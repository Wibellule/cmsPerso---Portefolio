-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 05 Décembre 2012 à 21:28
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `datas`
--

CREATE TABLE IF NOT EXISTS `datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `datas`
--

INSERT INTO `datas` (`id`, `name`, `firstname`, `birthday`, `address`, `email`, `website`) VALUES
(1, 'CORNU', 'Guillaume', '10 Septembre, 1988', '219, rue de saint hilaire', 'gyome34@hotmail.com', 'www.wibellule.com');

-- --------------------------------------------------------

--
-- Structure de la table `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

CREATE TABLE IF NOT EXISTS `emplois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `emplois`
--

INSERT INTO `emplois` (`id`, `title`, `subtitle`, `content`, `date`, `online`) VALUES
(1, 'titre1', 'sous-titre1', '<p>test</p>', 2010, 1);

-- --------------------------------------------------------

--
-- Structure de la table `focuss`
--

CREATE TABLE IF NOT EXISTS `focuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `focuss`
--

INSERT INTO `focuss` (`id`, `name`, `slug`, `file`, `online`, `position`) VALUES
(1, 'Mon premier focus', 'ma-premiere-page', '2012-11/LogoLechaud.png', 1, 1),
(2, NULL, NULL, NULL, -1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medias_posts_idx` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `medias`
--

INSERT INTO `medias` (`id`, `name`, `file`, `post_id`, `type`) VALUES
(1, 'fichier', '2012-09/15092012296.jpg', 19, 'img'),
(4, 'chat rigolo', '2012-09/5318802_460s.jpg', 20, 'img'),
(5, 'Slider_test', '2012-11/slider_pic3.png', 2, 'img'),
(8, 'churros', '2012-11/churros-3.jpg', 2, 'img');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `name`, `content`, `created`, `online`, `type`, `slug`, `user_id`) VALUES
(1, 'ma première page', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2012-11-09 03:52:43', 1, 'page', 'ma-premiere-page', 0),
(2, 'ma seconde page', '<p>mon second contenu apr&egrave;s le premier</p>', '2012-11-12 02:16:41', 1, 'page', 'ma-seconde-page', 0),
(3, 'mon premier article', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2012-09-19 00:00:00', 1, 'post', 'mon-premier-article', 0),
(4, 'mon second article', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2012-09-19 00:00:00', 1, 'post', 'mon-second-article', 0),
(5, 'mon titre', '<p>Mon contenu de test</p>', NULL, 1, 'post', 'mon-url', NULL),
(19, 'Editor - TinyMCE', '<p><a href="/cms/post/mon-nouvel-article-19"><img style="float: left;" src="/cms/img/2012-09/15092012296.jpg" alt="" width="200" height="150" /></a>Mon contenu :</p>\r\n<ul>\r\n<li style="text-align: justify;">Mon premier <strong>&eacute;lement</strong></li>\r\n<li style="text-align: justify;">Mon second <em>&eacute;lement</em></li>\r\n<li style="text-align: justify;">Mon troisi&egrave;me <span style="text-decoration: underline;">&eacute;lement</span></li>\r\n<li>Mon dernier <span style="text-decoration: line-through;">&eacute;lement</span></li>\r\n</ul>\r\n<p style="text-align: justify;">Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?&nbsp;Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?Nouvel essai tinymce, est ce que ce texte sera justifi&eacute; ?</p>\r\n<p style="text-align: justify;">&nbsp;</p>', '2012-09-28 01:12:24', 1, 'post', 'mon-nouvel-article', NULL),
(20, 'Chat', '<p><img style="float: left;" src="/cms/img/2012-09/5318802_460s.jpg" alt="" width="200" height="280" /></p>', '2012-10-23 12:38:21', 0, 'post', 'chat-rigolo', NULL),
(22, 'Ma troisième page', '<p>Test de la troisi&egrave;me page</p>', '2012-11-12 01:18:41', 0, 'page', 'ma-troisieme-page', NULL),
(23, 'mon titre de test', '<p>lksnco&ugrave;qiezsnc&ugrave;oizenc &ugrave;oeznc,&ugrave;zoiec,n &ugrave;zeoi,fdz&ugrave;edjn,cz&ugrave;ioek</p>', '2012-11-13 02:30:22', 1, 'post', 'mon-titre-de-test', NULL),
(24, NULL, NULL, NULL, -1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `file`, `online`) VALUES
(1, 'Slider1', '2012-11/slide1.jpg', 1),
(3, 'Slider2', '2012-11/slide2.jpg', 1),
(4, 'Slider3', '2012-11/slide3.jpg', 1),
(5, 'Slider4', '2012-12/306774_506641992686384_2118315817_n.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
