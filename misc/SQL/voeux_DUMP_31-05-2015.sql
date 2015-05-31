-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 31 Mai 2015 à 21:02
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `voeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `module` varchar(45) NOT NULL COMMENT 'Nom du module (FK vers l''attribut ident de module)',
  `partie` varchar(20) NOT NULL COMMENT 'Mon de la partie du module, par exemple CM, CM partie 1, CM partie 1, TD (si un seul TD), TD 1, TD 2, TP 1, TP 2, etc.',
  `type` varchar(45) NOT NULL COMMENT 'Type de la partie, à choisir parmis {CM, TD, TP, projet}',
  `hed` varchar(45) NOT NULL COMMENT 'Nombre d''heures équivalent TD associées à la partie',
  `enseignant` varchar(10) DEFAULT NULL COMMENT 'Enseignant assurant la partie de cours (FK vers l''attribut login de user)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenu`
--

INSERT INTO `contenu` (`module`, `partie`, `type`, `hed`, `enseignant`) VALUES
('ALGOC1', 'CM', 'CM', '22', 'fgoasdoue'),
('ALGOC1', 'TD 1', 'TD', '14', 'fgoasdoue'),
('ALGOC1', 'TD 2', 'TD', '14', 'kabbaci'),
('ALGOC1', 'TD 3', 'TD', '14', 'nestibal'),
('ALGOC1', 'TP 1', 'TP', '18', 'fgoasdoue'),
('ALGOC1', 'TP 2', 'TP', '18', NULL),
('ALGOC1', 'TP 3', 'TP', '18', NULL),
('ALGOC1', 'TP 4', 'TP', '18', NULL),
('ALGOC1', 'TP 5', 'TP', '18', NULL),
('ALGOC2', 'CM', 'CM', '15', 'fgoasdoue'),
('ALGOC2', 'TD', 'TD', '6', NULL),
('ALGOC2', 'TP 1', 'TP', '14', NULL),
('ALGOC2', 'TP 2', 'TP', '14', 'kabbaci'),
('BD', 'CM', 'CM', '27', 'opivert'),
('BD', 'TD', 'TD', '16', NULL),
('BD', 'TP 1', 'TP', '20', NULL),
('BD', 'TP 2', 'TP', '20', NULL),
('DOO', 'CM', 'CM', '24', NULL),
('DOO', 'TD', 'TD', '8', NULL),
('DOO', 'TP 1', 'TP', '18', NULL),
('DOO', 'TP 2', 'TP', '18', NULL),
('FONDSE', 'CM', 'CM', '30', NULL),
('FONDSE', 'TD', 'TD', '10', NULL),
('INTROSE', 'CM partie 1', 'CM', '15', 'jpettier'),
('INTROSE', 'CM partie 2', 'CM', '6', 'jpettier'),
('JavaIHM', 'CM', 'CM', '18', 'vthion'),
('JavaIHM', 'TP', 'TP', '24', 'vthion'),
('MDD', 'CM', 'CM', '18', 'hjaudoin'),
('MDD', 'TD', 'TD', '8', 'hjaudoin'),
('RESIMREII', 'CM partie 1', 'CM', '10', 'fgoasdoue'),
('RESIMREII', 'CM partie 2', 'CM', '10', NULL),
('RESIMREII', 'TD EII2', 'TD', '10', 'fgoasdoue'),
('RESIMREII', 'TD IMR1', 'TD', '10', NULL),
('SAR', 'CM', 'CM', '12', 'vbarreaud'),
('SAR', 'TP partie 1', 'TP', '10', 'vbarreaud'),
('SAR', 'TP partie 2', 'TP', '10', NULL),
('SDD', 'CM', 'CM', '33', 'hjaudoin'),
('SDD', 'TD', 'TD', '20', 'hjaudoin'),
('SDD', 'TP 1', 'TP', '22', NULL),
('SDD', 'TP 2', 'TP', '22', NULL),
('UML', 'CM', 'CM', '15', NULL),
('UML', 'Projet', 'Projet', '8', NULL),
('UML', 'TD', 'TD', '6', NULL),
('UML', 'TP', 'TP', '4', NULL),
('UnixP', 'CM', 'CM', '9', 'vthion'),
('UnixP', 'TP 1', 'TP', '18', 'vthion'),
('UnixP', 'TP 2', 'TP', '18', 'kabbaci'),
('UnixU', 'CM', 'CM', '3', 'kabbaci'),
('UnixU', 'TP 1', 'TP', '18', NULL),
('UnixU', 'TP 2', 'TP', '18', 'hjaudoin');

