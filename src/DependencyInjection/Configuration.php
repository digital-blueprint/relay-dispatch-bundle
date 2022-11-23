<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const GROUP_READER = 'GROUP_READER';
    public const GROUP_WRITER = 'GROUP_WRITER';
    public const ADMIN = 'ADMIN';
    public const MANAGER = 'MANAGER';
    public const GROUPS_MAY_READ = 'GROUPS_MAY_READ';
    public const GROUPS_MAY_WRITE = 'GROUPS_MAY_WRITE';

    private function getAuthNode(): NodeDefinition
    {
        $treeBuilder = new TreeBuilder('authorization');

        $node = $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('rights')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(self::GROUP_READER)
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode(self::GROUP_WRITER)
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode(self::ADMIN)
                            ->defaultValue('false')
                        ->end()
                        ->scalarNode(self::MANAGER)
                            ->defaultValue('false')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('attributes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(self::GROUPS_MAY_READ)
                            ->defaultValue('[]')
                        ->end()
                            ->scalarNode(self::GROUPS_MAY_WRITE)
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
                ->scalarNode('sender_profile_version')
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
