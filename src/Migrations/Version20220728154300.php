<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Create table dispatch_requests.
 */
final class Version20220728154300 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Creates table dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX dispatch_request_identifier ON dispatch_request_recipients');
    }
}
