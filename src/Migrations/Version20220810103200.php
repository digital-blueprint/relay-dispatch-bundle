<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Add DELETE and UPDATE cascades.
 */
final class Version20220810103200 extends EntityManagerMigration
{
    public function getDescription(): string
    {
        return 'Adds DELETE and UPDATE cascades.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_files DROP FOREIGN KEY dispatch_request_files_ibfk_1');
        $this->addSql('ALTER TABLE dispatch_request_files ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->addSql('ALTER TABLE dispatch_request_recipients DROP FOREIGN KEY dispatch_request_recipients_ibfk_1');
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->addSql('ALTER TABLE dispatch_request_status_changes DROP KEY IDX_83F6E7C899F83637');
        $this->addSql('ALTER TABLE dispatch_request_status_changes ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dispatch_request_files DROP FOREIGN KEY dispatch_request_files_ibfk_1');
        $this->addSql('ALTER TABLE dispatch_request_files ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier)');

        $this->addSql('ALTER TABLE dispatch_request_recipients DROP FOREIGN KEY dispatch_request_recipients_ibfk_1');
        $this->addSql('ALTER TABLE dispatch_request_recipients ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier)');

        $this->addSql('ALTER TABLE dispatch_request_status_changes DROP FOREIGN KEY dispatch_request_status_changes_ibfk_1');
        $this->addSql('ALTER TABLE dispatch_request_status_changes ADD FOREIGN KEY (dispatch_request_identifier) REFERENCES dispatch_requests(identifier)');
    }
}
