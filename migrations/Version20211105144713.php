<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211105144713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, id_prods VARCHAR(255) NOT NULL, amount_max DOUBLE PRECISION DEFAULT NULL, amount_min DOUBLE PRECISION DEFAULT NULL, availability LONGTEXT DEFAULT NULL, conditionp LONGTEXT DEFAULT NULL, currency VARCHAR(20) DEFAULT NULL, date_seen LONGTEXT DEFAULT NULL, is_sale INT DEFAULT NULL, merchant LONGTEXT NOT NULL, shipping LONGTEXT DEFAULT NULL, source_urls LONGTEXT NOT NULL, asins LONGTEXT DEFAULT NULL, brand VARCHAR(255) NOT NULL, categories VARCHAR(255) NOT NULL, date_added VARCHAR(255) DEFAULT NULL, date_updated VARCHAR(255) DEFAULT NULL, ean VARCHAR(255) DEFAULT NULL, image_urls LONGTEXT DEFAULT NULL, keys_p LONGTEXT DEFAULT NULL, manufacturer VARCHAR(255) DEFAULT NULL, manufacturer_number VARCHAR(255) DEFAULT NULL, name LONGTEXT DEFAULT NULL, primary_categories LONGTEXT DEFAULT NULL, upc LONGTEXT DEFAULT NULL, weight LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
    }
}
