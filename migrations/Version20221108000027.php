<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108000027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE container (id INT AUTO_INCREMENT NOT NULL, container_type_id INT NOT NULL, code VARCHAR(255) NOT NULL, capacity VARCHAR(255) NOT NULL, INDEX IDX_C7A2EC1B5B3408DE (container_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE container_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observation (id INT AUTO_INCREMENT NOT NULL, plant_id INT NOT NULL, note LONGTEXT NOT NULL, severity VARCHAR(255) NOT NULL, observed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C576DBE01D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant (id INT AUTO_INCREMENT NOT NULL, seed_id INT NOT NULL, parent_id INT DEFAULT NULL, container_id INT NOT NULL, code VARCHAR(255) NOT NULL, qty_seeds_per_slot INT NOT NULL, pos_x INT NOT NULL, pos_y INT NOT NULL, planted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AB030D7264430F6A (seed_id), UNIQUE INDEX UNIQ_AB030D72727ACA70 (parent_id), INDEX IDX_AB030D72BC21F742 (container_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_feed (plant_id INT NOT NULL, feed_id INT NOT NULL, INDEX IDX_40A884B91D935652 (plant_id), INDEX IDX_40A884B951A5BC03 (feed_id), PRIMARY KEY(plant_id, feed_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed (id INT AUTO_INCREMENT NOT NULL, seed_type_id INT NOT NULL, seed_source_id INT NOT NULL, seed_brand_id INT NOT NULL, code VARCHAR(255) NOT NULL, is_organic TINYINT(1) NOT NULL, stock INT NOT NULL, acquired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', icon VARCHAR(255) NOT NULL, INDEX IDX_4487E306EBE5020A (seed_type_id), INDEX IDX_4487E3063FBFADBC (seed_source_id), INDEX IDX_4487E306CD085266 (seed_brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed_brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed_source (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed_type (id INT AUTO_INCREMENT NOT NULL, seed_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EA1EBB40EBE5020A (seed_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seed_variety (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT FK_C7A2EC1B5B3408DE FOREIGN KEY (container_type_id) REFERENCES container_type (id)');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE01D935652 FOREIGN KEY (plant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7264430F6A FOREIGN KEY (seed_id) REFERENCES seed (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72727ACA70 FOREIGN KEY (parent_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72BC21F742 FOREIGN KEY (container_id) REFERENCES container (id)');
        $this->addSql('ALTER TABLE plant_feed ADD CONSTRAINT FK_40A884B91D935652 FOREIGN KEY (plant_id) REFERENCES plant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant_feed ADD CONSTRAINT FK_40A884B951A5BC03 FOREIGN KEY (feed_id) REFERENCES feed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seed ADD CONSTRAINT FK_4487E306EBE5020A FOREIGN KEY (seed_type_id) REFERENCES seed_type (id)');
        $this->addSql('ALTER TABLE seed ADD CONSTRAINT FK_4487E3063FBFADBC FOREIGN KEY (seed_source_id) REFERENCES seed_source (id)');
        $this->addSql('ALTER TABLE seed ADD CONSTRAINT FK_4487E306CD085266 FOREIGN KEY (seed_brand_id) REFERENCES seed_brand (id)');
        $this->addSql('ALTER TABLE seed_type ADD CONSTRAINT FK_EA1EBB40EBE5020A FOREIGN KEY (seed_type_id) REFERENCES seed_variety (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1B5B3408DE');
        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE01D935652');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7264430F6A');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72727ACA70');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72BC21F742');
        $this->addSql('ALTER TABLE plant_feed DROP FOREIGN KEY FK_40A884B91D935652');
        $this->addSql('ALTER TABLE plant_feed DROP FOREIGN KEY FK_40A884B951A5BC03');
        $this->addSql('ALTER TABLE seed DROP FOREIGN KEY FK_4487E306EBE5020A');
        $this->addSql('ALTER TABLE seed DROP FOREIGN KEY FK_4487E3063FBFADBC');
        $this->addSql('ALTER TABLE seed DROP FOREIGN KEY FK_4487E306CD085266');
        $this->addSql('ALTER TABLE seed_type DROP FOREIGN KEY FK_EA1EBB40EBE5020A');
        $this->addSql('DROP TABLE container');
        $this->addSql('DROP TABLE container_type');
        $this->addSql('DROP TABLE feed');
        $this->addSql('DROP TABLE observation');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE plant_feed');
        $this->addSql('DROP TABLE seed');
        $this->addSql('DROP TABLE seed_brand');
        $this->addSql('DROP TABLE seed_source');
        $this->addSql('DROP TABLE seed_type');
        $this->addSql('DROP TABLE seed_variety');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
