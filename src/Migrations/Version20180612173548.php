<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180612173548 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE0A0BBAE0E');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DA76ED395');
        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE0A76ED395');
        $this->addSql('CREATE TABLE nao_application (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, experience LONGTEXT NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_C1FC9615A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_observ (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, bird VARCHAR(1) NOT NULL, statut INT NOT NULL, description LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3243B27DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, `order` VARCHAR(255) NOT NULL, family VARCHAR(255) NOT NULL, cd_nom INT NOT NULL, lb_nom VARCHAR(255) NOT NULL, nom_vern VARCHAR(255) NOT NULL, habitat INT NOT NULL, statut VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', usr_lastname VARCHAR(100) DEFAULT NULL, usr_firstname VARCHAR(100) DEFAULT NULL, usr_birth DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_62B4C67192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_62B4C671A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_62B4C671C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nao_application ADD CONSTRAINT FK_C1FC9615A76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
        $this->addSql('DROP TABLE bird');
        $this->addSql('DROP TABLE observation');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DA76ED395');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nao_application DROP FOREIGN KEY FK_C1FC9615A76ED395');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DA76ED395');
        $this->addSql('ALTER TABLE nao_observ DROP FOREIGN KEY FK_3243B27DA76ED395');
        $this->addSql('CREATE TABLE bird (id INT AUTO_INCREMENT NOT NULL, scientific_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, vern_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observation (id INT AUTO_INCREMENT NOT NULL, bird INT DEFAULT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, statut INT NOT NULL, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, updated_at DATETIME NOT NULL, INDEX IDX_C576DBE0A0BBAE0E (bird), INDEX IDX_C576DBE0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, username_canonical VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, email_canonical VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', lastname VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, firstname VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, birth DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0A0BBAE0E FOREIGN KEY (bird) REFERENCES bird (id)');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE nao_application');
        $this->addSql('DROP TABLE nao_observ');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE nao_user');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DA76ED395');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
