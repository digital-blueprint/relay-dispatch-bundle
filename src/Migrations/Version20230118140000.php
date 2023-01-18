<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Allow NULL for most of the columns in dispatch_request_recipients.
 */
final class Version20230118140000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Allow NULL for most of the columns in dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY given_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY family_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY address_country VARCHAR(2) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY postal_code VARCHAR(20) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY address_locality VARCHAR(120) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY street_address VARCHAR(120) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY building_number VARCHAR(10) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY given_name VARCHAR(255) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY family_name VARCHAR(255) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY address_country VARCHAR(2) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY postal_code VARCHAR(20) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY address_locality VARCHAR(120) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY street_address VARCHAR(120) NULL');
        $this->addSql('ALTER TABLE dispatch_request_recipients MODIFY building_number VARCHAR(10) NULL');
    }
}
