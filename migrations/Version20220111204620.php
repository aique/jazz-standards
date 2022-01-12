<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111204620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jazz_standard (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, authors LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', genres LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', form VARCHAR(55) NOT NULL, interpreter VARCHAR(255) NOT NULL, tempo SMALLINT NOT NULL, track VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tempo_range (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start SMALLINT NOT NULL, end SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE jazz_standard');
        $this->addSql('DROP TABLE tempo_range');
    }
}
