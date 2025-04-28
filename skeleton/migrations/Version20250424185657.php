<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250424185657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql(<<<'SQL'
            CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, niveau_acces INT NOT NULL, UNIQUE INDEX UNIQ_880E0D76FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT NOT NULL, reservation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_publication DATETIME NOT NULL, date_echeance DATE NOT NULL, est_active TINYINT(1) NOT NULL, INDEX IDX_F65593E5858C065E (vendeur_id), UNIQUE INDEX UNIQ_F65593E5B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, vendeur_id INT NOT NULL, note INT NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_67F068BC19EB6921 (client_id), INDEX IDX_67F068BC858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3EC63EAAA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, destination_id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(180) NOT NULL, INDEX IDX_20FD592CBCF5E72D (categorie_id), INDEX IDX_20FD592C816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etablissement_vendeur (etablissement_id INT NOT NULL, vendeur_id INT NOT NULL, INDEX IDX_7EE58655FF631228 (etablissement_id), INDEX IDX_7EE58655858C065E (vendeur_id), PRIMARY KEY(etablissement_id, vendeur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_6A2CA10C8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, expediteur_id INT NOT NULL, destinataire_id INT NOT NULL, contenu LONGTEXT NOT NULL, date_envoi DATETIME NOT NULL, est_lu TINYINT(1) NOT NULL, INDEX IDX_B6BD307F10335F61 (expediteur_id), INDEX IDX_B6BD307FA4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, est_lue TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_BF5476CAFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, vendeur_id INT NOT NULL, etablissement_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, prix_total DOUBLE PRECISION NOT NULL, date_mise_en_ligne DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_42C8495519EB6921 (client_id), INDEX IDX_42C84955858C065E (vendeur_id), INDEX IDX_42C84955FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prénom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, derniere_connexion DATETIME DEFAULT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_7AF49996A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C3A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592C816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement_vendeur ADD CONSTRAINT FK_7EE58655FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement_vendeur ADD CONSTRAINT FK_7EE58655858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)
        SQL);
    }

    public function down(Schema $schema): void
    {

        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5858C065E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC19EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC858C065E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAAA73F0036
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CBCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592C816C6140
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement_vendeur DROP FOREIGN KEY FK_7EE58655FF631228
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etablissement_vendeur DROP FOREIGN KEY FK_7EE58655858C065E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C8805AB2F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAFB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955858C065E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FF631228
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF49996A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `admin`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE annonce
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE commentaire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE destination
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etablissement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etablissement_vendeur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE media
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notification
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pays
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vendeur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ville
        SQL);
    }
}
