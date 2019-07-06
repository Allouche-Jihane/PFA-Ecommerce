-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 06 juil. 2019 à 20:41
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nom`, `prenom`, `email`, `password`, `role`) VALUES
(9, 'TAARABT', 'Zakariae', 'taarabtzakariae@gmail.com', '123', 'SuperAdmin'),
(10, 'allouche', 'jihane', 'jihaane.allouche@gmail.com', '123', 'Utilisateur'),
(11, 'adminNom', 'adminPrenom', 'admin@gmail.com', '123', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `idAvis` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `commentaire` longtext,
  `created_at` datetime DEFAULT NULL,
  `evaluation` int(11) DEFAULT NULL,
  `Produit_idProduit` int(11) DEFAULT NULL,
  `Client_idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAvis`),
  KEY `fk_Avis_Produit1_idx` (`Produit_idProduit`),
  KEY `fk_Avis_Client1_idx` (`Client_idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`idAvis`, `nom`, `commentaire`, `created_at`, `evaluation`, `Produit_idProduit`, `Client_idClient`) VALUES
(1, 'pseudo', 'Très Bonne qualité !\r\n\r\n', '2019-07-23 11:15:00', 4, 59, 1),
(2, 'pseudo 2 ', 'Pas mal !\r\n\r\n', '2019-07-24 11:12:00', 2, 59, 2),
(3, 'zaki', 'hllldd', NULL, 4, 59, 2),
(4, 'zakariae', 'mkkkmmk', '2019-07-03 16:37:16', 3, 59, 1),
(7, 'zafa', 'fazfazfa', '2019-07-03 17:34:21', 3, 57, 1),
(8, 'fefe', 'fezfze', '2019-07-03 17:38:24', 3, 57, 1),
(9, 'fefe', 'fezfze', '2019-07-03 17:39:17', 3, 57, 1),
(10, 'akhirtest', 'zadkzad', '2019-07-03 17:39:39', 5, 57, 1),
(11, 'da', 'blabla', '2019-07-03 17:42:38', 2, 57, 1),
(12, 'da', 'blabla', '2019-07-03 17:43:03', 2, 57, 1),
(13, 'da', 'blabla', '2019-07-03 17:43:21', 2, 57, 1),
(14, 'daz', 'AAAAa', '2019-07-03 17:43:40', 1, 57, 1),
(15, 'TAARABT', 'dazd', '2019-07-06 14:19:32', 3, 59, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(45) DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  `Categorie_idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`),
  KEY `fk_Categorie_Categorie1_idx` (`Categorie_idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `designation`, `actif`, `Categorie_idCategorie`) VALUES
(1, 'Homme', 1, NULL),
(2, 'Femme', 0, NULL),
(3, 'Enfant', 1, NULL),
(10, 'LMA', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(45) DEFAULT NULL,
  `prenom_client` varchar(45) DEFAULT NULL,
  `email_client` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `code_postal` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nom_client`, `prenom_client`, `email_client`, `password`, `adresse`, `tel`, `ville`, `code_postal`, `age`) VALUES
(1, 'TAARABT', 'Zakariae', 'taarabtzakariae@gmail.com', '123456', 'dzad', 'ljdaz', 'daz', 'kdajz', 24),
(2, 'ALLOUCHE', 'Jihane', 'jihaane.allouche@gmail.com', '123456', 'oujda', '0768495890', 'oujda', '6000', 21);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` datetime DEFAULT NULL,
  `etat_commande` varchar(25) DEFAULT NULL,
  `prix_vente` float DEFAULT NULL,
  `Client_idClient` int(11) DEFAULT NULL,
  `Panier_idPanier` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `fk_Commande_Client1_idx` (`Client_idClient`),
  KEY `fk_Commande_Panier1_idx` (`Panier_idPanier`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `date_commande`, `etat_commande`, `prix_vente`, `Client_idClient`, `Panier_idPanier`) VALUES
(1, '2019-06-29 00:00:00', 'Terminée', 300, 1, 1),
(2, '2019-07-14 00:00:00', 'Attente', 200, 2, 1),
(3, '2019-07-30 00:00:00', 'Annulée', 200, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `idCoupons` int(11) NOT NULL AUTO_INCREMENT,
  `nom_coupon` varchar(255) DEFAULT NULL,
  `code_coupon` varchar(45) DEFAULT NULL,
  `value` decimal(50,0) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `valide` tinyint(4) DEFAULT NULL,
  `nombre_personne` int(11) DEFAULT NULL,
  `dateCreation` date DEFAULT NULL,
  `limite_utilisation` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCoupons`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `coupons`
