<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231231175823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts_list_categories (posts_list_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_659A505992CE0FE0 (posts_list_id), INDEX IDX_659A5059A21214B7 (categories_id), PRIMARY KEY(posts_list_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts_list_categories ADD CONSTRAINT FK_659A505992CE0FE0 FOREIGN KEY (posts_list_id) REFERENCES posts_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts_list_categories ADD CONSTRAINT FK_659A5059A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts_list DROP categories');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts_list_categories DROP FOREIGN KEY FK_659A505992CE0FE0');
        $this->addSql('ALTER TABLE posts_list_categories DROP FOREIGN KEY FK_659A5059A21214B7');
        $this->addSql('DROP TABLE posts_list_categories');
        $this->addSql('ALTER TABLE posts_list ADD categories JSON DEFAULT NULL');
    }
}
