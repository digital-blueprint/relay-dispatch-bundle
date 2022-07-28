<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Create table dispatch_request_recipients.
 */
final class Version20220727105201 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Creates table dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dispatch_request_recipients (identifier VARCHAR(50) NOT NULL, date_created DATETIME NOT NULL, dispatch_request_identifier VARCHAR(50) NOT NULL, recipient_id VARCHAR(50) NOT NULL, given_name VARCHAR(255) NOT NULL, family_name VARCHAR(255) NOT NULL, postal_address VARCHAR(255) NOT NULL, PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE dispatch_request_recipients');
    }
}
