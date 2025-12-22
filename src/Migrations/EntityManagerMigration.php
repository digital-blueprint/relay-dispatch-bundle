<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Migrations;

use Dbp\Relay\CoreBundle\Doctrine\AbstractEntityManagerMigration;

abstract class EntityManagerMigration extends AbstractEntityManagerMigration
{
    private const EM_NAME = 'dbp_relay_dispatch_bundle';

    protected function getEntityManagerId(): string
    {
        return self::EM_NAME;
    }
}
