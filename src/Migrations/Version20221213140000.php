<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Change file data in dispatch_delivery_status_changes.
 */
final class Version20221213140000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Change file data in dispatch_delivery_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` MODIFY `file_data` LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` MODIFY `file_format` VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` MODIFY `file_data` LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE `dispatch_delivery_status_changes` MODIFY `file_format` VARCHAR(100) NOT NULL');
    }
}
