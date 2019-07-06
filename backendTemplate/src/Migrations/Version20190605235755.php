<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605235755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY fk_Avis_Client1');
        $this->addSql('ALTER TABLE avis CHANGE Produit_idProduit Produit_idProduit INT DEFAULT NULL, CHANGE Client_idClient Client_idClient INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0276A294 FOREIGN KEY (Client_idClient) REFERENCES client (idClient)');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY fk_Categorie_Categorie1');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie)');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY fk_Wishlist_Produit1');
        $this->addSql('ALTER TABLE wishlist DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A319328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE wishlist RENAME INDEX fk_wishlist_client1_idx TO IDX_9CE12A31276A294');
        $this->addSql('ALTER TABLE wishlist RENAME INDEX fk_wishlist_produit1_idx TO IDX_9CE12A319328EBC3');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY fk_Commande_Panier1');
        $this->addSql('ALTER TABLE commande CHANGE Client_idClient Client_idClient INT DEFAULT NULL, CHANGE Panier_idPanier Panier_idPanier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D555D9284 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY fk_Facture_Commande1');
        $this->addSql('ALTER TABLE facture CHANGE Commande_idCommande Commande_idCommande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY fk_Paiement_Facture1');
        $this->addSql('ALTER TABLE paiement CHANGE Facture_idFacture Facture_idFacture INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA34009C FOREIGN KEY (Facture_idFacture) REFERENCES facture (idFacture)');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY fk_Panier_has_Produit_Produit1');
        $this->addSql('ALTER TABLE lignecommandearticle DROP quantite, DROP prix_total');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT FK_1F9A7D709328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE lignecommandearticle RENAME INDEX fk_panier_has_produit_panier1_idx TO IDX_1F9A7D70555D9284');
        $this->addSql('ALTER TABLE lignecommandearticle RENAME INDEX fk_panier_has_produit_produit1_idx TO IDX_1F9A7D709328EBC3');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY fk_Produit_Categorie1');
        $this->addSql('ALTER TABLE produit ADD image_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie)');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY fk_Produit_has_Coupons_Coupons1');
        $this->addSql('ALTER TABLE coupons_products DROP valide');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT FK_D52EBA6BC7C51C FOREIGN KEY (Coupons_idCoupons) REFERENCES coupons (idCoupons)');
        $this->addSql('ALTER TABLE coupons_products RENAME INDEX fk_produit_has_coupons_produit1_idx TO IDX_D52EBA9328EBC3');
        $this->addSql('ALTER TABLE coupons_products RENAME INDEX fk_produit_has_coupons_coupons1_idx TO IDX_D52EBA6BC7C51C');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY fk_Roles_Admin1');
        $this->addSql('ALTER TABLE roles CHANGE Admin_idAdmin Admin_idAdmin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7E8888717 FOREIGN KEY (Admin_idAdmin) REFERENCES admin (idAdmin)');
        $this->addSql('ALTER TABLE sortiestock DROP FOREIGN KEY fk_SortieStock_Commande1');
        $this->addSql('ALTER TABLE sortiestock CHANGE Commande_idCommande Commande_idCommande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sortiestock ADD CONSTRAINT FK_11E79878830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0276A294');
        $this->addSql('ALTER TABLE avis CHANGE Client_idClient Client_idClient INT NOT NULL, CHANGE Produit_idProduit Produit_idProduit INT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT fk_Avis_Client1 FOREIGN KEY (Client_idClient) REFERENCES client (idClient) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634FDA1FEB3');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT fk_Categorie_Categorie1 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D555D9284');
        $this->addSql('ALTER TABLE commande CHANGE Client_idClient Client_idClient INT NOT NULL, CHANGE Panier_idPanier Panier_idPanier INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT fk_Commande_Panier1 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY FK_D52EBA6BC7C51C');
        $this->addSql('ALTER TABLE coupons_products ADD valide TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT fk_Produit_has_Coupons_Coupons1 FOREIGN KEY (Coupons_idCoupons) REFERENCES coupons (idCoupons) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupons_products RENAME INDEX idx_d52eba6bc7c51c TO fk_Produit_has_Coupons_Coupons1_idx');
        $this->addSql('ALTER TABLE coupons_products RENAME INDEX idx_d52eba9328ebc3 TO fk_Produit_has_Coupons_Produit1_idx');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410830FD6D4');
        $this->addSql('ALTER TABLE facture CHANGE Commande_idCommande Commande_idCommande INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_Facture_Commande1 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY FK_1F9A7D709328EBC3');
        $this->addSql('ALTER TABLE lignecommandearticle ADD quantite INT DEFAULT NULL, ADD prix_total DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT fk_Panier_has_Produit_Produit1 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lignecommandearticle RENAME INDEX idx_1f9a7d709328ebc3 TO fk_Panier_has_Produit_Produit1_idx');
        $this->addSql('ALTER TABLE lignecommandearticle RENAME INDEX idx_1f9a7d70555d9284 TO fk_Panier_has_Produit_Panier1_idx');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA34009C');
        $this->addSql('ALTER TABLE paiement CHANGE Facture_idFacture Facture_idFacture INT NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT fk_Paiement_Facture1 FOREIGN KEY (Facture_idFacture) REFERENCES facture (idFacture) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FDA1FEB3');
        $this->addSql('ALTER TABLE produit DROP image_name');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT fk_Produit_Categorie1 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7E8888717');
        $this->addSql('ALTER TABLE roles CHANGE Admin_idAdmin Admin_idAdmin INT NOT NULL');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT fk_Roles_Admin1 FOREIGN KEY (Admin_idAdmin) REFERENCES admin (idAdmin) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortiestock DROP FOREIGN KEY FK_11E79878830FD6D4');
        $this->addSql('ALTER TABLE sortiestock CHANGE Commande_idCommande Commande_idCommande INT NOT NULL');
        $this->addSql('ALTER TABLE sortiestock ADD CONSTRAINT fk_SortieStock_Commande1 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A319328EBC3');
        $this->addSql('ALTER TABLE wishlist ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT fk_Wishlist_Produit1 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist RENAME INDEX idx_9ce12a31276a294 TO fk_Wishlist_Client1_idx');
        $this->addSql('ALTER TABLE wishlist RENAME INDEX idx_9ce12a319328ebc3 TO fk_Wishlist_Produit1_idx');
    }
}
