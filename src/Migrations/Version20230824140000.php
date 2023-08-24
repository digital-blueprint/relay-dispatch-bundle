<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add file_storage_system and file_storage_identifier to dispatch_delivery_status_changes.
 */
final class Version20230824140000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add file_storage_system and file_storage_identifier to dispatch_delivery_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD file_storage_system VARCHAR(100) NULL DEFAULT "database"');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD file_storage_identifier VARCHAR(1000) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_storage_system');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_storage_identifier');
    }
}
