<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add app_delivery_id to dispatch_request_recipients.
 */
final class Version20221214100000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add app_delivery_id to dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD app_delivery_id VARCHAR(100) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP app_delivery_id');
    }
}
