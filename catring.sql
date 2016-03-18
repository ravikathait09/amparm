-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2014 at 06:56 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catring`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contactemail` varchar(100) NOT NULL,
  `contactphone` varchar(15) NOT NULL,
  `zip` varchar(8) NOT NULL,
  `area` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `description`, `price`, `image`, `address`, `contactemail`, `contactphone`, `zip`, `area`, `created`) VALUES
(1, 'Sagar Ratna', '<p>he food at Sagar Ratna mostly fits the pallet of Tamilians. I wouldn&#39;t really call it the taste of South India. Maybe parts.<br />\r\n<br />\r\nNot the kind of dosa or sambar I have eaten Or still served at the shanthi sagar&#39;s or the sukh sagar&#39;s or shiv sagar&#39;s, MTR ( The world knows them ), CTR&#39;s or the Kamats. The name &quot;Sagar&quot; revolutionized and popularized the south Indian restaurants in Bangalore in the early 80&#39;s until today. This is where the word Sagar started doing its rounds.<br />\r\n<br />\r\nNow coming to the crux of it.. The potatoes in the Masala Dosa are more like a paste very typical of the thin Papad like Masala Dosa&#39;s served in Tamil Nadu.<br />\r\n<br />\r\nThe Butter Dosa or Bene Dosa, tastes nothing like butter dosa. Its probably a few million miles away from the real thing.<br />\r\n&nbsp;</p>\r\n', 4500000.00, '', 'Ansal Fortune Arcade, 49-50, Sector 18', 'ravi01@gmail.com', '4758475', '248001', 'Noida', '0000-00-00 00:00:00'),
(2, 'Sagar Ratna', '<p>he food at Sagar Ratna mostly fits the pallet of Tamilians. I wouldn&#39;t really call it the taste of South India. Maybe parts.<br />\r\n<br />\r\nNot the kind of dosa or sambar I have eaten Or still served at the shanthi sagar&#39;s or the sukh sagar&#39;s or shiv sagar&#39;s, MTR ( The world knows them ), CTR&#39;s or the Kamats. The name &quot;Sagar&quot; revolutionized and popularized the south Indian restaurants in Bangalore in the early 80&#39;s until today. This is where the word Sagar started doing its rounds.<br />\r\n<br />\r\nNow coming to the crux of it.. The potatoes in the Masala Dosa are more like a paste very typical of the thin Papad like Masala Dosa&#39;s served in Tamil Nadu.<br />\r\n<br />\r\nThe Butter Dosa or Bene Dosa, tastes nothing like butter dosa. Its probably a few million miles away from the real thing.<br />\r\n&nbsp;</p>\r\n', 4500000.00, '', 'Ansal Fortune Arcade, 49-50, Sector 18', 'ravi01@gmail.com', '4758475', '248001', 'Noida', '0000-00-00 00:00:00'),
(3, 'Sagar Ratna', '<p>he food at Sagar Ratna mostly fits the pallet of Tamilians. I wouldn&#39;t really call it the taste of South India. Maybe parts.<br />\r\n<br />\r\nNot the kind of dosa or sambar I have eaten Or still served at the shanthi sagar&#39;s or the sukh sagar&#39;s or shiv sagar&#39;s, MTR ( The world knows them ), CTR&#39;s or the Kamats. The name &quot;Sagar&quot; revolutionized and popularized the south Indian restaurants in Bangalore in the early 80&#39;s until today. This is where the word Sagar started doing its rounds.<br />\r\n<br />\r\nNow coming to the crux of it.. The potatoes in the Masala Dosa are more like a paste very typical of the thin Papad like Masala Dosa&#39;s served in Tamil Nadu.<br />\r\n<br />\r\nThe Butter Dosa or Bene Dosa, tastes nothing like butter dosa. Its probably a few million miles away from the real thing.<br />\r\n&nbsp;</p>\r\n', 4500000.00, '', 'Ansal Fortune Arcade, 49-50, Sector 18', 'ravi01@gmail.com', '4758475', '248001', 'Noida', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cat_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_desc`, `added_on`) VALUES
(1, 'Caravan', 'Caravan Tours offers fully escorted tours plus all-inclusive Latin America vacations with tour operators, meals, water, 1st class resorts and airport transfers.', '2014-04-08 18:34:09'),
(6, 'Mobile Home', 'All about komotor', '2014-04-19 18:11:04'),
(8, 'test 9', 'dfasd dfads ', '2014-11-11 07:17:42'),
(9, 'test 2', 'dfasf', '2014-11-11 07:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `phone`, `ip`, `created`) VALUES
(1, 'ravi', 'ravikathait01@gmail.com', 'he food at Sagar Ratna mostly fits the pallet of Tamilians. I wouldn''t really call it the taste of South India. Maybe parts.\r\n\r\nNot the kind of dosa or sambar I have eaten Or still served at the shanthi sagar''s or the sukh sagar''s or shiv sagar''s, MTR ( The world knows them ), CTR''s or the Kamats. The name "Sagar" revolutionized and popularized the south Indian restaurants in Bangalore in the early 80''s until today. This is where the word Sagar started doing its rounds.\r\n\r\nNow coming to the crux of it.. The potatoes in the Masala Dosa are more like a paste very typical of the thin Papad like Masala Dosa''s served in Tamil Nadu.\r\n\r\nThe Butter Dosa or Bene Dosa, tastes nothing like butter dosa. Its probably a few million miles away from the real thing.\r\n\r\n', '34534656', '198.168.0.92', '2014-11-12 06:29:00'),
(2, 'vivek', 'vivek@gmail.com', 'he food at Sagar Ratna mostly fits the pallet of Tamilians. I wouldn''t really call it the taste of South India. Maybe parts.\r\n\r\nNot the kind of dosa or sambar I have eaten Or still served at the shanthi sagar''s or the sukh sagar''s or shiv sagar''s, MTR ( The world knows them ), CTR''s or the Kamats. The name "Sagar" revolutionized and popularized the south Indian restaurants in Bangalore in the early 80''s until today. This is where the word Sagar started doing its rounds.\r\n\r\nNow coming to the crux of it.. The potatoes in the Masala Dosa are more like a paste very typical of the thin Papad like Masala Dosa''s served in Tamil Nadu.\r\n\r\nThe Butter Dosa or Bene Dosa, tastes nothing like butter dosa. Its probably a few million miles away from the real thing.\r\n\r\n', '566767', '192.68.0.0', '2014-11-29 23:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bussinessid` int(11) NOT NULL,
  `imageurl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `bussinessid`, `imageurl`) VALUES
(6, 3, '14172646606-150x111.jpg'),
(5, 3, '14172646603-150x111.jpg'),
(3, 3, '14172588593-150x111.jpg'),
(4, 3, '14172588594-150x111.jpg'),
(7, 3, '14172646609-150x111.jpg'),
(8, 3, '14172646741-150x111.jpg'),
(9, 3, '14172646742-150x111.jpg'),
(10, 3, '14172646743-150x111.jpg'),
(11, 2, '14172648583-150x111.jpg'),
(12, 2, '14172648584-150x111.jpg'),
(13, 2, '14172648585-150x111.jpg'),
(14, 2, '14172648721.jpg'),
(15, 2, '14172648722-150x111.jpg'),
(16, 2, '14172648723-150x111.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` int(2) NOT NULL,
  `language` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `meta_keywords`, `meta_tag`, `visibility`, `language`) VALUES
