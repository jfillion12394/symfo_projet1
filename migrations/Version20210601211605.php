<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601211605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, year INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison_program (saison_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_7121C2B2F965414C (saison_id), INDEX IDX_7121C2B23EB8070A (program_id), PRIMARY KEY(saison_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, relation VARCHAR(255) NOT NULL, number INT DEFAULT NULL, year INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, relat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE saison_program ADD CONSTRAINT FK_7121C2B2F965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_program ADD CONSTRAINT FK_7121C2B23EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE saison_program DROP FOREIGN KEY FK_7121C2B2F965414C');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE saison_program');
        $this->addSql('DROP TABLE season');
    }
}
