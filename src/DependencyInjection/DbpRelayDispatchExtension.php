<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Dbp\Relay\CoreBundle\Doctrine\DoctrineConfiguration;
use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use Dbp\Relay\DispatchBundle\Service\GroupService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpRelayDispatchExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    use ExtensionTrait;

    public const DISPATCH_ENTITY_MANAGER_ID = 'dbp_relay_dispatch_bundle';
    public const DISPATCH_DB_CONNECTION_ID = 'dbp_relay_dispatch_bundle';

    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $pathsToHide = [
            '/dispatch/pre-addressing-requests/{identifier}',
            '/dispatch/pre-addressing-requests',
            '/dispatch/request-recipients',
            '/dispatch/request-files',
            '/dispatch/request-status-changes',
        ];

        foreach ($pathsToHide as $path) {
            $this->addPathToHide($container, $path);
        }

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $definition = $container->getDefinition('Dbp\Relay\DispatchBundle\Service\BlobService');
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $definition = $container->getDefinition('Dbp\Relay\DispatchBundle\Service\DispatchService');
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $definition = $container->getDefinition(AuthorizationService::class);
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $definition = $container->getDefinition(GroupService::class);
        $definition->addMethodCall('setConfig', [$mergedConfig[Configuration::GROUP_NODE] ?? []]);

        $definition = $container->getDefinition(DualDeliveryService::class);
        $definition->addMethodCall('setConfig', [$mergedConfig]);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $this->addQueueMessageClass($container, RequestSubmissionMessage::class);
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        DoctrineConfiguration::prependEntityManagerConfig($container, self::DISPATCH_ENTITY_MANAGER_ID,
            $config['database_url'] ?? '',
            __DIR__.'/../Entity',
            'Dbp\Relay\DispatchBundle\Entity',
            self::DISPATCH_DB_CONNECTION_ID);
        DoctrineConfiguration::prependMigrationsConfig($container,
            __DIR__.'/../Migrations',
            'Dbp\Relay\DispatchBundle\Migrations');
    }
}
