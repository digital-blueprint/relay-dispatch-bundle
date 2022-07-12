<?php

declare(strict_types=1);

namespace DBP\API\DualDeliveryBundle\DependencyInjection;

use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpDualDeliveryExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    use ExtensionTrait;

    public function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

//        $cacheDef = $container->register('dbp.relay.cache.dual_delivery', FilesystemAdapter::class);
//        $cacheDef->setArguments(['dual_delivery', 3600, '%kernel.cache_dir%/dbp/dual_delivery']);
//        $cacheDef->addTag('cache.pool');
//
//        $definition = $container->getDefinition('DBP\API\DualDeliveryBundle\Service\DualDeliveryService');
//        $definition->addMethodCall('setCache', [$cacheDef]);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
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
                    'dbp_relay_dual_delivery_bundle' => [
                        'url' => $config['database_url'] ?? '',
                    ],
                ],
            ],
            'orm' => [
                'entity_managers' => [
                    'dbp_relay_dual_delivery_bundle' => [
                        'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                        'connection' => 'dbp_relay_dual_delivery_bundle',
                        'mappings' => [
                            'dbp_relay_dual_delivery' => [
                                'type' => 'annotation',
                                'dir' => __DIR__.'/../Entity',
                                'prefix' => 'DBP\API\DualDeliveryBundle\Entity',
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $container->prependExtensionConfig('doctrine_migrations', [
            'migrations_paths' => [
                'DBP\API\DualDeliveryBundle\Migrations' => __DIR__.'/../Migrations',
            ],
        ]);
    }
}
