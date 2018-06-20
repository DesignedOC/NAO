<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180617161610 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nao_application (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, experience LONGTEXT NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_C1FC9615A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FEF0481DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_bird (id INT AUTO_INCREMENT NOT NULL, regne VARCHAR(255) DEFAULT NULL, phylum VARCHAR(255) DEFAULT NULL, classe VARCHAR(255) DEFAULT NULL, ordre VARCHAR(255) DEFAULT NULL, famille VARCHAR(255) DEFAULT NULL, cd_nom INT DEFAULT NULL, cd_taxsup INT DEFAULT NULL, cd_ref INT DEFAULT NULL, rang VARCHAR(255) DEFAULT NULL, lb_nom VARCHAR(255) DEFAULT NULL, lb_auteur VARCHAR(255) DEFAULT NULL, nom_complet VARCHAR(255) DEFAULT NULL, nom_valide VARCHAR(255) DEFAULT NULL, nom_vern VARCHAR(255) NOT NULL, nom_vern_eng VARCHAR(255) DEFAULT NULL, habitat SMALLINT DEFAULT NULL, fr VARCHAR(1) DEFAULT NULL, gf VARCHAR(1) DEFAULT NULL, mar VARCHAR(1) DEFAULT NULL, gua VARCHAR(1) DEFAULT NULL, sm VARCHAR(1) DEFAULT NULL, sb VARCHAR(1) DEFAULT NULL, spm VARCHAR(1) DEFAULT NULL, may VARCHAR(1) DEFAULT NULL, epa VARCHAR(1) DEFAULT NULL, reu VARCHAR(1) DEFAULT NULL, sa VARCHAR(1) DEFAULT NULL, ta VARCHAR(1) DEFAULT NULL, nc VARCHAR(1) DEFAULT NULL, wf VARCHAR(1) DEFAULT NULL, pf VARCHAR(1) DEFAULT NULL, cli VARCHAR(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_observ (id INT AUTO_INCREMENT NOT NULL, bird INT DEFAULT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, statut INT NOT NULL, description LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3243B27DA0BBAE0E (bird), INDEX IDX_3243B27DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', usr_lastname VARCHAR(100) DEFAULT NULL, usr_firstname VARCHAR(100) DEFAULT NULL, usr_birth DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_62B4C67192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_62B4C671A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_62B4C671C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nao_application ADD CONSTRAINT FK_C1FC9615A76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA0BBAE0E FOREIGN KEY (bird) REFERENCES nao_bird (id)');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nao_observ DROP FOREIGN KEY FK_3243B27DA0BBAE0E');
        $this->addSql('ALTER TABLE nao_application DROP FOREIGN KEY FK_C1FC9615A76ED395');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DA76ED395');
        $this->addSql('ALTER TABLE nao_observ DROP FOREIGN KEY FK_3243B27DA76ED395');
        $this->addSql('DROP TABLE nao_application');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE nao_bird');
        $this->addSql('DROP TABLE nao_observ');
        $this->addSql('DROP TABLE nao_user');
    }
}
