<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Do status refactoring and add name to request.
 */
final class Version20221115130000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Do status refactoring and add name to request.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD dual_delivery_id VARCHAR(50) NULL DEFAULT NULL');

        $this->addSql('DROP TABLE dispatch_request_status_changes');
        $this->addSql('CREATE TABLE dispatch_delivery_status_changes (identifier VARCHAR(50) NOT NULL, dispatch_request_recipient_identifier VARCHAR(50) NOT NULL, date_created DATETIME NOT NULL, status_type INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispatch_delivery_status_changes ADD FOREIGN KEY (dispatch_request_recipient_identifier) REFERENCES dispatch_request_recipients(identifier) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->addSql('ALTER TABLE dispatch_requests ADD name VARCHAR(255) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests DROP name');
        $this->addSql('DROP TABLE dispatch_delivery_status_changes');
        $this->addSql('ALTER TABLE dispatch_request_recipients DROP dual_delivery_id');
    }
}
