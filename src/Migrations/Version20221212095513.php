<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

final class Version20221212095513 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add a group column to dispatch_requests';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests ADD `group_id` VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests DROP `group_id`');
    }
}
