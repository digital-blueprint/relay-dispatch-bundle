<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Create table dispatch_requests.
 */
final class Version20220721105026 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Creates table dispatch_requests.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dispatch_requests (identifier VARCHAR(50) NOT NULL, date_created DATETIME NOT NULL, person_identifier VARCHAR(100) NOT NULL, sender_given_name VARCHAR(255) NOT NULL, sender_family_name VARCHAR(255) NOT NULL, sender_postal_address VARCHAR(255) NOT NULL, PRIMARY KEY(identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE dispatch_requests');
    }
}
