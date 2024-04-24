<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Remove "/base/people/" prefix from person_identifier fields in dispatch_requests and dispatch_request_recipients tables.
 */
final class Version20240419150000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Remove "/base/people/" prefix from person_identifier fields in dispatch_requests and dispatch_request_recipients tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE dispatch_request_recipients SET person_identifier = REPLACE(person_identifier, "/base/people/", "") WHERE person_identifier LIKE "/base/people/%"');
        $this->addSql('UPDATE dispatch_requests SET person_identifier = REPLACE(person_identifier, "/base/people/", "") WHERE person_identifier LIKE "/base/people/%"');
    }

    public function down(Schema $schema): void
    {
        // This migration is not reversible.
    }
}
