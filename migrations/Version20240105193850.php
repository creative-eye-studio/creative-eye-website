<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105193850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ext_realisations (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, intro JSON NOT NULL, annee SMALLINT NOT NULL, youtube VARCHAR(255) DEFAULT NULL, demande JSON NOT NULL, approche JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_realisations_ext_services (ext_realisations_id INT NOT NULL, ext_services_id INT NOT NULL, INDEX IDX_1DB986F02C40F80A (ext_realisations_id), INDEX IDX_1DB986F08E8C91BE (ext_services_id), PRIMARY KEY(ext_realisations_id, ext_services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_realisations_ext_partenaires (ext_realisations_id INT NOT NULL, ext_partenaires_id INT NOT NULL, INDEX IDX_702434F72C40F80A (ext_realisations_id), INDEX IDX_702434F7DEFACA14 (ext_partenaires_id), PRIMARY KEY(ext_realisations_id, ext_partenaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_realisations_images (id INT AUTO_INCREMENT NOT NULL, ext_realisations_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_251BAE202C40F80A (ext_realisations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ext_realisations_ext_services ADD CONSTRAINT FK_1DB986F02C40F80A FOREIGN KEY (ext_realisations_id) REFERENCES ext_realisations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ext_realisations_ext_services ADD CONSTRAINT FK_1DB986F08E8C91BE FOREIGN KEY (ext_services_id) REFERENCES ext_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ext_realisations_ext_partenaires ADD CONSTRAINT FK_702434F72C40F80A FOREIGN KEY (ext_realisations_id) REFERENCES ext_realisations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ext_realisations_ext_partenaires ADD CONSTRAINT FK_702434F7DEFACA14 FOREIGN KEY (ext_partenaires_id) REFERENCES ext_partenaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ext_realisations_images ADD CONSTRAINT FK_251BAE202C40F80A FOREIGN KEY (ext_realisations_id) REFERENCES ext_realisations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ext_realisations_ext_services DROP FOREIGN KEY FK_1DB986F02C40F80A');
        $this->addSql('ALTER TABLE ext_realisations_ext_services DROP FOREIGN KEY FK_1DB986F08E8C91BE');
        $this->addSql('ALTER TABLE ext_realisations_ext_partenaires DROP FOREIGN KEY FK_702434F72C40F80A');
        $this->addSql('ALTER TABLE ext_realisations_ext_partenaires DROP FOREIGN KEY FK_702434F7DEFACA14');
        $this->addSql('ALTER TABLE ext_realisations_images DROP FOREIGN KEY FK_251BAE202C40F80A');
        $this->addSql('DROP TABLE ext_realisations');
        $this->addSql('DROP TABLE ext_realisations_ext_services');
        $this->addSql('DROP TABLE ext_realisations_ext_partenaires');
        $this->addSql('DROP TABLE ext_realisations_images');
    }
}
