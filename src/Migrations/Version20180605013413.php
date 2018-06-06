<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180605013413 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE observation CHANGE bird bird VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE observation RENAME INDEX idx_3243b27da76ed395 TO IDX_C576DBE0A76ED395');
        $this->addSql('ALTER TABLE user ADD lastname VARCHAR(100) DEFAULT NULL, ADD firstname VARCHAR(100) DEFAULT NULL, DROP usr_lastname, DROP usr_firstname, CHANGE usr_birth birth DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_62b4c67192fc23a8 TO UNIQ_8D93D64992FC23A8');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_62b4c671a0d96fbf TO UNIQ_8D93D649A0D96FBF');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_62b4c671c05fb297 TO UNIQ_8D93D649C05FB297');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE observation CHANGE bird bird VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE observation RENAME INDEX idx_c576dbe0a76ed395 TO IDX_3243B27DA76ED395');
        $this->addSql('ALTER TABLE user ADD usr_lastname VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD usr_firstname VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP lastname, DROP firstname, CHANGE birth usr_birth DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d64992fc23a8 TO UNIQ_62B4C67192FC23A8');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649a0d96fbf TO UNIQ_62B4C671A0D96FBF');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649c05fb297 TO UNIQ_62B4C671C05FB297');
    }
}
