<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180621104507 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nao_observ (id INT AUTO_INCREMENT NOT NULL, bird INT DEFAULT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, statut INT NOT NULL, description LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3243B27DA0BBAE0E (bird), INDEX IDX_3243B27DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA0BBAE0E FOREIGN KEY (bird) REFERENCES nao_bird (id)');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nao_observ');
    }
}
