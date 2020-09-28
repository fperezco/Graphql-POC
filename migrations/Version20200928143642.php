<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200928143642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, dealer_id INT DEFAULT NULL, category_id INT NOT NULL, engine VARCHAR(255) NOT NULL, wheels INT NOT NULL, model VARCHAR(255) NOT NULL, INDEX IDX_773DE69D249E6EA1 (dealer_id), INDEX IDX_773DE69D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dealer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D249E6EA1 FOREIGN KEY (dealer_id) REFERENCES dealer (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D12469DE2 FOREIGN KEY (category_id) REFERENCES car_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D12469DE2');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D249E6EA1');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_category');
        $this->addSql('DROP TABLE dealer');
    }
}
