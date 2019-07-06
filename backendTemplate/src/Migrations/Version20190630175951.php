<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190630175951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin DROP username, CHANGE role role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY fk_Avis_Produit1');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0276A294');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF09328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0276A294 FOREIGN KEY (Client_idClient) REFERENCES client (idClient)');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634FDA1FEB3');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie)');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY fk_Wishlist_Client1');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A319328EBC3');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31276A294 FOREIGN KEY (Client_idClient) REFERENCES client (idClient)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A319328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY fk_Commande_Client1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D555D9284');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D276A294 FOREIGN KEY (Client_idClient) REFERENCES client (idClient)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D555D9284 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410830FD6D4');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA34009C');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA34009C FOREIGN KEY (Facture_idFacture) REFERENCES facture (idFacture)');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY fk_Panier_has_Produit_Panier1');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY FK_1F9A7D709328EBC3');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT FK_1F9A7D70555D9284 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier)');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT FK_1F9A7D709328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FDA1FEB3');
        $this->addSql('ALTER TABLE produit CHANGE images_additio images_additio LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE Categorie_idCategorie Categorie_idCategorie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie)');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY fk_Produit_has_Coupons_Produit1');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY FK_D52EBA6BC7C51C');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT FK_D52EBA9328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit)');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT FK_D52EBA6BC7C51C FOREIGN KEY (Coupons_idCoupons) REFERENCES coupons (idCoupons)');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7E8888717');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7E8888717 FOREIGN KEY (Admin_idAdmin) REFERENCES admin (idAdmin)');
        $this->addSql('ALTER TABLE sortiestock DROP FOREIGN KEY FK_11E79878830FD6D4');
        $this->addSql('ALTER TABLE sortiestock ADD CONSTRAINT FK_11E79878830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE admin ADD username VARCHAR(45) NOT NULL COLLATE utf8_general_ci, CHANGE role role VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF09328EBC3');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0276A294');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT fk_Avis_Produit1 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0276A294 FOREIGN KEY (Client_idClient) REFERENCES client (idClient) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634FDA1FEB3');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D276A294');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D555D9284');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT fk_Commande_Client1 FOREIGN KEY (Client_idClient) REFERENCES client (idClient) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D555D9284 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY FK_D52EBA9328EBC3');
        $this->addSql('ALTER TABLE coupons_products DROP FOREIGN KEY FK_D52EBA6BC7C51C');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT fk_Produit_has_Coupons_Produit1 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupons_products ADD CONSTRAINT FK_D52EBA6BC7C51C FOREIGN KEY (Coupons_idCoupons) REFERENCES coupons (idCoupons) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410830FD6D4');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY FK_1F9A7D70555D9284');
        $this->addSql('ALTER TABLE lignecommandearticle DROP FOREIGN KEY FK_1F9A7D709328EBC3');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT fk_Panier_has_Produit_Panier1 FOREIGN KEY (Panier_idPanier) REFERENCES panier (idPanier) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lignecommandearticle ADD CONSTRAINT FK_1F9A7D709328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA34009C');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA34009C FOREIGN KEY (Facture_idFacture) REFERENCES facture (idFacture) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FDA1FEB3');
        $this->addSql('ALTER TABLE produit CHANGE images_additio images_additio VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, CHANGE Categorie_idCategorie Categorie_idCategorie INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FDA1FEB3 FOREIGN KEY (Categorie_idCategorie) REFERENCES categorie (idCategorie) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7E8888717');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7E8888717 FOREIGN KEY (Admin_idAdmin) REFERENCES admin (idAdmin) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortiestock DROP FOREIGN KEY FK_11E79878830FD6D4');
        $this->addSql('ALTER TABLE sortiestock ADD CONSTRAINT FK_11E79878830FD6D4 FOREIGN KEY (Commande_idCommande) REFERENCES commande (idCommande) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31276A294');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A319328EBC3');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT fk_Wishlist_Client1 FOREIGN KEY (Client_idClient) REFERENCES client (idClient) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A319328EBC3 FOREIGN KEY (Produit_idProduit) REFERENCES produit (idProduit) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