-- --------------------------------------------------------

--
-- Structure de la table `decharge`
--

CREATE TABLE `decharge` (
  `enseignant` varchar(10) NOT NULL COMMENT 'Login de l''enseignant concerné par une décharge',
  `decharge` int(11) NOT NULL DEFAULT '0' COMMENT 'Nombre d''heures TOTALES de décharge'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `decharge`
--

INSERT INTO `decharge` (`enseignant`, `decharge`) VALUES
('hjaudoin', 10),
('opivert', 14),
('vthion', 22);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `login` varchar(10) NOT NULL COMMENT 'Login (identifiant) de l''enseignant.\nPour simuler un utilisateur non enseignant, simplement indiquer un service statutaire à 0.',
  `pwd` varchar(61) NOT NULL DEFAULT 'servicesENSSAT' COMMENT 'Mot de passe',
  `nom` varchar(40) NOT NULL COMMENT 'Nom de famille',
  `prenom` varchar(40) NOT NULL COMMENT 'Prénom',
  `email` varchar(255) NOT NULL,
  `statut` varchar(45) NOT NULL COMMENT 'Statut à choisir parmis {administratif, contractuel, titulaire, vacataire)',
  `statutaire` int(11) DEFAULT '192' COMMENT 'Service statutaire de l''enseignant. Les éventuelles décharges sont indiquées dans la table decharge. \n',
  `actif` int(1) NOT NULL DEFAULT '1' COMMENT 'Indique si l''enseignant est actif, à choisir parmi 0 pour inactif et 1 pour actif',
  `administrateur` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`login`, `pwd`, `nom`, `prenom`, `email`, `statut`, `statutaire`, `actif`, `administrateur`) VALUES
