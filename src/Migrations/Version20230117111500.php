<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add reference_number to dispatch_request_recipients.
 */
final class Version20230117111500 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add reference_number to dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD reference_number VARCHAR(25) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP reference_number');
    }
}
