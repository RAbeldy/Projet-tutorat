-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 09 juil. 2019 à 18:44
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetTutorat`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `Adress` int(11) DEFAULT NULL,
  `Complement_Adress` int(11) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `avoir_statut`
--

CREATE TABLE `avoir_statut` (
  `id_avoir_statut` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `niveau` varchar(255) DEFAULT NULL,
  `ecole` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lieu` varchar(255) DEFAULT NULL,
  `nb_tutorés` int(11) DEFAULT NULL,
  `nb_tuteurs` int(11) DEFAULT NULL,
  `id_planning` int(11) DEFAULT NULL,
  `id_statut_evenement` int(11) DEFAULT NULL,
  `id_tutorat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participer_evenement`
--

CREATE TABLE `participer_evenement` (
  `id_evenement` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning_event`
--

CREATE TABLE `planning_event` (
  `id_planning` int(11) NOT NULL,
  `durée` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `se_destine`
--

CREATE TABLE `se_destine` (
  `id_tutorés` int(11) NOT NULL,
  `id_tutorat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id_statut` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id_statut`, `libelle`) VALUES
(1, 'SUPER_ADMIN'),
(3, 'TUTORE_PRREL'),
(4, 'TUTORE_NONPRREL'),
(6, 'VALIDATEUR'),
(8, 'ADMIN'),
(9, 'TUTORE_PRREL'),
(11, 'ADMIN_MEF'),
(12, 'VALIDATEUR'),
(13, 'TUTEUR'),
(14, 'SUP_LYCEE'),
(15, 'ADMIN_VAUBAN');

-- --------------------------------------------------------

--
-- Structure de la table `statut_compte`
--

CREATE TABLE `statut_compte` (
  `id_statut_compte` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut_compte`
--

INSERT INTO `statut_compte` (`id_statut_compte`, `libelle`) VALUES
(1, 'VALIDER'),
(2, 'ATTENTE_VALIDATION'),
(3, 'REJETE');

-- --------------------------------------------------------

--
-- Structure de la table `statut_evenement`
--

CREATE TABLE `statut_evenement` (
  `id_statut_evenement` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut_evenement`
--

INSERT INTO `statut_evenement` (`id_statut_evenement`, `libelle`) VALUES
(1, 'EN_COURS'),
(2, 'PASSE'),
(3, 'A_VENIR');

-- --------------------------------------------------------

--
-- Structure de la table `tuteurs`
--

CREATE TABLE `tuteurs` (
  `id_user` int(11) NOT NULL,
  `prioritaire` varchar(255) DEFAULT NULL,
  `nb_max_mef` int(11) DEFAULT NULL,
  `nb_max_perso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tutorat`
--

CREATE TABLE `tutorat` (
  `id_tutorat` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tutorat`
--

INSERT INTO `tutorat` (`id_tutorat`, `libelle`) VALUES
(1, 'IMMERSSION_SAMEDI_PRREL'),
(2, 'IMMERSSION_VACANCES_PRREL'),
(3, 'TUTORAT_PERSONNALISE'),
(4, 'MEF'),
(5, 'APSCO'),
(6, 'LYCEES'),
(7, 'COLLEGE'),
(8, 'VAUBAN');

-- --------------------------------------------------------

--
-- Structure de la table `tutorés`
--

CREATE TABLE `tutorés` (
  `id_user` int(11) NOT NULL,
  `charte` varchar(255) NOT NULL,
  `id_tutorat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nationalité` varchar(255) DEFAULT NULL,
  `chemin_photo` varchar(255) DEFAULT NULL,
  `id_statut` int(11) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_statut_compte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `date_naissance`, `email`, `password`, `nationalité`, `chemin_photo`, `id_statut`, `id_classe`, `id_statut_compte`) VALUES
(1, 'sfsf', 'sfs', '1237-03-04', 'bricenicodem@gmail.com', 'sfsfsf', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `avoir_statut`
--
ALTER TABLE `avoir_statut`
  ADD PRIMARY KEY (`id_avoir_statut`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_statut` (`id_statut`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `id_planning` (`id_planning`,`id_statut_evenement`,`id_tutorat`),
  ADD KEY `id_statut_event` (`id_statut_evenement`),
  ADD KEY `id_tutorat` (`id_tutorat`);

--
-- Index pour la table `participer_evenement`
--
ALTER TABLE `participer_evenement`
  ADD PRIMARY KEY (`id_evenement`,`id_user`),
  ADD KEY `id_evenement` (`id_evenement`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `planning_event`
--
ALTER TABLE `planning_event`
  ADD PRIMARY KEY (`id_planning`);

--
-- Index pour la table `se_destine`
--
ALTER TABLE `se_destine`
  ADD PRIMARY KEY (`id_tutorés`,`id_tutorat`),
  ADD KEY `id_tutorés` (`id_tutorés`,`id_tutorat`),
  ADD KEY `id_tutorat` (`id_tutorat`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id_statut`);

--
-- Index pour la table `statut_compte`
--
ALTER TABLE `statut_compte`
  ADD PRIMARY KEY (`id_statut_compte`);

--
-- Index pour la table `statut_evenement`
--
ALTER TABLE `statut_evenement`
  ADD PRIMARY KEY (`id_statut_evenement`);

--
-- Index pour la table `tuteurs`
--
ALTER TABLE `tuteurs`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `tutorat`
--
ALTER TABLE `tutorat`
  ADD PRIMARY KEY (`id_tutorat`);

--
-- Index pour la table `tutorés`
--
ALTER TABLE `tutorés`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_type` (`id_tutorat`),
  ADD KEY `id_tutorat` (`id_tutorat`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_statut` (`id_statut`,`id_classe`,`id_statut_compte`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `avoir_statut`
--
ALTER TABLE `avoir_statut`
  MODIFY `id_avoir_statut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning_event`
--
ALTER TABLE `planning_event`
  MODIFY `id_planning` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_statut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `statut_compte`
--
ALTER TABLE `statut_compte`
  MODIFY `id_statut_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `statut_evenement`
--
ALTER TABLE `statut_evenement`
  MODIFY `id_statut_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tuteurs`
--
ALTER TABLE `tuteurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tutorat`
--
ALTER TABLE `tutorat`
  MODIFY `id_tutorat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tutorés`
--
ALTER TABLE `tutorés`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir_statut`
--
ALTER TABLE `avoir_statut`
  ADD CONSTRAINT `avoir_statut_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `avoir_statut_ibfk_2` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id_statut`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`id_statut_evenement`) REFERENCES `statut_evenement` (`id_statut_evenement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`id_planning`) REFERENCES `planning_event` (`id_planning`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`id_tutorat`) REFERENCES `tutorat` (`id_tutorat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participer_evenement`
--
ALTER TABLE `participer_evenement`
  ADD CONSTRAINT `participer_evenement_ibfk_1` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participer_evenement_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `se_destine`
--
ALTER TABLE `se_destine`
  ADD CONSTRAINT `se_destine_ibfk_1` FOREIGN KEY (`id_tutorat`) REFERENCES `tutorat` (`id_tutorat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tutorés`
--
ALTER TABLE `tutorés`
  ADD CONSTRAINT `tutorés_ibfk_1` FOREIGN KEY (`id_tutorat`) REFERENCES `tutorat` (`id_tutorat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
