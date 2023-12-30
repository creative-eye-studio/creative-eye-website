<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20230806080456.php
final class Version20230806080456 extends AbstractMigration
========
final class Version20231217155444 extends AbstractMigration
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231217155444.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230806080456.php
        $this->addSql('CREATE TABLE partenaires (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, societe VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, texte JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
========
        $this->addSql('CREATE TABLE code_weaver_files (id INT AUTO_INCREMENT NOT NULL, css_file VARCHAR(255) DEFAULT NULL, js_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231217155444.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230806080456.php
        $this->addSql('DROP TABLE partenaires');
========
        $this->addSql('DROP TABLE code_weaver_files');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231217155444.php
    }
}
