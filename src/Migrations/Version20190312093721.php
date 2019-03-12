<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312093721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, trick_id INT NOT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, INDEX IDX_9474526CB281BE2E (trick_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick DROP INDEX FK_D8F0A91EF675F31B, ADD UNIQUE INDEX UNIQ_D8F0A91EF675F31B (author_id)');
        $this->addSql('ALTER TABLE trick DROP image');
        $this->addSql('ALTER TABLE user CHANGE signup_date signup_date DATETIME NOT NULL, CHANGE last_login last_login DATETIME NOT NULL, CHANGE picture_id picture_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE trick DROP INDEX UNIQ_D8F0A91EF675F31B, ADD INDEX FK_D8F0A91EF675F31B (author_id)');
        $this->addSql('ALTER TABLE trick ADD image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE signup_date signup_date DATETIME DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE picture_id picture_id INT DEFAULT NULL');
    }
}
