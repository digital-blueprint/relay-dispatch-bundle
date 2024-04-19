<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add file_date_added, file_uploader_identifier and file_is_uploaded_manually to dispatch_delivery_status_changes.
 */
final class Version20240411150000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add file_date_added, file_uploader_identifier and file_is_uploaded_manually to dispatch_delivery_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD file_date_added DATETIME NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD file_uploader_identifier VARCHAR(100) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD file_is_uploaded_manually BOOLEAN NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_date_added');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_uploader_identifier');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_is_uploaded_manually');
    }
}
