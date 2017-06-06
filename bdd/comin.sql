-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Juin 2017 à 08:38
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `comin`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `date_debut` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`id`, `titre`, `date_debut`, `active`) VALUES
(15, 'Sortie au sables', '2017-01-11 00:00:00', 1),
(14, 'Halloween', '2016-10-31 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `a_venir`
--

CREATE TABLE IF NOT EXISTS `a_venir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `lieu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `a_venir`
--

INSERT INTO `a_venir` (`id`, `titre`, `description`, `date_debut`, `date_fin`, `active`, `lieu`) VALUES
(16, 'remise de diplÃ´me', 'Nous vous convions Ã  la remise des diplÃ´mes des Ã©tudiants du Rizomm', '2017-09-01 17:00:00', '2017-09-01 18:00:00', 1, 'Rizomm'),
(18, 'GALA FGES', 'Gala de fin d''annÃ©e <br/>\r\n- Un lot Ã  gagner toutes les heures <br/>\r\n- BiÃ¨res / Vins / Champagne <br/>\r\n- WEKEED en concert <br/>', '2017-06-07 19:00:00', '2017-06-08 00:03:00', 1, 'Secret Place'),
(19, 'ABC D''ailleurs', 'Vente de gateaux', '2017-08-09 08:00:00', '2017-08-10 12:00:00', 1, 'Hall RS');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `id_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `type`, `id_type`, `name`, `text`, `active`, `created`) VALUES
(1, 'aze', 1, 'aze', 'zer', 0, '2017-06-05 20:03:59'),
(2, 'aze', 1, 'aze', 'zer', 0, '2017-06-05 20:04:00'),
(3, 'aze', 1, 'aze', 'zer', 0, '2017-06-05 20:04:00'),
(4, 'aze', 1, 'aze', 'zer', 0, '2017-06-05 20:04:01');

-- --------------------------------------------------------

--
-- Structure de la table `flashback`
--

CREATE TABLE IF NOT EXISTS `flashback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `date_debut` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `flashback`
--

INSERT INTO `flashback` (`id`, `titre`, `description`, `date_debut`, `active`) VALUES
(6, 'BSH - Don du Sang ', '<p><img class="fr-dib fr-draggable" src="/assets/img/flashback/6/8240bbef3cb1ec3abd8c305c0080cabe44f1b468.png" style="width: 100%; height: 100%;"></p><p><u><a class="fr-green" href="https://www.facebook.com/BSH.Fges/?fref=ts">BSH FGES</a></u></p>', '2017-02-16 00:00:00', 1),
(7, 'FGES Conseil - Information Recrutement ', '<p><img class="fr-dib fr-draggable" src="/assets/img/flashback/7/f372f6da551e252ed731dcfcdd8626ec0e706cfd.png" style="width: 100%; height: 100%;"></p><p><br><u><a class="fr-green" href="https://www.facebook.com/FGES-Conseil-450054628356179/?fref=ts">FGES Conseil</a></u></p>', '2017-02-13 00:00:00', 1),
(8, 'La FGES FÃ©es des RÃªves - Petit Dej', '<p><img class="fr-dib fr-draggable" src="/assets/img/flashback/8/bbe5f4af754e0959d7a6d02f564571b04472867f.png" style="width: 100%; height: 100%;"></p><p><br><u><a class="fr-green" href="https://www.facebook.com/La-FGES-F%C3%A9e-Des-R%C3%AAves-957601390967029/?fref=ts">La FGES F&eacute;es des R&ecirc;ves</a></u></p>', '2017-01-18 00:00:00', 1),
(9, 'FGES DAY 1', '<p>FGES DAY : LA JOURNEE QU&#39;IL NE FALLAIT SURTOUT PAS MANQUER !<br><br>Aujourd&#39;hui, on vous d&eacute;voile enfin LA vid&eacute;o de cette journ&eacute;e pleine de folie !<br><br>Flashback de toutes nos associations :<u>&nbsp;<a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=1069893536451776" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/BDA.FGES/">BDA FGES</a> <span style="color: rgb(41, 105, 176);"><a data-hovercard="/ajax/hovercard/page.php?id=1464800417119219" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/bds.flseg/">BDS FGES</a>&nbsp;</span><a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=924064137608186" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/BSH.Fges/">BSH FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=550775711758103" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/sailfges/">SAIL FGES</a><a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=324473007713732" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/travelinfges/">Travel&#39;in FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=634107246687251" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/lequationgourmandefges/">L&#39;&eacute;quation Gourmande FGES</a><a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=1709486412608578" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/dayclicfges/">Day&#39;Clic FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=600589750109634" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/cominfges/">Com&#39;in FGES</a> <a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=602315439877766" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/tedefilepasfseg/">Te D&eacute;file Pas FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=1329297543749195" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/promofges/">Promo FGES</a> <a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=499054970230517" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/filao.burkinafaso/">Filao FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=1752679741654175" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/Eur%C3%AAka-FGES-1752679741654175/">Eur&ecirc;ka FGES</a><a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=859816054038096" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/graindesable59/">Grain de Sable</a> <a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=523336687825229" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/EnactuslesFacultesdelUniversiteCatholiquedeLille/">Enactus Les Facult&eacute;s de l&#39;Universit&eacute; Catholique de Lille</a> <a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=1482418992009432" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/BVI.FGES/">BVI FGES</a><a data-hovercard="/ajax/hovercard/page.php?id=875931972475298" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/EcogestFGES/">Ecogest&#39;</a> <a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=562164050556159" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/wine.not.fges/">Wine Not FGES</a> <a data-hovercard="/ajax/hovercard/page.php?id=326834897670917" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/GoodVibesFGES/">Good Vibes FGES</a><a class="fr-green" data-hovercard="/ajax/hovercard/page.php?id=718719598260402" data-hovercard-prefer-more-content-show="1" href="https://www.facebook.com/linstantstartup/">L&#39;Instant Start-UP</a></u><br><br>On vous invite &agrave; suivre chacune des associations de notre facult&eacute; afin de vous tenir &agrave; la page ! <br><br>Ne ratez surtout pas la prochaine FGES DAY ! <br><br>&amp; la prochaine fois, tu ferais mieux de venir !</p><p><a class="fr-green" href="https://www.facebook.com/YouBetterCome/videos/585782298235384/"><u>Vid&eacute;o</u></a></p>', '2016-12-01 00:00:00', 1),
(5, 'Enactus - Panier LÃ©gumes', '<p><img class="fr-dib fr-draggable" src="/assets/img/flashback/5/d41146ba1e18de6ff471fc99027761c05cbf8271.png" style="width: 100%; height: 100%;"><a class="fr-green" href="https://www.facebook.com/EnactuslesFacultesdelUniversiteCatholiquedeLille/"><u>Enactus Les Facult&eacute;s de l&#39;Universit&eacute; Catholique de Lille</u></a></p><p><a class="fr-green" href="https://www.facebook.com/laruchequiditoui/"><u>La Ruche qui dit Oui</u></a></p>', '2017-03-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `flashback_has_photos`
--

CREATE TABLE IF NOT EXISTS `flashback_has_photos` (
  `id_flashback` int(11) NOT NULL,
  `id_photos` int(11) NOT NULL,
  PRIMARY KEY (`id_flashback`,`id_photos`),
  KEY `fk_flashback_has_photos_photos1_idx` (`id_photos`),
  KEY `fk_flashback_has_photos_flashback1_idx` (`id_flashback`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_album` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_album`),
  KEY `fk_photos_album1_idx` (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=557 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `url`, `name`, `id_album`) VALUES
(556, '/assets/img/album/15/4c64cd6d272473c2e8495eaf2d160594.jpg', '4c64cd6d272473c2e8495eaf2d160594.jpg', 15),
(555, '/assets/img/album/15/f4dbffa1d002cd41cd2a0e35f1233ec6.jpg', 'f4dbffa1d002cd41cd2a0e35f1233ec6.jpg', 15),
(554, '/assets/img/album/15/e7a333dbbc4073cd03dc0006bde74426.jpg', 'e7a333dbbc4073cd03dc0006bde74426.jpg', 15),
(553, '/assets/img/album/14/742818cd1ecb80d41bff474e414458dd.jpg', '742818cd1ecb80d41bff474e414458dd.jpg', 14),
(552, '/assets/img/album/14/ff2b4a2f0309514c1c24268001f86bbb.jpg', 'ff2b4a2f0309514c1c24268001f86bbb.jpg', 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `avenir` tinyint(1) NOT NULL,
  `lesphotos` tinyint(1) NOT NULL,
  `flashback` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `motdepasse`, `avenir`, `lesphotos`, `flashback`, `admin`) VALUES
(12, 'apple@apple.com', '5d88ef77d039f4594828866f6f99574f', 1, 1, 1, 0),
(1, 'frederic.guilbert@univ-catholille.fr', '0a5b3913cbc9a9092311630e869b4442', 1, 1, 1, 1),
(2, 'coralie.talma@univ-catholille.fr', '0a5b3913cbc9a9092311630e869b4442', 1, 1, 1, 1),
(8, 'youbettercomeybc@gmail.com', 'ad90c2c745a775cb0c6ac8001c32cb64', 0, 0, 1, 0),
(9, 'cominfges@gmail.com', '1917b8c17e8d48a2041134af8ea7dae8', 1, 0, 0, 0),
(10, 'debaeckergautier@gmail.com', '35f95ee729c6a811eadbf800491e752f', 0, 1, 0, 0),
(11, 'groover.dieu@gmail.com', 'f4fe4cc2cccb6407c18e6305f7e48842', 1, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
