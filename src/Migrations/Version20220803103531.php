<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Create table dispatch_request_statuses.
 */
final class Version20220803103531 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Creates table dispatch_request_statuses.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dispatch_request_statuses (identifier VARCHAR(50) NOT NULL, dispatch_request_identifier VARCHAR(50) NOT NULL, date_created DATETIME NOT NULL, status_type INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_83F6E7C899F83637 (dispatch_request_identifier), PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispatch_request_statuses ADD CONSTRAINT FK_83F6E7C899F83637 FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests (identifier)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE dispatch_request_statuses');
    }
}
