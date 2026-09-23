<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use Dbp\Relay\BasePersonBundle\DbpRelayBasePersonBundle;
use Dbp\Relay\CoreBundle\TestUtils\CoreTestKernelTrait;
use Dbp\Relay\DispatchBundle\DbpRelayDispatchBundle;
use Dbp\Relay\DispatchBundle\DependencyInjection\DbpRelayDispatchExtension;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use CoreTestKernelTrait;

    protected function registerAdditionalBundles(): iterable
    {
        yield new DoctrineBundle();
        yield new DoctrineMigrationsBundle();
        yield new DbpRelayBasePersonBundle();
        yield new DbpRelayDispatchBundle();
    }

    protected function configureAdditionalContainer(ContainerConfigurator $container): void
    {
        $container->extension('dbp_relay_core', [
            'queue_dsn' => 'doctrine://'.DbpRelayDispatchExtension::DISPATCH_DB_CONNECTION_ID,
        ]);

        $container->extension('dbp_relay_dispatch', self::getTestConfig());
    }

    public static function getTestConfig(): array
    {
        return [
            'database_url' => 'sqlite:///:memory:',
            'service_url' => 'https:/foo.bar',
            'sender_profile' => 'foobar',
            'sender_profile_version' => '42.42',
            'authorization' => [
                'roles' => [
                    'ROLE_USER' => 'true',
                ],
                'resource_permissions' => [
                    'ROLE_GROUP_READER_METADATA' => 'resource.getIdentifier() in user.get("READ_METADATA_GROUPS", [])',
                    'ROLE_GROUP_READER_CONTENT' => 'resource.getIdentifier() in user.get("READ_CONTENT_GROUPS", [])',
                    'ROLE_GROUP_WRITER' => 'resource.getIdentifier() in user.get("WRITE_GROUPS", [])',
                    'ROLE_GROUP_WRITER_READ_ADDRESS' => 'resource.getIdentifier() in user.get("WRITE_READ_ADDRESS_GROUPS", [])',
                ],
                'attributes' => [
                    'GROUPS' => '["1", "2", "3", "4"]',
                ],
            ],
        ];
    }
}
