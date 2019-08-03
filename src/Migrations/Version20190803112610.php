<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803112610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compt_bancaire DROP FOREIGN KEY FK_A53C2544B514973B');
        $this->addSql('DROP INDEX IDX_A53C2544B514973B ON compt_bancaire');
        $this->addSql('ALTER TABLE compt_bancaire DROP caissier_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compt_bancaire ADD caissier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compt_bancaire ADD CONSTRAINT FK_A53C2544B514973B FOREIGN KEY (caissier_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A53C2544B514973B ON compt_bancaire (caissier_id)');
    }
}