--

INSERT INTO `coupons` (`idCoupons`, `nom_coupon`, `code_coupon`, `value`, `date_debut`, `date_fin`, `valide`, `nombre_personne`, `dateCreation`, `limite_utilisation`) VALUES
(13, 'Coupon1', 'KLDD1', '200', '2019-07-13', '2019-07-20', 1, 1020, '2019-07-06', 96),
(15, 'sa', 'dalj', '12', '2019-07-06', '2019-07-13', 1, 130, '2019-07-06', 103),
(16, 'sa', 'FEL2', '200', '2019-07-06', '2019-07-21', 0, 1, '2019-07-06', 100);

-- --------------------------------------------------------

--
-- Structure de la table `coupons_products`
--

DROP TABLE IF EXISTS `coupons_products`;
CREATE TABLE IF NOT EXISTS `coupons_products` (
  `Produit_idProduit` int(11) NOT NULL,
  `Coupons_idCoupons` int(11) NOT NULL,
  PRIMARY KEY (`Produit_idProduit`,`Coupons_idCoupons`),
  KEY `IDX_D52EBA6BC7C51C` (`Coupons_idCoupons`),
  KEY `IDX_D52EBA9328EBC3` (`Produit_idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `idFacture` int(11) NOT NULL AUTO_INCREMENT,
  `date_facture` datetime DEFAULT NULL,
  `Commande_idCommande` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFacture`),
  KEY `fk_Facture_Commande1_idx` (`Commande_idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignecommandearticle`
--

DROP TABLE IF EXISTS `lignecommandearticle`;
CREATE TABLE IF NOT EXISTS `lignecommandearticle` (
  `Panier_idPanier` int(11) NOT NULL,
  `Produit_idProduit` int(11) NOT NULL,
  PRIMARY KEY (`Panier_idPanier`,`Produit_idProduit`),
  KEY `IDX_1F9A7D709328EBC3` (`Produit_idProduit`),
  KEY `IDX_1F9A7D70555D9284` (`Panier_idPanier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190605235755', '2019-06-05 23:58:46'),
('20190606000410', '2019-06-06 00:04:16'),
('20190630175951', '2019-06-30 18:00:11');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idPaiement` int(11) NOT NULL AUTO_INCREMENT,
  `Facture_idFacture` int(11) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `mode_paiement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPaiement`),
  KEY `fk_Paiement_Facture1_idx` (`Facture_idFacture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `idPanier` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_articles` int(11) DEFAULT NULL,
  `Total` float DEFAULT NULL,
  PRIMARY KEY (`idPanier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`idPanier`, `nombre_articles`, `Total`) VALUES
(1, 2, 400);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(45) DEFAULT NULL,
  `typeProduit` varchar(255) DEFAULT NULL,
  `description` text,
  `prix` float DEFAULT NULL,
  `image_principale` varchar(255) DEFAULT NULL,
  `images_additio` varchar(255) DEFAULT NULL,
  `quantite_stock` int(11) DEFAULT NULL,
  `actif` tinyint(1) DEFAULT NULL,
  `valeur_promo` double DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `Categorie_idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `fk_Produit_Categorie1_idx` (`Categorie_idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom_produit`, `typeProduit`, `description`, `prix`, `image_principale`, `images_additio`, `quantite_stock`, `actif`, `valeur_promo`, `date_debut`, `date_fin`, `Categorie_idCategorie`) VALUES
(57, 'Sac', 'autre', ' sac à main pour femme', 150, 'chair3.png', 'a:1:{i:0;s:10:\"chair3.png\";}', 120, 0, 50, '2019-06-21', '2019-06-28', 3),
(58, 'montre', 'montre', 'bla bla bla bla', 230, 'chair4.png', 'a:1:{i:0;s:8:\"ipad.png\";}', 120, 1, 31, '2019-06-07', '2019-06-29', 1),
(59, 'tshirt', 'tshirt', '  tshirt pour homme', 321, 'iwatch.png', 'a:1:{i:0;s:10:\"iphone.png\";}', 10, 1, 0, '2019-06-08', '2019-06-30', 1),
(68, 'Pantalon', 'pantalon', 'pantalon homme ', 300, '1-1.jpg', 'a:2:{i:0;s:5:\"1.jpg\";i:1;s:7:\"1-1.jpg\";}', 100, 0, 50, '2019-07-05', '2019-07-14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRoles` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(255) DEFAULT NULL,
  `Admin_idAdmin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRoles`),
  KEY `fk_Roles_Admin1_idx` (`Admin_idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sortiestock`
--

DROP TABLE IF EXISTS `sortiestock`;
CREATE TABLE IF NOT EXISTS `sortiestock` (
  `idSortieStock` int(11) NOT NULL AUTO_INCREMENT,
  `Commande_idCommande` int(11) DEFAULT NULL,
  `qte_sortie` int(11) DEFAULT NULL,
  `prix_vente` float DEFAULT NULL,
  PRIMARY KEY (`idSortieStock`),
  KEY `fk_SortieStock_Commande1_idx` (`Commande_idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, 'jihane@gmail.com', 'jihane', '123');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `idWishlist` int(11) NOT NULL AUTO_INCREMENT,
  `Client_idClient` int(11) NOT NULL,
  `Produit_idProduit` int(11) NOT NULL,
  PRIMARY KEY (`idWishlist`),
  KEY `IDX_9CE12A31276A294` (`Client_idClient`),
  KEY `IDX_9CE12A319328EBC3` (`Produit_idProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`idWishlist`, `Client_idClient`, `Produit_idProduit`) VALUES
(18, 1, 59),
(19, 1, 59);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0276A294` FOREIGN KEY (`Client_idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_8F91ABF09328EBC3` FOREIGN KEY (`Produit_idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD634FDA1FEB3` FOREIGN KEY (`Categorie_idCategorie`) REFERENCES `categorie` (`idCategorie`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D276A294` FOREIGN KEY (`Client_idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_6EEAA67D555D9284` FOREIGN KEY (`Panier_idPanier`) REFERENCES `panier` (`idPanier`);

--
-- Contraintes pour la table `coupons_products`
--
ALTER TABLE `coupons_products`
  ADD CONSTRAINT `FK_D52EBA6BC7C51C` FOREIGN KEY (`Coupons_idCoupons`) REFERENCES `coupons` (`idCoupons`),
  ADD CONSTRAINT `FK_D52EBA9328EBC3` FOREIGN KEY (`Produit_idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE866410830FD6D4` FOREIGN KEY (`Commande_idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `lignecommandearticle`
--
ALTER TABLE `lignecommandearticle`
  ADD CONSTRAINT `FK_1F9A7D70555D9284` FOREIGN KEY (`Panier_idPanier`) REFERENCES `panier` (`idPanier`),
  ADD CONSTRAINT `FK_1F9A7D709328EBC3` FOREIGN KEY (`Produit_idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_B1DC7A1EA34009C` FOREIGN KEY (`Facture_idFacture`) REFERENCES `facture` (`idFacture`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27FDA1FEB3` FOREIGN KEY (`Categorie_idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_B63E2EC7E8888717` FOREIGN KEY (`Admin_idAdmin`) REFERENCES `admin` (`idAdmin`);

--
-- Contraintes pour la table `sortiestock`
--
ALTER TABLE `sortiestock`
  ADD CONSTRAINT `FK_11E79878830FD6D4` FOREIGN KEY (`Commande_idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK_9CE12A31276A294` FOREIGN KEY (`Client_idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_9CE12A319328EBC3` FOREIGN KEY (`Produit_idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
