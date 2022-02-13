<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106094052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, subtitle VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, image_url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, subtitle VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, src_img LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX ix_product_index ON product');
        $this->addSql('ALTER TABLE product ADD id INT AUTO_INCREMENT NOT NULL, ADD id_prods VARCHAR(255) NOT NULL, ADD amount_max DOUBLE PRECISION DEFAULT NULL, ADD amount_min DOUBLE PRECISION DEFAULT NULL, ADD conditionp LONGTEXT DEFAULT NULL, ADD date_seen LONGTEXT DEFAULT NULL, ADD is_sale INT DEFAULT NULL, ADD source_urls LONGTEXT NOT NULL, ADD date_added VARCHAR(255) DEFAULT NULL, ADD date_updated VARCHAR(255) DEFAULT NULL, ADD image_urls LONGTEXT DEFAULT NULL, ADD keys_p LONGTEXT DEFAULT NULL, ADD manufacturer_number VARCHAR(255) DEFAULT NULL, ADD primary_categories LONGTEXT DEFAULT NULL, DROP `index`, DROP idProds, DROP amountMax, DROP amountMin, DROP `condition`, DROP dateSeen, DROP isSale, DROP sourceURLs, DROP dateAdded, DROP dateUpdated, DROP imageURLs, DROP `keys`, DROP manufacturerNumber, DROP primaryCategories, CHANGE currency currency VARCHAR(20) DEFAULT NULL, CHANGE merchant merchant LONGTEXT NOT NULL, CHANGE brand brand VARCHAR(255) NOT NULL, CHANGE categories categories VARCHAR(255) NOT NULL, CHANGE ean ean VARCHAR(255) DEFAULT NULL, CHANGE manufacturer manufacturer VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE posts');
        $this->addSql('ALTER TABLE product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product ADD `index` BIGINT DEFAULT NULL, ADD idProds TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD amountMax DOUBLE PRECISION DEFAULT NULL, ADD amountMin DOUBLE PRECISION DEFAULT NULL, ADD `condition` TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD dateSeen TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD isSale TINYINT(1) DEFAULT NULL, ADD sourceURLs TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD dateAdded TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD dateUpdated TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD imageURLs TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD `keys` TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD manufacturerNumber TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD primaryCategories TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, DROP id, DROP id_prods, DROP amount_max, DROP amount_min, DROP conditionp, DROP date_seen, DROP is_sale, DROP source_urls, DROP date_added, DROP date_updated, DROP image_urls, DROP keys_p, DROP manufacturer_number, DROP primary_categories, CHANGE currency currency TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE merchant merchant TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE brand brand TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE categories categories TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE ean ean TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE manufacturer manufacturer TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('CREATE INDEX ix_product_index ON product (`index`)');
    }
}
