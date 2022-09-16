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
            ->scalarNode('database_url')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('sender_profile')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('cert_password')->end()
            ->scalarNode('cert_p12')->end()
            ->scalarNode('base_url')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('delivery_request_url_part')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('pre_addressing_request_url_part')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('status_request_url_part')->isRequired()->cannotBeEmpty()->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
