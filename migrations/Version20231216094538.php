<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20230805185631.php
final class Version20230805185631 extends AbstractMigration
========
final class Version20231216094538 extends AbstractMigration
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094538.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805185631.php
        $this->addSql('CREATE TABLE ext_services (id INT AUTO_INCREMENT NOT NULL, titre JSON NOT NULL, sous_titre JSON NOT NULL, contenu JSON NOT NULL, services JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
========
        $this->addSql('CREATE TABLE code_weave (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, code LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094538.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805185631.php
        $this->addSql('DROP TABLE ext_services');
========
        $this->addSql('DROP TABLE code_weave');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094538.php
    }
}
