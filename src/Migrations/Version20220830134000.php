<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Allow NULL.
 */
final class Version20220830134000 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Allows NULL.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_given_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_family_name VARCHAR(255) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_address_country VARCHAR(2) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_postal_code VARCHAR(20) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_address_locality VARCHAR(120) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_street_address VARCHAR(120) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_building_number VARCHAR(10) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_given_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_family_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_address_country VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_postal_code VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_address_locality VARCHAR(120) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_street_address VARCHAR(120) NOT NULL');
        $this->addSql('ALTER TABLE dispatch_requests MODIFY sender_building_number VARCHAR(10) NOT NULL');
    }
}
