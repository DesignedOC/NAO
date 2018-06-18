<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180618133240 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nao_bird (cd_nom INT NOT NULL, regne VARCHAR(255) DEFAULT NULL, phylum VARCHAR(255) DEFAULT NULL, classe VARCHAR(255) DEFAULT NULL, ordre VARCHAR(255) NOT NULL, famille VARCHAR(255) NOT NULL, cd_taxsup INT DEFAULT NULL, cd_ref INT DEFAULT NULL, rang VARCHAR(255) DEFAULT NULL, lb_nom VARCHAR(255) NOT NULL, lb_auteur VARCHAR(255) DEFAULT NULL, nom_complet VARCHAR(255) DEFAULT NULL, nom_valide VARCHAR(255) DEFAULT NULL, nom_vern VARCHAR(255) NOT NULL, nom_vern_eng VARCHAR(255) DEFAULT NULL, habitat SMALLINT NOT NULL, fr VARCHAR(1) NOT NULL, gf VARCHAR(1) DEFAULT NULL, mar VARCHAR(1) DEFAULT NULL, gua VARCHAR(1) DEFAULT NULL, sm VARCHAR(1) DEFAULT NULL, sb VARCHAR(1) DEFAULT NULL, spm VARCHAR(1) DEFAULT NULL, may VARCHAR(1) DEFAULT NULL, epa VARCHAR(1) DEFAULT NULL, reu VARCHAR(1) DEFAULT NULL, sa VARCHAR(1) DEFAULT NULL, ta VARCHAR(1) DEFAULT NULL, nc VARCHAR(1) DEFAULT NULL, wf VARCHAR(1) DEFAULT NULL, pf VARCHAR(1) DEFAULT NULL, cli VARCHAR(1) DEFAULT NULL, PRIMARY KEY(cd_nom)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nao_observ (id INT AUTO_INCREMENT NOT NULL, bird_cd_nom INT DEFAULT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, statut INT NOT NULL, description LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3243B27DF33752C9 (bird_cd_nom), INDEX IDX_3243B27DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DF33752C9 FOREIGN KEY (bird_cd_nom) REFERENCES nao_bird (cd_nom)');
        $this->addSql('ALTER TABLE nao_observ ADD CONSTRAINT FK_3243B27DA76ED395 FOREIGN KEY (user_id) REFERENCES nao_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nao_observ DROP FOREIGN KEY FK_3243B27DF33752C9');
        $this->addSql('DROP TABLE nao_bird');
        $this->addSql('DROP TABLE nao_observ');
    }
}
