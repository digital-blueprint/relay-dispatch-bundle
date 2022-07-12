<?php

declare(strict_types=1);

namespace DBP\API\DualDeliveryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_dual_delivery');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('database_url')->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
