
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `voeux`
--
DROP DATABASE IF EXISTS  `voeux`;
CREATE DATABASE  `voeux`;
USE  `voeux`;

-- --------------------------------------------------------
--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `module` bigint(20) NOT NULL COMMENT 'Nom du module (FK vers l''attribut id de module)',
  `partie` varchar(20) NOT NULL COMMENT 'Mon de la partie du module, par exemple CM, CM partie 1, CM partie 1, TD (si un seul TD), TD 1, TD 2, TP 1, TP 2, etc.',
  `type` varchar(45) NOT NULL COMMENT 'Type de la partie, à choisir parmis {CM, TD, TP, projet}',
  `hed` varchar(45) NOT NULL COMMENT 'Nombre d''heures équivalent TD associées à la partie',
  `enseignant` varchar(10) DEFAULT NULL COMMENT 'Enseignant assurant la partie de cours (FK vers l''attribut login de user)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenu`
--

INSERT INTO `contenu` (`module`, `partie`, `type`, `hed`, `enseignant`) VALUES
(1, 'CM', 'CM', '22', 'fgoasdoue'),
(1, 'TD 1', 'TD', '14', 'fgoasdoue'),
(1, 'TD 2', 'TD', '14', 'kabbaci'),
(1, 'TD 3', 'TD', '14', 'nestibal'),
(1, 'TP 1', 'TP', '18', 'fgoasdoue'),
(1, 'TP 2', 'TP', '18', NULL),
(1, 'TP 3', 'TP', '18', NULL),
(1, 'TP 4', 'TP', '18', NULL),
(1, 'TP 5', 'TP', '18', NULL),
(2, 'CM', 'CM', '15', 'fgoasdoue'),
(2, 'TD', 'TD', '6', NULL),
(2, 'TP 1', 'TP', '14', NULL),
(2, 'TP 2', 'TP', '14', 'kabbaci'),
(3, 'CM', 'CM', '27', 'opivert'),
(3, 'TD', 'TD', '16', NULL),
(3, 'TP 1', 'TP', '20', NULL),
(3, 'TP 2', 'TP', '20', NULL),
(4, 'CM', 'CM', '24', NULL),
(4, 'TD', 'TD', '8', NULL),
(4, 'TP 1', 'TP', '18', NULL),
(4, 'TP 2', 'TP', '18', NULL),
(5, 'CM', 'CM', '30', NULL),
(5, 'TD', 'TD', '10', NULL),
(6, 'CM partie 1', 'CM', '15', 'jpettier'),
(6, 'CM partie 2', 'CM', '6', 'jpettier'),
(7, 'CM', 'CM', '18', 'vthion'),
(7, 'TP', 'TP', '24', 'vthion'),
(8, 'CM', 'CM', '18', 'hjaudoin'),
(8, 'TD', 'TD', '8', 'hjaudoin'),
(9, 'CM partie 1', 'CM', '10', 'fgoasdoue'),
(9, 'CM partie 2', 'CM', '10', NULL),
(9, 'TD EII2', 'TD', '10', 'fgoasdoue'),
(9, 'TD IMR1', 'TD', '10', NULL),
(10, 'CM', 'CM', '12', 'vbarreaud'),
(10, 'TP partie 1', 'TP', '10', 'vbarreaud'),
(10, 'TP partie 2', 'TP', '10', NULL),
(11, 'CM', 'CM', '33', 'hjaudoin'),
(11, 'TP 2', 'TP', '22', NULL),
(12, 'CM', 'CM', '15', NULL),
(12, 'Projet', 'Projet', '8', NULL),
(12, 'TD', 'TD', '6', NULL),
(12, 'TP', 'TP', '4', NULL),
(13, 'CM', 'CM', '9', 'vthion'),
(13, 'TP 1', 'TP', '18', 'vthion'),
(13, 'TP 2', 'TP', '18', 'kabbaci'),
(14, 'CM', 'CM', '3', 'kabbaci'),
(14, 'TP 1', 'TP', '18', NULL),
(14, 'TP 2', 'TP', '18', 'hjaudoin');

-- --------------------------------------------------------

--
-- Structure de la table `decharge`
--

