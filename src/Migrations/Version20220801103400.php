<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Create table dispatch_request_files.
 */
final class Version20220801103400 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Creates table dispatch_request_files.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dispatch_request_files (identifier VARCHAR(50) NOT NULL, date_created DATETIME NOT NULL, dispatch_request_identifier VARCHAR(50) DEFAULT NULL, name VARCHAR(255) NOT NULL, data BLOB NOT NULL, size int, PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispatch_request_files ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX dispatch_request_identifier ON dispatch_request_files');
        $this->addSql('DROP TABLE dispatch_request_files');
    }
}