(9, 'About us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n                                           \r\n\r\n                                        ', 'about us', 'about us', 1, ''),
(10, 'How it works', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test', 'Test', 1, ''),
(11, 'Privacy Policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown <strong><em>printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their de</em></strong>fault model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 'test', 'test', 0, ''),
(12, 'Vehicle Owner Info', '<p><strong>Hyr ut din husvagn eller husbil!</strong></p>\r\n\r\n<p>Komotor.se ger dig m&ouml;jlighet att visa upp din husvagn eller husbil f&ouml;r alla dem som hyra den f&ouml;r att prova p&aring;, eller inte har r&aring;d eller lust att k&ouml;pa en egen.</p>\r\n\r\n<p>Det kostar ingenting just nu f&ouml;r vi vill att s&aring; m&aring;nga som m&ouml;jligt skall prova p&aring; att anv&auml;nda servicen. Senare kommer priset att vara ca 100 SEK/halv&aring;r, men du beh&ouml;ver inte oroa dig f&ouml;r o&ouml;nskade kostnader. Vi kommer inte att kr&auml;va n&aring;got betalt om du inte &auml;r intresserad av att forts&auml;tta, fast vi hoppas ju att du tycker det h&auml;r var en bra id&eacute; och vill ha kvar din annons.</p>\r\n\r\n<p>Komotor.se marknadsf&ouml;r din husbil eller husvagn i andra l&auml;nder ocks&aring; och du kan ange texter om fordonet p&aring; engelska, tyska och svenska. Fler spr&aring;k kommer!</p>\r\n\r\n<p><strong>Hur g&aring;r det till?</strong></p>\r\n\r\n<p>F&ouml;rst registrerar du dig som anv&auml;ndare.</p>\r\n\r\n<p>Ett email skickas till din emailadress.</p>\r\n\r\n<p>Klicka p&aring; l&auml;nken i emailet f&ouml;r att bekr&auml;fta adressen.</p>\r\n\r\n<p><em>Nu kan du logga in</em></p>\r\n\r\n<p>Registrera information om din husvagn eller husbil och ladda upp bilder p&aring; den. Upp till 3 stycken bilder.</p>\r\n\r\n<p>Du kan fylla i olika priser f&ouml;r olika tidsperioder s&aring; att priset anpassas till tex h&ouml;gs&auml;song och l&aring;gs&auml;song.</p>\r\n\r\n<p>Du kan beskriva n&auml;r fordonet &auml;r tillg&auml;ngligt f&ouml;r uthyrning och n&auml;r det &auml;r upptaget, detta kan du uppdatera efterhand som du hyr ut det, eller om det &auml;r ditt privata fordon, n&auml;r du sj&auml;lv vill anv&auml;nda det.</p>\r\n\r\n<p>D&auml;refter skulle du komma till en betalningssida d&auml;r du skulle ha angivit hur du ville betala, med kreditkort, PayPal eller mot faktura&hellip; men nu hoppar vi &ouml;ver det.</p>\r\n\r\n<p>Sedan tar det upp till n&aring;gra timmar innan annonsen godk&auml;nns av v&aring;ra kontrollanter.</p>\r\n\r\n<p><em>Annonsen &auml;r klar</em></p>\r\n\r\n<p>N&auml;r annonsen &auml;r klar, kommer de som vill hyra husvanar och husbilar att kunna s&ouml;ka p&aring; Komotor.se, se annonsen och kontakta dig med ett email som komotor.se skickar ut.</p>\r\n\r\n<p>Komotor.se tar inget ansvar f&ouml;r att du f&aring;r betalt av den du hyr ut till, men vi tar heller inte ut n&aring;gon komission eller n&aring;gra andra avgifter &auml;n den fasta kostnaden f&ouml;r att annonsera p&aring; Komotor.se (fast det &auml;r ju gratis nu&hellip;)</p>\r\n\r\n<p>V&auml;lkommen till komotor!</p>\r\n', '', '', 0, ''),
(13, 'Test Page ARea', '', 'Test , Page ,ARea', 'Test , Page ,ARea', 1, ''),
(14, 'Test Page ARea 2', '', 'Test , Page ,ARea', 'Test , Page ,ARea', 1, ''),
(17, '', '', '', '', 1, ''),
(16, 'Want to find', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bussinessid` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opt_title` varchar(250) NOT NULL,
  `opt_name` varchar(250) NOT NULL,
  `opt_val` text NOT NULL,
  `opt_order` int(11) NOT NULL,
  `opt_val_type` varchar(20) NOT NULL,
  `opt_tooltip` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `opt_title`, `opt_name`, `opt_val`, `opt_order`, `opt_val_type`, `opt_tooltip`, `added_on`) VALUES
(1, 'Site Name', 'site_name', 'Latest', 0, '', '', '2014-04-04 19:18:01'),
(2, 'Admin email', 'admin_email', 'ravikathait01@gmail.com', 1, '', 'admin email', '2014-04-10 09:49:41'),
(3, 'Admin contact email address', 'admin_contact_email', 'ravikathait01@gmail.com', 2, '', '', '2014-04-10 09:52:48'),
(4, 'Phone No', 'admin_phone', '1234567890', 0, '', '', '2014-04-10 09:52:48'),
(5, 'Address', 'admin_address', '', 0, '', '', '2014-04-10 09:55:16'),
(22, '1 year Subscription Fee', 'subscription_fee', '1000', 0, '', '', '2014-11-12 05:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `ip`, `name`, `email`, `code`, `added_on`) VALUES
(3, '117.225.194.239', 'aman', 'er.amandeep04@gmail.com', 'EXP', '2014-05-10 12:13:49'),
(4, '117.234.127.97', 'ravi', 'ideaamandeep@yahoo.co.in', '1400091040', '2014-05-14 18:10:40'),
(5, '202.131.116.194', 'raka', 'er.raj@gmail.com', 'EXP', '2014-05-17 07:19:46'),
(6, '122.173.235.247', 'deepak', 'deepak@gmail.com', '1400951757', '2014-05-24 17:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `originalpwd` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `region` varchar(50) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `company_name` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 for admin 2 for publisher 3 for visitor',
  `permission` varchar(100) NOT NULL,
  `unique_code` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active 2 for inactive',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `username`, `password`, `originalpwd`, `address`, `region`, `address2`, `company_name`, `phone`, `type`, `permission`, `unique_code`, `status`, `created_on`) VALUES
(21, 'Admin', 'admin@admin.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', 'West', 'noida ashok nagar', '', '3452435', 1, '', '', 1, '2014-03-19 16:26:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
