<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308122802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE signup_date signup_date DATETIME NOT NULL, CHANGE last_login last_login DATETIME NOT NULL, CHANGE picture_id picture_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick CHANGE image image TEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE signup_date signup_date DATETIME DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE picture_id picture_id INT DEFAULT NULL');
    }
}
