<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029143705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, marketer_id INT NOT NULL, title VARCHAR(50) NOT NULL, date_update DATE NOT NULL, description VARCHAR(255) NOT NULL, is_provide TINYINT(1) NOT NULL, INDEX IDX_77E0ED58DDEFF2BE (marketer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adopting (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, department_id INT NOT NULL, name VARCHAR(50) NOT NULL, zip_code VARCHAR(5) NOT NULL, INDEX IDX_2D5B0234AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demand (id INT AUTO_INCREMENT NOT NULL, adopting_id INT NOT NULL, ad_id INT NOT NULL, date_demand DATE NOT NULL, INDEX IDX_428D7973237433E5 (adopting_id), INDEX IDX_428D79734F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demand_dog (demand_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_F812BA905D022E59 (demand_id), INDEX IDX_F812BA90634DFEB (dog_id), PRIMARY KEY(demand_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, ad_id INT DEFAULT NULL, history VARCHAR(255) DEFAULT NULL, lof TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, animals_friendly TINYINT(1) NOT NULL, name VARCHAR(50) NOT NULL, sex VARCHAR(10) NOT NULL, is_available TINYINT(1) NOT NULL, INDEX IDX_812C397D4F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog_race (dog_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_18E44E6F634DFEB (dog_id), INDEX IDX_18E44E6F6E59D40D (race_id), PRIMARY KEY(dog_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marketer (id INT NOT NULL, type_marketer_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_52848F8B96F6252F (type_marketer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, demand_id INT NOT NULL, type_message_id INT NOT NULL, content VARCHAR(255) NOT NULL, date_message DATE NOT NULL, INDEX IDX_B6BD307F5D022E59 (demand_id), INDEX IDX_B6BD307F4E79C50C (type_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_16DB4F89634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_marketer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_message (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, last_name VARCHAR(60) NOT NULL, first_name VARCHAR(60) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, is_administrator TINYINT(1) NOT NULL, roles JSON NOT NULL, phone VARCHAR(10) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58DDEFF2BE FOREIGN KEY (marketer_id) REFERENCES marketer (id)');
        $this->addSql('ALTER TABLE adopting ADD CONSTRAINT FK_8D193F4CBF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE demand ADD CONSTRAINT FK_428D7973237433E5 FOREIGN KEY (adopting_id) REFERENCES adopting (id)');
        $this->addSql('ALTER TABLE demand ADD CONSTRAINT FK_428D79734F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE demand_dog ADD CONSTRAINT FK_F812BA905D022E59 FOREIGN KEY (demand_id) REFERENCES demand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demand_dog ADD CONSTRAINT FK_F812BA90634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE dog_race ADD CONSTRAINT FK_18E44E6F634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog_race ADD CONSTRAINT FK_18E44E6F6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marketer ADD CONSTRAINT FK_52848F8B96F6252F FOREIGN KEY (type_marketer_id) REFERENCES type_marketer (id)');
        $this->addSql('ALTER TABLE marketer ADD CONSTRAINT FK_52848F8BBF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5D022E59 FOREIGN KEY (demand_id) REFERENCES demand (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4E79C50C FOREIGN KEY (type_message_id) REFERENCES type_message (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demand DROP FOREIGN KEY FK_428D79734F34D596');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D4F34D596');
        $this->addSql('ALTER TABLE demand DROP FOREIGN KEY FK_428D7973237433E5');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE demand_dog DROP FOREIGN KEY FK_F812BA905D022E59');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5D022E59');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('ALTER TABLE demand_dog DROP FOREIGN KEY FK_F812BA90634DFEB');
        $this->addSql('ALTER TABLE dog_race DROP FOREIGN KEY FK_18E44E6F634DFEB');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89634DFEB');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58DDEFF2BE');
        $this->addSql('ALTER TABLE dog_race DROP FOREIGN KEY FK_18E44E6F6E59D40D');
        $this->addSql('ALTER TABLE marketer DROP FOREIGN KEY FK_52848F8B96F6252F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4E79C50C');
        $this->addSql('ALTER TABLE adopting DROP FOREIGN KEY FK_8D193F4CBF396750');
        $this->addSql('ALTER TABLE marketer DROP FOREIGN KEY FK_52848F8BBF396750');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE adopting');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE demand');
        $this->addSql('DROP TABLE demand_dog');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE dog_race');
        $this->addSql('DROP TABLE marketer');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE type_marketer');
        $this->addSql('DROP TABLE type_message');
        $this->addSql('DROP TABLE `user`');
    }
}
