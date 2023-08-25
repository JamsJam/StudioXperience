<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825161938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mediatheque (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, path_type_id INT NOT NULL, title VARCHAR(255) NOT NULL, alternate VARCHAR(255) NOT NULL, path LONGTEXT NOT NULL, legend VARCHAR(255) DEFAULT NULL, chapitres JSON DEFAULT NULL, INDEX IDX_2B49E7E7C54C8C93 (type_id), INDEX IDX_2B49E7E72FABABA (path_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mediatheque ADD CONSTRAINT FK_2B49E7E7C54C8C93 FOREIGN KEY (type_id) REFERENCES media_type (id)');
        $this->addSql('ALTER TABLE mediatheque ADD CONSTRAINT FK_2B49E7E72FABABA FOREIGN KEY (path_type_id) REFERENCES path_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mediatheque DROP FOREIGN KEY FK_2B49E7E7C54C8C93');
        $this->addSql('ALTER TABLE mediatheque DROP FOREIGN KEY FK_2B49E7E72FABABA');
        $this->addSql('DROP TABLE media_type');
        $this->addSql('DROP TABLE mediatheque');
        $this->addSql('DROP TABLE path_type');
    }
}