('ahadjali', 'servicesENSSAT', 'Hadjali', 'Allel', '', 'permanent', 192, 1, 1),
('dguennec', 'servicesENSSAT', 'Guennec', 'David', '', 'contractuel', 192, 1, 1),
('fgoasdoue', 'servicesENSSAT', 'Goasdoué', 'François', 'francois.gasdoue@enssat.fr', 'titulaire', 192, 1, 0),
('glecorve', 'servicesENSSAT', 'Lecorvé', 'Gwénolé', '', 'titulaire', 192, 1, 0),
('hjaudoin', 'servicesENSSAT', 'Jaudoin', 'Hélène', '', 'titulaire', 192, 1, 0),
('jpettier', 'servicesENSSAT', 'Pettier', 'Jean-Christophe', '', 'titulaire', 192, 1, 1),
('kabbaci', 'servicesENSSAT', 'Abbaci', 'Katia', '', 'contractuel', 192, 1, 0),
('mnantel', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'nantel', 'maelig', 'mnantel@enssat.fr', 'administratif', 192, 1, 1),
('nestibal', 'servicesENSSAT', 'Estibal', 'Nicolas', '', 'contractuel', 192, 1, 0),
('opivert', 'servicesENSSAT', 'Pivert', 'Olivier', '', 'titulaire', 192, 1, 0),
('pbosc', 'servicesENSSAT', 'Bosc', 'Patrick', '', 'titulaire', 192, 1, 0),
('pcrepieux', 'servicesENSSAT', 'Crepieux', 'Pierre', '', 'vacataire', 192, 1, 0),
('vbarreaud', 'servicesENSSAT', 'Barreaud', 'Vincent', '', 'titulaire', 192, 1, 0),
('vthion', 'servicesENSSAT', 'Thion', 'Virginie', 'virginie.thion@enssat.fr', 'titulaire', 192, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `ident` varchar(10) NOT NULL COMMENT 'identifiant du module',
  `public` varchar(20) NOT NULL COMMENT 'Formation, à choisir parmi {par exemple, EII2, TC, Commun IMR1-EII2}',
  `semestre` varchar(10) NOT NULL DEFAULT 'S1',
  `libelle` varchar(50) NOT NULL COMMENT 'Label (nom long) du module',
  `responsable` varchar(10) DEFAULT NULL COMMENT 'Responsable du module (FK vers login de user)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`ident`, `public`, `semestre`, `libelle`, `responsable`) VALUES
('ALGOC1', 'TC', 'S1', 'Algorithmique et language C 1', 'fgoasdoue'),
('ALGOC2', 'LSI1', 'S1', 'Algorithmique et language C 2', NULL),
('BD', 'LSI1', 'S2', 'Bases de données', NULL),
('DOO', 'LSI1', 'S2', 'Développement Orienté Objet', NULL),
('FONDSE', 'LSI1', 'S2', 'Fondement des Systèmes d''Exploitation', NULL),
('INTROSE', 'LSI1', 'S1', 'Introduction aux systèmes d''exploitatiob', 'jpettier'),
('JavaIHM', 'LSI2', 'S1', 'Java Interfaces graphiques', NULL),
('MDD', 'LSI1', 'S1', 'Modèle de données', 'hjaudoin'),
('PROGWEB', 'LSI1', 'S2', 'Programmation Web', NULL),
('RESIMREII', 'commun IMR1 et EII2', 'S1', 'Réseaux IMR1 et EII2', NULL),
('SAR', 'LSI3', 'S1', 'Systèmes et algorithmes répartis', NULL),
('SDD', 'LSI1', 'S2', 'Structures de données', NULL),
('UML', 'LSI2', 'S1', 'Méthode de conception UML/RUP', 'hjaudoin'),
('UnixP', 'LSI1', 'S2', 'Unix programmation', NULL),
('UnixU', 'LSI1', 'S1', 'Unix utilisation', 'glecorve');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `services`
--
CREATE TABLE `services` (
`login` varchar(10)
,`nom` varchar(40)
,`prenom` varchar(40)
,`statutaire` bigint(12)
,`service` double
);

-- --------------------------------------------------------

--
-- Structure de la vue `services`
--
DROP TABLE IF EXISTS `services`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `services` AS select `enseignant`.`login` AS `login`,`enseignant`.`nom` AS `nom`,`enseignant`.`prenom` AS `prenom`,(`enseignant`.`statutaire` - ifnull(`decharge`.`decharge`,0)) AS `statutaire`,ifnull(sum(`contenu`.`hed`),0) AS `service` from ((`enseignant` left join `contenu` on((`contenu`.`enseignant` = `enseignant`.`login`))) left join `decharge` on((`enseignant`.`login` = `decharge`.`enseignant`))) where (`enseignant`.`actif` = 1) group by `enseignant`.`login`;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`module`,`partie`),
  ADD KEY `FK_contenu_module_idx` (`module`),
  ADD KEY `FK_contenu_enseignant_idx` (`enseignant`);

--
-- Index pour la table `decharge`
--
ALTER TABLE `decharge`
  ADD PRIMARY KEY (`enseignant`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`ident`),
  ADD KEY `FK_module_responsable_idx` (`responsable`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `FK_contenu_enseignant` FOREIGN KEY (`enseignant`) REFERENCES `enseignant` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_contenu_module` FOREIGN KEY (`module`) REFERENCES `module` (`ident`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `decharge`
--
ALTER TABLE `decharge`
  ADD CONSTRAINT `FK_decharge_enseignant` FOREIGN KEY (`enseignant`) REFERENCES `enseignant` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_module_resp` FOREIGN KEY (`responsable`) REFERENCES `enseignant` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;
