<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613112633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nao_bird CHANGE regne regne VARCHAR(255) DEFAULT NULL, CHANGE phylum phylum VARCHAR(255) DEFAULT NULL, CHANGE classe classe VARCHAR(255) DEFAULT NULL, CHANGE cd_taxsup cd_taxsup INT DEFAULT NULL, CHANGE cd_ref cd_ref INT DEFAULT NULL, CHANGE rang rang VARCHAR(255) DEFAULT NULL, CHANGE lb_auteur lb_auteur VARCHAR(255) DEFAULT NULL, CHANGE nom_complet nom_complet VARCHAR(255) DEFAULT NULL, CHANGE nom_valide nom_valide VARCHAR(255) DEFAULT NULL, CHANGE nom_vern_eng nom_vern_eng VARCHAR(255) DEFAULT NULL, CHANGE gf gf VARCHAR(1) DEFAULT NULL, CHANGE mar mar VARCHAR(1) DEFAULT NULL, CHANGE gua gua VARCHAR(1) DEFAULT NULL, CHANGE sm sm VARCHAR(1) DEFAULT NULL, CHANGE sb sb VARCHAR(1) DEFAULT NULL, CHANGE spm spm VARCHAR(1) DEFAULT NULL, CHANGE may may VARCHAR(1) DEFAULT NULL, CHANGE epa epa VARCHAR(1) DEFAULT NULL, CHANGE reu reu VARCHAR(1) DEFAULT NULL, CHANGE sa sa VARCHAR(1) DEFAULT NULL, CHANGE ta ta VARCHAR(1) DEFAULT NULL, CHANGE nc nc VARCHAR(1) DEFAULT NULL, CHANGE wf wf VARCHAR(1) DEFAULT NULL, CHANGE pf pf VARCHAR(1) DEFAULT NULL, CHANGE cli cli VARCHAR(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nao_bird CHANGE regne regne VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE phylum phylum VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE classe classe VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cd_taxsup cd_taxsup INT NOT NULL, CHANGE cd_ref cd_ref INT NOT NULL, CHANGE rang rang VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE lb_auteur lb_auteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_complet nom_complet VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_valide nom_valide VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_vern_eng nom_vern_eng VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE gf gf VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mar mar VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE gua gua VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE sm sm VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE sb sb VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE spm spm VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE may may VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE epa epa VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE reu reu VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE sa sa VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE ta ta VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nc nc VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE wf wf VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pf pf VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cli cli VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
