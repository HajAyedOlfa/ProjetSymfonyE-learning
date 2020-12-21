<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215133934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CF46CD258 ON cours (matiere_id)');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A7ECF78B0');
        $this->addSql('DROP INDEX IDX_9014574A7ECF78B0 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP cours_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF46CD258');
        $this->addSql('DROP INDEX IDX_FDCA8C9CF46CD258 ON cours');
        $this->addSql('ALTER TABLE cours DROP matiere_id');
        $this->addSql('ALTER TABLE matiere ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_9014574A7ECF78B0 ON matiere (cours_id)');
    }
}
