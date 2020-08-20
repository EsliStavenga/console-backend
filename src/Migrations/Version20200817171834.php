<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817171834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line (id INT AUTO_INCREMENT NOT NULL, response_id INT NOT NULL, INDEX IDX_D114B4F6FBF32840 (response_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part (id INT AUTO_INCREMENT NOT NULL, response_id INT DEFAULT NULL, command_to_execute_on_click INT DEFAULT NULL, line_id INT NOT NULL, content VARCHAR(255) NOT NULL, foreground_color VARCHAR(255) NOT NULL, INDEX IDX_490F70C6FBF32840 (response_id), INDEX IDX_490F70C62161FBB9 (command_to_execute_on_click), INDEX IDX_490F70C64D7B7542 (line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, command_id INT NOT NULL, INDEX IDX_3E7B0BFB33E1689A (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE line ADD CONSTRAINT FK_D114B4F6FBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6FBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C62161FBB9 FOREIGN KEY (command_to_execute_on_click) REFERENCES command (id)');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C64D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C62161FBB9');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB33E1689A');
        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C64D7B7542');
        $this->addSql('ALTER TABLE line DROP FOREIGN KEY FK_D114B4F6FBF32840');
        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C6FBF32840');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE line');
        $this->addSql('DROP TABLE part');
        $this->addSql('DROP TABLE response');
    }
}
