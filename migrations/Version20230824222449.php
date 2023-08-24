<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824222449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, thematique_id INT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, publish_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edit_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content JSON DEFAULT NULL, INDEX IDX_5A8A6C8D476556AF (thematique_id), INDEX IDX_5A8A6C8DC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_sousthematique (post_id INT NOT NULL, sousthematique_id INT NOT NULL, INDEX IDX_E8BAAF9A4B89032C (post_id), INDEX IDX_E8BAAF9AA2AE6C63 (sousthematique_id), PRIMARY KEY(post_id, sousthematique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sousthematique (id INT AUTO_INCREMENT NOT NULL, sous_theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thematique (id INT AUTO_INCREMENT NOT NULL, theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D476556AF FOREIGN KEY (thematique_id) REFERENCES thematique (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE post_sousthematique ADD CONSTRAINT FK_E8BAAF9A4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_sousthematique ADD CONSTRAINT FK_E8BAAF9AA2AE6C63 FOREIGN KEY (sousthematique_id) REFERENCES sousthematique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D476556AF');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DC54C8C93');
        $this->addSql('ALTER TABLE post_sousthematique DROP FOREIGN KEY FK_E8BAAF9A4B89032C');
        $this->addSql('ALTER TABLE post_sousthematique DROP FOREIGN KEY FK_E8BAAF9AA2AE6C63');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_sousthematique');
        $this->addSql('DROP TABLE sousthematique');
        $this->addSql('DROP TABLE thematique');
        $this->addSql('DROP TABLE type');
    }
}
