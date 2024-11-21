<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120205904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees ADD department_id INT NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_BA82C300AE80F5DF ON employees (department_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300AE80F5DF');
        $this->addSql('DROP INDEX IDX_BA82C300AE80F5DF ON employees');
        $this->addSql('ALTER TABLE employees DROP department_id');
    }
}
