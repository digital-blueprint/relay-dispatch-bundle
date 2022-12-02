<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add order_id to dispatch_delivery_status_changes.
 */
final class Version20221202130000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Add order_id to dispatch_delivery_status_changes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD order_id INT(11) UNIQUE NOT NULL AUTO_INCREMENT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes DROP order_id');
    }
}
