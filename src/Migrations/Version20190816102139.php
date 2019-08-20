<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816102139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD cniE VARCHAR(255) NOT NULL, ADD cniB VARCHAR(255) NOT NULL, ADD telephoneE VARCHAR(255) NOT NULL, ADD telephoneB VARCHAR(255) DEFAULT NULL, DROP cni_e, DROP cni_b');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D1F817042A ON transaction (cniE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D166739189 ON transaction (cniB)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D1C9464506 ON transaction (telephoneE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D15722D0A5 ON transaction (telephoneB)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_723705D1F817042A ON transaction');
        $this->addSql('DROP INDEX UNIQ_723705D166739189 ON transaction');
        $this->addSql('DROP INDEX UNIQ_723705D1C9464506 ON transaction');
        $this->addSql('DROP INDEX UNIQ_723705D15722D0A5 ON transaction');
        $this->addSql('ALTER TABLE transaction ADD cni_b VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP cniE, DROP cniB, DROP telephoneE, CHANGE telephoneb cni_e VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
