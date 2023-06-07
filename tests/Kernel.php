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
use Symfony\Component\Routing\RouteCollectionBuilder;

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

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import('@DbpRelayCoreBundle/Resources/config/routing.yaml');
    }

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader)
    {
        $container->import('@DbpRelayCoreBundle/Resources/config/services_test.yaml');
        $container->extension('framework', [
            'test' => true,
            'secret' => '',
        ]);

        $container->extension('dbp_relay_dispatch', [
            'database_url' => 'mysql://dummy:dummy@dummy',
            'service_url' => 'https:/foo.bar',
            'sender_profile' => 'foobar',
            'sender_profile_version' => '42.42',
        ]);

        $container->extension('api_platform', [
            'metadata_backward_compatibility_layer' => false,
        ]);
    }
}
