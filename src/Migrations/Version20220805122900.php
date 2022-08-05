<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add column date_created to dispatch_request.
 */
final class Version20220805122900 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Adds column date_created to dispatch_request.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_requests` ADD `date_submitted` DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `date_submitted`');
    }
}
