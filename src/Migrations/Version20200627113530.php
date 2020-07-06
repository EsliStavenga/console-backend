<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200627113530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response ADD command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3E7B0BFB33E1689A ON response (command_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB33E1689A');
        $this->addSql('DROP INDEX UNIQ_3E7B0BFB33E1689A ON response');
        $this->addSql('ALTER TABLE response DROP command_id');
    }
}
