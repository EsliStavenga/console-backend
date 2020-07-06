<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200627154445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE part ADD command_to_execute_on_click INT DEFAULT NULL');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6D6F25A7B FOREIGN KEY (command_to_execute_on_click) REFERENCES command (id)');
        $this->addSql('CREATE INDEX IDX_490F70C6D6F25A7B ON part (command_to_execute_on_click)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C6D6F25A7B');
        $this->addSql('DROP INDEX IDX_490F70C6D6F25A7B ON part');
        $this->addSql('ALTER TABLE part DROP command_to_execute_on_click');
    }
}
