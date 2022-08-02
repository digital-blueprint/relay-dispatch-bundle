<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Update table dispatch_request_files.
 */
final class Version20220802112700 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Updates table dispatch_request_files.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_files` CHANGE `data` `data` LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE `dispatch_request_files` ADD `file_format` VARCHAR(100) NOT NULL AFTER `data`');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_files` DROP `file_format`');
        $this->addSql('ALTER TABLE `dispatch_request_files` CHANGE `data` `data` BLOB NOT NULL');
    }
}
