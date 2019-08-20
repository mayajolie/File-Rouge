<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190808121212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compt_bancaire DROP FOREIGN KEY FK_A53C254498DE13AC');
        $this->addSql('DROP INDEX IDX_A53C254498DE13AC ON compt_bancaire');
        $this->addSql('ALTER TABLE compt_bancaire DROP partenaire_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compt_bancaire ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compt_bancaire ADD CONSTRAINT FK_A53C254498DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaires (id)');
        $this->addSql('CREATE INDEX IDX_A53C254498DE13AC ON compt_bancaire (partenaire_id)');
    }
}
