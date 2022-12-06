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
    public const GROUP_READER_METADATA = 'GROUP_READER_METADATA';
    public const GROUP_READER_CONTENT = 'GROUP_READER_CONTENT';
    public const GROUP_WRITER = 'GROUP_WRITER';
    public const GROUPS = 'GROUPS';

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
                        // Metadata in this case means everything a "physical" postmaster could know about a delivery.
                        // So source/target identities, date/time, but no content i.e. what was previously hidden in a
                        // letter, like the subject and the attachments.
                        ->scalarNode(self::GROUP_READER_METADATA)
                            ->defaultValue('false')
                            ->info('Returns true if the user has read access for the given group, limited to metadata.')
                        ->end()
                        ->scalarNode(self::GROUP_READER_CONTENT)
                            ->defaultValue('false')
                            ->info('Returns true if the user has read access for the given group, including delivery content. Implies the metadata reader role.')
                        ->end()
                        ->scalarNode(self::GROUP_WRITER)
                            ->defaultValue('false')
                            ->info('Returns true if the user has write access for the given group. Implies all reader roles.')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode(self::AUTHORIZATION_ATTRIBUTES_NODE)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(self::GROUPS)
                            ->defaultValue('[]')
                            ->info('Returns an array of group IDs.')
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
