<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use ApiPlatform\Symfony\Bundle\ApiPlatformBundle;
use Dbp\Relay\BasePersonBundle\DbpRelayBasePersonBundle;
use Dbp\Relay\CoreBundle\DbpRelayCoreBundle;
use Dbp\Relay\DispatchBundle\DbpRelayDispatchBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Nelmio\CorsBundle\NelmioCorsBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new SecurityBundle();
        yield new TwigBundle();
        yield new NelmioCorsBundle();
        yield new MonologBundle();
        yield new DoctrineBundle();
        yield new DoctrineMigrationsBundle();
        yield new ApiPlatformBundle();
        yield new DbpRelayBasePersonBundle();
        yield new DbpRelayDispatchBundle();
        yield new DbpRelayCoreBundle();
    }

    protected function configureRoutes(RoutingConfigurator $routes)
    {
        $routes->import('@DbpRelayCoreBundle/Resources/config/routing.yaml');
    }

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader)
    {
        $container->import('@DbpRelayCoreBundle/Resources/config/services_test.yaml');
        $container->extension('framework', [
            'test' => true,
            'secret' => '',
            'annotations' => false,
        ]);

        $container->extension('dbp_relay_core', [
            'queue_dsn' => 'doctrine://dbp_relay_dispatch_bundle',
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
