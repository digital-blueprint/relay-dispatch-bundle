<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add dispatch_request_recipients to dispatch_request_recipients.
 */
final class Version20221125100000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add dispatch_request_recipients to dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD delivery_end_date DATETIME NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP delivery_end_date');
    }
}
