<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230806072837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_link ADD ext_service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_link ADD CONSTRAINT FK_FEE369BFFBEE6593 FOREIGN KEY (ext_service_id) REFERENCES ext_services (id)');
        $this->addSql('CREATE INDEX IDX_FEE369BFFBEE6593 ON menu_link (ext_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_link DROP FOREIGN KEY FK_FEE369BFFBEE6593');
        $this->addSql('DROP INDEX IDX_FEE369BFFBEE6593 ON menu_link');
        $this->addSql('ALTER TABLE menu_link DROP ext_service_id');
    }
}
