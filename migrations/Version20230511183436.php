<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511183436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_categorie (post_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_E813A8C34B89032C (post_id), INDEX IDX_E813A8C3BCF5E72D (categorie_id), PRIMARY KEY(post_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_categorie ADD CONSTRAINT FK_E813A8C34B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_categorie ADD CONSTRAINT FK_E813A8C3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD format_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DD629F605 ON post (format_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_categorie DROP FOREIGN KEY FK_E813A8C34B89032C');
        $this->addSql('ALTER TABLE post_categorie DROP FOREIGN KEY FK_E813A8C3BCF5E72D');
        $this->addSql('DROP TABLE post_categorie');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DD629F605');
        $this->addSql('DROP INDEX IDX_5A8A6C8DD629F605 ON post');
        $this->addSql('ALTER TABLE post DROP format_id');
    }
}
