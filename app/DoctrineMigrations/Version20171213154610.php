<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171213154610 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria_scientist DROP FOREIGN KEY FK_FCF136E43397707A');
        $this->addSql('ALTER TABLE categoria_scientist DROP FOREIGN KEY FK_FCF136E4A76ED395');
        $this->addSql('ALTER TABLE categoria_scientist DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE categoria_scientist ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id), ADD periodo_categoria VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE categoria_scientist ADD CONSTRAINT FK_FCF136E43397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE categoria_scientist ADD CONSTRAINT FK_FCF136E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria_scientist MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE categoria_scientist DROP FOREIGN KEY FK_FCF136E43397707A');
        $this->addSql('ALTER TABLE categoria_scientist DROP FOREIGN KEY FK_FCF136E4A76ED395');
        $this->addSql('ALTER TABLE categoria_scientist DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE categoria_scientist DROP id, DROP periodo_categoria');
        $this->addSql('ALTER TABLE categoria_scientist ADD CONSTRAINT FK_FCF136E43397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_scientist ADD CONSTRAINT FK_FCF136E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_scientist ADD PRIMARY KEY (categoria_id, user_id)');
    }
}
