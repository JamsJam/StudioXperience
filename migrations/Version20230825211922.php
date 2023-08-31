<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825211922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD poster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D5BB66C05 FOREIGN KEY (poster_id) REFERENCES mediatheque (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D5BB66C05 ON post (poster_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D5BB66C05');
        $this->addSql('DROP INDEX IDX_5A8A6C8D5BB66C05 ON post');
        $this->addSql('ALTER TABLE post DROP poster_id');
    }
}
