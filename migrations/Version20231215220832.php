<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20230805213405.php
final class Version20230805213405 extends AbstractMigration
========
final class Version20231215220832 extends AbstractMigration
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231215220832.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805213405.php
        $this->addSql('ALTER TABLE ext_services ADD thumb VARCHAR(255) NOT NULL');
========
        $this->addSql('ALTER TABLE comments ADD pseudo VARCHAR(255) NOT NULL');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231215220832.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805213405.php
        $this->addSql('ALTER TABLE ext_services DROP thumb');
========
        $this->addSql('ALTER TABLE comments DROP pseudo');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231215220832.php
    }
}
