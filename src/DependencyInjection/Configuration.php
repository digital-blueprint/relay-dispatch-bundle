<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private function getAuthNode(): NodeDefinition
    {
        $treeBuilder = new TreeBuilder('authorization');

        $node = $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('rights')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('GROUP_READER')
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode('GROUP_WRITER')
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode('ADMIN')
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode('MANAGER')
                            ->defaultValue('false')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('attributes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('GROUPS')
                            ->defaultValue('[]')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_dispatch');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('database_url')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sender_profile')
                    ->isRequired()->cannotBeEmpty()
                ->end()
                ->scalarNode('cert_password')
                ->end()
                ->scalarNode('cert')
                ->end()
                ->scalarNode('base_url')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('delivery_request_url_part')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('pre_addressing_request_url_part')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('status_request_url_part')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end()
            ->append($this->getAuthNode())
            ->end();

        return $treeBuilder;
    }
}
