<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190815145628 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD cni_e VARCHAR(255) DEFAULT NULL, ADD cni_b VARCHAR(255) DEFAULT NULL, ADD envoi VARCHAR(255) DEFAULT NULL, ADD retrait VARCHAR(255) DEFAULT NULL, DROP montant, DROP type_trans, DROP code, DROP cniE, DROP cniB, CHANGE nom_e nom_e VARCHAR(255) DEFAULT NULL, CHANGE prenom_e prenom_e VARCHAR(255) DEFAULT NULL, CHANGE nom_b nom_b VARCHAR(255) DEFAULT NULL, CHANGE prenom_b prenom_b VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD montant BIGINT NOT NULL, ADD type_trans VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD code VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD cniE VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD cniB VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP cni_e, DROP cni_b, DROP envoi, DROP retrait, CHANGE nom_e nom_e VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom_e prenom_e VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_b nom_b VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom_b prenom_b VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
