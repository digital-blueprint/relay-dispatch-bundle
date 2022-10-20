<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Command\Debug2Command;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Dbp\Relay\DispatchBundle\Service\GroupService;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpRelayDispatchExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    use ExtensionTrait;

    public function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $pathsToHide = [
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

        $cacheDef = $container->register('dbp.relay.cache.dispatch', FilesystemAdapter::class);
        $cacheDef->setArguments(['dispatch', 3600, '%kernel.cache_dir%/dbp/dispatch']);
        $cacheDef->addTag('cache.pool');

        $definition = $container->getDefinition('Dbp\Relay\DispatchBundle\Service\DispatchService');
        $definition->addMethodCall('setCache', [$cacheDef]);
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $definition = $container->getDefinition(Debug2Command::class);
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $groupCache = $container->register('dbp.relay.cache.dispatch.groups', FilesystemAdapter::class);
        $groupCache->setArguments(['dispatch-groups', 60, '%kernel.cache_dir%/dbp/dispatch-groups']);
        $groupCache->setPublic(true);
        $groupCache->addTag('cache.pool');

        $definition = $container->getDefinition(GroupService::class);
        $definition->addMethodCall('setConfig', [$mergedConfig['campus_online'] ?? []]);
        $definition->addMethodCall('setCache', [$groupCache, 3600]);

        $definition = $container->getDefinition(AuthorizationService::class);
        $definition->addMethodCall('setConfig', [$mergedConfig['authorization'] ?? []]);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
        $this->addQueueMessageClass($container, RequestSubmissionMessage::class);
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        foreach (['doctrine', 'doctrine_migrations'] as $extKey) {
            if (!$container->hasExtension($extKey)) {
                throw new \Exception("'".$this->getAlias()."' requires the '$extKey' bundle to be loaded!");
            }
        }

        $container->prependExtensionConfig('doctrine', [
            'dbal' => [
                'connections' => [
                    'dbp_relay_dispatch_bundle' => [
                        'url' => $config['database_url'] ?? '',
                    ],
                ],
            ],
            'orm' => [
                'entity_managers' => [
                    'dbp_relay_dispatch_bundle' => [
                        'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                        'connection' => 'dbp_relay_dispatch_bundle',
                        'mappings' => [
                            'dbp_relay_dispatch' => [
                                'type' => 'annotation',
                                'dir' => __DIR__.'/../Entity',
                                'prefix' => 'Dbp\Relay\DispatchBundle\Entity',
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $this->registerEntityManager($container, 'dbp_relay_dispatch_bundle');

        $container->prependExtensionConfig('doctrine_migrations', [
            'migrations_paths' => [
                'Dbp\Relay\DispatchBundle\Migrations' => __DIR__.'/../Migrations',
            ],
        ]);
    }
}
