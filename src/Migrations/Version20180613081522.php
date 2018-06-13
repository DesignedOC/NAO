<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613081522 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nao_bird (id INT AUTO_INCREMENT NOT NULL, regne VARCHAR(255) NOT NULL, phylum VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, ordre VARCHAR(255) NOT NULL, famille VARCHAR(255) NOT NULL, cd_nom INT NOT NULL, cd_taxsup INT NOT NULL, cd_ref INT NOT NULL, rang VARCHAR(255) NOT NULL, lb_nom VARCHAR(255) NOT NULL, lb_auteur VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, nom_valide VARCHAR(255) NOT NULL, nom_vern VARCHAR(255) NOT NULL, nom_vern_eng VARCHAR(255) NOT NULL, habitat SMALLINT NOT NULL, fr VARCHAR(1) NOT NULL, gf VARCHAR(1) NOT NULL, mar VARCHAR(1) NOT NULL, gua VARCHAR(1) NOT NULL, sm VARCHAR(1) NOT NULL, sb VARCHAR(1) NOT NULL, spm VARCHAR(1) NOT NULL, may VARCHAR(1) NOT NULL, epa VARCHAR(1) NOT NULL, reu VARCHAR(1) NOT NULL, sa VARCHAR(1) NOT NULL, ta VARCHAR(1) NOT NULL, nc VARCHAR(1) NOT NULL, wf VARCHAR(1) NOT NULL, pf VARCHAR(1) NOT NULL, cli VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nao_bird');
    }
}
