<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Adds and removes address columns from dispatch_request and dispatch_request_recipients.
 */
final class Version20220808160200 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Adds and removes address columns from dispatch_request and dispatch_request_recipients.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_postal_address`');
        $this->addSql('ALTER TABLE dispatch_requests
            ADD sender_address_country VARCHAR(2) NOT NULL,
            ADD sender_postal_code VARCHAR(20) NOT NULL,
            ADD sender_address_locality VARCHAR(120) NOT NULL,
            ADD sender_street_address VARCHAR(120) NOT NULL,
            ADD sender_building_number VARCHAR(10) NOT NULL');

        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `postal_address`');
        $this->addSql('ALTER TABLE dispatch_request_recipients
            ADD address_country VARCHAR(2) NOT NULL,
            ADD postal_code VARCHAR(20) NOT NULL,
            ADD address_locality VARCHAR(120) NOT NULL,
            ADD street_address VARCHAR(120) NOT NULL,
            ADD building_number VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_address_country`');
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_postal_code`');
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_address_locality`');
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_street_address`');
        $this->addSql('ALTER TABLE `dispatch_requests` DROP `sender_building_number`');
        $this->addSql('ALTER TABLE `dispatch_requests` ADD `sender_postal_address` VARCHAR(255) NOT NULL');

        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `address_country`');
        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `postal_code`');
        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `address_locality`');
        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `street_address`');
        $this->addSql('ALTER TABLE `dispatch_request_recipients` DROP `building_number`');
        $this->addSql('ALTER TABLE `dispatch_request_recipients` ADD `postal_address` VARCHAR(255) NOT NULL');
    }
}
