<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add file data to dispatch_delivery_status_changes.
 */
final class Version20221213090000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add file data to dispatch_delivery_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` ADD `file_data` LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` ADD `file_format` VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_format');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP file_data');
    }
}
