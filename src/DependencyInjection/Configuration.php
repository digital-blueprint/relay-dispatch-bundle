<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_dispatch');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('database_url')->end()
            ->scalarNode('sender_profile')->end()
            ->scalarNode('cert_password')->end()
            ->scalarNode('cert_p12')->end()
            ->scalarNode('base_url')->end()
            ->scalarNode('delivery_request_url_part')->end()
            ->scalarNode('pre_addressing_request_url_part')->end()
            ->scalarNode('status_request_url_part')->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
