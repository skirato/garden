<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108142758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seed_type DROP FOREIGN KEY FK_EA1EBB40EBE5020A');
        $this->addSql('DROP INDEX IDX_EA1EBB40EBE5020A ON seed_type');
        $this->addSql('ALTER TABLE seed_type CHANGE seed_type_id seed_variety_id INT NOT NULL');
        $this->addSql('ALTER TABLE seed_type ADD CONSTRAINT FK_EA1EBB40800A919F FOREIGN KEY (seed_variety_id) REFERENCES seed_variety (id)');
        $this->addSql('CREATE INDEX IDX_EA1EBB40800A919F ON seed_type (seed_variety_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seed_type DROP FOREIGN KEY FK_EA1EBB40800A919F');
        $this->addSql('DROP INDEX IDX_EA1EBB40800A919F ON seed_type');
        $this->addSql('ALTER TABLE seed_type CHANGE seed_variety_id seed_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE seed_type ADD CONSTRAINT FK_EA1EBB40EBE5020A FOREIGN KEY (seed_type_id) REFERENCES seed_variety (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EA1EBB40EBE5020A ON seed_type (seed_type_id)');
    }
}
