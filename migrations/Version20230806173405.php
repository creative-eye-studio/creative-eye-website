<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230806173405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ext_realisations DROP FOREIGN KEY FK_3CC652F715718F3F');
        $this->addSql('ALTER TABLE ext_realisations DROP FOREIGN KEY FK_3CC652F7AEF5A6C1');
        $this->addSql('DROP TABLE ext_realisations');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ext_realisations (id INT AUTO_INCREMENT NOT NULL, services_id INT DEFAULT NULL, collab_id INT DEFAULT NULL, nom_projet JSON NOT NULL, main_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, intro JSON NOT NULL, annee VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, video_link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, demande JSON NOT NULL, approche JSON NOT NULL, images JSON DEFAULT NULL, INDEX IDX_3CC652F7AEF5A6C1 (services_id), INDEX IDX_3CC652F715718F3F (collab_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ext_realisations ADD CONSTRAINT FK_3CC652F715718F3F FOREIGN KEY (collab_id) REFERENCES ext_partenaires (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ext_realisations ADD CONSTRAINT FK_3CC652F7AEF5A6C1 FOREIGN KEY (services_id) REFERENCES ext_services (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
