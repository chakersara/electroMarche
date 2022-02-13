<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111190623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE idProds idProds VARCHAR(255) NOT NULL, CHANGE currency currency VARCHAR(20) DEFAULT NULL, CHANGE isSale isSale INT DEFAULT NULL, CHANGE merchant merchant LONGTEXT NOT NULL, CHANGE sourceURLs sourceURLs LONGTEXT NOT NULL, CHANGE brand brand VARCHAR(255) NOT NULL, CHANGE categories categories VARCHAR(255) NOT NULL, CHANGE dateAdded dateAdded VARCHAR(255) DEFAULT NULL, CHANGE dateUpdated dateUpdated VARCHAR(255) DEFAULT NULL, CHANGE ean ean VARCHAR(255) DEFAULT NULL, CHANGE manufacturer manufacturer VARCHAR(255) DEFAULT NULL, CHANGE manufacturerNumber manufacturerNumber VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD user√name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product CHANGE id id BIGINT DEFAULT NULL, CHANGE idProds idProds VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE currency currency TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE isSale isSale TINYINT(1) DEFAULT NULL, CHANGE merchant merchant TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE sourceURLs sourceURLs TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE brand brand TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE categories categories TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE dateAdded dateAdded TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE dateUpdated dateUpdated TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE ean ean TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE manufacturer manufacturer TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE manufacturerNumber manufacturerNumber TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE user DROP user√name');
    }
}
