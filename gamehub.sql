-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Mars 2017 à 11:06
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gamehub`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessoire`
--

DROP TABLE IF EXISTS `accessoire`;
CREATE TABLE IF NOT EXISTS `accessoire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_sortie` date NOT NULL,
  `evaluation` int(11) NOT NULL,
  `plateforme` varchar(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `caraceristique` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique_jeu`
--

DROP TABLE IF EXISTS `caracteristique_jeu`;
CREATE TABLE IF NOT EXISTS `caracteristique_jeu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processeur` varchar(20) NOT NULL,
  `memoire` varchar(20) NOT NULL,
  `carte_graphique` varchar(20) NOT NULL,
  `systeme_exploitation` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` varchar(30) NOT NULL,
  `contenu` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `id_jeu` int(11) DEFAULT NULL,
  `id_accessoire` int(11) DEFAULT NULL,
  `id_jeuamateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Cjeu` (`id_jeu`),
  KEY `fk_Cja` (`id_jeuamateur`),
  KEY `fk_Caccessoire` (`id_accessoire`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `utilisateur_id`, `contenu`, `date`, `id_jeu`, `id_accessoire`, `id_jeuamateur`) VALUES
(15, 'jandlnl', 'c''est un tres beau jeu :)', '2017-02-21', NULL, NULL, 5),
(14, 'jandlnl', 'yoww', '2017-02-21', NULL, NULL, 5),
(13, 'hdh', 'heyy', '2017-02-21', NULL, NULL, 4),
(16, 'bakker', 'ahawa', '2017-02-21', NULL, NULL, 7),
(17, 'bakker', 'gdjffjyj', '2017-02-21', NULL, NULL, 7),
(18, 'bakker', 'com', '2017-02-21', NULL, NULL, 7),
(19, 'bakker', 'gdjfd', '2017-02-21', NULL, NULL, 7),
(20, 'bakker', 'hvjknbji', '2017-02-21', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

DROP TABLE IF EXISTS `jeu`;
CREATE TABLE IF NOT EXISTS `jeu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prix` float NOT NULL,
  `date_sortie` date NOT NULL,
  `evaluation` int(11) DEFAULT NULL,
  `plateforme` varchar(8) NOT NULL,
  `historique` varchar(200) DEFAULT NULL,
  `lien` varchar(200) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `caracteristique` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jeu` (`caracteristique`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `jeu_amateur`
--

DROP TABLE IF EXISTS `jeu_amateur`;
CREATE TABLE IF NOT EXISTS `jeu_amateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `evaluation` int(11) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `membre` varchar(50) NOT NULL,
  `lien` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeu_amateur`
--

INSERT INTO `jeu_amateur` (`id`, `nom`, `description`, `evaluation`, `categorie`, `membre`, `lien`) VALUES
(7, 'Arcade 1 ', 'first', 0, 'Race', 'bakker', 'www..'),
(10, 'ARCADE', 'RACE', 0, 'RAVCE', 'bakker', 'wwww'),
(12, 'Foot Salle', 'jeu', 0, 'Sport', 'bakker', 'www'),
(15, 'Game', 'desc', 0, 'categ', 'bakker', 'wwww'),
(25, 'jeu', 'eef', 0, 'ee', 'wael', 'lien de telechargement'),
(17, 'Postkill', 'kill', 0, 'Action', 'bakker', 'wwww'),
(24, 'GameTank', 'desc', 0, 'cat', 'wael', 'lien de telechargement');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `console` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `email`, `pseudo`, `mdp`, `telephone`, `console`, `role`) VALUES
(1, 'bakker', 'mvt', 'bakker.mvt@gmail.com', 'bakker', 'bakker', '22943307', 'ps4', 'ADMIN'),
(2, 'wael', 'wael', 'waelpidev@gmail.com', 'wael', 'wael', '22943307', 'xbox', 'USER'),
(3, 'lahmer', 'ahmed', 'bqg1123@gmail.com', 'kiko', 'kiko', '548119479', 'ps4', 'USER');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `id_jeuamateur` int(11) DEFAULT NULL,
  `id_jeu` int(11) DEFAULT NULL,
  `id_accessoire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Njeu` (`id_jeu`),
  KEY `fk_Naccessoire` (`id_accessoire`),
  KEY `fk_Njeuamateur` (`id_jeuamateur`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id`, `contenu`, `date`, `enable`, `membre_id`, `id_jeuamateur`, `id_jeu`, `id_accessoire`) VALUES
(8, 'waela ajouter un jeu amateur : League of warriors', '2017-02-21', 1, 15, 1, NULL, NULL),
(7, 'bakkera ajouter un jeu amateur : ARCADE', '2017-02-21', 1, 15, 2, NULL, NULL),
(6, 'waela ajouter un jeu amateur : Tekken', '2017-02-21', 1, 15, 1, NULL, NULL),
(9, 'bakkera ajouter un jeu amateur : Foot Salle', '2017-02-21', 1, 15, 2, NULL, NULL),
(10, 'bakker a ajouter un jeu amateur : AFSport', '2017-02-21', 1, 15, 2, NULL, NULL),
(11, 'wael a ajouter un jeu amateur : DFEU', '2017-02-21', 1, 15, 1, NULL, NULL),
(12, 'bakker a ajouter un jeu amateur : Game', '2017-02-21', 1, 15, 2, NULL, NULL),
(13, 'wael a ajouter un jeu amateur : Guitare', '2017-02-21', 1, 15, 1, NULL, NULL),
(14, 'bakker a ajouter un jeu amateur : Jeu', '2017-02-21', 1, 2, 0, NULL, NULL),
(15, 'bakker a ajouter un jeu amateur : Postkill', '2017-02-21', 1, 2, 17, NULL, NULL),
(16, 'wael a ajouter un jeu amateur : TroubleGame', '2017-02-21', 1, 1, 18, NULL, NULL),
(17, 'wael a ajouter un jeu amateur : Crash', '2017-02-21', 1, 1, 19, NULL, NULL),
(18, 'wael a ajouter un jeu amateur : Street Dancer', '2017-02-21', 1, 1, 20, NULL, NULL),
(19, 'wael a ajouter un jeu amateur : TOMB RIDER', '2017-02-21', 1, 1, 21, NULL, NULL),
(20, 'wael a ajouter un jeu amateur : stream', '2017-02-21', 1, 1, 22, NULL, NULL),
(21, 'wael a ajouter un jeu amateur : Dgun', '2017-02-21', 1, 1, 23, NULL, NULL),
(22, 'wael a ajouter un jeu amateur : GameTank', '2017-02-21', 1, 1, 24, NULL, NULL),
(23, 'wael a ajouter un jeu amateur : jeu', '2017-02-21', 1, 1, 25, NULL, NULL),
(24, 'wael a ajouter un jeu amateur : jeu', '2017-02-21', 1, 1, 25, NULL, NULL),
(25, 'bakker a ajouter un jeu amateur : swit', '2017-02-21', 0, 2, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pc_membre`
--

DROP TABLE IF EXISTS `pc_membre`;
CREATE TABLE IF NOT EXISTS `pc_membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processeur` varchar(20) NOT NULL,
  `memoire` varchar(20) NOT NULL,
  `carte_graphique` varchar(20) NOT NULL,
  `systeme_exploitation` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(100) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `membre` int(11) NOT NULL,
  `vu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `sujet`, `contenu`, `membre`, `vu`) VALUES
(1, 'df', 'df', 2, 1),
(2, 'Send mail ', '&ajout BD', 1, 1),
(3, 'nclick notif', 'ONCLICK', 1, 1),
(4, '2', '145616', 1, 1),
(5, 'xdfghjk', 'sdfghjk', 1, 1),
(6, 'fghjkl', 'fghjklm', 1, 1),
(7, 'dfghjkl', 'dfghjklm', 1, 1),
(8, 'vbn', 'b,n', 1, 1),
(9, 'mail dynaique', 'aya bara ayaaa', 1, 1),
(10, 'dfhjk', 'sdfghjk', 1, 1),
(11, 'hk', 'cev', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sujet_forum`
--

DROP TABLE IF EXISTS `sujet_forum`;
CREATE TABLE IF NOT EXISTS `sujet_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(500) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tournoi`
--

DROP TABLE IF EXISTS `tournoi`;
CREATE TABLE IF NOT EXISTS `tournoi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` int(11) NOT NULL,
  `jeux` varchar(30) NOT NULL,
  `nombe_participant` int(11) NOT NULL,
  `lieu` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `URL` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