CREATE TABLE `decharge` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
  `login` varchar(10) NOT NULL PRIMARY KEY COMMENT 'Login (identifiant) de l''enseignant.\nPour simuler un utilisateur non enseignant, simplement indiquer un service statutaire à 0.',
  `pwd` varchar(61) NOT NULL  COMMENT 'Mot de passe',
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
('ahadjali', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Hadjali', 'Allel', '', 'permanent', 192, 1, 1),
('dguennec', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Guennec', 'David', '', 'contractuel', 192, 1, 1),
('fgoasdoue', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Goasdoué', 'François', 'francois.gasdoue@enssat.fr', 'titulaire', 192, 1, 0),
('glecorve', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Lecorvé', 'Gwénolé', '', 'titulaire', 192, 1, 0),
('hjaudoin', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Jaudoin', 'Hélène', '', 'titulaire', 192, 1, 0),
('jpettier', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Pettier', 'Jean-Christophe', '', 'titulaire', 192, 1, 1),
('kabbaci', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Abbaci', 'Katia', '', 'contractuel', 192, 1, 0),
('mnantel', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'nantel', 'maelig', 'mnantel@enssat.fr', 'administratif', 192, 1, 1),
('nestibal', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Estibal', 'Nicolas', '', 'contractuel', 192, 1, 0),
('opivert', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Pivert', 'Olivier', '', 'titulaire', 192, 1, 0),
('pbosc', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Bosc', 'Patrick', '', 'titulaire', 192, 1, 0),
('pcrepieux', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Crepieux', 'Pierre', '', 'vacataire', 192, 1, 0),
('vbarreaud', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Barreaud', 'Vincent', '', 'titulaire', 192, 1, 0),
('vthion', '$2y$10$6XMHO9L4DCELp4VS4zOzse9MPd8gQpDeKoE9gjE8/eqrr4JSx8YOO', 'Thion', 'Virginie', 'virginie.thion@enssat.fr', 'titulaire', 192, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom` varchar(10) UNIQUE NOT NULL COMMENT 'nom d affichage du module',
  `public` varchar(20) NOT NULL COMMENT 'Formation, à choisir parmi {par exemple, EII2, TC, Commun IMR1-EII2}',
  `semestre` varchar(10) NOT NULL DEFAULT 'S1',
  `libelle` varchar(50) NOT NULL COMMENT 'Label (nom long) du module',
  `responsable` varchar(10) DEFAULT NULL COMMENT 'Responsable du module (FK vers login de user)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`nom`, `public`, `semestre`, `libelle`, `responsable`) VALUES
('ALGOC1','TC', 'S1', 'Algorithmique et language C 1', 'fgoasdoue'),
('ALGOC2','LSI1', 'S1', 'Algorithmique et language C 2', NULL),
('BDD', 'LSI1', 'S2', 'Bases de données', NULL),
('DOO','LSI1', 'S2', 'Développement Orienté Objet', NULL),
('FSE','LSI1', 'S2', 'Fondement des Systèmes d''Exploitation', NULL),
('ESI','LSI1', 'S1', 'Introduction aux systèmes d''exploitatiob', 'jpettier'),
('JavaIHM', 'LSI2', 'S1', 'Java Interfaces graphiques', NULL),
('MDD', 'LSI1', 'S1', 'Modèle de données', 'hjaudoin'),
('ProgWeb', 'LSI1', 'S2', 'Programmation Web', NULL),
('RESIMR1EII2','commun IMR1 et EII2', 'S1', 'Réseaux IMR1 et EII2', NULL),
('SYSREP','IMR3','S1', 'Systèmes et algorithmes répartis', NULL),
('SDD','LSI1', 'S2', 'Structures de données', NULL),
('UML','LSI2', 'S1', 'Méthode de conception UML/RUP', 'hjaudoin'),
('Unix','LSI1', 'S2', 'Unix programmation', NULL),
('Unix', 'LSI1', 'S1', 'Unix utilisation', 'glecorve');
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
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `FK_contenu_enseignant` FOREIGN KEY (`enseignant`) REFERENCES `enseignant` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_contenu_module` FOREIGN KEY (`module`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
