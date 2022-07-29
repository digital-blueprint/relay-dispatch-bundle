<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Change default null for dispatch_request_identifier in table dispatch_request_recipients.
 */
final class Version20220729140000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Changes default null for dispatch_request_identifier in table dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_recipients` CHANGE `dispatch_request_identifier` `dispatch_request_identifier` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_recipients` CHANGE `dispatch_request_identifier` `dispatch_request_identifier` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL NOT NULL');
    }
}
