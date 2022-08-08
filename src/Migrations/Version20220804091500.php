<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Rename table dispatch_request_statuses to dispatch_request_status_changes.
 */
final class Version20220804091500 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Renames table dispatch_request_statuses to dispatch_request_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_statuses RENAME dispatch_request_status_changes;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_status_changes RENAME dispatch_request_statuses;');
    }
}
