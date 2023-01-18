<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add reference_number to dispatch_requests and person_identifier, postal_deliverable and electronically_deliverable to dispatch_request_recipients.
 */
final class Version20230118090000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add reference_number to dispatch_requests and person_identifier, postal_deliverable and electronically_deliverable to dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests ADD reference_number VARCHAR(25) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD person_identifier VARCHAR(100) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD postal_deliverable BOOLEAN NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD electronically_deliverable BOOLEAN NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests DROP reference_number');
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP person_identifier');
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP postal_deliverable');
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP electronically_deliverable');
    }
}
