-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 11 Janvier 2020 à 13:10
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `demo`
--

CREATE TABLE IF NOT EXISTS `demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `demo`
--

INSERT INTO `demo` (`id`, `prenom`, `nom`) VALUES
(1, 'Jay', 'Némar'),
(2, 'Jay,', 'Lafrite'),
(3, 'Jay', 'Hochon'),
(4, 'Jay', 'Hurni');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `pass_md5` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `pass_md5`) VALUES
(1, 'peter', 'b1933e2b3c3d99c62d2831f448c98f6f'),
(2, 'peter', 'b1933e2b3c3d99c62d2831f448c98f6f');

-- --------------------------------------------------------

--
-- Structure de la table `photolabadmin`
--

CREATE TABLE IF NOT EXISTS `photolabadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_unicode_ci NOT NULL,
  `pass_md5` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `photolabadmin`
--

INSERT INTO `photolabadmin` (`id`, `login`, `pass_md5`) VALUES
(1, 'peter', 'b1933e2b3c3d99c62d2831f448c98f6f');

-- --------------------------------------------------------

--
-- Structure de la table `photolabcmd`
--

CREATE TABLE IF NOT EXISTS `photolabcmd` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DATECMD` date NOT NULL,
  `NOMCOMMANDE` text NOT NULL,
  `NBPLANCHES` int(10) NOT NULL DEFAULT '0',
  `TYPE` varchar(8) NOT NULL,
  `ETAT` int(10) NOT NULL DEFAULT '0',
  `FACTURE` int(11) DEFAULT NULL,
  `PAYE` int(11) NOT NULL,
  `commentaires` text NOT NULL,
  `Date_Record` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=278 ;

--
-- Contenu de la table `photolabcmd`
--

INSERT INTO `photolabcmd` (`ID`, `DATECMD`, `NOMCOMMANDE`, `NBPLANCHES`, `TYPE`, `ETAT`, `FACTURE`, `PAYE`, `commentaires`, `Date_Record`) VALUES
(270, '2019-10-21', '2019-10-21-Commandes isolees multiples-WEB', 30, 'lab', 6, 421, 0, 'drop', '2019-11-03 18:37:41'),
(268, '2020-04-18', '2020-04-18-L2 Gestion Erreur', 8, 'lab', 6, 421, 0, 'drop', '2019-11-03 18:37:41'),
(273, '2020-04-19', '2020-04-19-TEST DEROULE ERREUR RRR', 3, 'lab', 6, 0, 0, 'drop', '2019-11-25 00:26:55'),
(272, '2019-10-17', '2019-10-17-SITEWEB-Lamoriciere-Nantes ', 740, 'web', 6, 0, 0, 'drop', '2019-11-24 23:36:18'),
(277, '2019-10-17', '2019-10-17-L2-WEB-Mona Ozouf - SAVENAY-WEB-L2', 1026, 'lab', 0, 0, 0, 'drop', '2019-12-29 17:08:28');

-- --------------------------------------------------------

--
-- Structure de la table `photolabcmd_bak`
--

CREATE TABLE IF NOT EXISTS `photolabcmd_bak` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DATECMD` date NOT NULL,
  `NOMCOMMANDE` text NOT NULL,
  `NBPLANCHES` int(10) NOT NULL DEFAULT '0',
  `TYPE` varchar(8) NOT NULL DEFAULT 'LAB',
  `ETAT` int(10) NOT NULL DEFAULT '0',
  `FACTURE` int(11) DEFAULT NULL,
  `PAYE` int(11) NOT NULL,
  `commentaires` text NOT NULL,
  `Date_Record` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=643 ;

--
-- Contenu de la table `photolabcmd_bak`
--

