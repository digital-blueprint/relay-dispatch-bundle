<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add DateTime.
 */
final class Version20221012130000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add DateTime.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD birth_date DATE NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP birth_date');
    }
}
