<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20230805193046.php
final class Version20230805193046 extends AbstractMigration
========
final class Version20231216094737 extends AbstractMigration
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094737.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805193046.php
        $this->addSql('ALTER TABLE ext_services ADD intro JSON NOT NULL');
========
        $this->addSql('ALTER TABLE code_weave ADD nom VARCHAR(255) NOT NULL');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094737.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<<< HEAD:migrations/Version20230805193046.php
        $this->addSql('ALTER TABLE ext_services DROP intro');
========
        $this->addSql('ALTER TABLE code_weave DROP nom');
>>>>>>>> c6c34fbe74d719e64a492859dd80cd42029b1cbd:migrations/Version20231216094737.php
    }
}
