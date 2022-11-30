<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const AUTHORIZATION_NODE = 'authorization';
    public const AUTHORIZATION_RIGHTS_NODE = 'rights';
    public const AUTHORIZATION_ATTRIBUTES_NODE = 'attributes';
    public const GROUP_READER = 'GROUP_READER';
    public const GROUP_WRITER = 'GROUP_WRITER';
    public const ADMIN = 'ADMIN';
    public const MANAGER = 'MANAGER';
    public const GROUPS_MAY_READ = 'GROUPS_MAY_READ';
    public const GROUPS_MAY_WRITE = 'GROUPS_MAY_WRITE';

    public const GROUP_NODE = 'group';
    public const GROUP_DATA_ADDRESS_ATTRIBUTES_NODE = 'address_attributes';
    public const GROUP_DATA_IRI_TEMPLATE = 'iri_template';
    public const GROUP_STREET_ATTRIBUTE = 'street';
    public const GROUP_LOCALITY_ATTRIBUTE = 'locality';
    public const GROUP_POSTAL_CODE_ATTRIBUTE = 'postal_code';
    public const GROUP_COUNTRY_ATTRIBUTE = 'country';

    private function getGroupNode(): NodeDefinition
    {
        $treeBuilder = new TreeBuilder(self::GROUP_NODE);

        $node = $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode(self::GROUP_DATA_IRI_TEMPLATE)
                    ->defaultValue('/base/organizations/%s')
                ->end()
                ->arrayNode(self::GROUP_DATA_ADDRESS_ATTRIBUTES_NODE)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(self::GROUP_STREET_ATTRIBUTE)
                            ->defaultValue('streetAddress')
                        ->end()
                        ->scalarNode(self::GROUP_LOCALITY_ATTRIBUTE)
                            ->defaultValue('addressLocality')
                        ->end()
                        ->scalarNode(self::GROUP_POSTAL_CODE_ATTRIBUTE)
                            ->defaultValue('postalCode')
                        ->end()
                        ->scalarNode(self::GROUP_COUNTRY_ATTRIBUTE)
                            ->defaultValue('addressCountry')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    private function getAuthNode(): NodeDefinition
    {
        $treeBuilder = new TreeBuilder(self::AUTHORIZATION_NODE);

        $node = $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode(self::AUTHORIZATION_RIGHTS_NODE)
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
                ->arrayNode(self::AUTHORIZATION_ATTRIBUTES_NODE)
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
            ->append($this->getGroupNode())
            ->append($this->getAuthNode())
            ->end();

        return $treeBuilder;
    }
}