INSERT INTO `photolabcmd_bak` (`ID`, `DATECMD`, `NOMCOMMANDE`, `NBPLANCHES`, `TYPE`, `ETAT`, `FACTURE`, `PAYE`, `commentaires`, `Date_Record`) VALUES
(393, '2018-05-30', '2018-05-30-WEB-L2-Charles Perrault-LIRE', 346, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 346', '2019-01-13 17:19:44'),
(392, '2018-05-30', '2018-05-30-L3-Sainte Marie-MAREUIL-SUR-LAY-DISSAIS', 126, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 126', '2019-01-13 17:19:44'),
(391, '2018-05-30', '2018-05-30-L2-Sainte Marie-MAREUIL-SUR-LAY-DISSAIS', 126, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 126', '2019-01-13 17:19:44'),
(390, '2018-05-30', '2018-05-30-L2-Du Val D Asson-TREIZE SEPTIERS', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 18', '2019-01-13 17:19:44'),
(389, '2018-05-22', '2018-05-22-L1-Saint Joseph-CHAMBRETAUD', 500, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 500', '2019-01-13 17:19:44'),
(388, '2018-05-22', '2018-05-22-L2-R P I Bannes-COSSE EN CHAMPAGNE', 10, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 10', '2019-01-13 17:19:44'),
(387, '2018-05-29', '2018-05-29-WEB-Commandes isolees multiples', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 18', '2019-01-13 17:19:44'),
(386, '2018-05-28', '2018-05-28-WEB-L2-Les Garennes-CHAMPTOCEAUX', 567, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 567', '2019-01-13 17:19:44'),
(385, '2018-05-28', '2018-05-28-WEB-L2-Fredureau-NANTES', 262, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 262', '2019-01-13 17:19:44'),
(384, '2018-05-25', '2018-05-25-WEB-L2-Photo de classe panoramique-CADRE POUR PANORAMIQUE (VIDE)', 344, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 344', '2019-01-13 17:19:44'),
(383, '2018-05-24', '2018-05-24-L2-Saint Joseph-ASTILLE', 11, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 11', '2019-01-13 17:19:44'),
(382, '2018-05-23', '2018-05-23-WEB-L2-Photo de classe panoramique-CADRE POUR PANORAMIQUE (VIDE)', 242, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 242', '2019-01-13 17:19:44'),
(381, '2018-05-23', '2018-05-23-WEB-L2-Saint Antoine-BALLOTS', 242, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 242', '2019-01-13 17:19:44'),
(380, '2018-05-17', '2018-05-17-L2-Pierre Menanteau-LE BOUPERE', 55, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 55', '2019-01-13 17:19:44'),
(379, '2018-05-10', '2018-05-10-L2-Saint Joseph-COURBEVEILLE', 12, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 12', '2019-01-13 17:19:44'),
(378, '2018-05-02', '2018-05-02-L2-Jules Ferry-INDRE', 111, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 111', '2019-01-13 17:19:44'),
(377, '2018-04-24', '2018-04-24-WEB-L2-Jules Verne-MAUVES SUR LOIRE', 724, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 724', '2019-01-13 17:19:44'),
(376, '2018-04-24', '2018-04-24-L2-Jules Ferry-INDRE', 129, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 129', '2019-01-13 17:19:44'),
(374, '2018-03-26', '2018-03-26-L2-Sainte Marie-LHUISSERIE', 29, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 29', '2019-01-13 17:19:44'),
(375, '2018-04-12', '2018-04-12-L2-Le Sacre Coeur-BOURGNEUF EN RETZ', 443, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 443', '2019-01-13 17:19:44'),
(373, '2018-03-29', '2018-03-29-De La Pierre Mara-HAUTE INDRE', 35, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 35', '2019-01-13 17:19:44'),
(372, '2018-03-12', '2018-03-12-LABO Ostrea-BOURGNEUF EN RETZ', 33, 'LAB', 0, 0, 0, 'Nb planches enregistrées... : 33', '2019-01-13 17:19:44'),
(394, '2018-04-18', '2018-04-18-L2-Sainte Marie-LHUISSERIE', 11, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 11', '2019-01-13 17:19:44'),
(395, '2018-05-31', '2018-05-31-WEB-Commandes isolees multiples', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 18', '2019-01-13 17:19:44'),
(396, '2018-06-05', '2018-06-05-L1-Joachim Du Bellay-MONTRELAIS', 390, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 390', '2019-01-13 17:19:44'),
(397, '2018-06-05', '2018-06-05-L2-Camille Corot-CORSEPT', 84, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 84', '2019-01-13 17:19:44'),
(398, '2018-06-06', '2018-06-06-L1-Joachim Du Bellay-MONTRELAIS', 397, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 397', '2019-01-13 17:19:44'),
(399, '2018-06-05', '2018-06-05-L2-Le Sacre Coeur-BOURGNEUF EN RETZ', 21, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 21', '2019-01-13 17:19:44'),
(400, '2018-06-06', '2018-06-06-L2-Aime Cesaire-NANTES', 93, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 93', '2019-01-13 17:19:44'),
(401, '2018-06-06', '2018-06-06-L2-Les P Tits Minois-ST MESMIN', 179, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 179', '2019-01-13 17:19:44'),
(402, '2018-06-06', '2018-06-06-L2-Saint Charles-MESNARD LA BAROTIERE', 403, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 403', '2019-01-13 17:19:44'),
(403, '2018-06-07', '2018-06-07-L2-Sainte Opportune-ST PERE EN RETZ', 43, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 43', '2019-01-13 17:19:44'),
(404, '2018-06-07', '2018-06-07-WEB-Commandes isolees multiples', 37, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 37', '2019-01-13 17:19:44'),
(405, '2018-06-08', '2018-06-08-L2-Jules Verne-MONTAIGU', 226, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 226', '2019-01-13 17:19:44'),
(406, '2018-06-12', '2018-06-12-L2-ELEM Alexis Maneyrol-FROSSAY', 42, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 42', '2019-01-13 17:19:44'),
(407, '2018-06-12', '2018-06-12-L2-Le Figuier-CHAVAGNES LES REDOUX', 27, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 27', '2019-01-13 17:19:44'),
(408, '2018-06-12', '2018-06-12-L2-MAT Alexis Maneyrol-FROSSAY', 41, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 41', '2019-01-13 17:19:44'),
(409, '2018-06-12', '2018-06-12-L2-MATER Jules Verne-MONTAIGU', 109, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 109', '2019-01-13 17:19:44'),
(410, '2018-06-12', '2018-06-12-L3-Sainte Marie-MAREUIL-SUR-LAY-DISSAIS', 14, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 14', '2019-01-13 17:19:44'),
(411, '2018-06-13', '2018-06-13-L2-Alain-LAVAL', 24, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 24', '2019-01-13 17:19:44'),
(412, '2018-06-13', '2018-06-13-L2-Michelet-LAVAL', 9, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 9', '2019-01-13 17:19:44'),
(413, '2018-06-13', '2018-06-13-WEB-L2-Apel Saint Joseph-BOUFFERE', 179, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 179', '2019-01-13 17:19:44'),
(414, '2018-06-14', '2018-06-14-L2-Francoise Dolto-POUZAUGES', 63, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 63', '2019-01-13 17:19:44'),
(415, '2018-06-14', '2018-06-14-L2-Saint Joseph-ST REVEREND', 43, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 43', '2019-01-13 17:19:44'),
(416, '2018-06-15', '2018-06-15-L2-Henri Bergson-NANTES', 329, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 329', '2019-01-13 17:19:44'),
(417, '2018-06-15', '2018-06-15-L2-La Rose Des Vents-ERBRAY', 164, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 164', '2019-01-13 17:19:44'),
(418, '2018-06-18', '2018-06-18-L2-Sainte Marie Des Vents-TREIZE VENTS', 19, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 19', '2019-01-13 17:19:44'),
(419, '2018-06-19', '2018-06-19-L2-Jean Zay-BOUGUENAIS', 198, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 198', '2019-01-13 17:19:44'),
(420, '2018-06-19', '2018-06-19-L2-Jules Verne-POUZAUGES', 361, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 361', '2019-01-13 17:19:44'),
(421, '2018-06-19', '2018-06-19-WEB-Commandes isolees multiples', 15, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 15', '2019-01-13 17:19:44'),
(422, '2018-06-22', '2018-06-22-L2-Joachim Du Bellay-MONTRELAIS', 37, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 37', '2019-01-13 17:19:44'),
(423, '2018-06-22', '2018-06-22-L2-Saint Joseph-CHAMBRETAUD', 5, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 5', '2019-01-13 17:19:44'),
(424, '2018-06-26', '2018-06-26-L2-Robert Doisneau-COMMEQUIERS', 59, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 59', '2019-01-13 17:19:44'),
(425, '2018-06-27', '2018-06-27-WEB-L2-Simone Veil-NANTES', 192, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 192', '2019-01-13 17:19:44'),
(426, '2018-07-02', '2018-07-02-WEB-Commandes isolees multiples', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 18', '2019-01-13 17:19:44'),
(427, '2018-07-04', '2018-07-04-WEB-Commandes isolees multiples', 23, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 23', '2019-01-13 17:19:44'),
(466, '2018-09-21', '2018-09-21-L1-Sophie Germain-NANTES', 39, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 39', '2019-01-13 17:19:44'),
(467, '2018-09-26', '2018-09-26-SITEWEB-La Fontaine-ANETZ', 781, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 781', '2019-01-13 17:19:44'),
(465, '2018-09-21', '2018-09-21-L1-Notre Dame De Bon Port-NANTES', 1220, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1220', '2019-01-13 17:19:44'),
(463, '2018-10-03', '2018-10-03-SITEWEB-Prince Bois-SAVENAY', 1264, 'WEB', 1, 0, 0, 'Nb planches enregistrées : 1264', '2018-12-23 17:37:10'),
(464, '2018-09-19', '2018-09-19-SITEWEB-Simone Veil-NANTES', 1733, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 1733', '2019-01-13 17:19:44'),
(461, '2018-09-28', '2018-09-28-SITEWEB-Les Treilles-VERTOU', 1478, 'WEB', 1, 0, 0, 'Nb planches enregistrées : 1478', '2018-12-23 17:37:02'),
(462, '2018-10-03', '2018-10-03-SITEWEB-Lamoriciere-NANTES ', 718, 'WEB', 1, 0, 0, 'Nb planches enregistrées : 718', '2018-12-23 17:37:12'),
(474, '2018-10-11', '2018-10-11-SITEWEB-Joachim Du Bellay-THOUARE SUR LOIRE', 1708, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 1708', '2019-01-13 17:19:44'),
(468, '2018-09-28', '2018-09-28-L2-La Cerisaie-STE LUCE SUR LOIRE', 32, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 32', '2019-01-13 17:19:44'),
(469, '2018-09-28', '2018-09-28-SITEWEB-Les Sablons-PORNIC', 913, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 913', '2019-01-13 17:19:44'),
(470, '2018-09-28', '2018-09-28-SITEWEB-Nelson Mandela -NANTES', 239, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 239', '2019-01-13 17:19:44'),
(471, '2018-10-04', '2018-10-04-SITEWEB-Notre Dame Saint Joseph-ST NAZAIRE', 1197, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 1197', '2018-12-23 17:33:35'),
(472, '2018-10-11', '2018-10-11-L1-Ferdinand Daniel-CAMPBON', 749, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 749', '2019-01-13 17:19:44'),
(473, '2018-10-11', '2018-10-11-L2-Jean Brelet Primaire-ST JULIEN DE CONCELLES', 438, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 438', '2019-01-13 17:19:44'),
(475, '2018-10-12', '2018-10-12-L2-Jean Brelet Primaire-ST JULIEN DE CONCELLES', 53, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 53', '2019-01-13 17:19:44'),
(476, '2018-10-15', '2018-10-15-SITEWEB-Saint Leger-MARSAC SUR DON', 485, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 485', '2019-01-13 17:19:44'),
(477, '2018-10-15', '2018-10-15-SITEWEB-Paul Bert-COUERON', 811, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 811', '2019-01-13 17:19:44'),
(478, '2018-10-16', '2018-10-16-SITEWEB-Saint Vincent-SAINTE LUCE SUR LOIRE', 2182, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 2182', '2019-01-13 17:19:44'),
(479, '2018-10-16', '2018-10-16-SITEWEB-Notre Dame-LA POMMERAYE', 851, 'WEB', 0, 0, 0, 'Nb planches enregistrées : 851', '2019-01-13 17:19:44'),
(480, '2018-10-17', '2018-10-17-WEB-L2-Mona Ozouf-SAVENAY', 2, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 2', '2019-01-13 17:19:44'),
(481, '2018-10-24', '2018-10-24-L1-La Ronde-PLESSE', 879, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 879', '2019-01-13 16:28:28'),
(482, '2018-10-17', '2018-10-17-WEB-L2-Mona Ozouf-SAVENAY', 905, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 905', '2019-01-13 16:28:29'),
(483, '2018-10-23', '2018-10-23-L1-Fonteny-NANTES', 433, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 433', '2019-01-13 16:28:29'),
(484, '2018-10-23', '2018-10-23-WEB-Commandes isolees multiples', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 18', '2019-01-13 16:28:29'),
(485, '2018-10-23', '2018-10-23-WEB-Commandes Simone 2017-2018 isolees multiples', 6, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 6', '2019-01-13 16:28:29'),
(486, '2018-10-23', '2018-10-23-WEB-L2-COR-Mona Ozouf-SAVENAY', 6, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 6', '2019-01-13 16:28:30'),
(487, '2018-10-24', '2018-10-24-L2-Notre Dame De Bon Port-NANTES', 103, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 103', '2019-01-13 16:28:30'),
(488, '2018-10-26', '2018-10-26-L1-Les Courlis-BOUEE', 239, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 239', '2019-01-13 16:28:30'),
(489, '2018-10-29', '2018-10-29-L1-Sainte Therese-QUILLY', 203, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 203', '2019-01-13 17:08:36'),
(490, '2018-11-20', '2018-11-20-WEB-L2-St Joseph-Pontchateau3', 1479, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1479', '2019-01-13 17:08:37'),
(491, '2018-10-29', '2018-10-29-WEB-L2-La Fontaine-ANETZ', 412, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 412', '2019-01-13 17:08:38'),
(492, '2018-10-29', '2018-10-29-GRP-EXEMPLE-La Profondine-SAINT SEBASTIEN SUR LOIRE', 32, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 32', '2019-01-13 17:08:38'),
(493, '2018-10-30', '2018-10-30-L1-N D De La Clarte-St Philbert De Grand Lieu', 1732, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1732', '2019-01-13 17:08:38'),
(494, '2018-10-30', '2018-10-30-WEB-L2-Simone Veil-Nantes', 571, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 571', '2019-01-13 17:08:39'),
(495, '2018-10-30', '2018-10-30-WEB-L2-Les Sablons-Pornic', 426, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 426', '2019-01-13 17:08:39'),
(496, '2018-10-30', '2018-10-30-WEB-L2-Elem-Les Treilles-Vertou', 924, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 924', '2019-01-13 17:08:40'),
(497, '2018-10-31', '2018-10-31-L1-Du Chambord-Lege', 487, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 487', '2019-01-13 17:08:40'),
(498, '2018-11-03', '2018-11-03-WEB-Commandes isolees multiples', 117, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 117', '2019-01-13 17:08:40'),
(499, '2018-11-08', '2018-11-08-L1-St Clair-Nantes', 1063, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1063', '2019-01-13 17:08:41'),
(500, '2018-11-08', '2018-11-08-WEB-L2-Notre Dame Saint Joseph-St Nazaire', 716, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 716', '2019-01-13 17:08:41'),
(501, '2018-11-08', '2018-11-08-WEB-L2-Prince Bois-Savenay', 695, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 695', '2019-01-13 17:08:41'),
(502, '2018-11-09', '2018-11-09-L1-St Joseph-Pontchateau', 1580, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1580', '2019-01-13 17:08:42'),
(503, '2018-11-14', '2018-11-14-L1-St Vital-St Viaud', 587, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 587', '2019-01-13 17:08:42'),
(504, '2018-11-14', '2018-11-14-L1-Maison Neuve-Nantes', 658, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 658', '2019-01-13 17:08:43'),
(505, '2018-11-14', '2018-11-14-L1-Alexis Elem Maneyrol-Frossay', 469, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 469', '2019-01-13 17:08:43'),
(506, '2018-11-14', '2018-11-14-L1-Alexis Mat Maneyrol-Frossay', 435, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 435', '2019-01-13 17:08:44'),
(507, '2018-11-14', '2018-11-14-WEB-L2-Paul Bert-Coueron', 488, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 488', '2019-01-13 17:08:45'),
(508, '2018-11-14', '2018-11-14-WEB-L2-Lamoriciere-Nantes ', 594, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 594', '2019-01-13 17:08:45'),
(509, '2018-11-15', '2018-11-15-WEB-L2-Joachim Du Bellay-Thouare Sur Loire', 1115, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1115', '2019-01-13 17:08:45'),
(511, '2018-11-16', '2018-11-16-WEB-L2-Saint Vincent-Sainte Luce Sur Loire2', 1485, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1485', '2019-01-13 17:08:46'),
(512, '2018-11-16', '2018-11-16-L1-La Metairie-Coueron', 349, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 349', '2019-01-13 17:08:46'),
(513, '2018-11-16', '2018-11-16-L1-Le Mont Scobrit-St Viaud', 566, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 566', '2019-01-13 17:08:46'),
(514, '2018-11-20', '2018-11-20-WEB-L2-Saint Vincent-Sainte Luce Sur Loire2', 1485, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1485', '2019-01-13 17:08:47'),
(515, '2018-11-20', '2018-11-20-WEB-L2-Saint Vincent-Sainte Luce Sur Loire', 1485, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1485', '2019-01-13 17:08:47'),
(516, '2018-11-20', '2018-11-20-WEB-L2-St Joseph-Pontchateau', 1485, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 1485', '2019-01-13 17:08:47'),
(517, '2018-11-21', '2018-11-21-WEB-L2-Notre Dame-La Pommeraye', 793, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 793', '2019-01-13 17:08:48'),
(518, '2018-11-22', '2018-11-22-L2-College  Lycee Saint Joseph-Chateaubriant', 3150, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 3150', '2019-01-13 17:13:36'),
(519, '2018-11-23', '2018-11-23-L2-College  Lycee Saint Joseph-Chateaubriant ID Seul', 172, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 172', '2019-01-13 17:13:37'),
(520, '2018-11-23', '2018-11-23-WEB-Commandes isolees multiples', 433, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 433', '2019-01-13 17:13:37'),
(521, '2018-11-23', '2018-11-23-L2-Salentine-ORVAULT', 196, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 196', '2019-01-13 17:13:37'),
(522, '2018-11-26', '2018-11-26-L2-Sophie Germain-NANTES', 177, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 177', '2019-01-13 17:13:37'),
(523, '2018-11-26', '2018-11-26-WEB-L2-Saint Leger-Marsac Sur Don', 279, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 279', '2019-01-13 17:13:38'),
(524, '2018-11-26', '2018-11-26-WEB-L2-Gustave Roch-Aigrefeuille Sur Maine', 785, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 785', '2019-01-13 17:13:38'),
(525, '2018-11-26', '2018-11-26-WEB-L2-Mater Agenets-Nantes', 347, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 347', '2019-01-13 17:13:39'),
(526, '2018-11-26', '2018-11-26-WEB-L2-MateEmile Gibier', 349, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 349', '2019-01-13 17:13:40'),
(527, '2018-11-26', '2018-11-26-WEB-L2-Les Garennes-Nantes', 372, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 372', '2019-01-13 17:13:40'),
(528, '2018-11-26', '2018-11-26-WEB-L2-LArbre Enchante-Dreffeac', 579, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 579', '2019-01-13 17:13:41'),
(529, '2018-11-22', '2018-11-22-L2-College  Lycee Chateaubriant LIGNE BLANCHE', 7, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 7', '2019-01-13 17:13:41'),
(530, '2018-11-27', '2018-11-27-WEB-L2-St Joseph-Mauves Sur Loire', 334, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 334', '2019-01-13 17:13:41'),
(531, '2018-11-27', '2018-11-27-L2-St Vital-St Viaud', 27, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 27', '2019-01-13 17:13:42'),
(532, '2018-11-27', '2018-11-27-WEB-L2-Les Tilleuls-Sainte Luce Sur Loire', 518, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 518', '2019-01-13 17:13:42'),
(533, '2018-11-27', '2018-11-27-WEB-L2-Elem Emile Gibier-Orvault', 458, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 458', '2019-01-13 17:13:42'),
(534, '2018-11-27', '2018-11-27-L2-Jean Brelet-ST JULIEN DE CONCELLES', 332, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 332', '2019-01-13 17:13:42'),
(535, '2018-11-27', '2018-11-27-L2-Felix Tessier-SAINTE LUCE SUR LOIRE', 710, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 710', '2019-01-13 17:13:43'),
(536, '2018-11-27', '2018-11-27-L2-Notre Dame Du Sacre Coeur-PRINQUIAU', 631, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 631', '2019-01-13 17:13:43'),
(537, '2018-11-27', '2018-11-27-L2-Notre Dame Du Sacre Coeur-PRINQUIAU SUITE', 31, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 31', '2019-01-13 17:13:43'),
(538, '2018-11-28', '2018-11-28-L2-Leon Blum-Nantes', 281, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 281', '2019-01-13 17:13:44'),
(539, '2018-11-28', '2018-11-28-L1-Sainte Marie-Cosse Le Vivien', 644, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 644', '2019-01-13 17:13:44'),
(540, '2018-11-28', '2018-11-28-L1-Saint Joseph-Astille', 369, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 369', '2019-01-13 17:13:44'),
(541, '2018-11-28', '2018-11-28-L2-TEST EMILE', 4, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 4', '2019-01-13 17:13:44'),
(542, '2018-11-28', '2018-11-28-L1-Sainte Marie-Cosse Le Vivien COR', 687, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 687', '2019-01-13 17:13:45'),
(543, '2018-11-28', '2018-11-28-L1-Saint Joseph-Astille COR', 388, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 388', '2019-01-13 17:13:45'),
(544, '2018-12-01', '2018-12-01-WEB-Commandes isolees multiples', 226, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 226', '2019-01-13 17:13:45'),
(545, '2018-12-03', '2018-12-03-WEB-L2-Pont Marchand-Orvault', 470, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 470', '2019-01-13 17:13:46'),
(546, '2018-12-03', '2018-12-03-WEB-L2-Elem-Agenets-Nantes', 495, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 495', '2019-01-13 17:13:46'),
(547, '2018-12-03', '2018-12-03-L2-Sainte Therese-QUILLY', 38, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 38', '2019-01-13 17:13:47'),
(548, '2018-12-03', '2018-12-03-L2-Paul Fort-THOUARE SUR LOIRE', 26, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 26', '2019-01-13 17:13:47'),
(549, '2018-12-03', '2018-12-03-L2-Notre Dame Du Sacre Coeur-PRINQUIAU', 4, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 4', '2019-01-13 17:13:47'),
(550, '2018-12-03', '2018-12-03-L2-Prim Sainte Anne  St Joseph-Reze', 659, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 659', '2019-01-13 17:13:48'),
(551, '2018-12-04', '2018-12-04-GRP-EXEMPLE-Chateau Sud-Reze', 13, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 13', '2019-01-13 17:13:48'),
(552, '2018-12-04', '2018-12-04-L1-Amiral Du Chaffault-La Guyonniere', 423, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 423', '2019-01-13 17:13:49'),
(553, '2018-12-04', '2018-12-04-L1-Chene D Aron-Nantes', 505, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 505', '2019-01-13 17:13:49'),
(554, '2018-12-04', '2018-12-04-L1-ELEM Batignolles-Nantes', 431, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 431', '2019-01-13 17:13:49'),
(555, '2018-12-04', '2018-12-04-L1-MATER Batignolles-Nantes', 417, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 417', '2019-01-13 17:13:49'),
(556, '2018-12-05', '2018-12-05-WEB-L2-Nelson Mandela -Nantes', 688, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 688', '2019-01-13 17:13:50'),
(557, '2018-12-05', '2018-12-05-L1-Jean Mace-Coueron', 443, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 443', '2019-01-13 17:13:50'),
(558, '2018-12-05', '2018-12-05-L1-Mater Pano Gustave Roch', 146, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 146', '2019-01-13 17:13:50'),
(559, '2018-12-05', '2018-12-05-L1-Mater TRAD Gustave Roch', 139, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 139', '2019-01-13 17:13:51'),
(560, '2018-12-05', '2018-12-05-GRP-EXEMPLE-Ecole Le Petit Prince-Le Fresne Sur Loire', 11, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 11', '2019-01-13 17:13:51'),
(561, '2018-12-05', '2018-12-05-L1-Pierre Stalder-Carquefou', 742, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 742', '2019-01-13 17:13:51'),
(562, '2018-12-05', '2018-12-05-L1-Saint Joseph-Courbeveille', 167, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 167', '2019-01-13 17:13:52'),
(563, '2018-12-06', '2018-12-06-WEB-L2-Les Mille Mots-Trans Sur Erdre', 290, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 290', '2019-01-13 17:13:52'),
(564, '2018-12-06', '2018-12-06-GRP-EXEMPLE-Chateau Sud-Reze', 13, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 13', '2019-01-13 17:13:53'),
(565, '2018-12-06', '2018-12-06-L1-Aime Cesaire-Nantes', 916, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 916', '2019-01-13 17:13:53'),
(566, '2018-12-06', '2018-12-06-L1-Ste Therese-Corsept', 227, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 227', '2019-01-13 17:13:53'),
(567, '2018-12-06', '2018-12-06-L1-COR Aime Cesaire-Nantes', 9, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 9', '2019-01-13 17:13:53'),
(568, '2018-12-06', '2018-12-06-WEB-L2-Orange Bleue-Malville', 562, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 562', '2019-01-13 17:13:54'),
(569, '2018-12-06', '2018-12-06-WEB-L2-Paul Fort-St Brevin Les Pins', 619, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 619', '2019-01-13 17:13:54'),
(570, '2018-12-06', '2018-12-06-L1-International School Of Nantes-Saint Herblain', 252, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 252', '2019-01-13 17:13:54'),
(571, '2018-12-06', '2018-12-06-L1-Le Val Du Don-Marsac Sur Don', 236, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 236', '2019-01-13 17:13:55'),
(572, '2018-12-07', '2018-12-07-L2-MAT Le Douet-St Sebastien Sur Loire', 560, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 560', '2019-01-13 17:13:55'),
(573, '2018-12-07', '2018-12-07-WEB-Commandes isolees multiples', 227, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 227', '2019-01-13 17:13:55'),
(574, '2018-12-07', '2018-12-07-L2-Les Courlis-Bouee', 38, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 38', '2019-01-13 17:13:56'),
(575, '2018-12-10', '2018-12-10-L2-Amicale Lai?que Bois Saint Louis-Orvault', 145, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 145', '2019-01-13 17:13:56'),
(576, '2018-12-10', '2018-12-10-L2-Amicale Laique Bois Saint Louis-Orvault', 153, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 153', '2019-01-13 17:13:57'),
(577, '2018-12-10', '2018-12-10-L2-College Sainte Anne-Reze', 486, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 486', '2019-01-13 17:13:57'),
(578, '2018-12-10', '2018-12-10-L2-ELEM Le Douet-Saint Sebastien Sur Loire', 403, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 403', '2019-01-13 17:13:58'),
(579, '2018-12-11', '2018-12-11-L2-TEST College Sainte Anne-Reze', 2, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 2', '2019-01-13 17:13:58'),
(580, '2018-12-11', '2018-12-11-L2-ELEM Gaston Serpette-Nantes', 474, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 474', '2019-01-13 17:13:58'),
(581, '2018-12-11', '2018-12-11-L2-Notre Dame De La Briere-Missillac', 776, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 776', '2019-01-13 17:13:58'),
(582, '2018-12-11', '2018-12-11-L2-Notre Dame De La Briere-Missillac (Angle Bertho)', 185, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 185', '2019-01-13 17:13:59'),
(583, '2018-12-11', '2018-12-11-L2-Jacques Moreau-Sainte Cecile', 24, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 24', '2019-01-13 17:13:59'),
(584, '2018-12-11', '2018-12-11-L2-Fonteny-NANTES', 67, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 67', '2019-01-13 17:14:00'),
(585, '2018-12-12', '2018-12-12-WEB-L2-Sainte Marie-Sainte Florence', 480, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 480', '2019-01-13 17:14:00'),
(586, '2018-12-12', '2018-12-12-WEB-L2-ELEM Gustave Roch-Nantes', 101, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 101', '2019-01-13 17:14:01'),
(587, '2018-12-12', '2018-12-12-WEB-L2-Elem Kerlor-Pornic', 557, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 557', '2019-01-13 17:14:01'),
(588, '2018-12-12', '2018-12-12-COR L2-College Sainte Anne-Reze', 4, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 4', '2019-01-13 17:14:01'),
(589, '2018-12-12', '2018-12-12-L2-ELEM Louise Michel-Nantes', 363, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 363', '2019-01-13 17:14:02'),
(590, '2018-12-12', '2018-12-12-L2-RECOCO St Vital-St Viaud', 13, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 13', '2019-01-13 17:14:02'),
(591, '2018-12-12', '2018-12-12-L2-La Metairie-Coueron', 79, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 79', '2019-01-13 17:14:03'),
(592, '2018-12-12', '2018-12-12-L2-St Joseph-Pontchateau', 135, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 135', '2019-01-13 17:14:03'),
(593, '2018-12-12', '2018-12-12-L2-Le Mont Scobrit-St Viaud', 46, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 46', '2019-01-13 17:14:03'),
(594, '2018-12-12', '2018-12-12-WEB-L2-Les Trois Chenes-Guenrouet', 385, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 385', '2019-01-13 17:14:03'),
(595, '2018-12-12', '2018-12-12-L2-Maison Neuve-Nantes', 59, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 59', '2019-01-13 17:14:04'),
(596, '2018-12-12', '2018-12-12-L2-Henri Bergson-Nantes', 338, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 338', '2019-01-13 17:14:04'),
(597, '2018-12-12', '2018-12-12-L2-Sainte Marie-Cosse Le Vivien', 46, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 46', '2019-01-13 17:14:05'),
(598, '2018-12-13', '2018-12-13-WEB-L2-Jules Verne-Brains', 638, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 638', '2019-01-13 17:14:05'),
(599, '2018-12-13', '2018-12-13-WEB-L2-Camille Corot-Corsept', 431, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 431', '2019-01-13 17:14:05'),
(600, '2018-12-13', '2018-12-13-WEB-L2-Fredureau-Nantes', 262, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 262', '2019-01-13 17:14:06'),
(601, '2018-12-13', '2018-12-13-WEB-L2-La Blanchetiere-La Chapelle Sur Erdre', 735, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 735', '2019-01-13 17:14:06'),
(602, '2018-12-14', '2018-12-14-L2-Felix Tessier-SAINTE LUCE SUR LOIRE', 7, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 7', '2019-01-13 17:14:06'),
(603, '2018-12-14', '2018-12-14-L2-ELEM Louise Michel-Nantes RECO', 7, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 7', '2019-01-13 17:14:06'),
(604, '2018-12-14', '2018-12-14-WEB-L2-MAT Kerlor-Pornic', 346, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 346', '2019-01-13 17:14:07'),
(605, '2018-12-14', '2018-12-14-L2-Condorcet-St Herblain', 921, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 921', '2019-01-13 17:14:07'),
(606, '2018-12-18', '2018-12-18-L2-Condorcet-St Herblain RECO 18-12', 5, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 5', '2019-01-13 17:14:07'),
(607, '2018-12-14', '2018-12-14-L2-Amiral Du Chaffault-La Guyonniere', 21, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 21', '2019-01-13 17:14:07'),
(608, '2018-12-14', '2018-12-14-L2-La Ronde-Plesse RECO', 136, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 136', '2019-01-13 17:14:08'),
(609, '2018-12-14', '2018-12-14-WEB-Commandes isolees multiples', 260, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 260', '2019-01-13 17:14:08'),
(610, '2018-12-14', '2018-12-14-L2-Saint Joseph-Astille', 7, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 7', '2019-01-13 17:14:08'),
(611, '2018-12-14', '2018-12-14-L2-Saint Joseph-Astille RECO 2', 5, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 5', '2019-01-13 17:14:09'),
(612, '2018-12-17', '2018-12-17-WEB-Commandes isolees multiples', 66, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 66', '2019-01-13 17:14:09'),
(613, '2018-12-19', '2018-12-19-L2-RECO 2 Chambord-Lege', 9, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 9', '2019-01-13 17:14:09'),
(614, '2018-12-17', '2018-12-17-WEB-L2-Le Sacre Coeur-Bourgneuf En Retz', 403, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 403', '2019-01-13 17:14:09'),
(615, '2018-12-17', '2018-12-17-L2-College  Lycee Saint Joseph-Chateaubriant RECO', 67, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 67', '2019-01-13 17:14:10'),
(616, '2018-12-17', '2018-12-17-L2-RECO Chambord-Lege', 29, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 29', '2019-01-13 17:14:10'),
(617, '2018-12-17', '2018-12-17-L2-Chene DAron-Nantes', 70, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 70', '2019-01-13 17:14:10'),
(618, '2018-12-17', '2018-12-17-L2-APEL Le Petit Prince-Le Fresne Sur Loire', 89, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 89', '2019-01-13 17:14:10'),
(619, '2018-12-17', '2018-12-17-WEB-L2-Henri Lesage-Vertou', 713, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 713', '2019-01-13 17:14:11'),
(620, '2018-12-17', '2018-12-17-WEB-L2-SECONDE Les Tilleuls-Sainte Luce Sur Loire', 40, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 40', '2019-01-13 17:14:11'),
(621, '2018-12-17', '2018-12-17-L2-ELEM Alexis Maneyrol-Frossay', 38, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 38', '2019-01-13 17:14:11'),
(622, '2018-12-17', '2018-12-17-L2-MAT Alexis Mat Maneyrol-Frossay', 36, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 36', '2019-01-13 17:14:12'),
(623, '2018-12-17', '2018-12-17-L2-RECO Le Mont Scobrit-St Viaud', 4, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 4', '2019-01-13 17:14:12'),
(624, '2018-12-18', '2018-12-18-L2-Notre Dame De La Briere-Missillac RECO 18-12', 10, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 10', '2019-01-13 17:14:12'),
(625, '2018-12-18', '2018-12-18-L2-Henri Bergson-Nantes RECO 18-12', 17, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 17', '2019-01-13 17:14:12'),
(626, '2018-12-18', '2018-12-18-L2-Henri Bergson-Nantes RECO2 18-12', 3, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 3', '2019-01-13 17:14:13'),
(627, '2018-12-19', '2018-12-19-WEB-Commandes isolees multiples', 64, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 64', '2019-01-13 17:14:13'),
(628, '2018-12-20', '2018-12-20-WEB-Commandes isolees multiples', 32, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 32', '2019-01-13 17:14:13'),
(629, '2018-12-21', '2018-12-21-WEB-Commandes isolees multiples', 18, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 18', '2019-01-13 17:14:14'),
(630, '2018-12-21', '2018-12-21-L2-College  Lycee Saint Joseph-Chateaubriant CORRECTION', 13, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 13', '2019-01-13 17:14:14'),
(631, '2019-01-02', '2019-01-02-WEB-Commandes isolees multiples', 72, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 72', '2019-01-13 17:14:14'),
(632, '2019-01-03', '2019-01-03-WEB-Commandes isolees multiples', 9, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 9', '2019-01-13 17:14:14'),
(633, '2019-01-07', '2019-01-07-WEB-Commandes isolees multiples', 20, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 20', '2019-01-13 17:14:15'),
(634, '2019-01-07', '2019-01-07-L2-St Clair-Nantes', 271, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 271', '2019-01-13 17:14:15'),
(635, '2019-01-07', '2019-01-07-WEB-Commandes isolees multiples-B', 20, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 20', '2019-01-13 17:14:15'),
(636, '2019-01-08', '2019-01-08-L2-College  Lycee Saint Joseph-Chateaubriant CORRECTION 2', 11, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 11', '2019-01-13 17:14:16'),
(637, '2019-01-09', '2019-01-09-WEB-Commandes isolees multiples', 25, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 25', '2019-01-13 17:14:16'),
(638, '2019-01-10', '2019-01-10-L2-MATER Batignolles-Nantes', 23, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 23', '2019-01-13 17:14:16'),
(639, '2019-01-10', '2019-01-10-L2-Jean Mace-Coueron', 17, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 17', '2019-01-13 17:14:17'),
(640, '2019-01-11', '2019-01-11-WEB-Commandes isolees multiples', 22, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 22', '2019-01-13 17:14:17'),
(641, '2019-01-11', '2019-01-11-L2-La Ronde-Plesse RECO', 8, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 8', '2019-01-13 17:14:17'),
(642, '2019-01-12', '2019-01-12-WEB-Commandes isolees multiples', 11, 'LAB', 0, 0, 0, 'Nb planches enregistrées : 11', '2019-01-13 17:14:18');

-- --------------------------------------------------------

--
-- Structure de la table `photolabfacture`
--

CREATE TABLE IF NOT EXISTS `photolabfacture` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DATECREATION` date NOT NULL,
  `SOLDE` float NOT NULL,
  `DATEPAYE` date NOT NULL,
  `NOMFACTURE` text NOT NULL,
  `Date_Record` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

--
-- Contenu de la table `photolabfacture`
--

INSERT INTO `photolabfacture` (`ID`, `DATECREATION`, `SOLDE`, `DATEPAYE`, `NOMFACTURE`, `Date_Record`) VALUES
(409, '2019-03-21', 49.35, '2019-06-19', 'Ma Note', '2019-06-19 00:44:17'),
(418, '2019-11-03', 2, '0000-00-00', 'Note ...kjhkj', '2019-11-03 18:31:44'),
(419, '2019-11-03', 2, '0000-00-00', 'Note ...', '2019-11-03 18:35:32'),
(420, '2019-11-03', 2, '0000-00-00', 'Note ...', '2019-11-03 18:35:37'),
(421, '2019-11-03', 5.7, '0000-00-00', 'Note ...', '2019-11-03 18:37:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
