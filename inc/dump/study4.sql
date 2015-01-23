SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `study4` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `study4`;

CREATE TABLE IF NOT EXISTS `st_gb_messages` (
`id` int(10) unsigned NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `messageText` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `st_gb_messages` (`id`, `userName`, `userEmail`, `messageText`, `date`) VALUES
(1, 'administrator', 'alexandr@gmail.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2015-01-16 20:26:03');

CREATE TABLE IF NOT EXISTS `st_notes` (
`id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL,
  `id_author` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `st_notes` (`id`, `title`, `description`, `text`, `id_author`, `date`) VALUES
(1, 'title1', 'The PHP development team announces the immediate availability of PHP 5.4.36. Two security-related bugs were fixed in this release, including the fix for CVE-2014-8142. All PHP 5.4 users are encouraged to upgrade to this version.', 'The PHP development team announces the immediate availability of PHP 5.4.36. Two security-related bugs were fixed in this release, including the fix for CVE-2014-8142. All PHP 5.4 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 5.4.36 please visit our downloads page, Windows binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 1, '2015-01-22 17:33:23'),
(2, 'title2', 'В языках программирования и теории типов полиморфизмом называется способность функции обрабатывать данные разных типов', 'Существует несколько видов полиморфизма. Два наиболее различных из них были описаны Кристофером Стрэчи[en] в 1967 году: это специальный полиморфизм (или «ad hoc полиморфизм») и параметрический полиморфизм. Кратко специальный полиморфизм описывается принципом «много реализаций с похожими интерфейсами», а параметрический полиморфизм — «одна реализация с обобщённым интерфейсом».', 1, '2015-01-22 18:41:35');

CREATE TABLE IF NOT EXISTS `st_users` (
`id` int(11) unsigned NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_status` int(2) unsigned NOT NULL,
  `hash` varchar(255) NOT NULL,
  `extInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `st_users` (`id`, `userName`, `userEmail`, `password`, `id_status`, `hash`, `extInfo`) VALUES
(1, 'administrator', 'afilipov92@gmail.com', '1c03086b5e9170031973682be9e35ec5', 1, 'actived', NULL),
(10, 'liluoz', 'liluoz@mail.ru', 'd6d386f34344727e12de86881571a77f', 2, 'actived', NULL);


ALTER TABLE `st_gb_messages`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `st_notes`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `st_users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_users_status` (`id_status`);


ALTER TABLE `st_gb_messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `st_notes`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `st_users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
