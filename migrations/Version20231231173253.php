<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231231173253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ext_services ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ext_services ADD CONSTRAINT FK_CB9CFB84BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_CB9CFB84BCF5E72D ON ext_services (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ext_services DROP FOREIGN KEY FK_CB9CFB84BCF5E72D');
        $this->addSql('DROP INDEX IDX_CB9CFB84BCF5E72D ON ext_services');
        $this->addSql('ALTER TABLE ext_services DROP categorie_id');
    }
}
