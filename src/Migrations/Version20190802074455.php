<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802074455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot ADD numero_compt_id INT NOT NULL, DROP num_compt');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCD74A54FF FOREIGN KEY (numero_compt_id) REFERENCES compt_bancaire (id)');
        $this->addSql('CREATE INDEX IDX_47948BBCD74A54FF ON depot (numero_compt_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCD74A54FF');
        $this->addSql('DROP INDEX IDX_47948BBCD74A54FF ON depot');
        $this->addSql('ALTER TABLE depot ADD num_compt VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP numero_compt_id');
    }
}
