<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029125325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad ADD is_provide TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE dog ADD is_available TINYINT(1) NOT NULL, CHANGE sex sex VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad DROP is_provide');
        $this->addSql('ALTER TABLE dog DROP is_available, CHANGE sex sex VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` DROP phone');
    }
}
