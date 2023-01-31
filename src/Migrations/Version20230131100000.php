<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Rename sender_given_name and sender_family_name in dispatch_requests.
 */
final class Version20230131100000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Rename sender_given_name and sender_family_name in dispatch_requests.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests CHANGE sender_given_name sender_full_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests CHANGE sender_family_name sender_organization_name VARCHAR(255) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests CHANGE sender_full_name sender_given_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests CHANGE sender_organization_name sender_family_name VARCHAR(255) NULL DEFAULT NULL');
    }
}
