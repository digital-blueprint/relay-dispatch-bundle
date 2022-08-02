<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Update table dispatch_request_files.
 */
final class Version20220802130800 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Updates table dispatch_request_files.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_files` CHANGE `size` `content_size` INT(11) NULL DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `dispatch_request_files` CHANGE `content_size` `size` INT(11) NULL DEFAULT NULL');
    }
}
